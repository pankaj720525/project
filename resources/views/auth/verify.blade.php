<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Legiit Leads | Verify</title>
    <link rel="icon" type="image/png" href="{{ Helper::assets('img/Favicon.png') }}"/>
    <link href="{{Helper::backend_asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{Helper::backend_asset('font-awesome/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{Helper::backend_asset('css/plugins/toastr/toastr.min.css')}}" rel="stylesheet">
    <link href="{{Helper::backend_asset('css/animate.css')}}" rel="stylesheet">
    <link href="{{Helper::backend_asset('css/style.css')}}" rel="stylesheet">
    <link href="{{Helper::frontend_asset('css/custom.css')}}" rel="stylesheet">
    
</head>
<body class="dark-gray-bg">
	<div class="container">
		<nav class="m-t d-flex justify-content-between">
			<a class="navbar-brand"> <img src="{{Helper::assets('img/small_logo.png')}}"> </a>
			<a href="{{route('logout')}}"> <button class="btn btn-primary btn-sm">Logout</button></a>
		</nav>
	</div>
    <div class="middle-box loginscreen animated fadeInDown">
        <div class="mt-5">
            <div class="text-center">
                <p>
                    {{ __('Before proceeding, please check your email for a verification link.') }}
                </p>
                <p>
                    {{ __('If you did not receive the email') }},
                </p>
            </div>
            {!! Form::open(['route' => ['verification.resend'],'class'=>'m-t','role'=>'form']) !!}
                <button type="submit" class="btn btn-primary btn-lg block full-width m-b border-none">
                {{ __('click here to request another') }}
                </button>
            </button>
            {!! Form::close() !!}
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="{{Helper::backend_asset('js/jquery-3.1.1.min.js')}}"></script>
    <script src="{{Helper::backend_asset('js/bootstrap.min.js')}}"></script>
    <script src="{{Helper::backend_asset('js/plugins/toastr/toastr.min.js')}}"></script>
    <script src="{{Helper::backend_asset('js/plugins/validate/jquery.validate.min.js')}}"></script>
    <script src="{{Helper::frontend_asset('js/custom.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            @if(Session::has('error'))
                toastr.error('{{Session::get('error')}}');
            @elseif(Session::has('Success'))
                toastr.success('{{Session::get('Success')}}');
            @endif
            @if (session('resent'))
                toastr.success('A fresh verification link has been sent to your email address.');
            @endif
        });
    </script>
</body>
</html>
