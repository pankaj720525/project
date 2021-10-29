@extends('layouts.backend.base')
@section('title','Dashboard')
@section('content')
{!! Form::open(['route' => ['admin.dashboard'],'class'=>'row','id'=>'search_form','method'=>'get']) !!}
{!! Form::close() !!}
<button class="btn btn-secondary d-none" id="auto-refresh">
    <i class="fa fa-refresh"></i> Refresh <span id="display_interval">(0)</span>
</button>
<div class="wrapper wrapper-content" id="load_content">
	@include('backend.common.dashboard_widget')
</div>
@endsection

@section('javascript')
@endsection
