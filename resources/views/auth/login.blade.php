<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Legiit Leads | Login</title>
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
<body class="dark-gray-bg">
    <div class="middle-box loginscreen animated justify-content-center fadeInDown d-flex align-item-center h-100">
        <div>
            <div class="text-center">
                <a href="{{route('landing')}}"> <img src="{{Helper::assets('img/Logo.png')}}" width="200"></a>
            </div>
            {!! Form::open(['route' => ['login'],'class'=>'m-t-lg','role'=>'form','id'=>'login_form']) !!}
            <div class="row">
                <div class="col-md-12 form-group">
                	<label>Email:</label>
                    <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" autofocus>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-md-12 form-group">
                	<label>Password:</label>
                    <input id="password" type="password" class="form-control pr-5 @error('password') is-invalid @enderror" name="password" autocomplete="current-password">
                    <i class="togglePassword fa fa-eye"  toggle="#password"></i>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
                <div class="form-group">
	                <button type="submit" class="mt-5 ladda-button ladda-button-demo br-10 btn btn-primary block full-width m-b "  data-style="zoom-in">
	                    {{ __('Login') }}
	                </button>
                </div>
                <div class="text-center m-t-lg">
                    <a href="{{route('password.request')}}" class="text-primary font-bold">Forgot password?</a>
                    <p class="text-muted text-center m-t"><small>Don't have an account?</small> <a href="{{route('register')}}" class="text-primary">Register here</a></p>
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
            var l = $('button[type=submit]').ladda();
            $("#login_form").validate({
                rules: {
                    email:{
                        required: true,
                        noSpace: true,
                        check_email: true,
                    },
                    password:{
                        required:  true,
                        normalizer: function( value ) {
                            return $.trim( value );
                        }
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
                    l.ladda( 'start' );
                    $('#login_form button').attr('disabled',true);
                    $('#login_form .fa-spin').removeClass('d-none');
                    $.ajax({
                        url: form.action,
                        type: form.method,
                        data: $(form).serialize(),
                        success: function(response) {
                            $('#login_form button').attr('disabled',false);
                            l.ladda('stop');
                            if (response.status == 200) {
                                toastr.success(response.message);
                                setTimeout(function() {
                                    location.reload();
                                }, 1000);
                            } else {
                                toastr.error(response.message);
                            }
                        },
                        error: function(){
                            setTimeout(function(){
                                location.reload();
                            },2000);
                            toastr.error('Something went wrong. Please try again sometime.');
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>
