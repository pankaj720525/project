<!DOCTYPE html>
<html>
@section('title','Print')
@include('layouts.head')
<body class="bg-white">
	<div class="container">
		<table class="table table-bordered">
			<thead>
				<tr>
					<th width="50">No</th>
					<th width="150">Name</th>
					<th width="150">Address</th>
					<th width="150">Phone</th>
					<th width="150">Email</th>
					<th width="150">Website</th>
					<th width="200">Search Type</th>
				</tr>
			</thead>
			<tbody>
				@php
				$i = 1;
				@endphp
				@foreach($campaigns as $campaign)
				<tr>
					<td>{{$i++}}</td>
					<td class="word-break-all">{{$campaign->name}}</td>
					<td class="word-break-all">{{$campaign->city}}</td>
					<td class="word-break-all">{{$campaign->phone}}</td>
					<td class="word-break-all">{{$campaign->email}}</td>
					<td class="word-break-all">{{$campaign->website}}</td>
					<td class="word-break-all">{{$campaign->search_type}}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</body>
@include('layouts.foot')
<script type="text/javascript">
	$(document).ready(function () {
		window.print();
	});
</script>
</html>
