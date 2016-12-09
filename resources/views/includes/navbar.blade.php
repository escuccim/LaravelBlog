<nav class="navbar navbar-default navbar-static-top">
	<div class="container">
		<div class="navbar-header">

			<!-- Collapsed Hamburger -->
			<button type="button" class="navbar-toggle collapsed"
				data-toggle="collapse" data-target="#app-navbar-collapse">
				<span class="sr-only">Toggle Navigation</span> <span
					class="icon-bar"></span> <span class="icon-bar"></span> <span
					class="icon-bar"></span>
			</button>

			<!-- Branding Image -->
			<a class="navbar-brand" href="{{ url('/home') }}"> {{ config('app.name', 'Eric Scuccimarra') }} </a>
		</div>

		<div class="collapse navbar-collapse" id="app-navbar-collapse">
			<!-- Left Side Of Navbar -->
			<ul class="nav navbar-nav">
				<li {!! Request::is( 'about') ? 'class="active"' : '' !!}>
					<a href="/about">About</a>
				</li>
				<li {!! Request::is( 'blog*') ? 'class="active"' : '' !!}><a href="/blog">Blog</a></li>
				
				<li {!! Request::is( 'about/contact*') ? 'class="active"' : '' !!}><a href="about/contact">Contact Me</a></li>
				@if(isUserAdmin())
					<li {!! Request::is( '*admin*') || Request::is('users*') ? 'class="active"' : '' !!}>
						<a class="dropdown-toggle" href="#" data-toggle="dropdown">Admin<span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="/users">User Management</a>
							<li><a href="/cvadmin">CV Management</a>
							<li><a href="/photoadmin">Photo Management</a>
						</ul>
				@endif
				
			</ul>

			<!-- Right Side Of Navbar -->
			<ul class="nav navbar-nav navbar-right">
				<!-- Authentication Links -->
				@if (Auth::guest())
					<li><a href="{{ url('/login') }}">Login</a></li>
					<li><a href="{{ url('/register') }}">Register</a></li> 
				@else
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"> 
							{{ Auth::user()->name }} <span class="caret"></span></a>

					<ul class="dropdown-menu" role="menu">
						<li><a href="{{ action('UserController@profile') }}" >Profile</a>
						<li><a href="{{ url('/logout') }}" onclick="event.preventDefault(); signOut(); document.getElementById('logout-form').submit();">
								Logout </a>

							<form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form></li>
					</ul></li> 
				@endif
			</ul>
		</div>
	</div>
</nav>