@extends('layouts.backend.base')
@section('title','Subscription Update')
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2>{{__('Update')}}</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{Route('admin.dashboard')}}">Dashboard</a>
            </li>
            <li>
                <a href="{{Route('subscription.index')}}">Subscription Plan</a>
            </li>
            <li class="active">
                <strong>Update</strong>
            </li>
        </ol>
    </div>
</div>
    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Update subscription plan</h5>
                    </div>
                    <div class="ibox-content">
                        {!! Form::open(['route' => ['subscription.update',$id],'class'=>'form-horizontal','id'=>'update_subscription_form','method' => 'PUT']) !!}
                            <div class="row">
                                <div class="col-sm-6">
                                    <label class="control-label">Package Name</label>
                                    {!! Form::text('package_name',$subscription->package_name,['class'=>'form-control'])!!}
                                </div>
                                <div class="col-sm-6">
                                    <label class="control-label">Billing Period</label>
                                    {!! Form::text('billing_period',Helper::getBillingPeriod($subscription->billing_period),['class'=>'form-control','readonly'=>true])!!}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label class="control-label">Description</label>
                                    {!! Form::textarea('description',$subscription->description,['class'=>'form-control','rows'=>'7'])!!}
                                </div>
                                <div class="col-sm-6">
                                    <label class="control-label">Billing Frequency</label>
                                    {!! Form::text('billing_frequency',$subscription->billing_frequency,['class'=>'form-control','readonly'=>true])!!}
                                </div>
                                <div class="col-sm-6">
                                    <div class="col-sm-6 pl-0">
                                        <label class="control-label">Search Limit</label>
                                        {!! Form::text('search_limit',$subscription->search_limit,['class'=>'form-control','id'=>'search_limit'])!!}
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="control-label">No of result</label>
                                        {!! Form::text('no_of_result',$subscription->no_of_result,['class'=>'form-control','id'=>'no_of_result'])!!}
                                        {{-- <div class="onoffswitch custom-switch-onoff mt-2">
                                            <input name="is_unlimited" @if($subscription->is_unlimited == 1) checked @endif type="checkbox" class="onoffswitch-checkbox" id="unlimited">
                                            <label class="onoffswitch-label" for="unlimited">
                                                <span class="onoffswitch-inner"></span>
                                                <span class="onoffswitch-switch"></span>
                                            </label>
                                        </div> --}}
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label class="control-label">Price</label>
                                    {!! Form::number('price',$subscription->price,['class'=>'form-control'])!!}
                                </div>
                            </div>
                            <div class="form-group row m-t">
                                <div class="col-sm-4 col-sm-offset-4">
                                    <a href="{{Route('subscription.index')}}" class="btn btn-white">Cancel</a>
                                    <button class="btn btn-primary" type="submit">Save</button>
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection