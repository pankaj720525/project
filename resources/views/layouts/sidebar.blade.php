<nav class="navbar-default navbar-static-side" role="navigation">
	<div class="sidebar-collapse">
		<ul class="nav metismenu" id="side-menu">
			<li class="nav-header">
                <div class="dropdown profile-element "> 
                    <a href="{{route('dashboard')}}">
                        <img src="{{Helper::assets('img/small_logo.png')}}" />
                    </a>
                </div>
                <div class="logo-element">
                    <a href="{{route('dashboard')}}">
                        <img alt="image" width="20" src="{{Helper::assets('img/Icon.png')}}" />
                    </a>
                </div>
            </li>
			<li class="{{Helper::getActiveClass(['dashboard','home'])}}">
				<a href="{{route('dashboard')}}"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboard</span></a>
			</li>
			<li class="{{Helper::getActiveClass(['new_search'])}}">
				<a href="{{route('new_search')}}"><i class="fa fa-search"></i> <span class="nav-label">New Search</span></a>
			</li>
			<li class="{{Helper::getActiveClass(['search_history','search_result'])}}">
				<a href="{{route('search_history')}}"><i class="fa fa-history"></i> <span class="nav-label">Search History</span></a>
			</li>
			<li class="{{Helper::getActiveClass(['email.template'])}}">
				<a href="{{route('email.template')}}"><i class="fa fa-envelope"></i> <span class="nav-label">Email Template</span></a>
			</li>
			<li class="{{Helper::getActiveClass(['training'])}}">
				<a href="{{route('training')}}"><i class="fa fa-graduation-cap"></i> <span class="nav-label">Training</span></a>
			</li>
			<li class="{{Helper::getActiveClass(['settings'])}}">
				<a href="{{route('settings')}}"><i class="fa fa-cog"></i> <span class="nav-label">Settings</span></a>
			</li>
			<li>
				<a href="{{env('HELP_CENTER_LINK')}}" target="_blank"><i class="fa fa-support"></i> <span class="nav-label">Support</span></a>
			</li>
		</ul>
	</div>
</nav>