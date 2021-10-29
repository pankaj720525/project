<?php

namespace App\Http\Controllers;

use App\Models\SubscribeUser;
use App\Models\Subscription;
use App\Models\CampaignsMaster;
use App\Models\PaymentHistory;
use App\Models\User;
use Carbon\Carbon;
use Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Session,Log;

class StripePayment extends Controller
{

    protected $provider;

    public function __construct()
    {
        \Stripe\Stripe::setApiKey(env('STRIPE_API_KEY'));
    }
    public function prepareData($plan_detail)
    {

        $items_arr[] = [
            "price"  => $plan_detail->stripe_price_id,
            "quantity"   => 1,
        ];
        $request_data = [
            'line_items'=>$items_arr,
            'customer' => $plan_detail->customer_id,
            'success_url'          => route('stripe_subscription_success'),
            'payment_method_types' => ['card'],
            'cancel_url'          => route('pricing'),
        ];
        if($plan_detail->billing_period !== 'lifetime'){
            $request_data['mode'] = 'subscription';
        }else{
            $request_data['mode'] = 'payment';
        }
        return $request_data;
    }
    public function pricing(Request $request){
        Session::forget('plan_id');
        Session::forget('register_data');
        return redirect()->route('subscription');
    }

    public function callbackIPN(Request $request){

    }
    public function createSubscription(Request $request)
    {
        $direct_register = "False";
        if(!Auth::check()){
            if(Session::has('plan_id') && !empty(Session::get('plan_id'))){
                $request->request->add(['plan_id' => Session::get('plan_id')]);
                $direct_register = "True";
            }
        }else{
            Session::forget('plan_id');
        }

        if ($request->method() == 'POST' || $direct_register == "True") {
            $request->validate([
                'plan_id' => 'required',
            ]);
            if (Session::has('register_data') && empty(Session::get('register_data'))) {
                Session::flash('error', 'Session timeout.!');
                return redirect()->route('register');
            } else if (!Session::has('register_data')) {
                Session::put('plan_id',$request->plan_id);
                return redirect()->route('register');
            }
            $plan_detail = Subscription::findOrFail(Helper::getDecrypted($request->plan_id));
            if ($plan_detail == null) {
                return redirect()->back()->with('error', 'Plan id not exists');
            }
            $stripe = new \Stripe\StripeClient(env('STRIPE_API_KEY'));
            $customer = $stripe->customers->create(['email'=>@Session::get('register_data')['email']]);
            if($customer){
                $plan_detail->customer_id = $customer->id;
            }
            $request_data = $this->prepareData($plan_detail);
            try {
                $session = \Stripe\Checkout\Session::create($request_data);
                session()->put(['stripe_id'=>$session->id,'customer'=>$customer->id]);
                if (!$session->url) {
                    return redirect()->route('subscription')->with('error', 'Something went wrong with Stripe');
                } else {
                    session()->put(["plan_id" => $request->plan_id]);
                    return redirect($session->url);
                }
            } catch (\Exception $e) {
                return redirect()->route('subscription')->with('error',$e->getMessage());
            }
        } else {
            $user_plan = array();
            if(Auth::check()){
                $user_plan = SubscribeUser::with('subscription')->where('user_id',Auth()->id())->orderby('end_date','desc')->first();
            }
            $subscriptions = Subscription::where('status', 1)->where('is_delete', 0)->get();
            return view('subscription', compact('subscriptions','user_plan'));
        }
    }

    public function paypalSuccess(Request $request)
    {
        $plan_detail = Subscription::findOrFail(Helper::getDecrypted(session('plan_id')));
        $request->request->add(['subscribe' => session('plan_id')]);
        return $this->registerUser($request, session('stripe_id'), []);

    }

    protected function verificationUrl($notifiable)
    {
        return \URL::temporarySignedRoute(
            'verification.verify',
            \Carbon\Carbon::now()->addMinutes(\Config::get('auth.verification.expire', 60)),
            [
                'id'   => $notifiable->getKey(),
                'hash' => sha1($notifiable->getEmailForVerification()),
            ]
        );
    }

    protected function registerUser(Request $request, $txn_id, $response)
    {
        if (Session::get('register_data') && Session::get('register_data') != '') {
            $input = Session::get('register_data');
            if ($request->has('subscribe')) {
                $subscription = Subscription::where('id', Helper::getDecrypted($request->subscribe))
                    ->where('status', 1)
                    ->first();
                if ($subscription) {
                    $customer_id = Session::get('customer');
                    Session::forget('register_data');
                    Session::forget('subscribe');
                    Session::forget('plan_id');
                    $user             = new User;
                    $user->first_name = $input['first_name'];
                    $user->last_name  = $input['last_name'];
                    $user->name       = $input['first_name'] . " " . $input['last_name'];
                    $user->email    = $input['email'];
                    $user->password = Hash::make($input['password']);
                    $user->save();
                    $stripe = new \Stripe\StripeClient(env('STRIPE_API_KEY'));
                    if($subscription->billing_period !== 'lifetime'){
                        $receipt = $stripe->subscriptions->all(['limit' => 1,'customer'=>$customer_id,'status'=>'active']);
                    }else{
                        $receipt = $stripe->paymentIntents->all(['limit' => 1,'customer'=>$customer_id]);
                    }
                    try {
                        $data['name']          = $user->name;
                        $data['email']         = $user->email;
                        $data['email_subject'] = 'Legiit Leads - Verify Account';
                        $data['verifiedurl']   = $this->verificationUrl($user);

                        \Mail::send(['html' => 'mails.verification_account'], $data, function ($message) use ($data) {
                            $message->to($data['email'])->subject($data['email_subject']);
                        });
                    } catch (\Exception $e) {
                        Session::flash('error', 'Verification mail does not send.!');
                    }
                    $txn_id =  @$receipt->data[0]->id;
                    Auth::loginUsingId($user->id);
                    User::where('id', $user->id)->update(['is_login_first' => 0, 'last_login' => now()]);
                    if (isset($txn_id) && $txn_id != "") {
                        $subscribe_user                      = new SubscribeUser;
                        $subscribe_user->user_id             = $user->id;
                        $subscribe_user->subscription_id     = Helper::getDecrypted($request->subscribe);
                        $subscribe_user->profile_id          = $txn_id;
                        $subscribe_user->status              = 1;
                        $subscribe_user->transaction_id      = $customer_id;
                        $subscribe_user->search_result_limit = $subscription->no_of_result;
                        $subscribe_user->receipt             = json_encode($receipt->data[0]->toArray());
                        $subscribe_user->profile_start_date  = date('Y-m-d H:i:s');
                        $subscribe_user->end_date            = date('Y-m-d H:i:s', strtotime('+30 days'));
                        $subscribe_user->is_payment_received = 1;
                        $subscribe_user->save();
                        Helper::createPaymentHistory([
                            "transaction_id"  => $txn_id,
                            "user_id"         => $subscribe_user->user_id,
                            "subscription_id" => $subscribe_user->subscription_id,
                            "amount"          => $subscription->price,
                            "start_date"      => $subscribe_user->profile_start_date,
                            "end_date"        => $subscribe_user->end_date
                        ]);
                    }else{
                        $subscribe_user                      = new SubscribeUser;
                        $subscribe_user->user_id             = $user->id;
                        $subscribe_user->subscription_id     = Helper::getDecrypted($request->subscribe);
                        $subscribe_user->profile_id          = uniqid('STRIPE');
                        $subscribe_user->status              = 1;
                        $subscribe_user->transaction_id      = $customer_id;
                        $subscribe_user->search_result_limit = $subscription->no_of_result;
                        $subscribe_user->receipt             = json_encode(Session::all());
                        $subscribe_user->profile_start_date  = date('Y-m-d H:i:s');
                        $subscribe_user->end_date            = date('Y-m-d H:i:s', strtotime('+30 days'));
                        $subscribe_user->is_payment_received = 0;
                        $subscribe_user->save();
                    }

                    Session::flash('Success', 'Your subscription profile setup successfully.');
                    return redirect()->route('dashboard');
                }
            } else {
                Session::flash('error', 'Something went wrong.!');
                return redirect()->route('subscription');
            }
        } else {
            Session::flash('error', 'Session timeout.!');
            return redirect()->route('subscription');
        }
    }
    public function changeSubscription(Request $request)
    {
        $user = auth()->user();
        $request->validate([
            'plan_id' => 'required',
        ]);
        $stripe = new \Stripe\StripeClient(env('STRIPE_API_KEY'));
        $plan_detail = Subscription::findOrFail(Helper::getDecrypted($request->plan_id));
        $old_plan_detail = SubscribeUser::where(['user_id' => $user->id])->first();

        if ($plan_detail == null || $old_plan_detail == null) {
            return redirect()->back()->with('error', 'Something went wrong....');
        }

        if ($old_plan_detail->subscription->billing_period == 'lifetime') {
            return redirect()->back()->with('error', 'Sorry! You weren\'t able to change your plan.');
        }
        if ($old_plan_detail->profile_id != "") {
            try{
                $cancel = $stripe->subscriptions->cancel($old_plan_detail->profile_id,[]);
                if(!$cancel){
                    return redirect()->back()->with('error', 'Something went wrong....');
                }
            }catch(\Exception $e){
                if(!strstr($e->getMessage(),'No such customer')){
                    $customer = $stripe->customers->create(['email'=>$user->email]);
                }
                if(!strstr($e->getMessage(),'No such subscription')){
                    return redirect()->back()->with('error', 'Something went wrong....');
                }
            }
        }
        session()->put(["plan_id" => $plan_detail->id]);
        try{
            $invoice_id = uniqid('Order');
            $plan_detail->customer_id = $old_plan_detail->transaction_id;
            $request_data = $this->prepareData($plan_detail);
            $request_data['success_url'] = route('stripe_update_success');
            $session = \Stripe\Checkout\Session::create($request_data);
            session()->put(['stripe_id'=>$session->id,'customer'=>$old_plan_detail->transaction_id]);

        }catch(\Exception $e){
            if(strstr($e->getMessage(),'No such customer')){
                $customer = $stripe->customers->create(['email'=>$user->email]);
                $plan_detail->customer_id = $customer->id;
                $request_data = $this->prepareData($plan_detail);
                $request_data['success_url'] = route('stripe_update_success');
                $session = \Stripe\Checkout\Session::create($request_data);
                session()->put(['stripe_id'=>$session->id,'customer'=>$customer->id]);
            }else if(!strstr($e->getMessage(),'No such subscription')){
                return redirect()->back()->with('error', 'Something went wrong....');
            }
        }
        if (!$session->url) {
            return redirect()->route('subscription')->with('error', 'Something went wrong with Stripe');
        } else {
            Session::forget('plan_id');
            session()->put(["plan_id" => $plan_detail->id]);
            return redirect($session->url);
        }

        return redirect()->route('subscription')->with('error', 'Something went wrong with Stripe');

    }

    public function paypalUpdateSuccess(Request $request)
    {
        $user            = auth()->user();
        $old_plan_detail = SubscribeUser::where(['user_id' => $user->id])->first();
        $token           = $request->get('token');
        $plan_detail     = Subscription::where('id', session('plan_id'))->first();
        $stripe = new \Stripe\StripeClient(env('STRIPE_API_KEY'));
        $customer_id = session('customer');
        if($plan_detail!=null && $plan_detail->billing_period !== 'lifetime'){
            $receipt = $stripe->subscriptions->all(['limit' => 1,'customer'=>$customer_id,'status'=>'active']);
        }else{
            $receipt = $stripe->paymentIntents->all(['limit' => 1,'customer'=>$customer_id]);
        }

        if (in_array( $receipt->data[0]->status,['active','succeeded'])) {
            $subscribe_user                      = SubscribeUser::firstOrCreate(['user_id' => $user->id]);
            $subscribe_user->user_id             = $user->id;
            $subscribe_user->subscription_id     = $plan_detail->id;
            $subscribe_user->profile_id          = $receipt->data[0]->id;
            $subscribe_user->is_cancel               = 0;
            $subscribe_user->status              = 1;
            $subscribe_user->receipt             = json_encode( $receipt->data[0]);
            $subscribe_user->profile_start_date  = date('Y-m-d H:i:s');
            $subscribe_user->end_date            = date('Y-m-d H:i:s', strtotime('+30 days'));
            $subscribe_user->is_payment_received = 1;
            $subscribe_user->save();
            if ($old_plan_detail->subscription->price > $plan_detail->price) {
                $type = "2";
            } else {
                $type = "1";
            }
            Helper::createPaymentHistory([
                "transaction_id"  => $subscribe_user->transaction_id,
                "user_id"         => $subscribe_user->user_id,
                "subscription_id" => $subscribe_user->subscription_id,
                "amount"          => $plan_detail->price,
                "start_date"      => $subscribe_user->profile_start_date,
                "end_date"        => $subscribe_user->end_date
            ], $type);
            try {
                Session::forget('register_data');
                Session::forget('subscribe');
                Session::forget('plan_id');
                $send = \Mail::send('mails.subscription_update', [
                    'plan_name'  => $plan_detail->package_name,
                    'plan_price' => $plan_detail->price,
                    'billing_period' => $plan_detail->billing_period,
                    'name'       => $user->name,
                ], function ($message) use ($user) {
                    $message->subject('Your plan has been updated');
                    $message->to($user->email);
                });
            } catch (\Exception $e) {

            }
            return redirect()->route('home')->with('Success', 'Subscription plan update successfully');
        } else {
            return redirect()->route('subscription')->with('error', 'Error processing PayPal payment');
        }
    }

    public function webhook(Request $request)
    {

        $event1 = $request->all();
        Log::info("======Request Data============");
        Log::info(json_encode($event1));
        Log::info("======Request Data============");
        Log::info(json_encode($request->header()));
        Log::info("===================");
        // Parse the message body and check the signature
        $webhookSecret = env('STRIPE_WEBHOOK_SECRET');
        $sign = \hash_hmac('sha256', file_get_contents("php://input"), $webhookSecret);
        if ($webhookSecret) {
            try {
                // $event = \Stripe\Webhook::constructEvent(
                // file_get_contents("php://input"),
                // $_SERVER['HTTP_STRIPE_SIGNATURE'],
                // $webhookSecret
                // );
            } catch (\Exception $e) {
                // return response()->json([ 'error' => $e->getMessage() ,'signature'=>$sign,'webhookSecret'=>$webhookSecret],403);
            }
        } else {
            $event = $request->all();
        }
        $event = $request->all();
        $type = @$event['type'];
        $object = @$event['data']['object'];

        switch ($type) {
        case 'checkout.session.completed':
            $subscribe_user = SubscribeUser::with('subscription')->where('transaction_id',$object['customer'])->orWhere('profile_id',$object['id'])->first();
            if($subscribe_user!=null){
                $subscribe_user->is_payment_received = 1;
                $subscribe_user->profile_id = $object['id'];
                $subscribe_user->save();
                $history = PaymentHistory::where(['user_id'=>$subscribe_user->user_id,'subscription_id'=>$subscribe_user->profile_id,'is_upgrade'=>'0'])->first();
                if($history==null){
                    Helper::createPaymentHistory([
                        "transaction_id"  => $subscribe_user->transaction_id,
                        "user_id"         => $subscribe_user->user_id,
                        "subscription_id" => $subscribe_user->subscription_id,
                        "amount"          => $subscribe_user->subscription->price,
                        "start_date"      => $subscribe_user->profile_start_date,
                        "end_date"        => $subscribe_user->end_date
                    ], '0');
                }
            }
        case 'customer.subscription.created':
            if($object['status']=='active'){
                $subscribe_user = SubscribeUser::with('subscription')->where('transaction_id',$object['customer'])->orWhere('profile_id',$object['id'])->first();
                if($subscribe_user!=null){
                    $subscribe_user->is_payment_received = 1;
                    $subscribe_user->profile_id = $object['id'];
                    $subscribe_user->is_renew = $subscribe_user->is_renew + 1;
                    $subscribe_user->end_date = Carbon::parse($object['ended_at'])->addDays(1);
                    $subscribe_user->save();
                    $history = PaymentHistory::where(['user_id'=>$subscribe_user->user_id,'subscription_id'=>$subscribe_user->profile_id,'is_upgrade'=>'0'])->first();
                    if($history==null){
                        Helper::createPaymentHistory([
                            "transaction_id"  => $subscribe_user->transaction_id,
                            "user_id"         => $subscribe_user->user_id,
                            "subscription_id" => $subscribe_user->subscription_id,
                            "amount"          => $subscribe_user->subscription->price,
                            "start_date"      => $subscribe_user->profile_start_date,
                            "end_date"        => $subscribe_user->end_date
                        ], '0');
                    }
                }
            }
        case 'customer.subscription.updated':
            if($object['status']=='active'){
                $subscribe_user = SubscribeUser::with('subscription')->where('transaction_id',$object['customer'])->orWhere('profile_id',$object['id'])->first();
                if($subscribe_user!=null){
                    $subscribe_user->is_renew = $subscribe_user->is_renew + 1;
                    $subscribe_user->end_date = Carbon::parse($object['ended_at']);
                    $subscribe_user->save();
                    Helper::createPaymentHistory([
                        "transaction_id"  => $subscribe_user->profile_id,
                        "user_id"         => $subscribe_user->user_id,
                        "subscription_id" => $subscribe_user->subscription_id,
                        "amount"          => $subscribe_user->subscription->price,
                        "start_date"      => $subscribe_user->profile_start_date,
                        "end_date"        => $subscribe_user->end_date
                    ], '3');
                }
            }
            break;
        case 'invoice.paid':
            // Continue to provision the subscription as payments continue to be made.
            // Store the status in your database and check when a user accesses your service.
            // This approach helps you avoid hitting rate limits.
            break;
        case 'invoice.payment_failed':
            // The payment failed or the customer does not have a valid payment method.
            // The subscription becomes past_due. Notify your customer and send them to the
            // customer portal to update their payment information.
            break;
        // ... handle other event types
        default:
            // Unhandled event type
        }

        return response()->json([ 'status' => 'success' ],200);
    }

    public function cancelSubscription(Request $request){
        $subscription = SubscribeUser::where('user_id',auth()->id())->first();
        if($subscription != null){
            if($subscription->is_cancel == 0){
                try {
                    $stripe = new \Stripe\StripeClient(env('STRIPE_API_KEY'));
                    $cancelled = $stripe->subscriptions->cancel($subscription->profile_id);
                    $subscription->is_cancel="1";
                    $subscription->save();
                } catch (\Exception $e) {
                    if(!strstr($e->getMessage(),'No such subscription')){
                        return redirect()->back()->with('error', 'Something went wrong....');
                    }
                }
                $subscription->is_cancel='1';
                $subscription->save();
                return response()->json(['status'=>'success',"message"=>'Subscription has been cancelled successfully','url'=>route('dashboard')],200);
            }
            return response()->json(['status'=>'fail',"message"=>'Your subscription is already cancelled','url'=>route('dashboard')],200);

        }else{
            return response()->json(['status'=>'fail',"message"=>'Subscription not found'],401);
        }
    }
}
