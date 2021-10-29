<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\Helper as HelpersHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\PaymentHistory;
use App\Models\SubscribeUser;
use App\Models\Subscription;
use Exception;
use Helper;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $limit = 10;

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = User::where('is_delete',0);
        if($request->ajax()){
            $general_search = $request->search;
            if($general_search != ""){
                $query = $query->where(function ($q) use ($general_search){
                    $q->where('name', 'LIKE', '%' . $general_search . '%');
                    $q->orWhere('email', 'LIKE', '%' . $general_search . '%');
                    $q->orWhere('created_at', 'LIKE', '%' . $general_search . '%');
                });
            }
            if($request->status){
                $query = $query->where('status',$request->status);
            }
            if($request->orderby != "" || $request->orderbycolumn != ""){
                $query = $query->orderBy($request->orderbycolumn,$request->orderby);
            }else{
                $query = $query->orderBy('id','desc');
            }
            $users = $query->paginate($this->limit)->appends($request->all());
            $view = view('backend.users.include.dynamicTableData',compact('users'))->render();
            return response()->json(['status' => 200, 'html' => $view]);
        }
        $users = $query->orderBy('id','desc')->paginate($this->limit)->appends($request->all());
        return view('backend.users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function paymentHistory(Request $request)
    {
        $query = PaymentHistory::select('*');
        $query = PaymentHistory::select('payment_histories.*','subscriptions.package_name','users.name as user_name','users.email as user_email');

        $query = $query->join('subscriptions', 'subscriptions.id', '=', 'payment_histories.subscription_id');
        $query = $query->join('users', 'users.id', '=', 'payment_histories.user_id');
        $general_search = $request->search;
        if($request->has('status') && $request->status!="All"){
            $query =  $query->where('payment_histories.is_upgrade', $request->status);
        }
        if($general_search != ""){
            $query = $query->where(function ($q) use ($general_search){
                $q->where('payment_histories.transaction_id', 'LIKE', '%' . $general_search . '%');
                $q->orWhere('users.name', 'LIKE', '%' . $general_search . '%');
                $q->orWhere('users.email', 'LIKE', '%' . $general_search . '%');
                $q->orWhere('subscriptions.package_name', 'LIKE', '%' . $general_search . '%');
            });
        }
        if($request->ajax()){
            if($request->orderby != "" || $request->orderbycolumn != ""){
                $query = $query->orderBy($request->orderbycolumn,$request->orderby);
            }else{
                $query = $query->orderBy('payment_histories.id','desc');
            }
            $transactions = $query->orderBy('payment_histories.id','desc')->paginate($this->limit)->appends($request->all());
            $view = view('backend.payment_history.include.dynamicTableData',compact('transactions'))->render();
            return response()->json(['status' => 200, 'html' => $view]);
        }
        $transactions = $query->orderBy('payment_histories.id','desc')->paginate($this->limit)->appends($request->all());
        return view('backend.payment_history.index',compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $plans = Subscription::where('is_delete',0)->where('status',1)->pluck('package_name','id')->toArray();
        return view('backend.users.add',compact('plans'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "first_name"    => "required",
            "last_name"    => "required",
            "email"    => "required|email|unique:users",
            "plan"    => "required",
            "password"    => "required|confirmed",
            "password_confirmation"    => "required",
        ]);
        $input=$request->all();
        $user = new User;
        $user->first_name = $input['first_name'];
        $user->last_name  = $input['last_name'];
        $user->name       = $input['first_name'] . " " . $input['last_name'];
        $user->email    = $input['email'];
        $user->password = Hash::make($input['password']);
        $user->is_login_first = 0;
        $user->last_login =now();
        $user->email_verified_at =now();
        try{
            if($user->save()){
                $subscription = Subscription::findOrFail($request->plan);
                $txn_id = $request->transaction_id!="" ? $request->transaction_id : uniqid('ADMIN');
                $subscribe_user                      = new SubscribeUser;
                $subscribe_user->user_id             = $user->id;
                $subscribe_user->subscription_id     = $request->plan;
                $subscribe_user->profile_id          = $txn_id;
                $subscribe_user->status              = 1;
                $subscribe_user->transaction_id      = $txn_id;
                $subscribe_user->search_result_limit = $subscription->no_of_result;
                $subscribe_user->profile_start_date  = date('Y-m-d H:i:s');
                $subscribe_user->end_date            = date('Y-m-d H:i:s', strtotime('+30 days'));
                $subscribe_user->is_payment_received = 1;
                $subscribe_user->save();
                Helper::createPaymentHistory([
                    "transaction_id"  => $txn_id,
                    "user_id"         => $subscribe_user->user_id,
                    "subscription_id" => $subscribe_user->subscription_id,
                    "search_limit"  => $subscription->search_limit,
                    "transaction_id"  => $txn_id,
                    "amount"          =>  $subscription->price,
                    "start_date"      => $subscribe_user->profile_start_date,
                    "end_date"        => $subscribe_user->end_date
                ]);
                return redirect()->route('user.index')->with('Success','User created successfully.');
            }
        }catch(\Exception $e){
            return redirect()->back()->with('error',$e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::where('id',Helper::getDecrypted($id))->where('is_delete',0)->first();
        $plans = Subscription::where('is_delete',0)->where('status',1)->pluck('package_name','id')->toArray();

        if($user){
            return view('backend.users.edit',compact('user','id','plans'));
        }
        return redirect()->back()->with('error','Something went wrong.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $update = User::where('id',Helper::getDecrypted($id))->where('is_delete',0)->first();
        if($update){
            if($request->has('type') && $request->type = 'password'){
                $request->validate([
                    "password"    => "required|confirmed",
                ]);

                $update->password = \Hash::make($request->password);
                $update->save();

                return redirect()->back()->with('Success','Password has been changed successfully.');
            }else{
                $request->validate([
                    "first_name"    => "required",
                    "last_name"    => "required",
                ]);
                if($request->plan && ($update->subscribe ==null || $request->plan!=$update->subscribe->subscription_id)){
                    $subscription = Subscription::findOrFail($request->plan);
                    $txn_id = $request->transaction_id!="" ? $request->transaction_id : uniqid('ADMIN');
                    $subscribe_user =  SubscribeUser::where('user_id',$update->id)->first();
                    if($subscribe_user==null){
                        $subscribe_user = new SubscribeUser;
                    }
                    $subscribe_user->user_id             = $update->id;
                    $subscribe_user->subscription_id     = $request->plan;
                    $subscribe_user->profile_id          = $txn_id;
                    $subscribe_user->status              = 1;
                    $subscribe_user->transaction_id      = $txn_id;
                    $subscribe_user->search_result_limit = $subscription->no_of_result;
                    $subscribe_user->profile_start_date  = date('Y-m-d H:i:s');
                    $subscribe_user->end_date            = date('Y-m-d H:i:s', strtotime('+30 days'));
                    $subscribe_user->is_payment_received = 1;
                    $subscribe_user->save();
                    Helper::createPaymentHistory([
                        "transaction_id"  => $txn_id,
                        "user_id"         => $subscribe_user->user_id,
                        "subscription_id" => $subscribe_user->subscription_id,
                        "search_limit"  => $subscription->search_limit,
                        "transaction_id"  => $txn_id,
                        "amount"          =>  $subscription->price,
                        "start_date"      => $subscribe_user->profile_start_date,
                        "end_date"        => $subscribe_user->end_date
                    ]);
                }
                $update->first_name = $request->first_name;
                $update->last_name = $request->last_name;
                $update->name =  $request->first_name . " " . $request->last_name;
                $update->save();

                return redirect()->route('user.index')->with('Success','User details has been updated successfully');
            }
        }
        return redirect()->back()->with('error','Something went wrong.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id = Helper::getDecrypted($id);
        $delete = User::where('is_delete',0)->where('id',$id)->first();
        if($delete){
            $delete->is_delete = 1;
            $delete->save();
            return response()->json(['status' => 200, 'message' => 'User has been deleted sucessfully.']);
        }
        return response()->json(['status' => 401, 'message' => 'Something went wrong. Please try again sometime.']);
    }

    /**
     * change status.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function changeStatus(Request $request, $id, $status)
    {
        $id = Helper::getDecrypted($id);
        $changeStatus = User::find($id);
        if($changeStatus){
            if($request->status == 1){
                $status = 2;
            }else{
                $status = 1;
            }
            $changeStatus->status = $status;
            $changeStatus->save();
            return response()->json(['status' => 200, 'message' => 'Status changed sucessfully.']);
        }
        return response()->json(['status' => 401, 'message' => 'Something went wrong. Please try again sometime.']);
    }
}
