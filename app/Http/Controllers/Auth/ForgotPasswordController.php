<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

use Illuminate\Contracts\Auth\PasswordBroker;
use Illuminate\Http\Request;
use App\Models\User;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        
        $user = User::where('email',$request->email)->where('is_delete',0)->where('status',1)->first();
        if($user){
            $data['name'] = $user->name;
            $data['email'] = $user->email;
            $data['reseturl'] = route('password.reset',[app('auth.password.broker')->createToken($user),'email' => $user->email]);
            $data['email_subject'] = 'Legiit Leads - Change Password';

            \Mail::send(['html' => 'mails.forgotpassword'], $data, function ($message) use ($data) {
                $message->to($data['email'])->subject($data['email_subject']);
            });
            return redirect()->back()->with('status','We have emailed your password reset link!');
        }else{
            return redirect()->back()->with('error','We can\'t find a user with that email address.');
        }
    }

}
