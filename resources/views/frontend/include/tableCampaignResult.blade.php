<table class="table bordered">
	<thead class="light-gray-bg">
		<tr>
			<th width="130">
				{!! Helper::custOrderBy('name',request()->get('orderby'),request()->get('orderbycolumn'))!!}
			</th>
			<th width="150">
				{!! Helper::custOrderBy('city',request()->get('orderby'),request()->get('orderbycolumn'),'Address')!!}
			</th>
			<th width="170">
				{!! Helper::custOrderBy('phone',request()->get('orderby'),request()->get('orderbycolumn'))!!}
			</th>
			<th width="220">
				{!! Helper::custOrderBy('email',request()->get('orderby'),request()->get('orderbycolumn'))!!}
			</th>
			<th width="200">
				{!! Helper::custOrderBy('website',request()->get('orderby'),request()->get('orderbycolumn'))!!}
			</th>
			<th width="130">
				{!! Helper::custOrderBy('search_type',request()->get('orderby'),request()->get('orderbycolumn'))!!}
			</th>
			{{-- <th>
				Social Media
			</th> --}}
			{{-- <td>
			</td> --}}
		</tr>
	</thead>
	<tbody class="white-bg">
		@if(count($campaigns) > 0)
		@foreach($campaigns as $campaign)
			<tr>
				<td class="word-break-all">{{$campaign->name}}</td>
				<td class="word-break-all">{{$campaign->city}}</td>
				<td>{{($campaign->phone)? $campaign->phone : '-'}}</td>
				<td>
					@if($campaign->email != "")
						<span class="label label-primary-outline" title="{{$campaign->email}}">{{$campaign->email}}</span> 
						<span class="text-primary copy-to-clipboard pull-right" data-text="{{$campaign->email}}"><i class="fa fa-clone" aria-hidden="true"></i></span>
					@else
					-
					@endif
				</td>
				<td class="word-break-all">{{$campaign->website}}</td>
				<td class="word-break-all">{{$campaign->search_type}}</td>
				{{-- <td class="text-center">
					<button class="btn btn-primary btn-circle " type="button"><i class="fa fa-facebook"></i></button>
					<a class="text-primary fs-20 pl-3 v-align-middle">
						<i class="fa fa-twitter"></i>
					</a>
				</td> --}}
				{{-- <td width="110">
					<button class="btn btn-primary btn-sm send-email" data-email="{{$campaign->email}}" type="button">
						<i class="fa fa-envelope"></i> Email
					</button>
				</td> --}}
			</tr>
		@endforeach
		@else
			<tr>
				<td class="text-center" colspan="8"> No records found </td>
			</tr>
		@endif
	</tbody>
</table>
<div class="row">
	<div class="col-md-6 custom-pagination">
		@if(count($campaigns) > 0)
			{!! $campaigns->render() !!}
		@endif
	</div>
	<div class="col-md-6 text-right">
	    <div class="pr-2">
	    	Total: <b>{{$campaigns->total()}}</b>
	    </div>
	</div>
</div>