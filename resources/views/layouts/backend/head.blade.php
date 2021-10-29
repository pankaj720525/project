<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> @yield('title') </title>

    <link rel="icon" type="image/png" href="{{ Helper::assets('img/Favicon.png') }}"/>
    <link href="{{Helper::backend_asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{Helper::backend_asset('font-awesome/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{Helper::backend_asset('css/plugins/toastr/toastr.min.css')}}" rel="stylesheet">
    <link href="{{Helper::backend_asset('css/animate.css')}}" rel="stylesheet">
    <link href="{{Helper::backend_asset('css/style.css')}}" rel="stylesheet">
    <link href="{{Helper::backend_asset('css/custom.css')}}" rel="stylesheet">
    <link href="{{Helper::backend_asset('css/plugins/sweetalert/sweetalert.css')}}" rel="stylesheet">
    
    @yield('style')

</head>