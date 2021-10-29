@extends('layouts.base')
@section('title','New Search')
@section('style')
	<script src="https://maps.googleapis.com/maps/api/js?key={{env('GMAP_API_KEY')}}&sensor=false&libraries=places"></script>
	{{-- <script src="https://maps.googleapis.com/maps/api/js?key={{env('GMAP_API_KEY')}}&libraries=places" async defer></script> --}}
@endsection
@section('content')
<div class="row wrapper border-bottom light-gray-bg page-heading">
    <form action="{{route('new_search')}}" id="campaign_search_form" method="post">
    	@csrf
        {{Form::hidden('latitude','',['id'=>'latitude'])}}
        {{Form::hidden('longitude','',['id'=>'longitude'])}}

        <div class="col-sm-9 mt-2 text-black">
            <h3 class="m-t-20 fs-20">
                <strong>
                    <span class="label_keyword">
                        &lt;Keywords&gt;
                    </span>
                    {{Form::hidden('keywords','',['id'=>'keywords'])}}
                </strong>
                <span class="text-gray">
                    in
                </span>
                <span class="label_location text-gray">
                    &lt;Location&gt;
                </span>
                {{Form::hidden('location','',['id'=>'location'])}}
                <span class="label label-warning ml-4 br-6 fs-11 p1 pr-2 pl-2 label_type">
                    &lt;Search Type&gt;
                </span>
                {{Form::hidden('type','',['id'=>'type'])}}
                {{Form::hidden('mailme','false',['id'=>'mail_me'])}}
            </h3>
        </div>
        <div class="col-sm-3 text-right">
            <button class="btn btn-primary m-t-20 br-10" id="search_btn" type="button">
                Search
                <i class="fa fa-spinner fa-spin d-none">
                </i>
            </button>
        </div>
    </form>
</div>
<div class="wrapper wrapper-content custom-search-type">
    <div class="row custom-form">
        <div class="col-sm-4">
            <div class="form-group">
                <label class="text-black fs-13">
                    Keywords:
                </label>
                <input class="form-control" id="input_keywords" name="keywords" placeholder="Search" type="text">
                </input>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label class="text-black fs-13">
                    Location:
                </label>
                <input class="form-control" id="input_location" name="location" placeholder="Search" type="text">
                </input>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group text-right">
                <label></label>
                <div class="pull-right m-t-lg">
                    <label class="checkbox-label font-bold-none">
                        Email Me The Results
                        <input id="input_email_me" name="input_email_me" type="checkbox">
                            <span class="checkmark"></span>
                        </input>
                    </label>
                </div>
            </div>
        </div>
    </div>
    <hr class="mt-0"/>
    <div class="row d-flex">
        @php
		$i = 1;
		@endphp
		@foreach($searchTypes as $key => $type)
        <div class="col-sm-3 pr-3 pl-3">
            <a class="input_search_type" data-type="{{$type->name}}" href="Javascript:;" id="{{Helper::getEncrypted($type->id)}}">
                <div class="custom-card text-center h-100">
                    <div class="mt-5 mb-4 fs-19 text-primary">
                        @php
                            $img = Helper::getSearchTypeImg($key);
							@endphp
                        <img src="{{Helper::assets('img/'.$img)}}">
                        </img>
                    </div>
                    <h3 class="mb-0 text-black">
                        <strong class="word-break-all">
                            {{$type->name}}
                        </strong>
                    </h3>
                    <p class="fs-12 p-4 text-light-sky-gray word-break-all">
                        {{$type->description}}
                    </p>
                </div>
            </a>
        </div>
        @if($i == 4)
    </div>
    <div class="row d-flex m-t">
        @php
			$i = 1;
			@endphp
		@else
			@php
			$i++;
			@endphp
		@endif
		@endforeach
    </div>
</div>
@endsection
@section('javascript')
<script type="text/javascript">
    $(document).on('keyup','#input_keywords', function(){
		$('#keywords').val($(this).val());
		if($(this).val().length > 0){
			$('.label_keyword').html($(this).val());
		}else{
			$('.label_keyword').html("&lt;Keywords&gt;");
		}
	});
	$(document).on('keyup','#input_location', function(){
			var location = $('#input_location').val();
			$('.label_location').html("&lt;Location&gt;");
            $('#latitude').val('');
            $('#longitude').val('');
	});
	$(document).on('click','.input_search_type', function(){
		var id = $(this).attr('id');
		if($('.input_search_type.active').attr('id') != id){
			$('.input_search_type').removeClass('active');
			$('#'+id).addClass('active');
			$('#type').val(id);
			$('.label_type').html($(this).attr('data-type'));
		}else{
			$('.input_search_type').removeClass('active');
			$('#type').val('');
			$('.label_type').html('&lt;Search Type&gt;');
		}
	});
	$(document).on('change','#input_email_me',function(){
		$('#mail_me').val($(this).is(':checked'));
	})
	$(document).on('click','#search_btn',function(){
		var keywords = $('#keywords').val();
		var location = $('#location').val();
		var type 	 = $('#type').val();
        var latitude = $('#latitude').val();
        var longitude = $('#longitude').val();

		if(keywords == ""){
			toastr.error('Please enter any keywords.')
		}else if(location == ""){
			toastr.error('Please enter any location.')
		}else if(type == ""){
			toastr.error('Please select any search type.')
		}else if(latitude == "" || longitude == ""){
            $('#input_location').trigger('focus');
            toastr.error('Please enter valid location.')
        }else{
			$('#campaign_search_form').trigger('submit');
			$(this).attr('disabled',true);
		}
	});
</script>
<script type="text/javascript">
	function initialize() {
		var options = {
			types: ['(cities)'],
		};
		var input = document.getElementById('input_location');
		var autocomplete = new google.maps.places.Autocomplete(input,options);

        google.maps.event.addListener(autocomplete, 'place_changed', function () {
            var place = autocomplete.getPlace();
            var location = $('#input_location').val();
            $('.label_location').html(location +' <i class="fa fa-pencil"></i>');
            $('#location').val(location);
            $('#latitude').val(place.geometry.location.lat());
            $('#longitude').val(place.geometry.location.lng());
        });
	}
	google.maps.event.addDomListener(window, 'load', initialize);
</script>
@endsection
