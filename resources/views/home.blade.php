@extends('layouts.app')

@section('content')

<div class="row">
	<div class="col-md-6 col-md-offset-1">
    	<div class="panel panel-default">
			<div class="panel-heading gray"><h4>Welcome!</h4></div>
			<div class="panel-body">
				Content Goes Here
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
