<!-- main-header -->
<header class="dash-toolbar">
	<a class="menu-toggle">
		<i class="fas fa-bars"></i>
	</a>
	<div class="tools">
		<a class="tools-item">
			<i class="fas fa-bell"></i>
			<i class="tools-item-count">4</i>
		</a>
		<div class="dropdown tools-item">
			<a class="" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<i class="fas fa-user"></i>
			</a>
			<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1">
				<a class="dropdown-item">Profile</a>
				<a class="dropdown-item" href="{{ route('logout') }}"
					onclick="event.preventDefault();
									document.getElementById('logout-form').submit();">
					{{ __('Logout') }}
				</a>

				<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
					@csrf
				</form>
			</div>
		</div>
	</div>
</header>
<!-- main-header -->