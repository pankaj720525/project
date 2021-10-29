<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subscription;
use App\Models\SubscribeUser;
use Auth;
use Session;
use Helper;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Subscription::where('is_delete',0);
        if($request->ajax()){
            $general_search = $request->search;
            if($general_search != ""){
                $query = $query->where(function ($q) use ($general_search){
                    $q->where('package_name', 'LIKE', '%' . $general_search . '%');
                    $q->orWhere('description', 'LIKE', '%' . $general_search . '%');
                    $q->orWhere('billing_period', 'LIKE', '%' . $general_search . '%');
                    $q->orWhere('billing_frequency', 'LIKE', '%' . $general_search . '%');
                    $q->orWhere('search_limit', 'LIKE', '%' . $general_search . '%');
                    $q->orWhere('price', 'LIKE', '%' . $general_search . '%');
                    $q->orWhere('no_of_result', 'LIKE', '%' . $general_search . '%');
                });
            }
            if($request->status){
                $query = $query->where('status',$request->status);
            }
            if($request->orderby != "" || $request->orderbycolumn != ""){
                $query = $query->orderBy($request->orderbycolumn,$request->orderby);
            }
            $subscriptions = $query->paginate(10)->appends($request->all());
            $view = view('backend.subscription.include.dynamicTableData',compact('subscriptions'))->render();
            return response()->json(['status' => 200, 'html' => $view]);
        }

        $subscriptions = $query->paginate(10)->appends($request->all());

        return view('backend.subscription.index',compact('subscriptions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.subscription.add');
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
            "package_name"    => "required",
            "description"    => "required",
            "billing_period"    => "required",
            "billing_frequency"    => "required",
            "price"    => "required",
            "search_limit" => "required",
            "no_of_result" => "required",
        ]);

        $add = new Subscription;
        $add->package_name = $request->package_name;
        $add->description = $request->description;
        $add->billing_period = $request->billing_period;
        $add->billing_frequency = $request->billing_frequency;
        $add->search_limit = $request->search_limit;
        $add->is_unlimited = 0;
        $add->no_of_result = $request->no_of_result;
        $add->price = $request->price;
        $add->save();

        Session::flash('Success','Subscription has been added successfully.');
        return redirect()->route('subscription.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect('404');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subscription = Subscription::where('id',Helper::getDecrypted($id))
        ->where('is_delete',0)
        ->first();
        if($subscription){
            return view('backend.subscription.update',compact('subscription','id'));
        }else{
            Session::flash('error','Something went wrong. Please try again.');
            return redirect()->back();
        }
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
        $request->validate([
            "package_name"    => "required",
            "description"    => "required",
            "no_of_result"    => "required",
            "price"    => "required",
            "search_limit" => "required",
        ]);
        $update = Subscription::where('id',Helper::getDecrypted($id))
        ->where('is_delete',0)
        ->first();

        if($update){
            $update->package_name = $request->package_name;
            $update->description  = $request->description;
            $update->search_limit = $request->search_limit;
            $update->no_of_result = $request->no_of_result;
            $update->price = $request->price;
            $update->save();
            
            Session::flash('Success','Subscription has been updated successfully.');
            return redirect()->route('subscription.index');
        }else{
            Session::flash('error','Something went wrong. please try again.');
            return redirect()->back();
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Subscription::where('id',Helper::getDecrypted($id))
        ->where('is_delete',0)
        ->first();

        if($delete){
            $check_exists_plan = SubscribeUser::where('subscription_id',$delete->id)->where('status',1)->count();
            if($check_exists_plan == 0){
                $delete->is_delete = 1;
                $delete->save();
                return response()->json(['status' => 200, 'message' => 'Subscription has been deleted successfully.']);
            }else{
                return response()->json(['status' => 401, 'message' => 'Sorry! This plan is associate with user, You weren\'t able to delete this plan.']);
            }
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
        $changeStatus = Subscription::find($id);
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
}
