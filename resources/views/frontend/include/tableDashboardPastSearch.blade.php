@include('backend.common.spinner')
<table class="table bordered">
	<thead class="light-gray-bg">
		<tr>
			<th>Keywords</th>
			<th>City</th>
			<th>Search Type</th>
			<th class="text-center">status</th>
			<th>Created At</th>
			<td>Options</td>
		</tr>
	</thead>
	<tbody class="white-bg">
		@if(count($campaigns) > 0)
			@foreach($campaigns as $campaign)
			<tr>
				<td>{{$campaign->keywords}}</td>
				<td>{{$campaign->city}}</td>
				<td>{{$campaign->search_type}}</td>
				<td class="text-center">
					@if($campaign->status == 0)
						<i class="fa fa-spinner fa-spin text-primary"></i>
		            @elseif($campaign->status == 2)
		            	<span class="label status-process">In Process</span>
		            @elseif($campaign->status == 1)
		            	<span class="label status-success">Complete</span>
		            @elseif($campaign->status == 3)
		            	<span class="label status-failed">Uncomplete</span>
		            @endif
				</td>
				<td>{{date('M d, Y h:i:A',strtotime($campaign->created_at))}}</td>
				<td width="110">
					@if($campaign->status == 1)
						<a href="{{route('search_result',Helper::getEncrypted($campaign->id))}}" class="btn btn-primary btn-sm">
							View
						</a>
	            	@else
						<a class="btn btn-primary btn-sm disabled">
							View
						</a>
		            @endif
				</td>
			</tr>
			@endforeach
		@else
			<tr>
				<th colspan="6" class="text-center">No records found</th>
			</tr>
		@endif
	</tbody>
</table>