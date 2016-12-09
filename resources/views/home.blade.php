@extends('layouts.app')

@section('content')

<div class="row">
	<div class="col-md-6 col-md-offset-1">
    	<div class="panel panel-default">
			<div class="panel-heading gray"><h4>Welcome!</h4></div>
			<div class="panel-body">
				<p>Welcome to my personal web site. What is here so far:
                <ul>
                	<li><a href="{{ url('/blog') }}">My Blog</a></li>
                	<li><a href="{{ url('/about') }}">About Me</a></li>
	                <li><a href="{{ action('PagesController@cv') }}">My CV</a></li>
	                <li><a href="{{ action('PagesController@contact') }}">Contact Me</a></li>
				</ul>
				
				@if(Auth::check())
					@if(Auth::user()->isAdmin())
						<p><strong>Admin Stuff</strong>
						<ul>
							<li><a href="{{ action('UserController@index') }}">User Management</a>
							<li><a href="{{ action('JobsController@index') }}">CV Management</a>
							<li><a href="{{ action('PhotoController@index') }}">Photo Management</a>
						</ul>
					@endif
				@endif
			</div>
		</div>
	</div>
    
	<div class="col-md-4">
    	<div class="panel panel-default">
    		<div class="panel-heading gray">
    			<h4>Latest Blog Posts</h4>
			</div>
    		<div class="panel-body">
    			<ul class="list-group">
	    			@foreach($blogs as $blog)
	    				<a href="{{ action('BlogController@show', [$blog->slug]) }}" class="list-group-item">{{ $blog->title }} - <small>{{date('Y-m-d', strtotime($blog->published_at->date)) }}</small></a>
					@endforeach
				</ul>
			</div>
		</div>
	</div>
</div>

@endsection
