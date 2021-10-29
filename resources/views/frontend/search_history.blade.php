@extends('layouts.base')
@section('title','Search History')
@section('content')
<div class="row wrapper border-bottom light-gray-bg page-heading">
    <div class="col-sm-9 mt-2 text-black">
        <h3 class="m-t-20 fs-20">
        	<strong>
        		<span class="label_keyword"> Search History </span>
        	</strong>
        </h3>
    </div>
    <div class="col-sm-3 mt-2">
    	<div class="m-t-20 text-right">
            <button class="btn btn-primary" id="auto-refresh">
                <i class="fa fa-refresh"></i> Refresh <span id="display_interval">(0)</span>
            </button>
        </div>
    </div>
</div>
<div class="wrapper wrapper-content">
	<div class="table-resposive">
		{!! Form::open(['route'=>['search_history'],'id'=>'search_form','method'=>'get'])!!}
		<div class="row company-search">
			<div class="col-md-6">
				<div class="input-group m-b">
					<span class="input-group-addon"><i class="fa fa-search"></i></span>
					<input type="text" name="search" placeholder="Search" class="form-control seach_on_change">
				</div>
			</div>
			<div class="col-md-6">
				<div class="text-right">
					<span><small>Status:</small></span>
					{{Form::select('status',['all'=>'All','1'=>'Complete','2'=>'In Process','3'=>'Uncomplete'],'',['id'=>'status','class'=>'search-status'])}}
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
            @include('frontend.include.tableCampaignMaster')
        </div>
	</div>
</div>
@endsection
@section('javascript')
@endsection
