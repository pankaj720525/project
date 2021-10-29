<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Legiit Leads | Reset Password</title>
    <link rel="icon" type="image/png" href="{{ Helper::assets('img/Favicon.png') }}"/>
    <link href="{{Helper::backend_asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{Helper::backend_asset('font-awesome/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{Helper::backend_asset('css/plugins/toastr/toastr.min.css')}}" rel="stylesheet">
    <link href="{{Helper::backend_asset('css/animate.css')}}" rel="stylesheet">
    <link href="{{Helper::backend_asset('css/style.css')}}" rel="stylesheet">
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
</head>
<body class="dark-gray-bg">
    <div class="middle-box loginscreen animated justify-content-center fadeInDown d-flex align-item-center h-100">
        <div>
            <div class=" text-center">
                <a href="{{route('login')}}"><img src="{{Helper::assets('img/Logo.png')}}" width="200"></a>
                <p class="m-t">Reset Password</p>
            </div>
            {!! Form::open(['route' => ['password.update'],'class'=>'m-t custom-form-div','role'=>'form','id'=>'updatePassword']) !!}
                <input type="hidden" name="token" value="{{ $token }}">
                <input id="email" type="hidden" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                 <div class="row">
                    <div class="col-md-12 form-group">
                        <label>Password:</label>
                        <input id="password" type="password" class="form-control pr-5 @error('password') is-invalid @enderror" name="password" placeholder="Password" required autocomplete="new-password">
                        <i class="fa fa-eye togglePassword"  toggle="#password"></i>
                    </div>
                    <div class="col-md-12 form-group">
                        <label>Confirm Password:</label>
                        <input id="password_confirmation" type="password" class="form-control pr-5" name="password_confirmation" placeholder="Confirm Password" required autocomplete="new-password">
                        <i class="fa fa-eye togglePassword" toggle="#password_confirmation"></i>
                    </div>
                </div>
                <button type="submit" class="m-t btn btn-primary block full-width m-b border-none">
                    {{ __('Reset Password') }} <i class="fa fa-spinner fa-spin d-none"></i>
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
            @error('email')
                toastr.error('{{ $message }}');
            @enderror
            @error('password')
                toastr.error('{{ $message }}');
            @enderror
        });
        $("#updatePassword").validate({
            rules: {
                password:{
                    required:  true,
                    noSpace: true,
                    pwcheck: true,
                },
                password_confirmation:{
                    equalTo: "#password",
                    required:  true
                }
            },
            messages: {
                password:{
                    required: "Password is required.",
                },
                password_confirmation:{
                    required: "Confirm Password is required.",
                    equalTo: "Password & Confirm Password does not match."
                }   
            }
        });
    </script>
</body>
</html>
