@extends('layouts.mail.mail')
@section('title', 'Legiit Leads - Verify Account')
@section('content')
<p style="font-size: 18px;font-weight: 500; color:#2d363a">Verify Legiit Leads Account</p>
<div style="">
	<p style="text-align: left; color:#2d363a">Hi {{ucfirst($name)}} ,</p>
	<p style="text-align: left; color:#2d363a">Please click the below button to verify your account.</p>
	<p style="text-align: left; color:#2d363a">If you did not create an account, no further action is required.</p>
	<p style="border-top:3px solid #e6e6e6; margin-top:30px; margin-bottom:0px;text-align:center">
		<a href="{{$verifiedurl}}" style="background-color: #47a4e6; color: #fff;padding: 10px 30px; text-decoration: none;border-radius: 6px;display: inline-block;margin-top: 20px;">Verify Now</a>
	</p>
</div>
@endsection
