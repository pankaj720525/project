<!DOCTYPE html>
<html>
@include('layouts.head')
<body>
    <div id="wrapper">
        @include('layouts.sidebar')
        <div id="page-wrapper" class="light-sky-blue-bg">
            @include('layouts.header')

            @yield('content')
            
            @include('layouts.footer')
        </div>
    </div>
    @include('layouts.foot')
</body>
</html>
