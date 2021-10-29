@if(count($legiit_services) > 0)
<div class="slick_demo_2 service-slider">
	@php
	$i = 1;
	@endphp
	@foreach($legiit_services as $service)
    <div>
		<div class="ibox-content">
			<div class="contact-box center-version custom-card-div h-100 legiit-services">
				<a target="_blank" href="{{$service['service_link']}}">
					<div class="border-bottom">
						<img alt="image" class="custom-card-image" src="{{Helper::imageExists($service['service_image'])}}">
					</div>
					<div>
						<div class="content-body">
							<h3 class="fs-15 pl-3 pr-3 service-title">
								{{$service['title']}}
							</h3>
							<div class="fs-10 description">
								{!! strip_tags($service['descriptions']) !!}
							</div>
						</div>
						<div class="text-left pl-3 pb-2">
							<div class="m-t-xs">
								<i class="fa fa-star text-skyblue"></i><span class="font-bold text-skyblue ml-1 mr-1">{{round($service['rating'],1)}}</span><small>({{$service['total_review']}})</small>
							</div>
						</div>
					</div>
					<div class="contact-box-footer p-2 text-align-none h-100">
						<div class="row">
							<div class="col-md-2 col-xs-2 custom-card-profile">
								<img width="20" alt="image" class="img-circle" src="{{Helper::imageExists($service['user_image'],'1')}}">
							</div>
							<div class="col-md-10 col-xs-10 fs-10">
								<div class="row">
									<div class="col-md-12">
										<div class="text-black"> <strong>{{$service['user']['Name']}}</strong></div>
										<div class="d-flex justify-content-space-between">
											<span>{{$service['user']['seller_level']}}</span> 
											<span>Starting at <b class="fs-12 text-black">${{$service['amount']}}</b></span>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</a>
			</div>
		</div>
	</div>
	@php $i++ @endphp
	@endforeach
</div>
@else
<div class="text-center">
	<h2><b>No services found</b></h2>
</div>
@endif