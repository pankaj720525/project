<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Legiit Leads | Registration</title>
    <link rel="icon" type="image/png" href="{{ Helper::assets('img/Favicon.png') }}"/>
    <link href="{{Helper::backend_asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{Helper::backend_asset('font-awesome/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{Helper::backend_asset('css/plugins/toastr/toastr.min.css')}}" rel="stylesheet">
    <link href="{{Helper::backend_asset('css/animate.css')}}" rel="stylesheet">
    <link href="{{Helper::backend_asset('css/style.css')}}" rel="stylesheet">
    <link href="{{Helper::backend_asset('css/plugins/ladda/ladda-themeless.min.css')}}" rel="stylesheet">
    <link href="{{Helper::frontend_asset('css/custom.css')}}" rel="stylesheet">
     <!-- Facebook Pixel Code -->
    <script>
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
        n.callMethod.apply(n,arguments):n.queue.push(arguments)};
        if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
        n.queue=[];t=b.createElement(e);t.async=!0;
        t.src=v;s=b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t,s)}(window, document,'script',
        'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '771544636257431');
        fbq('track', 'PageView');
        fbq('track', 'Purchase', {
        value: 297,
        currency: 'USD'
    });
    </script>
    <noscript><img height="1" width="1" style="display:none"
    src="https://www.facebook.com/tr?id=771544636257431&ev=PageView&noscript=1"
    /></noscript>
    <!-- End Facebook Pixel Code -->

    <!-- Facebook Pixel Code -->
    <script>
    !function(f,b,e,v,n,t,s)
    {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
    n.callMethod.apply(n,arguments):n.queue.push(arguments)};
    if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
    n.queue=[];t=b.createElement(e);t.async=!0;
    t.src=v;s=b.getElementsByTagName(e)[0];
    s.parentNode.insertBefore(t,s)}(window, document,'script',
    'https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', '291265201398169');
    fbq('track', 'PageView');
    fbq('track', 'Purchase', {
    value: 297,
    currency: 'USD'
    });
    </script>
    <noscript><img height="1" width="1" style="display:none"
    src="https://www.facebook.com/tr?id=291265201398169&ev=PageView&noscript=1"
    /></noscript>
    <!-- End Facebook Pixel Code -->

    <!-- Event snippet for Purchase conversion page -->
    <script>
      gtag('event', 'conversion', {
          'send_to': 'AW-881372725/0SYfCI7Crv8CELXcoqQD',
          'transaction_id': ''
      });
    </script>
    <script async src="//static.getclicky.com/101339245.js"></script>
    <noscript><p><img alt="Clicky" width="1" height="1" src="//in.getclicky.com/101339245ns.gif" /></p></noscript>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-ETGTQKJBYJ"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'G-ETGTQKJBYJ');
    </script>

    <!-- Global site tag (gtag.js) - Google Ads: 881372725 -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=AW-881372725"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'AW-881372725');
    </script>
</head>
<body>
    <div class="grid-column-form">
    	<div class="splitdiv" id="leftdiv">
			<div class="logo-header">
				<a href="{{route('landing')}}"><img width="150" src="{{Helper::assets('img/small_black_logo.png')}}"></a>
			</div>
			<a href="{{route('landing')}}"><img style="width: 100%;" src="{{Helper::assets('img/Illustration.png')}}"></a>
    	</div>

    	<div class="splitdiv" id="rightdiv">
            <div class="logo-header text-right">
                <small>Already have an account? </small><a class="text-primary" href="{{route('login')}}">Login</a>
            </div>
            <div class="d-flex justify-content-center">
            {!! Form::open(['route' => ['register'],'class'=>'register_form custom-form-div','role'=>'form','id'=>'register_form']) !!}
                <div class="row">
                    <div class="col-md-12 mb-5">
                        <h1 class="font-bold">Create Account</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 form-group">
                        <label>First Name:</label>
                        <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" placeholder="First Name" name="first_name" value="{{ old('first_name') }}" >
                        @error('first_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 form-group">
                        <label>Last Name:</label>
                        <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" placeholder="Last Name" name="last_name" value="{{ old('last_name') }}" >
                        @error('last_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 form-group">
                        <label>Email:</label>
                        <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" placeholder="Email" name="email" value="{{ old('email') }}" autocomplete="email" autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label>Password:</label>
                        <input id="password" type="password" class="form-control pr-5 @error('password') is-invalid @enderror" name="password" placeholder="Password" autocomplete="current-password">
                        <i class="fa fa-eye togglePassword"  toggle="#password"></i>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label>&nbsp;</label>
                        <input id="password_confirmation" type="password" class="form-control pr-5 @error('password_confirmation') is-invalid @enderror" name="password_confirmation" placeholder="Confirm Password">
                        <i class="fa fa-eye togglePassword" toggle="#password_confirmation"></i>
                        @error('password_confirmation')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-12 form-group">
                        <label class="checkbox-label text-gray font-bold-none"> By creating an account, you agree to the Terms of Service and Privacy Policy<br>
                            <input checked type="checkbox" id="agree" name="agree" id="agree" class="temrs_condition" required>
                            <span class="checkmark"></span>
                        </label>
                    </div>
                </div>
                <button type="submit" class="ladda-button ladda-button-demo btn btn-primary btn-lg block full-width m-b"  data-style="zoom-in">
                    {{ __('Register') }}
                </button>
            {!! Form::close() !!}
            </div>
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

    <script src="{{Helper::backend_asset('js/plugins/iCheck/icheck.min.js')}}"></script>
    <script src="{{Helper::frontend_asset('js/custom.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
            @if(Session::has('error'))
                toastr.error('{{Session::get('error')}}');
            @elseif(Session::has('Success'))
                toastr.success('{{Session::get('Success')}}');
            @endif
            @if($errors->any())
				toastr.error('{{ $errors->first() }}');
			@endif
        });

        var l = $('button[type=submit]').ladda();
        $("#register_form").validate({
            rules: {
                first_name:{
                    required: true,
                    noSpace: true,
                    minlength: 3,
                    lettersonly: true,
                    maxlength: 20,
                },
                last_name:{
                    required: true,
                    noSpace: true,
                    minlength: 3,
                    lettersonly: true,
                    maxlength: 20,
                },
                // phone:{
                //     number: true,
                //     required: true,
                //     minlength: 10,
                //     maxlength: 15,
                //     noSpace: true,
                //     remote: {
                //         url: "{{route('check.exists')}}",
                //         headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                //         type: 'post',
                //         data: {
                //             column_name: "phone",
                //             value: function()
                //             {
                //                 return $('#phone').val();
                //             }
                //         }
                //     }
                // },
                email:{
                    required: true,
                    noSpace: true,
                    check_email: true,
                    remote: {
                        url: "{{route('check.exists')}}",
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        type: 'post',
                        data: {
                            column_name: "email",
                            value: function()
                            {
                                return $('#email').val();
                            }
                        }
                    }
                },
                password:{
                    required:  true,
                    noSpace: true,
                    pwcheck: true,
                },
                password_confirmation:{
                    equalTo: "#password",
                    required:  true
                },
                agree: {
                	required: true
                }
            },
            messages: {
                first_name:{
                    required: "First Name is required.",
                },
                last_name:{
                    required: "Last Name is required.",
                },
                // phone:{
                //     required: "Phone Number is required.",
                //     remote: "This phone number is already exists."
                // },
                email:{
                    required: "Email Address is required.",
                    remote: "This email address is already exists."
                },
                password:{
                    required: "Password is required.",
                    minlength: "Please enter at least 8 characters."
                },
                password_confirmation:{
                    required: "Confirm Password is required.",
                    equalTo: "Password & Confirm Password does not match."
                }
            },
            submitHandler: function(form) {
                l.ladda( 'start' );
                form.submit(); // submit the form
            }
        });
    </script>
</body>
</html>
