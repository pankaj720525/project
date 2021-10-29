@include('backend.common.spinner')
<table class="table table-striped">
    <thead>
        <tr>
            <th class="text-center">#</th>
            <th>
                {!! Helper::custOrderBy('user_name',request()->get('orderby'),request()->get('orderbycolumn'))!!}
            </th>
            <th>
                {!! Helper::custOrderBy('package_name',request()->get('orderby'),request()->get('orderbycolumn'),'Subscribe Plan')!!}
            </th>
            <th>
                {!! Helper::custOrderBy('transaction_id',request()->get('orderby'),request()->get('orderbycolumn'))!!}
            </th>
            <th>
                {!! Helper::custOrderBy('created_at',request()->get('orderby'),request()->get('orderbycolumn'),'Transaction Date')!!}
            </th>
            <th>
                {!! Helper::custOrderBy('amount',request()->get('orderby'),request()->get('orderbycolumn'))!!}
            </th>
            <th>
                {!! Helper::custOrderBy('is_upgrade',request()->get('orderby'),request()->get('orderbycolumn'),'Transaction Type')!!}
            </th>
            {{-- <th >Status</th> --}}
        </tr>
    </thead>
    <tbody>
        @if(isset($transactions) && count($transactions) > 0)
        @php $i = $transactions->firstItem(); @endphp
        @foreach($transactions as $trans)
            <tr>
                <td class="text-center">{{$i++}}</td>
                <td>{{$trans->user_name}}</td>
                <td>{{$trans->package_name}}
                <td>{{$trans->transaction_id}}</td>
                <td>{{$trans->created_at->format('m/d/Y H:i:s')}}</td>
                <td>${{number_format($trans->amount,2)}}</td>
                <td>
                    @if($trans->is_upgrade == 0)
                        Purchase Plan
                    @elseif($trans->is_upgrade == 1)
                        Upgrade Plan
                    @elseif($trans->is_upgrade == 2)
                        Downgrade Plan
                    @elseif($trans->is_upgrade == 3)
                        Renew Plan
                    @endif
                </td>
            </tr>
        @endforeach
        @else
        <tr>
            <th colspan="7" class="text-center">No records found</th>
        </tr>
        @endif
    </tbody>
</table>
<div class="custom-pagination">
    {!! $transactions->render() !!}
</div>
