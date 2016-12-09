@extends('layouts.app')

@section('header')
	{{-- @if($user->isAdmin())
		<meta name="csrf-token" content="{{ csrf_token() }}">
	@endif --}}
@endsection

@section('content')
<div class="row">
	<div class="col-md-10">
		<article>
		<div class="panel {{ $blog->getBlogStatus() }}">
			<div class="panel-heading">
				<i>On {{ date('l Y-m-d', strtotime($blog->published_at)) }}	</i>	
				<h2>{{ $blog->title }}</h2>
				By {{ $blog->user->name }}
			</div>
			
			<div class="panel-body">	
				{!! $blog->body !!}
				
				@include('blog.tags')
				
				@if(isUserAdmin())
					<div class="row">
						<div align="center">
							<div class="btn-group">
								<a href="{{ action('BlogController@edit', [$blog->id]) }}" class="btn btn-primary">Edit Blog</a>
								<a href="{{ action('BlogController@destroy', [$blog->id]) }}" id="deleteBlog" class="btn btn-default">Delete Blog</a>
							</div>
						</div>
					</div>	
				@endif
			</div>	
		</div>		
		</article>
		<hr>
		
		@include('blog.comments')
	</div>
	
	<div class="col-md-2">
		@include('blog.archives')
	</div>
</div>

@endsection

@section('footer')
<script>
new Vue({
	el: '#comment',
	data: {
		comment: '',
	}
});

	@if(isUserAdmin())
		$.ajaxSetup({
		    headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    }
		});
		$("#deleteBlog").click(function(e){
			e.preventDefault();
			var x = confirm("Are you sure you want to delete this?");
			if(x){
				$.ajax({
					url: '/blog/{{ $blog->id }}',
					type: 'delete',
					success: function(result){
					},
					error: function(result){
					},
					complete: function(result){
						location.reload();
					},
				});
			}
		});
		
	@endif
</script>
@endsection