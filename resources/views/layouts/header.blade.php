<div class="row border-bottom">
    <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
        <ul class="nav navbar-top-links navbar-right">
            <li>
                <a data-toggle="dropdown" class="dropdown-toggle pl-1 pr-1 pt-3 pb-3" href="#">
                    <img alt="image" width="30" class="img-circle" src="{{Helper::assets('img/Profile.png')}}" />
                </a>
                <ul class="dropdown-menu animated fadeInRight m-t-xs">
                    <li><a href="{{route('subscription')}}">Change Plan</a></li>
                    <li><a href="{{route('settings')}}">Settings</a></li>
                    <li class="divider"></li>
                    <li><a href="{{route('logout')}}">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>
</div>