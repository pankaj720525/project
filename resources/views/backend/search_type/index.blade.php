@extends('layouts.backend.base')
@section('title','Search Type')
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2>{{__('Search Type')}}</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{Route('admin.dashboard')}}">Dashboard</a>
            </li>
            <li class="active">
                <strong>Search Type</strong>
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
                        <h5>Search Type </h5>
                        <div class="text-right">
                            {{-- <button class="btn btn-secondary" id="auto-refresh">
                                <i class="fa fa-refresh"></i> Refresh <span id="display_interval">(0)</span>
                            </button> --}}
                        </div>
                    </div>
                    <div class="ibox-content">
                        {!! Form::open(['route' => ['searchtype.index'],'class'=>'row d-none','id'=>'search_form','method'=>'get']) !!}
                            <div class="col-sm-4"></div>
                            <div class="col-sm-3 m-b-xs">
                                <select name="status" class="input-sm form-control input-s-sm inline">
                                    <option value="">All</option>
                                    <option value="1">Ative</option>
                                    <option value="2">Inactive</option>
                                </select>
                            </div>
                            <div class="col-sm-3">
                                <input name="search" type="text" placeholder="Search" class="input-sm form-control"> 
                            </div>
                            <div class="col-sm-2">
                                <input name="orderbycolumn" type="hidden" class="input-sm form-control" id="form-orderbycolumn"> 
                                <input name="orderby" type="hidden" class="input-sm form-control" id="form-orderby">
                                <input type="hidden" name="page" value="1" id="page">
                                <button class="btn btn-sm btn-block btn-primary" type="button" id="search_btn"> Search <i class="fa fa-spinner fa-spin d-none"></i></button>
                            </div>
                        {!! form::close() !!}
                        <div class="table-responsive ibox-content" id="load_content">
                            @include('backend.search_type.include.dynamicTableData')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="edit-modal-form" class="modal fade" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">Edit Search Type</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12" id="load-modal">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
