<!-- main-sidebar -->
<div class="dash-nav dash-nav-dark">
	<header>
		<a class="menu-toggle">
			<i class="fas fa-bars"></i>
		</a>
		<a href="{{ route('home') }}" class="spur-logo"><i class="fas fa-bolt"></i> <span>{{ __('CRM') }}</span></a>
	</header>
	<nav class="dash-nav-list">
		<a href="{{ route('home') }}" class="dash-nav-item"><i class="fas fa-home"></i>{{ __('Dashboard') }}</a>
		<a href="{{ route('users.index') }}" class="dash-nav-item"><i class="fas fa-user"></i>{{ __('Users') }}</a>
		<a href="{{ route('clients.index') }}" class="dash-nav-item"><i class="fas fa-id-card"></i>{{ __('Clients') }}</a>
		<a href="{{ route('projects.index') }}" class="dash-nav-item"><i class="fas fa-file"></i>{{ __('Projects') }}</a>
		<a href="{{ route('tasks.index') }}" class="dash-nav-item"><i class="fas fa-tasks"></i>{{ __('Tasks') }}</a>

		<div class="dash-nav-dropdown">
			<a class="dash-nav-item dash-nav-dropdown-toggle">
				<i class="fas fa-archive"></i> {{ __('Archive') }}
			</a>
			<div class="dash-nav-dropdown-menu mx-4">

				<a href="{{ route('clients.archiveList') }}" class="dash-nav-item"><i class="fas fa-id-card"></i>{{ __('Clients') }}</a>
				<a href="{{ route('projects.archiveList') }}" class="dash-nav-item"><i class="fas fa-file"></i>{{ __('Projects') }}</a>
				<a href="{{ route('tasks.archiveList') }}" class="dash-nav-item"><i class="fas fa-tasks"></i>{{ __('Tasks') }}</a>

			</div>
		</div>

	</nav>
</div>
<!-- main-sidebar -->
