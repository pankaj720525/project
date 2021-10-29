<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MemberContent;
use App\Models\CampaignsMaster;
use App\Models\EmailTemplate;
use App\Models\User;
use Auth;
use Session;
use Helper;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $member_contents = MemberContent::where('status',1)
        ->where('is_delete',0)
        ->whereNotNull('videolink')
        ->inRandomOrder()
        ->limit(3)
        ->orderby('updated_at')
        ->get();

        $campaigns = CampaignsMaster::select('campaigns_masters.*','search_types.name as search_type')
        ->where('user_id',Auth::user()->id)
        ->where('campaigns_masters.is_delete',0)
        ->join('search_types', 'search_types.id', '=', 'campaigns_masters.search_type_id')
        ->orderby('campaigns_masters.id','desc')
        ->limit(10)
        ->get();

        $last_search_type = CampaignsMaster::select('search_types.slug as slug')
        ->where('user_id',Auth::user()->id)
        ->where('campaigns_masters.is_delete',0)
        ->join('search_types', 'search_types.id', '=', 'campaigns_masters.search_type_id')
        ->orderby('campaigns_masters.id','desc')
        ->first();
        if(empty($last_search_type)){
            $last_search_type = env('DEFAULT_SERVICE_TYPE');
        }else{
            $last_search_type = $last_search_type->slug;
        }

        $last_search_type = Helper::getEncrypted($last_search_type);
        // $legiit_services = array();

        // $token = Helper::getToken();
        // if(isset($token['access_token']) && $token['access_token'] != ""){
        //     $response = Helper::callLegiitServiceApi($last_search_type,$token['access_token']);
        //     if(isset($response['success']) && $response['success'] == true){
        //         $legiit_services = $response['services'];
        //     }
        // }

        return view('frontend.dashboard',compact('member_contents','campaigns','last_search_type'));
    }

    /** Load Legiit Servies**/
    public function loadLegiitServices(Request $request, $last_search_type){

        $legiit_services = array();
        $token = Helper::getToken();
        if(isset($token['access_token']) && $token['access_token'] != ""){
            $response = Helper::callLegiitServiceApi(Helper::getDecrypted($last_search_type),$token['access_token']);
            if(isset($response['success']) && $response['success'] == true){
                $legiit_services = $response['services'];
            }
        }
        $view = view('frontend.include.loadLegiitService',compact('legiit_services'))->render();
        return response()->json(['status' => 200, 'html' => $view]);
    } 
    /** Filter Past search**/
    public function filterPastSearch(Request $request){
        $query = CampaignsMaster::select('campaigns_masters.*','search_types.name as search_type')
            ->where('campaigns_masters.user_id',Auth::user()->id)
            ->where('campaigns_masters.is_delete',0)
            ->join('search_types', 'search_types.id', '=', 'campaigns_masters.search_type_id');

        if($request->ajax()){
            if($request->orderby != "" || $request->orderbycolumn != ""){
                $query = $query->orderBy($request->orderbycolumn,$request->orderby);
            }else{
                $query = $query->orderBy('id','desc');
            }
            $campaigns = $query->limit(10)->get();
            $view = view('frontend.include.tableDashboardPastSearch',compact('campaigns'))->render();
            return response()->json(['status' => 200, 'html' => $view]);
        }

        return redirect()->route('dashboard');
    }

    /*** Check current password ***/
    public function passwordCheck(Request $request){
        $user = User::find(Auth::user()->id);
        if (\Hash::check($request->password, $user->password)) {
            echo "true";
        }else{
            echo "false";
        }
    }   

    /** Email Templates**/
    public function emailTemplates(Request $request){
        $query = EmailTemplate::select('*')->where('is_delete',0);
        $query = $query->where(function($q){
            $q->where('user_id',0);
            $q->orWhere('user_id',Auth::user()->id);
        });
        if($request->ajax()){
            if($request->orderby != "" || $request->orderbycolumn != ""){
                $query = $query->orderBy($request->orderbycolumn,$request->orderby);
            }else{
                $query = $query->orderBy('id','desc');
            }
            $templates = $query->paginate($this->limit);
            $view = view('frontend.include.tableEmailTemplate',compact('templates'))->render();
            return response()->json(['status' => 200, 'html' => $view]);
        }
        $templates = $query->orderBy('id','desc')->paginate($this->limit);
        return View('frontend.email_template', compact('templates'));
    }

    /*
    * Delete email template
    *
    */
    public function deleteEmailTemplate(Request $request, $id)
    {
        $delete = Emailtemplate::where('id', Helper::getDecrypted($id))
        ->where(['is_delete'=>0,'user_id'=>Auth::user()->id])
        ->first();

        if($delete){
            $delete->is_delete = 1;
            $delete->save();
            return response()->json(['status' => 200, 'message' => 'Email Template has been deleted successfully.']);
        }
        return response()->json(['status' => 401, 'message' => 'Something went wrong.']);
    }

    /*
    * Copy email template
    *
    */
    public function duplicateEmailTemplate(Request $request, $id)
    {
        $emailTemplate = Emailtemplate::where('id', Helper::getDecrypted($id))
        ->where('is_delete',0)
        ->first();

        if($emailTemplate){
            
            $title = $emailTemplate->title;
            if (strpos($title, '[Copy]') == false) {
                $title = $emailTemplate->title." [Copy]";
            }

            $duplicate          = new Emailtemplate;
            $duplicate->title   = $title;
            $duplicate->subject = $emailTemplate->subject;
            $duplicate->content = $emailTemplate->content;
            $duplicate->user_id = Auth::user()->id;
            $duplicate->save();
            if($request->ajax()){
                return response()->json(['status' => 200, 'message' => 'Email Template copied successfully.']);
            }else{
                return redirect()->back()->with('Success','Email Template copied successfully.');
            }

        }
        if($request->ajax()){
            return response()->json(['status' => 401, 'message' => 'Something went wrong.']);
        }else{
            return redirect()->back()->with('error','Something went wrong.');
        }
    }


    /*
    * Preview email template
    *
    */
    public function previewEmailTemplates(Request $request)
    {
        $html = "";
        $template = EmailTemplate::where('id', Helper::getDecrypted($request->get('id')))->first();
        if ($template != null) {
            $content = $template->content;
            $html = view('mails.template', compact('content'))->render();
            
            return response()->json([
                'html' => $html,
                'status' => 200,
                'content' => $content
            ]);
        }

        return response()->json([
            'html' => $html,
            'status' => 401,
        ]);
    }
    
    /*** Logout ***/
    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        Session::forget('subscribe');
        Session::forget('plan_id');
        Session::flash('Success','Logout successfully.');
        return redirect('/login');
    }
}
