@include('backend.common.spinner')
<table class="table bordered">
	<thead class="light-gray-bg">
		<tr>
			<th width="200">
				{!! Helper::custOrderBy('keywords',request()->get('orderby'),request()->get('orderbycolumn'))!!}
			</th>
			<th width="200">
				{!! Helper::custOrderBy('city',request()->get('orderby'),request()->get('orderbycolumn'),'Address')!!}
			</th>
			<th width="200">
				{!! Helper::custOrderBy('search_type',request()->get('orderby'),request()->get('orderbycolumn'))!!}
			</th>
			<th class="text-center">
				{!! Helper::custOrderBy('status',request()->get('orderby'),request()->get('orderbycolumn'))!!}
			</th>
			<th>
				{!! Helper::custOrderBy('created_at',request()->get('orderby'),request()->get('orderbycolumn'),'Created')!!}
			</th>
			<td>Options</td>
		</tr>
	</thead>
	<tbody class="white-bg">
		@if(count($campaigns) > 0)
		@foreach($campaigns as $campaign)
			<tr>
				<td>{{$campaign->keywords}}</td>
				<td>{{$campaign->city}}</td>
				<td class="word-break-all">{{$campaign->search_type}}</td>
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
				<td width="140">
					@if($campaign->status == 1)
						<a href="{{route('search_result',Helper::getEncrypted($campaign->id))}}" class="btn btn-primary btn-sm">
                    		View
						</a>
	            	@else
						<a href="Javascript:(0);" class="btn btn-primary btn-sm disabled">
                    		View
						</a>
		            @endif

					@if($campaign->status == 2)
						<a href="Javascript:(0);" class="btn btn-danger btn-sm disabled">
	                    	Delete
	                    </a>
					@else
	                	<a href="{{route('campaignDestroy',Helper::getEncrypted($campaign->id))}}" class="delete_record btn btn-danger btn-sm" data-title="search history">
	                    	Delete
	                    </a>
	                @endif
				</td>
			</tr>
		@endforeach
		@else
			<tr>
				<th class="text-center" colspan="8"> No records found </th>
			</tr>
		@endif
	</tbody>
</table>
<div class="custom-pagination">
	@if(count($campaigns) > 0)
		{{$campaigns->render()}}
	@endif
</div>