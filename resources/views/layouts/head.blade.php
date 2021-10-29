<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="facebook-domain-verification" content="t1nl91va3nfxoj2xuisopcq3lt7szc" />
    <meta name="google-site-verification" content="exHhsWw0oD3Gis7GlOhygHhJq1BQT5s2ve2VrvHzMPc" />
    <title> @yield('title') | Legiit Lead</title>

    <link rel="icon" type="image/png" href="{{ Helper::assets('img/Favicon.png') }}"/>
    <link href="{{Helper::backend_asset('css/plugins/summernote/summernote.css')}}" rel="stylesheet">
    <link href="{{Helper::backend_asset('css/plugins/summernote/summernote-bs3.css')}}" rel="stylesheet">
    <link href="{{Helper::public_assets('backend/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{Helper::public_assets('backend/font-awesome/css/font-awesome.css')}}" rel="stylesheet">
    
    <link href="{{Helper::backend_asset('css/plugins/slick/slick.css')}}" rel="stylesheet">
    <link href="{{Helper::backend_asset('css/plugins/slick/slick-theme.css')}}" rel="stylesheet">

    <link href="{{Helper::public_assets('backend/css/plugins/toastr/toastr.min.css')}}" rel="stylesheet">
    <link href="{{Helper::public_assets('backend/css/animate.css')}}" rel="stylesheet">
    <link href="{{Helper::backend_asset('css/plugins/ladda/ladda-themeless.min.css')}}" rel="stylesheet">

    <link href="{{Helper::backend_asset('css/plugins/sweetalert/sweetalert.css')}}" rel="stylesheet">
    <link href="{{Helper::public_assets('backend/css/style.css')}}" rel="stylesheet">
    <link href="{{Helper::frontend_asset('css/custom.css')}}" rel="stylesheet">
    
    @yield('style')
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