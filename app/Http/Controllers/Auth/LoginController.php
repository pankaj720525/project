<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\User;
use App\Models\Subscription;
use Auth,Validator,Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
    }

    public function landing(Request $request){
        return view('landing');
    }

    public function exists_record(Request $request){

        $query = User::select('id');

        if($request->has('id'))
        {
            $query = $query->where('id','!=',$request->id);
        }

        $email = $query->where($request->column_name, $request->value)->count();

        if ($email)
        {
            echo 'false';
        }
        else
        {
            echo 'true';
        }
    }

    public function login(Request $request){
        if($request->method() == 'GET'){
            return view('auth.login');
        }elseif($request->method() == 'POST'){
            $request->validate([

            ]);

            $validator = Validator::make($request->all(), array(
                'email' => 'required|email',
                'password' => 'required',
            ));

            if ($validator->fails()) {
                return response()->json(['status'=>401, 'message' => $validator->messages()->first() ]);
            }
            $user = User::where(['email' => $request->email, 'is_delete' => 0])->first();
            if ($user) {
                if (\Hash::check($request->password, $user->password)) {
                    if($user->status == 1){
                        Auth::loginUsingId($user->id);
                        if($request->ajax()){
                            return response()->json(['status'=>200,'message'=>'Login successfully.']);
                        }else{
                            Session::flash('Success', 'Login successfully.');
                            return redirect()->intended('/dashboard');
                        }
                    }else{
                        if($request->ajax()){
                            return response()->json(['status'=>401,'message'=>'Your account is inactive.']);
                        }else{
                            Session::flash('error', 'Your account is inactive.');
                            return redirect()->back();
                        }
                    }
                }else{
                    if($request->ajax()){
                        return response()->json(['status'=>401,'message'=>'Invalid password.']);
                    }else{
                        Session::flash('error', 'Your account is inactive.');
                        return redirect()->back();
                    }
                }
            }else{
                if($request->ajax()){
                    return response()->json(['status'=>401,'message'=>'Email Address or Password Invalid.']);
                }else{
                    Session::flash('error', 'Email Address or Password Invalid.');
                    return redirect()->back();
                }
            }
        }
        return redirect('/');
    }

    public function register(Request $request){
        if($request->method() == 'POST'){
            $request->validate([
                'first_name' => 'required',
                'last_name' => 'required',
                // 'phone' => 'required',
                'email' => 'required|email',
                'password' => 'required|confirmed'
            ]);

            $input = $request->all();
            $input['time'] = strtotime("+30 minutes");
            session()->put('register_data',$input);
            return redirect()->route('subscription');
        }else{
            return view('auth.register');
        }
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
    /* Admin Login*/
    public function AdminLogin(Request $request){
        if($request->method() == 'GET'){
            return view('auth.backend.login');
        }elseif($request->method() == 'POST'){
            $validator = Validator::make($request->all(), array(
                'email' => 'required|email',
                'password' => 'required',
            ));

            if ($validator->fails()) {
                return response()->json(['status'=>401, 'message' => $validator->messages()->first() ]);
            }

            if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password,'status'=>1,'is_delete'=>0])) {
                if($request->ajax()){
                    return response()->json(['status'=>200,'message'=>'Login successfully.']);
                }else{
                    Session::flash('Success', 'Login successfully.');
                    return redirect()->intended('/admin/dashboard');
                }
            }else{
                if($request->ajax()){
                    return response()->json(['status'=>401,'message'=>'Email Address or Password Invalid.']);
                }else{
                    Session::flash('error', 'Email Address or Password Invalid.');
                    return redirect()->back();
                }
            }
        }
        return redirect('/');
    }
}
