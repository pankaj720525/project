<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="facebook-domain-verification" content="t1nl91va3nfxoj2xuisopcq3lt7szc" />
    <meta name="google-site-verification" content="exHhsWw0oD3Gis7GlOhygHhJq1BQT5s2ve2VrvHzMPc" />
    <title>Legiit Leads | Subscription Plan</title>
    <link rel="icon" type="image/png" href="{{ Helper::assets('img/Favicon.png') }}"/>
    <link href="{{Helper::frontend_asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{Helper::frontend_asset('css/app.css') }}" rel="stylesheet">
    <link href="{{Helper::backend_asset('font-awesome/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{Helper::backend_asset('css/plugins/sweetalert/sweetalert.css')}}" rel="stylesheet">
    <link href="{{Helper::backend_asset('css/plugins/toastr/toastr.min.css')}}" rel="stylesheet">
    <link href="{{Helper::backend_asset('css/animate.css')}}" rel="stylesheet">
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
                    @if(Auth::check())
	                    <li class="nav-item">
	                        <a class="btn btn-full pl-4 pr-4 text-dark-blue font-SourceSansPro font-bold border-none" href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a>
	                    </li>
	                    <li class="nav-item">
	                        <a class="btn btn-full pl-4 pr-4 text-dark-blue font-SourceSansPro font-bold border-none" href="{{ route('logout') }}">{{ __('Logout') }}</a>
	                    </li>
                    @else
                    <li class="nav-item">
                        <a class="btn btn-full pl-4 pr-4 text-dark-blue font-SourceSansPro font-bold border-none" href="{{ route('pricing') }}">{{ __('Pricing') }}</a>
                    </li>
                    <li class="nav-item mr-5">
                        <a class="btn btn-full pl-4 pr-4 text-dark-blue font-SourceSansPro font-bold border-none" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-outline-light pl-5 pr-5 br-10 border-white font-bold font-SourceSansPro" href="{{route('register')}}">{{ __('Start Now') }}</a>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
	<!--End | Header -->

	<!-- Content -->
    <main class="py-4 custom-min-h d-flex justify-content-center custom-subscription-bg">
        <div class="container custom-plan">
        	@if(Auth::check())
	        	@if(!isset(Auth::user()->subscribe))
	        		<div class="alert alert-danger text-center">
	        			<button class="close" data-close="alert"></button>
	        			<span> Your subscription doesn't have purchase any plan yet. </span>
	        			{{-- <span> Your subscription plan is expired. </span> --}}
	        		</div>
	        	@elseif(Auth::user()->subscribe->subscription->billing_period == 'lifetime')
	        		<div class="alert alert-primary text-center">
	        			<button class="close" data-close="alert"></button>
	        			<span> You have already subscribed with the lifetime package. if you want change your subscription plan contact to administrator. <a href="mailto:{{env('MAIL_FROM_ADDRESS')}}">{{env('MAIL_FROM_ADDRESS')}}</a></span>
	        		</div>
	        	@endif
        	@endif
        	<div class="row cust-price-detail">
        		@if(count($subscriptions) > 0)
        		@php $i = 1; @endphp
                @foreach($subscriptions as $plan)
            		<div class="col-md-4 mb-4">
            			<div class="jumbotron bg-white text-black text-center br-20 cust-price-card @if(Auth::check() && isset(Auth::user()->subscribe) && Auth::user()->subscribe->status == 1 && Auth::user()->subscribe->is_cancel == 0 && Auth::user()->subscribe->subscription_id == $plan->id)active-plan @endif">
            				<div>
            					@if($i == 1)
            					<img src="{{Helper::assets('img/starter-plan.png')}}">
            					@elseif($i == 2)
            					<img src="{{Helper::assets('img/pro-plan.png')}}">
            					@elseif($i == 3)
            					<img src="{{Helper::assets('img/unlimited-plan.png')}}">
            					@endif
            				</div>
            				@php $i++ @endphp
            				<div class="plan-name word-break-all">{{$plan->package_name}}</div>
            				<hr>
                            @if(Auth::check()  && $user_plan!=null  && $user_plan->subscription_id == $plan->id  && $user_plan->is_cancel == '0')
                                <h4 class="current-plan-title">Current plan</h4>
                            @endif
            				<div>
            					<div class="custom-plan-price font-SourceSansPro fs-25">
            						<span>$</span>
        							<span class="price">{{$plan->price}}</span>
        							<span>/
            							{{ucfirst($plan->billing_period)}}
            						</span>
        						</div>
        						<div class="description mb-4">
                                    <div>{!! nl2br($plan->description) !!}</div>
        						</div>
            					@if(Auth::check())
                                    {!! Form::open(['route'=>['paypal_update_subscription'],'id'=>'subscription_form'])!!}
                                    @if($user_plan!=null  && $user_plan->subscription_id == $plan->id)
                                            @if($user_plan->status == 1 && $user_plan->is_cancel == '0')
                                            <button type="submit" class="btn btn-danger btn-circle  cancel_subscription" data-url="{{route('cancel-subscription')}}">
                                                Cancel Subscription
                                            </button>
                                            @else
                                            {{ Form::hidden('plan_id',Helper::getEncrypted($plan->id))}}
                                            <button type="submit" class="btn btn-primary btn-circle full-width m-b pr-4 pl-4 br-10" >
                                                Subscribe
                                            </button>
                                            @endif
                                    @else
	                                    @if(isset($user_plan->subscription) && $user_plan->subscription->billing_period == 'lifetime')
			                                    <button type="button" class="btn btn-primary btn-circle full-width m-b pr-4 pl-4 br-10" disabled>
			                                    	Subscribe
			                                    </button>
	                                    @else
		                                    	{{ Form::hidden('plan_id',Helper::getEncrypted($plan->id))}}
		                                    	<button type="submit" class="btn btn-primary btn-circle full-width m-b pr-4 pl-4 br-10">
			                                        @if(isset($user_plan) &&  $user_plan->subscription_id == $plan->id)
			                                        	Renew Plan
			                                        @else
			                                        	Subscribe
			                                        @endif
			                                    </button>

	                                    @endif
                                    @endif
            						{!! Form::close() !!}
                                @else
                                	{!! Form::open(['route'=>['subscription'],'id'=>'subscription_form'])!!}
            						{{ Form::hidden('plan_id',Helper::getEncrypted($plan->id))}}
                                    <button type="submit" class="btn btn-primary btn-circle full-width m-b pr-4 pl-4 br-10">
                                        Subscribe
                                    </button>
            						{!! Form::close() !!}
                                @endif
            				</div>
            			</div>
            		</div>
        		@endforeach
                @else
                    <div class="col-md-4">
                        <div class="jumbotron text-black text-center br-20 cust-price-card ">
                            <div class="description">
                                <h2>No any subscription plan available.</h2>
                            </div>
                        </div>
                    </div>
                @endif
        	</div>
        </div>
	</main>
    <main class="py-2 mt-4 mb-5">
    	<div class="container">
	    	<div class="row">
	    		<div class="col-md-12">
	    			<div class="price-faq">
	    				Pricing FAQ
	    			</div>
	    		</div>
	    		<div class="col-md-12">
	    			<div class="faq-item">
	    				<div class="row">
	    					<div class="col-md-8">
	    						<a data-toggle="collapse" href="#faq1" class="faq-question">
                                    How many searches can I do per month?
                                </a>
	    					</div>
	    					<div class="col-md-4 text-right">
                                <a data-toggle="collapse" href="#faq1" class="faq-question"><i class="fa fa-chevron-down"></i>
                                </a>
    						</div>
	    				</div>
	    				<div class="row">
	    					<div class="col-lg-12">
	    						<div id="faq1" class="panel-collapse collapse ">
	    							<div class="faq-answer">
	    								<p>
	    									The starter plan comes with 50 searches per month, and the Agency and Lifetime plans both come with 100 searches per month.
	    								</p>
	    							</div>
	    						</div>
	    					</div>
	    				</div>
	    			</div>
	    		</div>
	    		<div class="col-md-12">
	    			<div class="faq-item">
	    				<div class="row">
	    					<div class="col-md-8">
	    						<a data-toggle="collapse" href="#faq2" class="faq-question">Can I search based on keyword or location?</a>
	    					</div>
	    					<div class="col-md-4 text-right">
	    						<a data-toggle="collapse" href="#faq2" class="faq-question">
	                                <i class="fa fa-chevron-down"></i>
	                            </a>
    						</div>
	    				</div>
	    				<div class="row">
	    					<div class="col-lg-12">
	    						<div id="faq2" class="panel-collapse collapse ">
	    							<div class="faq-answer">
	    								<p>
	    									Yes, you can search based on keyword and location to show results specific to a certain area.
	    								</p>
	    							</div>
	    						</div>
	    					</div>
	    				</div>
	    			</div>
	    		</div>
	    		<div class="col-md-12">
	    			<div class="faq-item">
	    				<div class="row">
	    					<div class="col-md-8">
	    						<a data-toggle="collapse" href="#faq3" class="faq-question">
                                    How does the lifetime plan work?
                                </a>
	    					</div>
	    					<div class="col-md-4 text-right">
	    						<a data-toggle="collapse" href="#faq3" class="faq-question">
	                                <i class="fa fa-chevron-down"></i>
	                            </a>
    						</div>
	    				</div>
	    				<div class="row">
	    					<div class="col-lg-12">
	    						<div id="faq3" class="panel-collapse collapse ">
	    							<div class="faq-answer">
	    								<p>
	    									The lifetime plan is a one time payment and will grant you access to the Agency level plan for life.
	    								</p>
	    							</div>
	    						</div>
	    					</div>
	    				</div>
	    			</div>
	    		</div>
	    		<div class="col-md-12">
	    			<div class="faq-item">
	    				<div class="row">
	    					<div class="col-md-8">
	    						<a data-toggle="collapse" href="#faq4" class="faq-question">Is training available?</a>
	    					</div>
	    					<div class="col-md-4 text-right">
	    						<a data-toggle="collapse" href="#faq4" class="faq-question">
	                                <i class="fa fa-chevron-down"></i>
	                            </a>
    						</div>
	    				</div>
	    				<div class="row">
	    					<div class="col-lg-12">
	    						<div id="faq4" class="panel-collapse collapse ">
	    							<div class="faq-answer">
	    								<p>
	    									Yes, we provide training so that you can have better success when it comes to reaching out to your leads.
	    								</p>
	    							</div>
	    						</div>
	    					</div>
	    				</div>
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
    <script src="{{Helper::backend_asset('js/plugins/sweetalert/sweetalert.min.js')}}"></script>
    <script src="{{Helper::public_assets('backend/js/plugins/toastr/toastr.min.js')}}"></script>
    <script src="{{Helper::backend_asset('js/plugins/validate/jquery.validate.min.js')}}"></script>
    <!-- Ladda -->
    <script src="{{Helper::backend_asset('js/plugins/ladda/spin.min.js')}}"></script>
    <script src="{{Helper::backend_asset('js/plugins/ladda/ladda.min.js')}}"></script>
    <script src="{{Helper::backend_asset('js/plugins/ladda/ladda.jquery.min.js')}}"></script>

    <script src="{{Helper::backend_asset('js/plugins/iCheck/icheck.min.js')}}"></script>
    <script src="{{Helper::frontend_asset('js/custom.js')}}"></script>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    	function lifetime(){
            toastr.error('You have already subscribed with the lifetime package. if you want change your subscription plan contact to administrator.');
		}
        $(document).ready(function(){
        	$(document).on('submit','#subscription_form',function(){
        		$(this).find('button[type=submit]').ladda().ladda('start');
            	$('button[type=submit]').attr('disabled',true);
        	});
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
        $('.faq-question').click(function(){
        	if($(this).parent().parent().parent().attr('id') == '1'){
        		$(this).parent().parent().parent().removeClass('active').attr('id',0);
    			$(this).parent().parent().children().children().children('i').removeClass('fa-chevron-up').addClass('fa-chevron-down');
        	}else{
        		$(this).parent().parent().parent().addClass('active').attr('id',1);
    			$(this).parent().parent().children().children().children('i').removeClass('fa-chevron-down').addClass('fa-chevron-up');
        	}
        });
    </script>
</body>
</html>
