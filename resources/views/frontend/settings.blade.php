@extends('layouts.base')
@section('title','Settings')
@section('content')
<div class="row wrapper border-bottom light-gray-bg page-heading">
    <div class="col-sm-9 mt-2 text-black">
        <h3 class="m-t-20 fs-20">
        	<strong>
        		<span class="label_keyword"> Settings </span>
        	</strong>
        </h3>
    </div>
</div>
<div class="wrapper wrapper-content">
	<div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Profile Setting</h5>
                    </div>
                    <div class="ibox-content" id="profile_setting">
                        <div class="row">
                            <div class="col-lg-6">
                                {!! Form::open(['route' => ['settings'],'id'=>'profile_form','method'=>'post']) !!}
                                        <div class="row">
                                            <div class="form-group col-sm-12">
                                                <label class="control-label">First Name:<span class="text-danger">*</span></label>
                                                {!! Form::text('first_name',$user->first_name,['class'=>'form-control'])!!}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-sm-12">
                                                <label class="control-label">Last Name:<span class="text-danger">*</span></label>
                                                {!! Form::text('last_name',$user->last_name,['class'=>'form-control'])!!}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-sm-12">
                                                <label class="control-label">Email:<span class="text-danger">*</span></label>
                                                {!! Form::text('email',$user->email,['class'=>'form-control','autocomplete'=>'off','readonly'=>true])!!}
                                            </div>
                                        </div>
                                        <div class="form-group row m-t">
                                            <div class="col-sm-4 col-sm-offset-4">
                                                {{-- <a href="{{Route('dashboard')}}" class="btn btn-white">Cancel</a> --}}
                                                <button type="submit" class="ladda-button ladda-button-demo btn btn-primary m-b btn-block"  data-style="zoom-in" id="form-btn1">
                                                    {{ __('Save') }}
                                                </button>
                                            </div>
                                        </div>
                                {!! Form::close() !!}
                            </div>
                            <div class="col-lg-6">

                                {!! Form::open(['route' => ['settings'],'id'=>'profile_form2','method'=>'post']) !!}
                                    <div class="row">
                                        <div class="form-group col-sm-12">
                                            <label class="control-label">Current Password</label>
                                            {!! Form::password('current_password',['class'=>'form-control pr-5','id'=>'current_password'])!!}
                                            <i class="togglePassword fa fa-eye"  toggle="#current_password"></i>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-sm-12">
                                            <label class="control-label">New Password</label>
                                            {!! Form::password('new_password',['class'=>'form-control pr-5','id'=>'new_password'])!!}
                                            <i class="togglePassword fa fa-eye"  toggle="#new_password"></i>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-sm-12">
                                            <label class="control-label">Confirm Password</label>
                                            {!! Form::password('password_confirmation',['class'=>'form-control pr-5','id'=>'password_confirmation'])!!}
                                            <i class="togglePassword fa fa-eye"  toggle="#password_confirmation"></i>
                                        </div>
                                    </div>
                                    <div class="form-group row m-t">
                                        <div class="col-sm-4 col-sm-offset-4">
                                            {{-- <a href="{{Route('dashboard')}}" class="btn btn-white">Cancel</a> --}}
                                            <button type="submit" class="ladda-button ladda-button-demo btn btn-primary m-b btn-block" id="form-btn2" data-style="zoom-in">
                                                {{ __('Change') }}
                                            </button>
                                        </div>
                                    </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('javascript')
<script type="text/javascript">
$(document).ready(function(){
    // $('#current_password, #new_password, #password_confirmation').keyup(function(){
    //     if($('#current_password').val().length > 0 || $('#new_password').val().length > 0 || $('#password_confirmation').val().length > 0){
    //         $('#profile_form').attr('id','profile_form2');
    //         form2validation();
    //     }else{
    //         $('#profile_form2').attr('id','profile_form');
    //     }
    // });
    // $('#new_password').keyup(function(){
    //     isrequired($(this));
    // });
    // $('#password_confirmation').keyup(function(){
    //     isrequired($(this));
    // });
    function isrequired($this){
        if($this.val().length > 0){
            console.log($this.val());
            // $('#new_password').attr('required',true);
            // $('#password_confirmation').attr('required',true);
        }else{
            $('#profile_form2').attr('id','profile_form');
            // $('#current_password').removeAttr('required');
            // $('#new_password').removeAttr('required');
            // $('#password_confirmation').removeAttr('required');
        }
    }
    // var l = $('button[type=submit]').ladda();
    var btn1 = $('button[id="form-btn1"]').ladda();
    $("#profile_form").validate({
        rules: {
            first_name:{
                required: true,
                noSpace: true,
                lettersonly: true,
                maxlength: 20,
            },
            last_name:{
                required: true,
                noSpace: true,
                lettersonly: true,
                maxlength: 20,
            }
        },
        messages: {
            first_name:{
                required: "First Name is required.",
            },
            last_name:{
                required: "Last Name is required.",
            }
        },
        submitHandler: function(form) {
            btn1.ladda( 'start' );
            $('#profile_setting button').attr('disabled',true);
            $.ajax({
                url: form.action,
                type: form.method,
                data: $(form).serialize(),
                success: function(response) {
                    $('#profile_setting button').attr('disabled',false);
                    btn1.ladda('stop');
                    if (response.status == 401) {
                        toastr.error(response.message);
                    } else {
                        toastr.success(response.message);
                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                    }
                },
                error: function(){
                    $('#profile_form a').attr('disabled',false);
                    btn1.ladda('stop');
                    toastr.error('Something went wrong. Please try again sometime.');
                }
            });
        }
    });

    var btn2 = $('button[id="form-btn2"]').ladda();
    $("#profile_form2").validate({
        rules: {
            current_password:{
                required: true,
                remote: {
                    url: "{{route('check.current_password')}}",
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    type: 'get',
                    data: {
                        password: function()
                        {
                            return $('#current_password').val();
                        }
                    }
                }
            },
            new_password:{
                required: true,
                pwcheck: true,
            },
            password_confirmation:{
                required: true,
                equalTo: "#new_password",
            }
        },
        messages: {
            current_password:{
                required: "Current Password is required.",
                remote: "Current Password does not matched."
            },
            new_password:{
                required: "New Password is required.",
            },
            password_confirmation:{
                required: "Confirm Password is required.",
                equalTo: "New Password & Confirm Password does not match."
            }
        },
        submitHandler: function(form) {
            btn2.ladda( 'start' );
            $('#profile_setting button').attr('disabled',true);
            $.ajax({
                url: form.action,
                type: form.method,
                data: $(form).serialize(),
                success: function(response) {
                    $('#profile_setting button').attr('disabled',false);
                    btn2.ladda('stop');
                    if (response.status == 401) {
                        toastr.error(response.message);
                    } else {
                        toastr.success(response.message);
                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                    }
                },
                error: function(){
                    $('#profile_form a').attr('disabled',false);
                    btn2.ladda('stop');
                    toastr.error('Something went wrong. Please try again sometime.');
                }
            });
        }
    });
});
</script>
@endsection
