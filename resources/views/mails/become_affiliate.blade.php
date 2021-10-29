@extends('layouts.mail.mail')
@section('title', 'Become An Affiliate')
@section('content')
<p style="font-size: 18px; color:#2d363a">Become An Affiliate</p>
<div style="">
	<p style="text-align: left; color:#2d363a">
            Name: <strong>{{$name}}</strong> 
    </p>
	<p style="text-align: left; color:#2d363a">
            Email: <strong>{!! $mail !!}</strong> 
    </p>
	<p style="text-align: left; color:#2d363a">
            Message: <strong>{!! $messages !!}</strong> 
    </p>
</div>
@endsection
