@include('backend.common.spinner')
<table class="table table-striped">
    <thead>
        <tr>
            <th width="20">#</th>
            <th width="300">
                {!! Helper::custOrderBy('name',request()->get('orderby'),request()->get('orderbycolumn'))!!}
            </th>
            <th width="360">
                {!! Helper::custOrderBy('description',request()->get('orderby'),request()->get('orderbycolumn'))!!}
            </th>
            <th width="60" class="text-center">
                {!! Helper::custOrderBy('status',request()->get('orderby'),request()->get('orderbycolumn'))!!}
            </th>
            <th width="60" class="text-center">Action</th>
        </tr>
    </thead>
    <tbody>
        @if(count($search_types) > 0)
        @php $i = $search_types->firstItem(); @endphp
        @foreach($search_types as $value)
            <tr>
                <td>{{$i++}}</td>
                <td class="word-break-all">{{$value->name}}</td>
                <td class="word-break-all">{{$value->description}}</td>
                <td class="text-center">
                    @if($value->status == 1)
                        <a href="Javascript:;" class="change_status" data-title="search type" data-url="{{Route('searchtype.changeStatus',[Helper::getEncrypted($value->id),$value->status])}}"> <span class="label label-success">{{__('Active')}}</span>
                    @else
                        <a href="Javascript:;" class="change_status" data-title="search type" data-url="{{Route('searchtype.changeStatus',[Helper::getEncrypted($value->id),$value->status])}}"> <span class="label label-warning">{{__('Inactive')}}</span>
                    @endif
                </td>
                <td class="action text-center">
                    <a href="Javascript:;" title="Edit" data-id="{{Helper::getEncrypted($value->id)}}" data-url="{{route('searchtype.update',Helper::getEncrypted($value->id))}}" class="update-search-type">
                        <button class="btn btn-primary btn-sm dim" type="button"><i class="fa fa-pencil {{Helper::getEncrypted($value->id)}}"></i></button>
                    </a>
                    {{-- <a href="{{Route('searchtype.delete',[Helper::getEncrypted($value->id)])}}" class="delete_record" data-title="search type">
                        <button class="btn btn-danger btn-sm dim" type="button"><i class="fa fa-trash-o"></i></button>
                    </a> --}}
                </td>
            </tr>
        @endforeach
        @else
        <tr>
            <td class="text-center" colspan="8">{{__('No records found')}}</td>
        </tr>
        @endif
    </tbody>
</table>
<div class="custom-pagination">
    {!! $search_types->render() !!}
</div>