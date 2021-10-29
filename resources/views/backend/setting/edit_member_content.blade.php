@extends('layouts.backend.base')
@section('title','Member Content CMS Edit')
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2>Edit</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{Route('admin.dashboard')}}">Dashboard</a>
            </li>
            <li>
                <a href="{{Route('subscription.index')}}">Subscriptions</a>
            </li>
            <li class="active">
                <strong>Edit</strong>
            </li>
        </ol>
    </div>
</div>
    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Edit Member Content CMS</h5>
                    </div>
                    <div class="ibox-content">
                        {!! Form::open(['route' => ['editMemberContent',Helper::getEncrypted($member_content->id)],'class'=>'form-horizontal','id'=>'member_content_form']) !!}
                            <div class="row">
                                <div class="col-sm-6">
                                    <label class="control-label">Title</label>
                                    {!! Form::text('title',$member_content->title,['class'=>'form-control'])!!}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label class="control-label">Video Link</label>
                                    {!! Form::text('videolink',$member_content->videolink,['class'=>'form-control'])!!}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label class="control-label">Description</label>
                                    {!! Form::textarea('description',$member_content->description,['class'=>'form-control','rows'=>'4'])!!}
                                </div>
                            </div>
                            <div class="form-group row m-t">
                                <div class="col-sm-4">
                                    <a href="{{Route('member_content')}}" class="btn btn-white">Cancel</a>
                                    <button class="btn btn-primary" type="submit">Update</button>
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection