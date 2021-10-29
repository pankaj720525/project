<!DOCTYPE html>
<html>
@include('layouts.backend.head')
<body>
    <div id="wrapper">
        @include('layouts.backend.sidebar')
        <div id="page-wrapper" class="gray-bg">
            @include('layouts.backend.header')

            @yield('content')
            
            @include('layouts.backend.footer')
        </div>
    </div>
    @include('layouts.backend.foot')
</body>
</html>
