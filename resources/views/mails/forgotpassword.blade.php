@extends('layouts.mail.mail')
@section('title', 'Legiit Leads - Change Password')
@section('content')
<p style="font-size: 18px;font-weight: 500; color:#2d363a">Change Account Password</p>
<div style="">
	<p style="text-align: left; color:#2d363a">hi {{ucfirst($name)}} ,</p>
	<p style="text-align: left; color:#2d363a">You recently requested to reset your password for legiit leads account. Click the button below to reset it.</p>
	<p style="text-align: left; color:#2d363a">If you do not request a  password reset, please ignore this email. This password reset is only valid for the next 30 minutes.</p>
	<p style="border-top:3px solid #e6e6e6; margin-top:30px; margin-bottom:0px;text-align:center">
		<a href="{{$reseturl}}" style="background-color: #47a4e6; color: #fff;padding: 10px 30px; text-decoration: none;border-radius: 6px;display: inline-block;margin-top: 20px;">Reset your password</a>
	</p>
</div>
@endsection