<script type="text/javascript">
    var CHECK_PASSWORD_URL = "{{route('admin.check_password')}}";
</script>
<!-- Mainly scripts -->
<script src="{{Helper::backend_asset('js/jquery-3.1.1.min.js')}}"></script>
<script src="{{Helper::backend_asset('js/bootstrap.min.js')}}"></script>
<script src="{{Helper::backend_asset('js/plugins/metisMenu/jquery.metisMenu.js')}}"></script>
<script src="{{Helper::backend_asset('js/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>
<script src="{{Helper::backend_asset('js/plugins/sweetalert/sweetalert.min.js')}}"></script>


<!-- Custom and plugin javascript -->
<script src="{{Helper::backend_asset('js/inspinia.js')}}"></script>
<script src="{{Helper::backend_asset('js/plugins/pace/pace.min.js')}}"></script>
<script src="{{Helper::backend_asset('js/plugins/toastr/toastr.min.js')}}"></script>
<script src="{{Helper::assets('js/bootbox.min.js')}}"></script>

<!-- Validation javascript -->
<script src="{{Helper::backend_asset('js/plugins/validate/jquery.validate.min.js')}}"></script>
<script src="{{Helper::backend_asset('js/form-validation.js')}}"></script>

@include('layouts.backend.theme_config')
<!-- Custom javascript -->
<script src="{{Helper::backend_asset('js/custom.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function(){
        @if(Session::has('error'))
            toastr.error('{{Session::get('error')}}');
        @elseif(Session::has('Success'))
            toastr.success('{{Session::get('Success')}}');
        @endif
        @if($errors->any())
			toastr.error('{{ $errors->first() }}');
		@endif
    });
    $(document).find(".alert").delay(3000).fadeOut("slow");
</script>

@yield('javascript')
