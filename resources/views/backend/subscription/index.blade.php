@extends('layouts.backend.base')
@section('title','Subscription Plan')
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2>{{__('Subscription Plan')}}</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{Route('admin.dashboard')}}">Dashboard</a>
            </li>
            <li class="active">
                <strong>Subscription Plan</strong>
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
                        <h5>Subscription Plan </h5>
                        <div class="text-right">
                            <a class="btn btn-success" href="{{Route('subscription.create')}}">
                                <i class="fa fa-add"></i>Add
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        {!! Form::open(['route' => ['subscription.index'],'class'=>'row','id'=>'search_form','method'=>'get']) !!}
                            <div class="col-sm-5"></div>
                            <div class="col-sm-2 m-b-xs">
                                <select name="status" class="input-sm form-control input-s-sm inline">
                                    <option value="">All</option>
                                    <option value="1">Active</option>
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
                            @include('backend.subscription.include.dynamicTableData')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
