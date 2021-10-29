@include('backend.common.spinner')
<table class="table table-striped">
    <thead>
        <tr>
            <th>#</th>
{{--             <th>
                {!! Helper::custOrderBy('name',request()->get('orderby'),request()->get('orderbycolumn'))!!}
            </th> --}}
            <th>
                {!! Helper::custOrderBy('keywords',request()->get('orderby'),request()->get('orderbycolumn'))!!}
            </th>
            <th>
                {!! Helper::custOrderBy('email',request()->get('orderby'),request()->get('orderbycolumn'))!!}
            </th>
            <th>
                {!! Helper::custOrderBy('phone',request()->get('orderby'),request()->get('orderbycolumn'))!!}
            </th>
            <th>
                {!! Helper::custOrderBy('website',request()->get('orderby'),request()->get('orderbycolumn'))!!}
            </th>
            <th>
                {!! Helper::custOrderBy('city',request()->get('orderby'),request()->get('orderbycolumn'))!!}
            </th>
            <th>
                {!! Helper::custOrderBy('search_type',request()->get('orderby'),request()->get('orderbycolumn'))!!}
            </th>
            <th>
                {!! Helper::custOrderBy('created_at',request()->get('orderby'),request()->get('orderbycolumn'),'Created Date')!!}
            </th>
            <th width="110">Action</th>
        </tr>
    </thead>
    <tbody>
        @if(count($campaigns) > 0)
        @php $i = $campaigns->firstItem(); @endphp
        @foreach($campaigns as $compaign)
            <tr>
                <td>{{$i++}}</td>
                {{-- <td>{{$compaign->name}}</td> --}}
                <td>{{$compaign->keywords}}</td>
                <td>{{$compaign->email}}</td>
                <td>{{$compaign->phone}}</td>
                <td>{{$compaign->website}}</td>
                <td>{{$compaign->city}}</td>
                <td>{{$compaign->search_type}}</td>
                <td>{{$compaign->created_at}}</td>
                <td class="action">
                    <a href="{{route('campaigns_result.delete',Helper::getEncrypted($compaign->id))}}" class="delete_record" title="Delete" data-title="search history">
                        <button class="btn btn-danger btn-sm dim" type="button"><i class="fa fa-trash-o"></i></button>
                    </a>
                </td>
            </tr>
        @endforeach
        @else
        <tr>
            <td class="text-center" colspan="15">{{__('No records found')}}</td>
        </tr>
        @endif
    </tbody>
</table>
<div class="custom-pagination">
    {!! $campaigns->render() !!}
</div>
