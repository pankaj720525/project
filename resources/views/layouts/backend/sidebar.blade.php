<nav class="navbar-default navbar-static-side" role="navigation">
	<div class="sidebar-collapse">
		<ul class="nav metismenu" id="side-menu">
			<li class="nav-header">
                <div class="dropdown profile-element "> 
                    <a href="{{route('admin.dashboard')}}">
                        <img src="{{Helper::assets('img/small_logo.png')}}" />
                    </a>
                </div>
                <div class="logo-element">
                    <a href="{{route('admin.dashboard')}}">
                        <img alt="image" width="20" src="{{Helper::assets('img/Icon.png')}}" />
                    </a>
                </div>
            </li>
			<li class="{{Helper::getActiveClass(['admin.dashboard'])}}">
				<a href="{{route('admin.dashboard')}}"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboard</span></a>
			</li>

			<li class="{{Helper::getActiveClass(['user.index','campaigns.index','user.edit','campaigns.show'])}}">
				<a href="{{route('user.index')}}"><i class="fa fa-users"></i> <span class="nav-label">Users</span></a>
			</li>

			<li class="{{Helper::getActiveClass(['searchtype.index'])}}">
				<a href="{{route('searchtype.index')}}"><i class="fa fa-ravelry"></i> <span class="nav-label">Search Type</span></a>
			</li>

			<li class="{{Helper::getActiveClass(['subscription.index','subscription.create','subscription.edit'])}}">
				<a href="{{route('subscription.index')}}"><i class="fa fa-bar-chart-o"></i> <span class="nav-label">Subscription Plan</span></a>
			</li>

			<li class="{{Helper::getActiveClass(['emailtemplate','editemailtemplate'])}}">
				<a href="{{route('emailtemplate')}}"><i class="fa fa-envelope"></i> <span class="nav-label">Email Templates</span></a>
			</li>

			<li class="{{Helper::getActiveClass(['member_content'])}}">
				<a href="{{route('member_content')}}"><i class="fa fa-sitemap"></i> <span class="nav-label">Members Content CMS</span></a>
			</li>

			{{-- <li class="{{Helper::getActiveClass(['campaigns.index','campaigns.show'])}}">
				<a href="{{route('campaigns.index')}}"><i class="fa fa-paper-plane"></i> <span class="nav-label">User Search History</span></a>
			</li> --}}

			<li class="{{Helper::getActiveClass(['user.paymentHistory'])}}">
				<a href="{{route('user.paymentHistory')}}"><i class="fa fa-money"></i> <span class="nav-label">Payment History</span></a>
			</li>
		</ul>
	</div>
</nav>