<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\SubscribeUser;
use App\Models\Subscription;
use App\Models\PaymentHistory;
use App\Models\User;
use Helper;

class UpdateLifetimeSubscription extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:search_limit';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update lifetime subscription search limit';

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
        $today = \Carbon\Carbon::today()->toDateString();
        $subscribe_users = SubscribeUser::whereDate('end_date',"<=",$today)
        ->whereStatus(1)
        ->whereHas('subscription',function($q){
            $q->where('billing_period','lifetime');
        })
        ->get();

        foreach($subscribe_users as $user){
            $user->status = '1';
            $user->end_date = date('Y-m-d H:i:s',strtotime('+30 days'));
            $user->save();
            $user->user->search_limit = 0;
            $user->user->save();
            
            $update_transaction = PaymentHistory::where('subscription_id',$user->subscription_id)
            ->where('user_id',$user->user_id)
            ->where('transaction_id',$user->transaction_id)
            ->first();
            if($update_transaction){
                $update_transaction->end_date = $user->end_date;
                $update_transaction->save();
            }
        }
        $this->info('Success');
    }
}
