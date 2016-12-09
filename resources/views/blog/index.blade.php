@extends('layouts.app')

@section('content')
	<div class="content">
		<div class="row">
			<div class="col-md-10">	
				<h2>Blog Posts 
					@if($user->isAdmin())
						- Admin
					@endif
				</h2>
			</div>
			
			@if($user->isAdmin())
				<div class="col-md-2">
					<div class="text-right">
					<a href="/blog/create" class="btn btn-primary vcenter">Add Blog Post</a>
					</div>
				</div>
			@endif
		</div>
	
	@foreach($blogs as $blog)
		<article>
			<h3><a href="{{ action('BlogController@show', [$blog->slug]) }}">{{ $blog->title }}</a>
			</h3>
			{{ date('l Y-m-d', strtotime($blog->published_at)) }}	
			
			@if($user->isAdmin())
				<p><button data-toggle="collapse" data-target="#blog-{{ $blog->slug }}" class="btn btn-default small">Show Content</button>
			@endif
			
			<div class="collapse" id="blog-{{ $blog->slug }}">
				{!! $blog->body !!}
			</div>	
			
			<hr>
		</article>
	@endforeach
	</div>
@endsection