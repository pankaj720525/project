@include('backend.common.spinner')
<table class="table table-striped member-content-cms">
    <thead class="thead-light">
        <tr>
            <th width="200">
                {!! Helper::custOrderBy('title',request()->get('orderby'),request()->get('orderbycolumn'))!!}
            </th>
            <th width="400">
                {!! Helper::custOrderBy('description',request()->get('orderby'),request()->get('orderbycolumn'))!!}
            </th>
            <th width="200">
                {!! Helper::custOrderBy('videolink',request()->get('orderby'),request()->get('orderbycolumn'),'Video Link')!!}
            </th>
            <th width="70" class="text-center">
                {!! Helper::custOrderBy('status',request()->get('orderby'),request()->get('orderbycolumn'))!!}
            </th>
            <th width="130">Action</th>
        </tr>
    </thead>
    <tbody>
        @if(count($member_contents) > 0)
        @foreach($member_contents as $key => $value)
            <tr>
                <td>{{$value->title}}</td>
                <td>{{$value->description}}</td>
                <td>
                    @if($value->videolink)
                    <a href="{{$value->videolink}}" target="_blank"> {{$value->videolink}}</a>
                    @else
                    -
                    @endif
                </td>
                <td class="text-center">
                    @if($value->status == 1)
                        <a href="Javascript:;" class="change_status" data-title="member content" data-url="{{Route('memberContentStatusChange',[Helper::getEncrypted($value->id),$value->status])}}"> <span class="label label-success">{{__('Active')}}</span>
                    @else
                        <a href="Javascript:;" class="change_status" data-title="member content" data-url="{{Route('memberContentStatusChange',[Helper::getEncrypted($value->id),$value->status])}}"> <span class="label label-warning">{{__('Inactive')}}</span>
                    @endif
                </td>
                <td>
                    <a href="{{Route('editMemberContent',[Helper::getEncrypted($value->id)])}}" title="Edit" data-title="subscription"><button class="btn btn-primary btn-sm dim" type="button"><i class="fa fa-edit"></i></button></a>

                    {{-- <a href="javascript:void(0)" data-id="{{Helper::getEncrypted($value->id)}}" data-name="{{$value->subject}}" data-url="{{Route('preview-template')}}" class="preview-email-template"><button class="btn btn-success btn-sm dim" type="button"><i class="fa fa-eye"></i></button></a> --}}

                    <a href="{{Route('membercontent.delete',[Helper::getEncrypted($value->id)])}}"  title="Delete" class="delete_record" data-title="member content"><button class="btn btn-danger btn-sm  dim" type="button"><i class="fa fa-trash-o"></i></button></a>
                </td>
            </tr>
        @endforeach
        @else
            <tr>
                <td colspan="5" class="text-center text-danger">No member content found.</td>
            </tr>
        @endif
    </tbody>
</table>
<div class="custom-pagination">
    @if(isset($member_contents)){!! $member_contents->render() !!}@endif
</div>