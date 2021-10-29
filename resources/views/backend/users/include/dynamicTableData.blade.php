@include('backend.common.spinner')
<table class="table table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>
                {!! Helper::custOrderBy('name',request()->get('orderby'),request()->get('orderbycolumn'))!!}
            </th>
            <th>
                {!! Helper::custOrderBy('email',request()->get('orderby'),request()->get('orderbycolumn'))!!}
            </th>
            <th>
                Subscription
            </th>
            <th>
                {!! Helper::custOrderBy('last_login',request()->get('orderby'),request()->get('orderbycolumn'))!!}
            </th>
            <th class="text-center">
                {!! Helper::custOrderBy('status',request()->get('orderby'),request()->get('orderbycolumn'))!!}
            </th>
            <th width="160" class="text-center">Action</th>
        </tr>
    </thead>
    <tbody>
        @if(count($users) > 0)
        @php $i = $users->firstItem(); @endphp
        @foreach($users as $user)
            <tr>
                <td>{{$i++}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->subscribe!=null?@$user->subscribe->subscription->package_name:"-"}}</td>
                <td>{{$user->last_login}}</td>
                <td class="text-center">
                    @if($user->status == 1)
                        <a href="Javascript:;" class="change_status" data-title="user" data-url="{{Route('user.changesStatus',[Helper::getEncrypted($user->id),$user->status])}}"> <span class="label label-success">{{__('Active')}}</span>
                    @else
                        <a href="Javascript:;" class="change_status" data-title="user" data-url="{{Route('user.changesStatus',[Helper::getEncrypted($user->id),$user->status])}}"> <span class="label label-warning">{{__('Inactive')}}</span>
                    @endif
                </td>
                <td class="action text-right">
                    <a href="{{route('campaigns.index',Helper::getEncrypted($user->id))}}" title="Search History">
                        <button class="btn btn-info btn-sm dim" type="button"><i class="fa fa-history"></i></button>
                    </a>
                    <a href="{{route('user.edit',Helper::getEncrypted($user->id))}}" title="Edit">
                        <button class="btn btn-success btn-sm dim" type="button"><i class="fa fa-pencil"></i></button>
                    </a>
                    <a href="{{route('user.destroy',Helper::getEncrypted($user->id))}}" class="delete_record" title="Delete" data-title="user">
                        <button class="btn btn-danger btn-sm dim" type="button"><i class="fa fa-trash-o"></i></button>
                    </a>
                </td>
            </tr>
        @endforeach
        @else
        <tr>
            <td class="text-center" colspan="8">{{__('Records not found')}}</td>
        </tr>
        @endif
    </tbody>
</table>
<div class="custom-pagination">
    {!! $users->render() !!}
</div>
