@extends('layouts.backend.base')
@section('title','Setting - Member Contents CMS')
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2>Member Content CMS</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{Route('admin.dashboard')}}">Dashboard</a>
            </li>
            <li class="active">
                <strong>Member Content CMS</strong>
            </li>
        </ol>
    </div>
    <div class="col-sm-8">
        <div class="title-action">
            {{-- <a href="" class="btn btn-primary">This is action area</a> --}}
        </div>
    </div>
</div>
<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Member Content CMS</h5>
                    <div class="text-right">
                        <a class="btn btn-success" href="{{Route('addMemberContent')}}">
                            <i class="fa fa-add"></i>Add
                        </a>
                        {{-- <button class="btn btn-secondary" id="auto-refresh">
                            <i class="fa fa-refresh"></i> Refresh <span id="display_interval">(0)</span>
                        </button> --}}
                    </div>
                </div>
                <div class="ibox-content">
                    {!! Form::open(['route' => ['member_content'],'class'=>'row d-none','id'=>'search_form','method'=>'get']) !!}
                        <div class="col-sm-7"></div>
                        <div class="col-sm-2">
                            <input name="orderbycolumn" type="hidden" class="input-sm form-control" id="form-orderbycolumn"> 
                            <input name="orderby" type="hidden" class="input-sm form-control" id="form-orderby"> 
                            <input type="hidden" name="page" value="1" id="page">
                            <button class="btn btn-sm btn-block btn-primary" type="button" id="search_btn"> Search <i class="fa fa-spinner fa-spin d-none"></i></button>
                        </div>
                    {!! form::close() !!}
                    <div class="table-responsive ibox-content" id="load_content">
                        @include('backend.setting.include.dynamicMemberContentData')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
