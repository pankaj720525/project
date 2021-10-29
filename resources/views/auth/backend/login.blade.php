<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Legiitlead | Login</title>

    <link href="{{Helper::backend_asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{Helper::backend_asset('font-awesome/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{Helper::backend_asset('css/plugins/toastr/toastr.min.css')}}" rel="stylesheet">
    <link href="{{Helper::backend_asset('css/animate.css')}}" rel="stylesheet">
    <link href="{{Helper::backend_asset('css/style.css')}}" rel="stylesheet">
    <link href="{{Helper::backend_asset('css/custom.css')}}" rel="stylesheet">

</head>
<body class="gray-bg">
    <div class="middle-box loginscreen custom-loginscreen animated fadeInDown">
        <div>
            <div class="text-center mt-5">
                <img class="logo-name" src="{{Helper::assets('img/legiitleads.png')}}" width="250">
            </div>
            <h3 class=" text-center">Welcome to Legiit leads</h3>
            <p class=" text-center">Login in. To see it in action.</p>
            {!! Form::open(['route' => ['admin.login'],'class'=>'m-t','role'=>'form','id'=>'login_form']) !!}
                <div class="form-group">
                    <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" placeholder="Email" name="email" value="{{ old('email') }}" autocomplete="email" autofocus>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" autocomplete="current-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">
                    {{ __('Login') }} <i class="fa fa-spinner fa-spin d-none"></i>
                </button>
            {!! Form::close() !!}
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="{{Helper::backend_asset('js/jquery-3.1.1.min.js')}}"></script>
    <script src="{{Helper::backend_asset('js/bootstrap.min.js')}}"></script>
    <script src="{{Helper::backend_asset('js/plugins/toastr/toastr.min.js')}}"></script>
    <script src="{{Helper::backend_asset('js/plugins/validate/jquery.validate.min.js')}}"></script>
    <script src="{{Helper::backend_asset('js/custom.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            @if(Session::has('error'))
                toastr.error('{{Session::get('error')}}');
            @elseif(Session::has('Success'))
                toastr.success('{{Session::get('Success')}}');
            @endif
        });
        jQuery.validator.addMethod("noSpace", function(value, element) { 
            return value.indexOf(" ") < 0 && value != ""; 
        }, "Space not allow.");
        jQuery.validator.addMethod("check_email", function(value, element) {
            return this.optional(element) || /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/i.test(value);
        }, "Please enter a valid email address.");
        
        $(document).find(".alert").delay(3000).fadeOut("slow");
        $("#login_form").validate({
            rules: {
                email:{
                    required: true,
                    check_email: true,
                    noSpace: true
                },
                password:{
                    required:  true,
                    noSpace: true,
                }
            },
            messages: {
                email:{
                    required: "Email is required.",
                    email: "Please enter valid email address."
                },
                password:{
                    required:  "Password is required."
                }   
            },
            submitHandler: function(form) {
                $('#login_form button').attr('disabled',true);
                $('#login_form .fa-spin').removeClass('d-none');
                $.ajax({
                    url: form.action,
                    type: form.method,
                    data: $(form).serialize(),
                    success: function(response) {
                        $('#login_form button').attr('disabled',false);
                        $('#login_form .fa-spin').addClass('d-none');
                        if (response.status == 401) {
                            toastr.error(response.message);
                        } else {
                            toastr.success(response.message);
                            setTimeout(function() {
                                location.reload();
                            }, 1000);
                        }
                    },
                    error: function(){
                        $('#login_form .fa-spin').addClass('d-none');
                        $('#login_form button').attr('disabled',false);
                        toastr.error('Something went wrong. Please try again sometime.');
                    }
                });
            }
        });
    </script>
</body>
</html>
