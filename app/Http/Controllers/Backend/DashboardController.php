<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Models\User;
use App\Models\CampaignsMaster;
use Carbon\Carbon;
use Auth;
use Session;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $users_count = User::where('is_delete',0)->count();
        $today_users_count = User::where('is_delete',0)->whereDate('created_at', Carbon::today())->count();
        $campaigns_count = CampaignsMaster::where('is_delete',0)->count();
        $today_campaigns_count = CampaignsMaster::where('is_delete',0)->whereDate('created_at', Carbon::today())->count();
        if($request->ajax()){
            $view = view('backend.common.dashboard_widget',compact('users_count','campaigns_count','today_campaigns_count','today_users_count'))->render();
            return response()->json(['status' => 200, 'html' => $view]);
        }
        return view('backend.dashboard',compact('users_count','campaigns_count','today_campaigns_count','today_users_count'));
    }

    public function change_password(Request $request){
        $admin = Admin::where('id',Auth::user()->id)->first();
        if($admin){
            if(Hash::check($request->oldpassword, $admin->password)){
                $admin->password = Hash::make($request->password);
                $admin->save();
                Session::flash('Success','Password has been changed successfully.');
            }else{
                Session::flash('error','Current password is incorrect.');
            }
        }else{
            Session::flash('error','Something went wrong.');
        }
        return redirect()->back();    
    }
    
    public function check_password(Request $request){
        $admin = Admin::where('id',Auth::user()->id)->first();
        if (\Hash::check($request->password, $admin->password)) {
            echo "true";
        }else{
            echo "false";
        }    
    }


    public function logout()
    {
    	Auth::logout();
        Session::flash('Success','Logout successfully.');
    	return redirect('/admin');
    }
}
