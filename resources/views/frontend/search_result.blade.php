@extends('layouts.base')
@section('title','Search Result')
@section('content')
<div class="row wrapper border-bottom light-gray-bg page-heading">
	<div class="col-sm-9 mt-2 text-black">
	    <h3 class="m-t-20 fs-20">
	    	<strong>
	    		<span class="label_keyword"> @if($campaign->keywords) {{$campaign->keywords}} @else {{__('< Keywords >')}} @endif </span>
	    	</strong>
	    	<span class="text-gray"> in </span>
	    	<span class="label_location text-gray">
	    		@if($campaign->city)
	    		{{$campaign->city}}
	    		@else
	    		{{__('< Location >')}}
	    		@endif
	    	</span>
			<span class="label label-warning ml-4 br-6 fs-11 p1 pr-2 pl-2 label_type">
				@if(isset($campaign->searchType->name))
					{{$campaign->searchType->name}}
				@else
					{{__('< Search Type >')}}
	    		@endif
	    	</span>
	    </h3>
	</div>
    <div class="col-sm-3 mt-2">
    	<div class="m-t-20 text-right">
            {{-- <button class="btn btn-primary" id="auto-refresh">
                <i class="fa fa-refresh"></i> Refresh <span id="display_interval">(0)</span>
            </button> --}}
        </div>
    </div>
</div>
<div class="wrapper wrapper-content">
	<div class="row">
		<div class="col-md-6">
			<span class="fs-20">Leads</span>
		</div>
		<div class="col-md-6 text-right">
			<a href="{{route('printSeachResult',Helper::getEncrypted($campaign->id))}}" class="btn btn-default br-10 pl-4 pr-4" target="_blank"><i class="fa fa-print"></i> Print </a>
			<a href="{{route('exportSearchResults',Helper::getEncrypted($campaign->id))}}" class="btn btn-primary br-10 pl-4 pr-4">Export</a>
		</div>
	</div>
	<hr>
	<div class="table-resposive">
		{!! Form::open(['route'=>['search_result',Helper::getEncrypted($campaign->id)],'id'=>'search_form','method'=>'get'])!!}
		<div class="row company-search">
			<div class="col-md-6">
				<div class="input-group m-b">
					<span class="input-group-addon"><i class="fa fa-search"></i></span>
					<input type="text" name="search" placeholder="Search" class="form-control seach_on_change">
				</div>
			</div>
			<div class="col-md-6">
				<div class="text-right">
					<span class="ml-2"><small>Show:</small></span>
					{{Form::select('perpage',['10'=>'10','50'=>'50','75'=>'75','100'=>'100'],'',['id'=>'per_page'])}}
				</div>
			</div>
		</div>
		<input name="orderbycolumn" type="hidden" class="input-sm form-control" id="form-orderbycolumn">
    	<input name="orderby" type="hidden" class="input-sm form-control" id="form-orderby">
    	<input name="page" type="hidden" id="page">
		{!! Form::close() !!}
		<div class="table-responsive ibox-content" id="load_conent">
            @include('frontend.include.tableCampaignResult')
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
</div>
<!--begin::Modal-->
<div class="modal fade" id="send-mail-template" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
		{!! Form::open(['route' => ['campaign.sendemail'],'id'=>'send-email']) !!}
        <div class="modal-content model-lg">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Send Email</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body" id="preview-content">
            	{{Form::hidden('email','',['id'=>'to_email'])}}
            	<div class="form-group">
	            	<label>Email Template</label>
	            	<select name="email_template_id" class="form-control email_template">
	            		<option value="">Select Email Template</option>
	            		@foreach($mail_templates as $key => $value)
	            		<option value="{{Helper::getEncrypted($key)}}">{{$value}}</option>
	            		@endforeach
	            	</select>
	            </div>
            	<div class="mt-4" id="load-mail-content"></div>
            </div>
            <div class="modal-footer">
                <button type="submit" disabled class="ladda-button ladda-button-demo btn btn-primary"  data-style="zoom-in">
                Send</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
        {!! form::close() !!}
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
	    }
	});
</script>
@endsection
