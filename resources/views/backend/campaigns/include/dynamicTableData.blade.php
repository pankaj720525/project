@include('backend.common.spinner')
<table class="table table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th width="100">
                {!! Helper::custOrderBy('user_name',request()->get('orderby'),request()->get('orderbycolumn'),'User Name')!!}
            </th>
            <th width="200">
                {!! Helper::custOrderBy('keywords',request()->get('orderby'),request()->get('orderbycolumn'))!!}
            </th>
            <th width="200">
                {!! Helper::custOrderBy('city',request()->get('orderby'),request()->get('orderbycolumn'))!!}
            </th>
            <th width="150">
                {!! Helper::custOrderBy('search_type',request()->get('orderby'),request()->get('orderbycolumn'))!!}
            </th>
            <th class="text-center">
                {!! Helper::custOrderBy('status',request()->get('orderby'),request()->get('orderbycolumn'))!!}
            </th>
            <th>
                {!! Helper::custOrderBy('created_at',request()->get('orderby'),request()->get('orderbycolumn'))!!}
            </th>
            <th width="110">Action</th>
        </tr>
    </thead>
    <tbody>
        @if(count($campaigns_masters) > 0)
        @php $i = $campaigns_masters->firstItem(); @endphp
        @foreach($campaigns_masters as $campaigns)
            <tr>
                <td>{{$i++}}</td>
                <td>{{$campaigns->user_name}}</td>
                <td>{{$campaigns->keywords}}</td>
                <td>{{$campaigns->city}}</td>
                <td class="word-break-all">{{$campaigns->search_type}}</td>
                <td class="text-center">
                    @if($campaigns->status == 0)
                        <span class="label label-info">{{__('Pending')}}</span>
                    @elseif($campaigns->status == 2)
                        <span class="label label-primary">{{__('In Process')}}</span>
                    @elseif($campaigns->status == 1)
                       <span class="label label-success">{{__('Complete')}}</span>
                    @elseif($campaigns->status == 3)
                       <span class="label label-danger">{{__('Uncomplete')}}</span>
                    @endif
                </td>
                <td>{{$campaigns->created_at}}</td>
                <td class="action">
                    @if($campaigns->status == 1)
                        <a href="{{route('campaigns.show',Helper::getEncrypted($campaigns->id))}}" title="View" data-title="Search History">
                            <button class="btn btn-primary btn-sm dim" type="button"><i class="fa fa-eye"></i></button>
                        </a>
                    @else
                        <button  title="View" class="btn btn-primary btn-sm dim disabled" type="button"><i class="fa fa-eye"></i></button>
                    @endif

                    @if($campaigns->status == 2)
                        <button  title="Delete" class="btn btn-danger btn-sm dim disabled" type="button"><i class="fa fa-trash-o"></i></button>
                    @else
                        <a href="{{route('campaigns.delete',Helper::getEncrypted($campaigns->id))}}" class="delete_record" title="Delete" data-title="Search History">
                            <button class="btn btn-danger btn-sm dim" type="button"><i class="fa fa-trash-o"></i></button>
                        </a>
                    @endif
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
    {!! $campaigns_masters->render() !!}
</div>
