<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="facebook-domain-verification" content="t1nl91va3nfxoj2xuisopcq3lt7szc" />
    <meta name="google-site-verification" content="exHhsWw0oD3Gis7GlOhygHhJq1BQT5s2ve2VrvHzMPc" />
    <title>Legiit Leads | Landing</title>
    <link rel="icon" type="image/png" href="{{ Helper::assets('img/Favicon.png') }}"/>
    {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> --}}
    <link href="{{Helper::frontend_asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{Helper::frontend_asset('css/app.css') }}" rel="stylesheet">
    <link href="{{Helper::backend_asset('font-awesome/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{Helper::backend_asset('css/plugins/toastr/toastr.min.css')}}" rel="stylesheet">
    <link href="{{Helper::backend_asset('css/animate.css')}}" rel="stylesheet">
    {{-- <link href="{{Helper::backend_asset('css/style.css')}}" rel="stylesheet"> --}}
    <link href="{{Helper::backend_asset('css/plugins/ladda/ladda-themeless.min.css')}}" rel="stylesheet">
    <link href="{{Helper::frontend_asset('css/custom.css?version=3')}}" rel="stylesheet">
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
<body class="bg-white">
	<!-- Header -->
	<nav class="navbar navbar-expand-md navbar-light pt-4 dark-gray-bg">
        <div class="container">
            <a class="navbar-brand" href="{{ route('landing') }}">
    			<img src="{{Helper::assets('img/small_logo.png')}}" class="img-fluid" />
            </a>
            <button class="navbar-toggler text-white" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav ml-auto mr-5">
                    <!-- Authentication Links -->
                    <li class="nav-item">
                        <a class="btn btn-full pl-4 pr-4 text-dark-blue font-SourceSansPro font-bold border-none" href="{{ route('pricing') }}">{{ __('Pricing') }}</a>
                    </li>
                    <li class="nav-item mr-5">
                        <a class="btn btn-full pl-4 pr-4 text-dark-blue font-SourceSansPro font-bold border-none" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-outline-light pl-5 pr-5 br-10 border-white font-bold font-SourceSansPro" href="{{route('register')}}">{{ __('Start Now') }}</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
	<!--End | Header -->

	<!-- Content -->
    <main class="py-2 dark-gray-bg">
		<div class="container">
			<div class="row custom-min-h">
				<div class="col-md-6 min-h-350">
					<div class="custom-left-content">
						<div>
							<img src="{{Helper::assets('img/Tablet.png')}}" class="tablet-img">
						</div>
					</div>
				</div>
				<div class="col-md-6 pt-5">
					<div class="custom-right-content">
						<p class="custom-title-text">EASY AS 1 2 3</p>
						<p class="custom-large-title">
							We Make Finding Targeted Leads Simple & Effective
						</p>
						<p class="custom-bottom-text">
							Our proprietary search engine helps to uncover local leads who have proven problems you can solve
						</p>
						<a href="{{route('register')}}" class="btn btn-primary br-10 pr-4 pl-4 mt-2 mb-4">Get Started</a>
					</div>
				</div>
			</div>
		</div>
    </main>
    <main class=" custom-mt-5">
    	<div class="container">
    		<div class="row">
    			<div class="col-md-5 d-flex align-item-center">
    				<div class="custom-right-content pl-4">
						<p class="custom-large-title">
							Be An Outreach Legend
						</p>
						<p class="custom-bottom-text">
							With our training and outreach templates, you can find and close more leads faster and easier than ever before
						</p>
						<a href="{{route('register')}}" class="btn btn-primary br-10 pr-4 pl-4 mt-2 mb-4">Get Started</a>
    				</div>
    			</div>
    			<div class="col-md-7 pl-0">
					<img class="consectetur-image" src="{{Helper::assets('img/landing-image-2.png')}}">
    			</div>
    		</div>
    	</div>
    </main>
    <main class="py-2 bg-light-sky">
    	<div class="container">
    		<div class="row custom-min-h">
    			<div class="col-md-6 d-flex align-item-center mt-4 pl-0">
					<img class="dashboard-image" src="{{Helper::assets('img/landing-image-3.png')}}">
    			</div>
    			<div class="col-md-6 d-flex align-item-center">
    				<div class="custom-right-content pl-7 pr-5">
						<p class="custom-large-title">
							Directly Outsource Your Deals
						</p>
						<p class="custom-bottom-text">
							To make it even easier, we’ve hand selected service providers who can deliver results for your leads so you can close deals confidently knowing both you and your leads can get more stuff done
                        </p>
						<a href="{{route('register')}}" class="btn btn-primary br-10 pr-4 pl-4 mt-2 mb-4">Get Started</a>
    				</div>
    			</div>
    		</div>
    	</div>
    </main>

    <main class="py-2 dark-gray-bg">
	    <div id="client-feedback-slider" class="carousel slide" data-ride="carousel">
	    	<div class="carousel-inner">
	    		<div class="carousel-item active">
	    			<div class="d-flex justify-content-center pt-4 pb-4">
	    				<div class="text-center w-50 testinomal">
	    					<div class="testinomal-profile">
	    						<img src="{{Helper::assets('img/ellipse-36.png')}}">
	    					</div>
	    					<div class="testinomal-name">
	    						Craig Bellanca
	    					</div>
	    					<div class="designation">
	    						A Total Game Changer
	    					</div>
	    					<div class="description">
	    						I’ve been using Legiit Leads for only a few days and it’s already been a total game changer for me.  I can easily find local businesses who have a gap in their business and offer them the perfect solution, especially since I have access to pre-selected people to do the work for me.  This saves me so much time and makes bringing in new clients so much easier
	    					</div>
	    					<div class="rating text-yellow">
	    						<span class="fa fa-star checked"></span>
	    						<span class="fa fa-star checked"></span>
	    						<span class="fa fa-star checked"></span>
	    						<span class="fa fa-star checked"></span>
	    						<span class="fa fa-star checked"></span>
	    					</div>
	    				</div>
	    			</div>
	    		</div>
	    	</div>
	    	{{-- <a class="carousel-control-prev" href="#client-feedback-slider" role="button" data-slide="prev">
	    		<span class="carousel-control-prev-icon" aria-hidden="true"></span>
	    		<span class="sr-only">Previous</span>
	    	</a>
	    	<a class="carousel-control-next" href="#client-feedback-slider" role="button" data-slide="next">
	    		<span class="carousel-control-next-icon" aria-hidden="true"></span>
	    		<span class="sr-only">Next</span>
	    	</a> --}}
	    </div>
    </main>
	<!--End | Content -->

	<!-- Footer -->
	<footer class="footer">
	    <div class="container pt-2 pb-2">
	        <div class="row">
	        	<div class="col-12 d-flex justify-content-between">
	        		<div>
	    				<img src="{{Helper::assets('img/small_black_logo.png')}}" width="130" class="img-fluid" />
	        		</div>
	        		<div>
			           	<p class="line-height-1 mt-2 mb-2 custom-mr-3 h6">Copyright {{date('Y')}} by LegiitLeads</p>
	        		</div>
	        	</div>
	        </div>
	    </div>
	</footer>
	<!-- End | Footer -->

    <!-- Mainly scripts -->
	<script src="{{Helper::frontend_asset('js/jquery-3.5.1.min.js') }}"></script>
    <script src="{{Helper::frontend_asset('js/bootstrap.bundle.min.js')}}"></script>
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
    </script>
</body>
</html>
