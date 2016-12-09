@extends('layouts.app')

@section('header')
<link rel="alternate" type="application/rss+xml" title="Eric Scuccimarra's Blog" href="{{ url('feed') }}" />
@endsection

@section('content')

<div class="row">
	
	<div class="col-md-10">
		
		@if(Request::is( 'blog/labels*'))
			<div class="alert alert-warning alert-important text-center">
				Showing posts with label: <strong>{{ $name }}</strong>. 
				<a href="{{ action('BlogController@index')}}">Show all posts.</a>
			</div>
		@endif
		
		@foreach($blogs as $blog)
		<article>
			<div class="panel {{ $blog->getBlogStatus()  }}">
				<div class="panel-heading">
					<h3>
						<a href="{{ action('BlogController@show', [$blog->slug]) }}">{{ $blog->title }}</a>
					</h3>
					<strong>{{ date('l Y-m-d', strtotime($blog->published_at)) }}	</strong>
				</div>
				<div class="panel-body">	
					{!! $blog->body !!}
					
					@include('blog.tags')<br>
					
					<a href="{{ action('BlogController@show', [$blog->slug]) }}">
					@if($blog->comments->count())
						<small>{{ $blog->comments->count() }} comments</small>
					@else
						<small>No comments</small>
					@endif
					</a>
					
				</div>	
			</div>
		</article>
		@endforeach
	</div>	
	
	<div class="col-md-2">
		@if(isUserAdmin())
			<div class="text-right">
				<a href="/blog/create" class="btn btn-primary vcenter">Add Blog Post</a>
			</div>
		@endif
		
		@include('blog.archives')
	</div>
</div>

<div class="row">
	<div class="col-md-10 text-center">
		{{ $blogs->links() }}
	</div>
</div>
@endsection