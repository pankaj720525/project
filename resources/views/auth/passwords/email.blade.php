<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Legiit Leads | Forget Password</title>
    <link rel="icon" type="image/png" href="{{ Helper::assets('img/Favicon.png') }}"/>
    <link href="{{Helper::backend_asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{Helper::backend_asset('font-awesome/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{Helper::backend_asset('css/plugins/toastr/toastr.min.css')}}" rel="stylesheet">
    <link href="{{Helper::backend_asset('css/animate.css')}}" rel="stylesheet">
    <link href="{{Helper::backend_asset('css/style.css')}}" rel="stylesheet">
    <link href="{{Helper::backend_asset('css/plugins/ladda/ladda-themeless.min.css')}}" rel="stylesheet">
    <link href="{{Helper::frontend_asset('css/custom.css')}}" rel="stylesheet">

</head>
<body class="dark-gray-bg">
    <div class="middle-box loginscreen animated justify-content-center fadeInDown d-flex align-item-center h-100">
        <div>
            <div class="text-center w-350">
                <a href="{{route('landing')}}"><img src="{{Helper::assets('img/Logo.png')}}" width="200"></a>
                <p class="m-t">Reset Password</p>
            </div>
            {!! Form::open(['route' => ['password.email'],'class'=>'m-t-lg','role'=>'form','id'=>'sendResetPasswordForm']) !!}
            <div class="row">
                <div class="col-md-12 form-group">
                    <label>Email:</label>
                    <input id="email" type="email" class="form-control pr-5 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" autofocus>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="m-t ladda-button ladda-button-demo btn btn-primary block full-width m-b "  data-style="zoom-in">
                    {{ __('Send Password Reset Link') }}
                </button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="{{Helper::backend_asset('js/jquery-3.1.1.min.js')}}"></script>
    <script src="{{Helper::backend_asset('js/bootstrap.min.js')}}"></script>
    <script src="{{Helper::backend_asset('js/plugins/toastr/toastr.min.js')}}"></script>
    <script src="{{Helper::backend_asset('js/plugins/validate/jquery.validate.min.js')}}"></script>
    <!-- Ladda -->
    <script src="{{Helper::backend_asset('js/plugins/ladda/spin.min.js')}}"></script>
    <script src="{{Helper::backend_asset('js/plugins/ladda/ladda.min.js')}}"></script>
    <script src="{{Helper::backend_asset('js/plugins/ladda/ladda.jquery.min.js')}}"></script>

    <script src="{{Helper::frontend_asset('js/custom.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            @if(Session::has('error'))
                toastr.error('{{Session::get('error')}}');
            @elseif(Session::has('Success'))
                toastr.success('{{Session::get('Success')}}');
            @endif
            @error('email')
                toastr.error('{{ $message }}');
            @enderror
            @if (session('status'))
                toastr.success('{{ session('status') }}');
            @endif
            var l = $('button[type=submit]').ladda();
            $("#sendResetPasswordForm").validate({
                rules: {
                    email:{
                        required: true,
                        email: true
                    }
                },
                messages: {
                    email:{
                        required: "Email Address is required.",
                        email: "Please enter valid email address."
                    }  
                },
                submitHandler: function(form) {
                    l.ladda( 'start' );
                    form.submit(); // submit the form
                }
            });
        });
    </script>
</body>
</html>
