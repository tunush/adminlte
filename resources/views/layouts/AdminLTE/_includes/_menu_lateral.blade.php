<aside class="main-sidebar">
	<section class="sidebar">
		<ul class="sidebar-menu" data-widget="tree">
			<!-- <li class="header" style="color:#fff;"> MAIN MENU <i class="fa fa-level-down"></i></li>   -->
			<li class="{{ Request::segment(1) === 'profile' ? 'active' : null }}">
				<a href="{{ route('profile') }}" title="{{ Auth::user()->name }}"><i class="fa fa-user"></i> <span>{{ Auth::user()->name }}</span></a>
			</li>
			@if (Auth::user()->can('dashboard', ''))
				<li class="
							{{ Request::segment(1) === null ? 'active' : null }}
							{{ Request::segment(1) === 'home' ? 'active' : null }}
						">
					<a href="{{ route('home') }}" title="Dashboard"><i class="fa fa-home"></i> <span>Dashboard</span></a>
				</li>
			@endif
			
			<!-- @if(Request::segment(1) === 'profile') -->

			<!-- <li class="{{ Request::segment(1) === 'profile' ? 'active' : null }}">
				<a href="{{ route('profile') }}" title="Profile"><i class="fa fa-user"></i> <span>PROFILE</span></a>
			</li> -->

			<!-- @endif -->

			<li class="{{ Request::segment(1) === 'conversations' ? 'active' : null }}">
				<a href="{{ route('conversations') }}" title="Conversations"><i class="fa fa-comments"></i> <span>Conversations</span></a>
			</li>

			<li class="{{ Request::segment(1) === 'task_manager' ? 'active' : null }}">
				<a href="{{ route('task_manager') }}" title="Task Manager"><i class="fa fa-clipboard"></i> <span>Task Manager</span></a>
			</li>

			<li class="{{ Request::segment(1) === 'calendar' ? 'active' : null }}">
				<a href="{{ route('calendar') }}" title="Calendar"><i class="fa fa-calendar"></i> <span> Calendar</span></a>
			</li>

			@if (Auth::user()->can('white-board', ''))
				<li class="{{ Request::segment(1) === 'white_board' ? 'active' : null }}">
					<a href="{{ route('white_board') }}" title="White Board"><i class="fa fa-desktop"></i> <span>White Board</span></a>
				</li>
			@endif

			<li class="treeview 
				{{ Request::segment(1) === 'dashboard' ? 'active menu-open' : null }}
				{{ Request::segment(1) === 'pipeline' ? 'active menu-open' : null }}
				{{ Request::segment(1) === 'seller' ? 'active menu-open' : null }}
				{{ Request::segment(1) === 'buyer' ? 'active menu-open' : null }}
				">
				<a href="#">
					<i class="fa fa-flask"></i>
					<span>Leads</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">				
					@if (Auth::user()->can('leads-dashboard', ''))	
						<li class="{{ Request::segment(1) === 'dashboard' ? 'active' : null }}">
							<a href="{{ route('dashboard') }}" title="Dashboard">
								<i class="fa fa-dashboard"></i> <span>Dashboard</span>
							</a>
						</li>
					@endif
					@if (Auth::user()->can('leads-pipeline', ''))
						<li class="{{ Request::segment(1) === 'pipeline' ? 'active' : null }}">
							<a href="{{ route('pipeline') }}" title="Pipeline">
								<i class="fa fa-volume-up"></i> <span>Pipeline</span>
							</a>
						</li>
					@endif
					@if (Auth::user()->can('leads-seller', ''))
						<li class="{{ Request::segment(1) === 'seller' ? 'active' : null }}">
							<a href="{{ route('seller') }}" title="Seller">
								<i class="fa fa-user"></i> <span>Seller</span>
							</a>
						</li>
					@endif
					@if (Auth::user()->can('leads-buyer', ''))
						<li class="{{ Request::segment(1) === 'buyer' ? 'active' : null }}">
							<a href="{{ route('buyer') }}" title="Buyer">
								<i class="fa fa-user"></i> <span>Buyer</span>
							</a>
						</li>
					@endif
				</ul>
			</li>

			@if (Auth::user()->can('estimator', ''))
				<li class="{{ Request::segment(1) === 'estimator' ? 'active' : null }}">
					<a href="{{ route('estimator') }}" title="Estimator"><i class="fa fa-hourglass"></i> <span>Estimator</span></a>
				</li>
			@endif

			@if (Auth::user()->can('properties', ''))
				<li class="{{ Request::segment(1) === 'properties' ? 'active' : null }}">
					<a href="{{ route('properties') }}" title="Properties"><i class="fa fa-desktop"></i> <span>Properties</span></a>
				</li>
			@endif

			@if (Auth::user()->can('buyers', ''))
				<li class="{{ Request::segment(1) === 'buyers' ? 'active' : null }}">
					<a href="{{ route('buyers') }}" title="Buyers"><i class="fa fa-user"></i> <span>Buyers</span></a>
				</li>
			@endif

			@if (Auth::user()->can('contacts', ''))
				<li class="{{ Request::segment(1) === 'contacts' ? 'active' : null }}">
					<a href="{{ route('contacts') }}" title="Contacts"><i class="fa fa-address-book"></i> <span>Contacts</span></a>
				</li>
			@endif

			<li class="{{ Request::segment(1) === 'reporting' ? 'active' : null }}">
				<a href="{{ route('reporting') }}" title="Reporting"><i class="fa fa-pie-chart"></i> <span>Reporting</span></a>
			</li>

			<li class="{{ Request::segment(1) === 'call_scripts' ? 'active' : null }}">
				<a href="{{ route('call_scripts') }}" title="Call scripts"><i class="fa fa-list-alt"></i> <span>Call scripts</span></a>
			</li>

			<li class="treeview 
				{{ Request::segment(1) === 'config' ? 'active menu-open' : null }}
				{{ Request::segment(1) === 'user' ? 'active menu-open' : null }}
				{{ Request::segment(1) === 'role' ? 'active menu-open' : null }}

				{{ Request::segment(1) === 'profile' ? 'active menu-open' : null }}
				{{ Request::segment(1) === 'custom_fields' ? 'active menu-open' : null }}
				{{ Request::segment(1) === 'default_fields' ? 'active menu-open' : null }}
				{{ Request::segment(1) === 'smtp' ? 'active menu-open' : null }}
				{{ Request::segment(1) === 'phone' ? 'active menu-open' : null }}
				{{ Request::segment(1) === 'workflow' ? 'active menu-open' : null }}
				{{ Request::segment(1) === 'calendars' ? 'active menu-open' : null }}
				">
				<a href="#">
					<i class="fa fa-gear"></i>
					<span>Settings</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					@if (Auth::user()->can('settings-profile', ''))
						<li class="{{ Request::segment(1) === 'config' && Request::segment(2) === null ? 'active' : null }}">
							<a href="{{ route('config') }}" title="Profile">
								<i class="fa fa-info-circle"></i> <span>Profile</span>
							</a>
						</li>
					@endif
					@if (Auth::user()->can('settings-roles', ''))
						<li class="{{ Request::segment(1) === 'role' ? 'active' : null }}">
							<a href="{{ route('role') }}" title="Roles"><i class="fa fa-flag"></i> <span>Roles</span></a>
						</li>
					@endif
					@if (Auth::user()->can('settings-users', ''))
						<li class="{{ Request::segment(1) === 'user' ? 'active' : null }}">
							<a href="{{ route('user') }}" title="Users">
								<i class="fa fa-users"></i> <span>Users</span>
							</a>
						</li>
					@endif
					@if (Auth::user()->can('settings-custom-fields', ''))
						<li class="{{ Request::segment(1) === 'custom_fields' ? 'active' : null }}">
							<a href="{{ route('custom_fields') }}" title="Custom Fields">
								<i class="fa fa-list"></i> <span>Custom Fields</span>
							</a>
						</li>
					@endif
					@if (Auth::user()->can('settings-default-fields', ''))
						<li class="{{ Request::segment(1) === 'default_fields' ? 'active' : null }}">
							<a href="{{ route('default_fields') }}" title="Default Fields">
								<i class="fa fa-list"></i> <span>Default Fields</span>
							</a>
						</li>
					@endif
					@if (Auth::user()->can('settings-SMTP', ''))
						<li class="{{ Request::segment(1) === 'smtp' ? 'active' : null }}">
							<a href="{{ route('smtp') }}" title="SMTP">
								<i class="fa fa-envelope"></i> <span>SMTP</span>
							</a>
						</li>
					@endif
					@if (Auth::user()->can('settings-phone', ''))
						<li class="{{ Request::segment(1) === 'phone' ? 'active' : null }}">
							<a href="{{ route('phone') }}" title="Phone">
								<i class="fa fa-phone-square"></i> <span>Phone</span>
							</a>
						</li>
					@endif
					@if (Auth::user()->can('settings-workflow', ''))
						<li class="{{ Request::segment(1) === 'workflow' ? 'active' : null }}">
							<a href="{{ route('workflow') }}" title="Workflow">
								<i class="fa fa-magic"></i> <span>Workflow</span>
							</a>
						</li>
					@endif
					@if (Auth::user()->can('settings-calendars', ''))
						<li class="{{ Request::segment(1) === 'calendars' ? 'active' : null }}">
							<a href="{{ route('calendars') }}" title="Calendars">
								<i class="fa fa-calendar"></i> <span>Calendars</span>
							</a>
						</li>
					@endif
				</ul>
			</li>
		</ul>
	</section>
</aside>