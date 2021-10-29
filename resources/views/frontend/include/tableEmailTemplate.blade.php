@include('backend.common.spinner')
<table class="table bordered">
	<thead class="light-gray-bg">
		<tr>
			<th>
                {!! Helper::custOrderBy('title',request()->get('orderby'),request()->get('orderbycolumn'))!!}
            </th>
            <th>
                {!! Helper::custOrderBy('subject',request()->get('orderby'),request()->get('orderbycolumn'))!!}
            </th>
            <th>
                {!! Helper::custOrderBy('created_at',request()->get('orderby'),request()->get('orderbycolumn'),'Created')!!}
            </th>
            <th width="150">Action</th>
		</tr>
	</thead>
	<tbody class="white-bg">
		@if(count($templates) > 0)
        @foreach($templates as $key => $value)
            <tr>
                <td>{{$value->title}}</td>
                <td>{{$value->subject}}</td>
                <td>{{$value->created_at}}</td>
                <td width="20%">
{{--                     <a href="javascript:void(0)" data-id="{{Helper::getEncrypted($value->id)}}" data-name="{{$value->subject}}" data-url="{{Route('view.emailtemplates')}}" class="btn btn-primary btn-sm preview-email-template">
                    	Copy
                    </a> --}}
                     <a href="javascript:void(0)" data-id="{{Helper::getEncrypted($value->id)}}" data-name="{{$value->subject}}" data-url="{{Route('view.emailtemplates')}}" class="btn btn-primary btn-sm preview-email-template">
                        View
                    </a>
                    <a href="{{Route('duplicate.emailtemplate',Helper::getEncrypted($value->id))}}" class="ladda-button ladda-button-demo btn btn-primary btn-sm duplicate_email_template" data-style="zoom-in">
                        Copy
                    </a>
                    @if($value->user_id == Auth::user()->id)
                        <a href="{{Route('delete.emailtemplate',Helper::getEncrypted($value->id))}}" class="btn btn-danger btn-sm delete_record" data-title="email template">
                            Delete
                        </a>
                    @endif
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
	@if(count($templates) > 0)
		{!! $templates->render() !!}
	@endif
</div>