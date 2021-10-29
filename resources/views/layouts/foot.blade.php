
<!-- Mainly scripts -->
<script src="{{Helper::public_assets('backend/js/jquery-3.1.1.min.js')}}"></script>
<script src="{{Helper::public_assets('backend/js/bootstrap.min.js')}}"></script>
<script src="{{Helper::public_assets('backend/js/plugins/metisMenu/jquery.metisMenu.js')}}"></script>

<!-- slick carousel-->
<script src="{{Helper::backend_asset('js/plugins/slick/slick.min.js')}}"></script>

<script src="{{Helper::public_assets('backend/js/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>
<script src="{{Helper::backend_asset('js/plugins/sweetalert/sweetalert.min.js')}}"></script>
<script src="{{Helper::backend_asset('js/plugins/summernote/summernote.min.js')}}"></script>

 <!-- Ladda -->
<script src="{{Helper::backend_asset('js/plugins/ladda/spin.min.js')}}"></script>
<script src="{{Helper::backend_asset('js/plugins/ladda/ladda.min.js')}}"></script>
<script src="{{Helper::backend_asset('js/plugins/ladda/ladda.jquery.min.js')}}"></script>

<!-- Custom and plugin javascript -->
<script src="{{Helper::public_assets('backend/js/inspinia.js')}}"></script>
<script src="{{Helper::public_assets('backend/js/plugins/pace/pace.min.js')}}"></script>
<script src="{{Helper::public_assets('backend/js/plugins/toastr/toastr.min.js')}}"></script>

<!-- Validation javascript -->
<script src="{{Helper::backend_asset('js/plugins/validate/jquery.validate.min.js')}}"></script>

@include('layouts.jsroutes')
<script type="text/javascript">
    var View_Mail_Template_URL = "{{Route('preview-template')}}";
</script>

<!-- Custom javascript -->
<script src="{{Helper::frontend_asset('js/custom.js')}}"></script>

<script type="text/javascript">
    $(document).ready(function(){
        @if(Session::has('error'))
            toastr.error('{{Session::get('error')}}');
        @elseif(Session::has('Success'))
            toastr.success('{{Session::get('Success')}}');
        @endif

        @if(Session::has('status'))
            toastr.success('{{Session::get('status')}}');
        @endif

        @if(Session::has('success'))
            toastr.success('{{Session::get('success')}}');
        @endif

        @if($errors->any())
			toastr.error('{{ $errors->first() }}');
		@endif
    });
    $(document).find(".alert").delay(3000).fadeOut("slow");
</script>
@yield('javascript')

