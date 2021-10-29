<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Auth\Events\Verified;
use App\Models\User;
use App\Models\Subscription;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

    protected function verificationUrl($notifiable)
    {
        return \URL::temporarySignedRoute(
            'verification.verify',
            \Carbon\Carbon::now()->addMinutes(\Config::get('auth.verification.expire', 60)),
            [
                'id' => $notifiable->getKey(),
                'hash' => sha1($notifiable->getEmailForVerification()),
            ]
        );
    }
    
    protected function resend(Request $request){
        $user = auth()->user();
        if ($user->hasVerifiedEmail()) {
            return redirect()->route('home')->with('success','Your email address are already verified');
        }else{
            $data['name'] = $user->name;
            $data['email'] = $user->email;
            $data['email_subject'] = 'Legiit Leads - Verify Account';
            $data['verifiedurl'] = $this->verificationUrl($user);

            \Mail::send(['html' => 'mails.verification_account'], $data, function ($message) use ($data) {
                $message->to($data['email'])->subject($data['email_subject']);
            });
            return redirect()->back()->with('resent',true);
        }

    }
    protected function verify($key,Request $request)
    {
        $user = User::find($key);
        if(!empty($user->email_verified_at)){
            return redirect('login')->with('error','Your email address are already verified.');
        }
        if ($key != $user->getKey()) {
            throw new AuthorizationException;
        }
        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }
        if($user->subscribe != null){
            try {
                $subscription = Subscription::where('id',$user->subscribe->subscription_id)->first();
                $send = \Mail::send('mails.subscription_create', [
                    'plan_name'     => $subscription->package_name,
                    'plan_price'     => $subscription->price,
                    'billing_period' => $subscription->billing_period,
                    'name' => $user->name,
                ], function($message) use($user){
                    $message->subject('Legiit Leads -  Welcome to Legiit Leads');
                    $message->to($user->email);
                });
            } catch(\Exception $e){
                
            }
        }
        return redirect()->route('dashboard')->with('Success','Thank you, your account is verified successfully.');

    }
}
