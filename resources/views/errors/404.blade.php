<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Legiit Leads | 404 Error</title>
    <link href="{{Helper::backend_asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{Helper::backend_asset('font-awesome/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{Helper::backend_asset('css/animate.css')}}" rel="stylesheet">
    <link href="{{Helper::backend_asset('css/style.css')}}" rel="stylesheet">
    @if (!Auth::guard('admin')->check())
        <link href="{{Helper::frontend_asset('css/custom.css')}}" rel="stylesheet">
    @endif
</head>
<body class="@if(Auth::guard('admin')->check())gray-bg @else dark-gray-bg @endif">
    <div class="middle-box text-center animated fadeInDown">
        <h1>404</h1>
        <h3 class="font-bold">Page Not Found</h3>
        <div class="error-desc">
            Sorry, but the page you are looking for has note been found. Try checking the URL for error, then hit the refresh button on your browser or try found something else in our app.
            <div>
                @if (Auth::guard('admin')->check())
                    <a href="{{route('admin.dashboard')}}" class="btn btn-primary m-t">Dashboard</a>
                @elseif(Auth::guard('web')->check())
                    <a href="{{route('dashboard')}}" class="btn btn-primary m-t">Dashboard</a>
                @else
                    <a href="{{url('/')}}" class="btn btn-primary m-t">Dashboard</a>
                @endif
            </div>
        </div>
    </div>
    <!-- Mainly scripts -->
    <script src="{{Helper::backend_asset('js/jquery-3.1.1.min.js')}}"></script>
    <script src="{{Helper::backend_asset('js/bootstrap.min.js')}}"></script>
</body>
</html>