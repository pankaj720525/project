<?php

namespace App\Console\Commands;

use App\Models\SubscribeUser;
use App\Models\Subscription;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Srmklive\PayPal\Services\ExpressCheckout;

class GeneralScript extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'general:script {type}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'General Script for One time usage';

    /**
     * Create a new command instance.
     *
     * @return void
     */


    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $type = $this->argument('type');
        echo "type : ".$type.PHP_EOL ;
        if($type == 'paypal_deduct_payment') {
            $this->paypal_deduct_payment();
        }else if($type == 'create_subscription_plan') {
            $this->create_subscription_plan();
        }
    }
    public function paypal_deduct_payment()
    {
        $provider = new ExpressCheckout();
        $subscription_users = SubscribeUser::with('subscription')->where('is_payment_received','0')->get();
        foreach($subscription_users as $paypal){
            $token = $paypal->profile_id;
            $this->info( $paypal->user_id);
            $receipt = json_decode($paypal->receipt,true);

            $response                = $provider->getExpressCheckoutDetails($token);
            $profile_desc            = $response['DESC'];
            $invoice_id = $response['INVNUM'];
            if (!in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {
                return redirect()->route('subscription')->with('error', 'Error processing PayPal payment');
            }
            $PayerID = $receipt['PAYERID'];
            $plan_detail = $paypal->subscription;
            $request_data = $this->preparePaypal($plan_detail, $invoice_id);
            $payment_status = $provider->doExpressCheckoutPayment($request_data, $token, $PayerID);
            Log::info("Paypal Do checkout Response" . json_encode($payment_status));
            $status = $payment_status['PAYMENTINFO_0_PAYMENTSTATUS'];
            $txn_id = $payment_status['PAYMENTINFO_0_TRANSACTIONID'];
            if (isset($payment_status['ACK']) && $payment_status['ACK'] == 'Failure') {


            }else{
                $paypal->is_payment_received = '1';
                $paypal->save();
            }
            sleep(3);
        }
    }
    public function preparePaypal($plan_detail, $invoice_id)
    {
        $items_arr[] = [
            "name"  => $plan_detail->package_name,
            "price" => $plan_detail->price,
            "qty"   => 1,
        ];
        $totalAmount = $plan_detail->price;

        $request_data = [
            'items'               => $items_arr,
            'return_url'          => route('paypal_subscription_success'),
            'invoice_id'          => $invoice_id,
            'invoice_description' => "Invoice #" . $invoice_id,
            'cancel_url'          => route('pricing'),
            'total'               => number_format($totalAmount, 2, '.', ''),
            'currency'            => 'USD',
        ];
        return $request_data;
    }
    public function create_subscription_plan(){
        $stripe = new \Stripe\StripeClient(env('STRIPE_API_KEY'));
        $price = $stripe->prices->all()->toArray();
        dd($price);
        $subscription = Subscription::where(['status'=>'1','billing_period'=>'month'])->get();
        foreach ($subscription as $key => $value) {
            $product = uniqid('prod_');
            $plan_details = $stripe->prices->create([
                'unit_amount' => ($value->price*100),
                'currency' => 'usd',
                'recurring' => ['interval' => 'month'],
                'product' => $product_id,
            ]);
            $value->stripe_price_id =  $plan_details->id;
            $value->save();
        }
        $subscription = Subscription::where(['status'=>'1','billing_period'=>'lifetime'])->first();
        $plan_details = $stripe->prices->create([
            'unit_amount' => ($subscription->price*100),
            'currency' => 'usd',
            'product' => $product_id,
        ]);
        $subscription->stripe_price_id =  $plan_details->id;
        $subscription->save();

    }
}
