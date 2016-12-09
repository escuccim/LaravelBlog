@extends('layouts.app')

@section('content')

<div id="pictures" class="carousel slide container" style="width: 850px" data-ride="carousel" data-interval="8000">
	<ol class="carousel-indicators">
		@for($i = 0; $i < count($photos); $i++)
    		<li data-target="#pictures" data-slide-to="{{ $i }}" {!! ($i == 0) ? 'class="active"' : '' !!}></li>
    	@endfor
    </ol>
    
    <!-- Wrapper for slides -->
	<div class="carousel-inner" role="listbox">
		@foreach($photos as $photo)
			<div class="item {{ ($photos[0]->id == $photo->id) ? 'active' : '' }}">
				<img src="/storage/photos/{{ $photo->file }}">
				<div class="carousel-caption">
					<h3>{{ $photo->title }}</h3>
					<p>{{ $photo->caption }}
				</div>
			</div>
		@endforeach
	</div>
	
	<!-- Left and right controls -->
	<a class="left carousel-control" href="#pictures" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
	
	<a class="right carousel-control" href="#pictures" role="button" data-slide="next">
		<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
		<span class="sr-only">Next</span>
	</a>
</div>	
	
@endsection