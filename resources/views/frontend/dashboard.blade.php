@extends('layouts.base')
@section('title','Dashboard')
@section('content')
<div class="row wrapper border-bottom light-gray-bg page-heading">
    <div class="col-sm-4 text-black">
        <h3 class="m-t-20 fs-20"><strong>{{__('Dashboard')}}</strong></h3>
    </div>
    <button class="btn btn-primary d-none" id="auto-refresh">
    	<i class="fa fa-refresh"></i> Refresh <span id="display_interval">(0)</span>
    </button>
</div>
<div class="wrapper wrapper-content pb-0">
	<div class="table-resposive">
		<div>
			<h2>Past Searches <a href="{{route('search_history')}}" class="btn btn-link">View More</a></h2>
			{!! Form::open(['route' => ['filterPastSearch'],'class'=>'d-none','id'=>'search_form','method'=>'get']) !!}
                <input name="orderbycolumn" type="hidden" class="input-sm form-control" id="form-orderbycolumn">
            	<input name="orderby" type="hidden" class="input-sm form-control" id="form-orderby">
	        {!! form::close() !!}
		</div>
		<div class="table-responsive ibox-content" id="load_conent">
            @include('frontend.include.tableDashboardPastSearch')
        </div>
	</div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row d-flex align-item-center">
		<div class="col-lg-3 h-100">
			<div class="widget p-lg pr-3">
				<div class="m-b-md">
					<h4 class="text-primary">FEATURED</h4>
					<h2><strong>Best Matching Services</strong></h2>
					<div class="fs-14 mt-3">
						Check out these matching services on Legiit that have been catching a lot of attention lately.
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-9 h-100" id="load-legiit-service">
			@include('backend.common.spinner')
		</div>
	</div>
	<hr>
	<div class="row mb-5">
		@foreach($member_contents as $value)
			<div class="col-lg-4 pr-3 pl-3">
				<div>
	                <figure>
	                    <iframe height="200" src="{{Helper::getYoutubeLink($value->videolink)}}" frameborder="0" allowfullscreen style="width: 340px;"></iframe>
	                </figure>
	                <div><label>{{$value->title}}</label></div>
	                <div class="fs-12 text-gray">{{$value->description}}</div>
	            </div>
			</div>
		@endforeach
	</div>
</div>
@endsection

@section('javascript')
<script type="text/javascript">
	$(document).ready(function(){
		 $.ajax({
            type: "POST",
            url: "{{route('loadLegiitServices',$last_search_type)}}",
            data: { _token: $('meta[name="csrf-token"]').attr("content") },
            success: function (data) {
                $('#load-legiit-service').html(data.html);
                service_slider();
            },
            error: function(){
                $('#load-legiit-service').html('<div class="text-center"><h2><b>No services found</b></h2></div>');
            	toastr.error('Something went wrong. Legiit services not found.')
            }
        });

	    function service_slider(){
	        $('.slick_demo_2').slick({
	            infinite: true,
	            slidesToShow: 3,
	            slidesToScroll: 1,
	            centerMode: false,
	            responsive: [
	                {
	                    breakpoint: 1024,
	                    settings: {
	                        slidesToShow: 3,
	                        slidesToScroll: 3,
	                        infinite: true,
	                        dots: false
	                    }
	                },
	                {
	                    breakpoint: 600,
	                    settings: {
	                        slidesToShow: 2,
	                        slidesToScroll: 2,
	                        dots: false
	                    }
	                },
	                {
	                    breakpoint: 480,
	                    settings: {
	                        slidesToShow: 1,
	                        slidesToScroll: 1,
	                        dots: false
	                    }
	                }
	            ]
	        });

	        $(document).on('click','.read-more',function(){
	        	var val = $(this).val();
	        	if($(this).is(':checked')){
	        		$('#label-'+val).html('Less');
	        		$('#desc-'+val).css('-webkit-line-clamp','unset');
	        	}else{
	        		$('#desc-'+val).css('-webkit-line-clamp','3');
	        		$('#label-'+val).html('Read More');
	        	}
	        });
	    }
	});
</script>
@endsection
