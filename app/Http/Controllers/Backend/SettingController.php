<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EmailTemplate;
use App\Models\MemberContent;
use Helper;
use Session;

class SettingController extends Controller
{
    /*
     * Email Templates
     * 
     */
    private $limit = 10;

    public function emailTemplates(Request $request)
    {
        $query = EmailTemplate::select('*')->where(['user_id'=>0,'is_delete'=>0]);
        if($request->ajax()){
        	if($request->orderby != "" || $request->orderbycolumn != ""){
                $query = $query->orderBy($request->orderbycolumn,$request->orderby);
            }else{
                $query = $query->orderBy('id','desc');
            }
        	$templates = $query->paginate($this->limit);
        	$view = view('backend.setting.include.dynamicEmailData',compact('templates'))->render();
            return response()->json(['status' => 200, 'html' => $view]);
        }
        $templates = $query->orderBy('id','desc')->paginate($this->limit);
        return View('backend.setting.email_templates', compact('templates'));
    }

    /*
     * Add email template
     * 
     */
    public function addEmailTemplate(Request $request)
    {
        if ($request->isMethod('POST')) {
        	
        	$request->validate([
	            "title"  => "required",
                "subject"  => "required",
	            "content"  => "required",
	        ]);

            $template = new Emailtemplate;
            $template->title = $request->title;
            $template->subject = $request->subject;
            $template->content = $request->content;
            $template->save();
            Session::flash('Success', 'Email template added successfully');
            return redirect()->route('emailtemplate');
        } else {
            return View('backend.setting.add_email_template');
        }
        
    }

    /*
     * Update email template
     * 
     */

    public function editEmailTemplate(Request $request,$id)
    {
        $template = Emailtemplate::where(['id'=>Helper::getDecrypted($id),'is_delete'=>0])->first();
        if ($request->isMethod('POST')) {
            
            $request->validate([
                "title"  => "required",
                "subject"  => "required",
                "content"  => "required",
            ]);

            $template->title = $request->title;
            $template->subject = $request->subject;
            $template->content = $request->content;
            $template->save();
            Session::flash('Success', 'Email template updated');
            return redirect()->route('emailtemplate');
        } else {
            return View('backend.setting.edit_email_template', compact('template'));
        }
        
    }

    /*
     * Delete email template
     * 
     */
    public function deleteEmailTEmplate(Request $request,$id)
    {
        $delete = Emailtemplate::where('id', Helper::getDecrypted($id))
        ->where('is_delete',0)
        ->first();

        if($delete){
            $delete->is_delete = 1;
            $delete->save();
            return response()->json(['status' => 200, 'message' => 'Email Template has been deleted successfully.']);
        }
        return response()->json(['status' => 401, 'message' => 'Something went wrong.']);
        
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
        }
        return response()->json([
            'html' => $html
        ]);
    }

    /*
    * Member Content CMS
    *
    */
    public function memberContent(Request $request)
    {
        $html = "";
        $query = MemberContent::where('is_delete',0);
        
        if($request->ajax()){
            if($request->orderby != "" || $request->orderbycolumn != ""){
                $query = $query->orderBy($request->orderbycolumn,$request->orderby);
            }else{
                $query = $query->orderBy('id','desc');
            }
            $member_contents = $query->paginate($this->limit);
            $view = view('backend.setting.include.dynamicMemberContentData',compact('member_contents'))->render();
            return response()->json(['status' => 200, 'html' => $view]);
        }
        $member_contents = $query->orderBy('id','desc')->paginate($this->limit);
        return view('backend.setting.member_content', compact('member_contents'));
    }

    /*
    * Add Member Content CMS
    *
    */
    public function addMemberContent(Request $request)
    {
        if($request->method() == "POST"){
            $request->validate([
                "title"  => "required",
                "description"  => "required",
            ]);

            $add = new MemberContent;
            $add->title = $request->title;
            $add->description = $request->description;
            $add->videolink = $request->videolink;
            $add->save();

            Session::flash('Success','Member Content has been added successfully');
            return redirect()->route('member_content');
        }else{

            return view('backend.setting.add_member_content');
        }
    }

    /*
    * Edit Member Content CMS
    *
    */
    public function editMemberContent($id, Request $request)
    {
        $member_content = MemberContent::where('is_delete',0)->where('id',Helper::getDecrypted($id))->first();
        if($member_content){
            if($request->method() == "POST"){
                $request->validate([
                    "title"  => "required",
                    "description"  => "required",
                ]);

                $member_content->title = $request->title;
                $member_content->description = $request->description;
                $member_content->videolink = $request->videolink;
                $member_content->save();

                Session::flash('Success','Member Content has been updated successfully');
                return redirect()->route('member_content');
            }else{
                return view('backend.setting.edit_member_content',compact('member_content'));
            }
        }else{
            Session::flash('error','Something went wrong. Please try again.');
            return redirect()->route('member_content');
        }
    }

    /**
     * change status.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function memberContentStatusChange(Request $request, $id, $status)
    {   
        $id = Helper::getDecrypted($id);
        $changeStatus = MemberContent::where('is_delete',0)->where('id',$id)->first();
        if($changeStatus){
            if($request->status == 1){
                $status = 2;
            }else{
                $status = 1;
            }
            $changeStatus->status = $status;
            $changeStatus->save();
            return response()->json(['status' => 200, 'message' => 'Status changed successfully.']);
        }
        return response()->json(['status' => 401, 'message' => 'Something went wrong. Please try again sometime.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyMemberContent($id)
    {
        $delete = MemberContent::where('id',Helper::getDecrypted($id))
        ->where('is_delete',0)
        ->first();

        if($delete){
            $delete->is_delete = 1;
            $delete->save();
            return response()->json(['status' => 200, 'message' => 'Member Content has been deleted successfully.']);
        }
        return response()->json(['status' => 401, 'message' => 'Something went wrong. Please try again sometime.']);
    }

    
}
