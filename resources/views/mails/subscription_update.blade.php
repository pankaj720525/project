@extends('layouts.mail.mail')
@section('title', 'Your plan has been updated')
@section('content')
<p style="font-size: 18px;font-weight: 500; color:#2d363a">Plan updated</p>
<div style="">
	<p style="text-align: left; color:#2d363a">Hi {{ucfirst($name)}} ,</p>
	<p style="text-align: left; color:#2d363a">We have updated your plan, as you asked To view or change your account information <a href="{{route('home')}}">visit your account</a> .</p>
	<p style="text-align: left; color:#2d363a"><small>Plan name</small><br><strong>{{$plan_name}}</strong></p>
    <p style="text-align: left; color:#2d363a"></p>
	<p style="text-align: left; color:#2d363a"><small>Price</small><br><strong>{{$plan_price}}</strong>/{{$billing_period}}</p>
</div>
@endsection
