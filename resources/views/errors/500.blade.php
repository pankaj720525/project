<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Legiit Leads | 500 Error</title>

	<link href="{{Helper::backend_asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{Helper::backend_asset('font-awesome/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{Helper::backend_asset('css/animate.css')}}" rel="stylesheet">
    <link href="{{Helper::backend_asset('css/style.css')}}" rel="stylesheet">
    @if (!Auth::guard('admin')->check())
        <link href="{{Helper::frontend_asset('css/custom.css')}}" rel="stylesheet">
    @endif
</head>
<body class="@if(Auth::guard('admin')->check()) gray-bg @else dark-gray-bg @endif">
    <div class="middle-box text-center animated fadeInDown">
        <h1>500</h1>
        <h3 class="font-bold">Internal Server Error</h3>
        <div class="error-desc">
            The server encountered something unexpected that didn't allow it to complete the request. We apologize.<br/>
            You can go back to main page: <br/>
            
            @if (Auth::guard('admin')->check())
                <a href="{{route('admin.dashboard')}}" class="btn btn-primary m-t">Dashboard</a>
            @elseif(Auth::guard('web')->check())
                <a href="{{route('dashboard')}}" class="btn btn-primary m-t">Dashboard</a>
            @else
                <a href="{{url('/')}}" class="btn btn-primary m-t">Dashboard</a>
            @endif

        </div>
    </div>
    <!-- Mainly scripts -->
    <script src="{{Helper::backend_asset('js/jquery-3.1.1.min.js')}}"></script>
    <script src="{{Helper::backend_asset('js/bootstrap.min.js')}}"></script>
</body>
</html>
