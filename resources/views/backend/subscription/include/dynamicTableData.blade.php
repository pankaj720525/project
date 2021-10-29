@include('backend.common.spinner')
<table class="table table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th width="150px" class="word-break-all">
                {!! Helper::custOrderBy('package_name',request()->get('orderby'),request()->get('orderbycolumn'))!!}
            </th>
            <th width="400px" class="word-break-all">
                {!! Helper::custOrderBy('description',request()->get('orderby'),request()->get('orderbycolumn'))!!}
            </th>
            <th>
                {!! Helper::custOrderBy('billing_period',request()->get('orderby'),request()->get('orderbycolumn'))!!}
            </th>
            <th>
                {!! Helper::custOrderBy('billing_frequency',request()->get('orderby'),request()->get('orderbycolumn'))!!}
            </th>
            <th>
                {!! Helper::custOrderBy('search_limit',request()->get('orderby'),request()->get('orderbycolumn'))!!}
            </th>
            <th>
                {!! Helper::custOrderBy('no_of_result',request()->get('orderby'),request()->get('orderbycolumn'))!!}
            </th>
            <th>
                {!! Helper::custOrderBy('price',request()->get('orderby'),request()->get('orderbycolumn'))!!}
            </th>
            <th class="text-center">
                {!! Helper::custOrderBy('status',request()->get('orderby'),request()->get('orderbycolumn'))!!}
            </th>
            <th width="130" class="text-center">Action</th>
        </tr>
    </thead>
    <tbody>
        @if(count($subscriptions) > 0)
        @php $i = $subscriptions->firstItem(); @endphp
        @foreach($subscriptions as $plan)
            <tr>
                <td>{{$i++}}</td>
                <td class="word-break-all">{{$plan->package_name}}</td>
                <td class="word-break-all">{{$plan->description}}</td>
                <td>{{$plan->billing_period}}</td>
                <td>{{$plan->billing_frequency}}</td>
                <td>{{$plan->search_limit}}</td>
                <td>{{$plan->no_of_result}}</td>
                <td>${{$plan->price}}</td>
                <td class="text-center">
                    @if($plan->status == 1)
                        <a href="Javascript:;" class="change_status" data-title="subscription" data-url="{{Route('subscription.changesStatus',[Helper::getEncrypted($plan->id),$plan->status])}}"> <span class="label label-success">{{__('Active')}}</span>
                    @else
                        <a href="Javascript:;" class="change_status" data-title="subscription" data-url="{{Route('subscription.changesStatus',[Helper::getEncrypted($plan->id),$plan->status])}}"> <span class="label label-warning">{{__('Inactive')}}</span>
                    @endif
                </td>
                <td class="action">
                    <a title="Edit" href="{{Route('subscription.edit',[Helper::getEncrypted($plan->id)])}}" data-title="subscription"><button class="btn btn-primary btn-sm dim" type="button"><i class="fa fa-pencil"></i></button></a>

                    <a  title="Delete" href="{{Route('subscription.destroy',[Helper::getEncrypted($plan->id)])}}" class="delete_record" data-title="subscription plan"><button class="btn btn-danger btn-sm  dim" type="button"><i class="fa fa-trash-o"></i></button></a>
                </td>
            </tr>
        @endforeach
        @else
        <tr>
            <td class="text-center" colspan="10">{{__('Records not found')}}</td>
        </tr>
        @endif
    </tbody>
</table>
<div class="custom-pagination">
    {!! $subscriptions->render() !!}
</div>