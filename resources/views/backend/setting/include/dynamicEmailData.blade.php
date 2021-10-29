@include('backend.common.spinner')
<table class="table table-striped">
    <thead>
        <tr>
            <th>
                {!! Helper::custOrderBy('title',request()->get('orderby'),request()->get('orderbycolumn'))!!}
            </th>
            <th>
                {!! Helper::custOrderBy('subject',request()->get('orderby'),request()->get('orderbycolumn'))!!}
            </th>
            <th>
                {!! Helper::custOrderBy('created_at',request()->get('orderby'),request()->get('orderbycolumn'),'Created Date')!!}
            </th>
            </th>
            <th width="130">Action</th>
        </tr>
    </thead>
    <tbody>
        @if(count($templates) > 0)
        @foreach($templates as $key => $value)
            <tr>
                <td>{{$value->title}}</td>
                <td>{{$value->subject}}</td>
                <td>{{$value->created_at}}</td>
                <td>
                    <a href="{{Route('editemailtemplate',[Helper::getEncrypted($value->id)])}}" title="Edit" data-title="email template"><button class="btn btn-primary btn-sm dim" type="button"><i class="fa fa-edit"></i></button></a>

                    {{-- <a href="javascript:void(0)" data-id="{{Helper::getEncrypted($value->id)}}" data-name="{{$value->subject}}" data-url="{{Route('preview-template')}}" class="preview-email-template"><button class="btn btn-success btn-sm dim" type="button"><i class="fa fa-eye"></i></button></a> --}}
                    
                    <a  title="Delete" href="{{Route('deleteEmailTemplate',Helper::getEncrypted($value->id))}}" data-title="email template" class="delete_record"><button class="btn btn-danger btn-sm dim" type="button"><i class="fa fa-trash"></i></button></a>
                </td>
            </tr>
        @endforeach
        @else
            <tr>
                <td colspan="4" class="text-center text-danger">No emails template found.</td>
            </tr>
        @endif
    </tbody>
</table>
<div class="custom-pagination">
    @if(isset($templates)){!! $templates->render() !!}@endif
</div>