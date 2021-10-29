@extends('layouts.backend.base')
@section('title','User - Add')
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2>{{__('Add')}}</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{Route('admin.dashboard')}}">Dashboard</a>
            </li>
            <li>
                <a href="{{Route('user.index')}}">Users</a>
            </li>
            <li class="active">
                <strong>Add</strong>
            </li>
        </ol>
    </div>
</div>
    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5 class="">Add</h5>
                    </div>
                    <div class="ibox-content">
                        {!! Form::open(['route' => ['user.store'],'class'=>'form-horizontal','id'=>'create_user_form','method' => 'POST','autocomplete'=>'off']) !!}
                            <div class="row">
                                <div class="col-sm-6">
                                    <label class="control-label">First Name <small class="text-danger">*</small></label>
                                    {!! Form::text('first_name','',['class'=>'form-control'])!!}
                                </div>
                                <div class="col-sm-6">
                                    <label class="control-label">Last Name <small class="text-danger">*</small></label>
                                    {!! Form::text('last_name','',['class'=>'form-control'])!!}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label class="control-label">Email Address <small class="text-danger">*</small></label>
                                    {!! Form::text('email','',['class'=>'form-control','autocomplete'=>'off'])!!}
                                </div>
                                <div class="col-sm-6">
                                    <label class="control-label">Subscription Plan <small class="text-danger">*</small></label>
                                    {!! Form::select('plan',$plans,'',['class'=>'form-control','placeholder'=>'Select Plan'])!!}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label class="control-label">Password <small class="text-danger">*</small></label>
                                    {!! Form::password('password',['class'=>'form-control','id'=>'password','autocomplete'=>'false'])!!}
                                    <i class="fa fa-eye togglePassword" toggle="#password"></i>
                                </div>
                                <div class="col-sm-6">
                                    <label class="control-label">Confirm Password <small class="text-danger">*</small></label>
                                    {!! Form::password('password_confirmation',['class'=>'form-control','id'=>'password_confirmation','autocomplete'=>'false'])!!}
                                    <i class="fa fa-eye togglePassword" toggle="#password_confirmation"></i>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label class="control-label">Transaction Id <small class="">(Optional)</small></label>
                                    {!! Form::text('transaction_id',null,['class'=>'form-control','id'=>'transaction','autocomplete'=>'false'])!!}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 m-t">
                                    <a href="{{Route('user.index')}}" class="btn btn-white">Cancel</a>
                                    <button class="btn btn-primary" type="submit">Submit</button>
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
