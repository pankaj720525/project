@extends('layouts.base')
@section('title','Email Templates')
@section('content')
<div class="row wrapper border-bottom light-gray-bg page-heading">
    <div class="col-sm-9 mt-2 text-black">
        <h3 class="m-t-20 fs-20">
        	<strong>
        		<span class="label_keyword"> Email Templates </span>
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
	<div class="row pb-5 pt-3">
		{!! Form::open(['route'=>['email.template'],'id'=>'search_form','method'=>'get'])!!}
		<input name="orderbycolumn" type="hidden" class="input-sm form-control" id="form-orderbycolumn"> 
    	<input name="orderby" type="hidden" class="input-sm form-control" id="form-orderby">
    	<input name="page" type="hidden" id="page">
		{!! Form::close() !!}
		<div class="table-responsive ibox-content" id="load_conent">
            @include('frontend.include.tableEmailTemplate')
        </div>
	</div>
</div>
<!--begin::Modal-->
<div class="modal fade" id="preview-template-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                	<span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="preview-content">

            </div>
            <div class="modal-footer">
                {{-- <button type="button" class="btn btn-success" id="copy-template">Copy</button> --}}
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('javascript')
@endsection
