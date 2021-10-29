<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Srmklive\PayPal\Services\ExpressCheckout;
use App\Models\SubscribeUser;
use App\Models\User;
use Helper;

class PaypalSubscriptionExpiry extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'paypal:expiry';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check Paypal expiry and renewal for current subscription';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $provider = new ExpressCheckout();
        $today = \Carbon\Carbon::today()->toDateString();
        $subscribe_users = SubscribeUser::whereDate('end_date',"<=",$today)->whereNotNull('profile_id')
        ->whereStatus(1)
        ->whereHas('subscription',function($q){
            $q->where('billing_period','!=','lifetime');
        })
        ->get();
        if($subscribe_users!=null && count($subscribe_users)>0){
            foreach($subscribe_users as $user){
                if($user->profile_id!="" && !empty($user->profile_id)){
                    $response = $provider->getRecurringPaymentsProfileDetails($user->profile_id);
                    $gross_date = date('Y-m-d',strtotime('+3 days'));
                    $this->info($response['ACK']);
                    if($response['ACK']=='Success' && $response['STATUS']=='Active'){
                        $next_bill_date = date('Y-m-d',strtotime($response['NEXTBILLINGDATE']));
                        $this->info($gross_date);
                        $this->info( date('Y-m-d'));
                        $this->info(json_encode($response));
                        if($next_bill_date != $user->end_date && $next_bill_date > date('Y-m-d')){
                            $user->status = '1';
                            $user->end_date = date('Y-m-d H:i:s',strtotime($response['NEXTBILLINGDATE']));
                            $user->is_payment_received  = 1;
                            $user->save();
                            User::where('id',$user->user_id)->update(['search_limit' => 0]);
                            Helper::createPaymentHistory([
                                "transaction_id"=>$response['PROFILEID'],
                                "user_id"=>$user->user_id,
                                "subscription_id"=>$user->subscription_id,
                                "transaction_id"=>uniqid('Trans'),
                                "amount"=>$response['AMT'],
                                "start_date"=>date('Y-m-d H:i:s'),
                                "end_date"=>$user->end_date
                            ]);
                        }else if($gross_date == date('Y-m-d')){
                            $user->status = '0';
                            // $user->end_date = date('Y-m-d H:i:s',strtotime('+30 days'));
                            $user->is_payment_received  = 0;
                            $user->save();
                        }
                    }else{
                        $user->status = '0';
                        $user->is_payment_received  = 0;
                        $user->save();
                    }
                }else if($user->subscription!=null && $user->subscription->price <= 0){
                    $user->status = '0';
                    $user->is_payment_received  = 0;
                    $user->save();
                }
            }
        }
        return 0;
    }
}
