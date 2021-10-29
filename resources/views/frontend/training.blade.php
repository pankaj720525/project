@extends('layouts.base')
@section('title','Training')
@section('content')
<div class="row wrapper border-bottom light-gray-bg page-heading">
    <div class="col-sm-9 mt-2 text-black">
        <h3 class="m-t-20 fs-20">
        	<strong>
        		<span class="label_keyword"> Training </span>
        	</strong>
        </h3>
    </div>
</div>
<div class="wrapper wrapper-content">
	<div class="row pb-5 pt-3">
		<div class="col-md-6">
            @foreach($training_videos as $value)
				<div class="col-lg-12">
	            	<div class="m-b">
	            		<figure>
	            			<iframe height="300" src="{{Helper::getYoutubeLink($value->videolink)}}" frameborder="0" allowfullscreen style="width: 100%;"></iframe>
	            		</figure>
	            		<div class="mt-2">
	            			<label>{{$value->title}}</label>
	            		</div>
	            		<div>
	            			<div class="fs-12">{{$value->description}}</div>
	            		</div>
	            	</div>
	            </div>
            @endforeach
		</div>
		<div class="col-md-6">
            @foreach($training_contents as $value)
			<div class="custom-card p-5 mb-5">
				<div class="fs-18 text-black">
					<strong>
						{{$value->title}}
					</strong>
				</div>
				<div>
					<div class="fs-12 m-t">
						{{$value->description}}
					</div>
				</div>
				<div class="m-t">
				</div>
			</div>
            @endforeach
		</div>
	</div>
</div>
@endsection
@section('javascript')
@endsection
