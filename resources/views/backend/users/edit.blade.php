@extends('layouts.backend.base')
@section('title','User - Update')
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2>{{__('Update')}}</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{Route('admin.dashboard')}}">Dashboard</a>
            </li>
            <li>
                <a href="{{Route('user.index')}}">Users</a>
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
                        <h5 class="">Update Details</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-md-6">
                                {!! Form::open(['route' => ['user.update',$id],'class'=>'form-horizontal col-md-12','id'=>'update_user_form','method' => 'PUT']) !!}
                                    <div class="form-group">
                                        <label class="control-label">First Name</label>
                                        {!! Form::text('first_name',$user->first_name,['class'=>'form-control'])!!}
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Last Name</label>
                                        {!! Form::text('last_name',$user->last_name,['class'=>'form-control'])!!}
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Email Address</label>
                                        {!! Form::text('email',$user->email,['class'=>'form-control','readonly'=>true])!!}
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Subscription Plan <small class="text-danger">*</small></label>
                                        {!! Form::select('plan',$plans,($user->subscribe!=null?$user->subscribe->subscription_id:"") ,['class'=>'form-control','placeholder'=>'Select Plan','readonly'=>($user->subscribe!=null?true:false)])!!}
                                    </div>
                                    @if($user->subscribe==null)
                                    <div class="form-group">
                                        <label class="control-label">Transaction Id <small class="">(Optional)</small></label>
                                        {!! Form::text('transaction_id',null,['class'=>'form-control','id'=>'transaction','autocomplete'=>'false'])!!}
                                    </div>
                                    @endif
                                    <div class="form-group m-t">
                                        <a href="{{Route('user.index')}}" class="btn btn-white">Cancel</a>
                                        <button class="btn btn-primary" type="submit">Update</button>
                                    </div>
                                {!! Form::close() !!}
                            </div>
                            <div class="col-md-6 row">
                                {!! Form::open(['route' => ['user.update',$id],'class'=>'form-horizontal col-md-12','id'=>'user-change-password-form','method' => 'PUT']) !!}
                                    {{Form::hidden('type','password')}}
                                    <div class="col-md-12 form-group">
                                        <label class="control-label">Password</label>
                                        {!! Form::password('password',['class'=>'form-control','id'=>'password'])!!}
                                        <i class="fa fa-eye togglePassword" toggle="#password"></i>
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <label class="control-label">Confirm Password</label>
                                        {!! Form::password('password_confirmation',['class'=>'form-control','id'=>'password_confirmation'])!!}
                                        <i class="fa fa-eye togglePassword" toggle="#password_confirmation"></i>
                                    </div>
                                    <div class="form-group col-md-12 m-t">
                                        <button class="btn btn-primary" type="submit">Change</button>
                                    </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
