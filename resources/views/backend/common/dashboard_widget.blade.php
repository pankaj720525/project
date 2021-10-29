<div class="row">
    <div class="col-lg-3">
        <div class="widget style1">
            <div class="row">
                <div class="col-xs-4 text-center">
                    <i class="fa fa-users fa-5x"></i>
                </div>
                <div class="col-xs-8 text-right">
                    <a  class="color-none" href="{{route('user.index')}}">
                        <span>Today Registered Users</span>
                        <h2 class="font-bold">{{$today_users_count}}</h2>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="widget style1 lazur-bg">
            <div class="row">
                <div class="col-xs-4">
                    <i class="fa fa-users fa-5x"></i>
                </div>
                <div class="col-xs-8 text-right">
                    <a class="color-none" href="{{route('user.index')}}">
                        <span> Total Users </span>
                        <h2 class="font-bold">{{$users_count}}</h2>
                    </a>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="col-lg-3">
        <div class="widget style1 navy-bg">
            <div class="row">
                <div class="col-xs-4">
                    <i class="fa fa-paper-plane fa-5x"></i>
                </div>
                <div class="col-xs-8 text-right">
                    <a class="color-none" href="#">
                        <span> Today Search History</span>
                        <h2 class="font-bold">{{$today_campaigns_count}}</h2>
                    </a>
                </div>
            </div>
        </div>
    </div> --}}
    {{-- <div class="col-lg-3">
        <div class="widget style1 yellow-bg">
            <div class="row">
                <div class="col-xs-4">
                    <i class="fa fa-paper-plane fa-5x"></i>
                </div>
                <div class="col-xs-8 text-right">
                    <a class="color-none" href="#">
                        <span> Total Search History </span>
                        <h2 class="font-bold">{{$campaigns_count}}</h2>
                    </a>
                </div>
            </div>
        </div>
    </div> --}}
</div>