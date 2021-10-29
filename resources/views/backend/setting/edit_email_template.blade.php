@extends('layouts.backend.base')
@section('title','Setting - Edit Emails Template')
@section('style')
<link href="{{Helper::backend_asset('css/plugins/summernote/summernote.css')}}" rel="stylesheet">
<link href="{{Helper::backend_asset('css/plugins/summernote/summernote-bs3.css')}}" rel="stylesheet">
@endsection
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2>Edit</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{Route('admin.dashboard')}}">Dashboard</a>
            </li>
            <li>
                <a href="{{Route('emailtemplate')}}">Email Template</a>
            </li>
            <li class="active">
                <strong>Edit</strong>
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
                        <h5>Edit Email Templates </h5>
                    </div>
                    <div class="ibox-content">
                        {!! Form::open(['route' => ['editemailtemplate',Helper::getEncrypted($template->id)],'id'=>'update_email_template'])!!}
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label>Title:<span class="text-danger">*</span></label>
                                <input type="text" name="title" class="form-control" value="{{$template->title}}" />
                            </div>
                            <div class="col-md-12 form-group">
                                <label>Subject:<span class="text-danger">*</span></label>
                                <input type="text" name="subject" class="form-control" value="{{$template->subject}}" />
                            </div>
                            <div class="col-md-12">
                                <label>Content:<span class="text-danger">*</span></label>
                                <textarea class="summernote" id="content" name="content">{!! $template->content !!}</textarea>
                                <div id="content-err" class="error" style="display: none;">Content is required.</div>
                            </div>
                            <div class="col-sm-4 form-group m-t">
                                <a href="{{Route('emailtemplate')}}" class="btn btn-white">Cancel</a>
                                <button class="btn btn-primary" type="submit">Save</button>
                            </div>
                        </div>
                        {!! Form::close()!!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascript')
<script type="text/javascript">
    $(document).ready(function(){
        $('.summernote').summernote({
            // width: editorWidth,
            popover: {
              image: [],
              link: [],
              table: [
                  ['add', ['addRowDown', 'addRowUp', 'addColLeft', 'addColRight']],
                  ['delete', ['deleteRow', 'deleteCol', 'deleteTable']],
              ],
              air: [
                  ['color', ['color']],
                  ['font', ['bold', 'underline', 'clear']],
                  ['para', ['ul', 'paragraph']],
                  ['table', ['table']],
                  ['insert', ['link', 'picture']]
              ]
          }
        });
        $('.note-editable').css('height','200px');
    });
    
</script>
<script src="{{Helper::backend_asset('js/plugins/summernote/summernote.min.js')}}"></script>
@endsection
