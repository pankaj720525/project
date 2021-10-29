@extends('layouts.mail.mail')
@section('title', 'Plan purchase')
@section('content')
<p style="font-size: 18px; color:#2d363a">Thanks for joining <a href="{{route('home')}}"> Legiitleads.com </a></p>
<div style="">
	<p style="text-align: left; color:#2d363a">Hi {{ucfirst($name)}} ,</p>
	<p style="text-align: left; color:#2d363a">
            Thank you for creating your account here at <a href="{{route('home')}}"> Legiitleads.com </a> and welcome to the family!
    </p>
    <p style="text-align: left; color:#2d363a">
    </p>
    <p style="text-align: left; color:#2d363a">
    </p>
    <p style="text-align: left; color:#2d363a">
            To view or change your account information, <a href="{{route('home')}}">visit your account.</a>
    </p>
	<p style="text-align: left; color:#2d363a"><small>Plan name</small><br><strong>{{$plan_name}}</strong></p>
    <p style="text-align: left; color:#2d363a"></p>
	<p style="text-align: left; color:#2d363a"><small>Price</small><br><strong>{{$plan_price}}</strong>/{{$billing_period}}</p>
</div>
@endsection
