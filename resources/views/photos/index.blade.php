@extends('layouts.app')

@section('header')
<style>
	#sortable { list-style-type: none; margin: 0; padding: 0; width: 100%; }
	.ui-state-highlight { height: 1.5em; line-height: 1.2em; }
</style>

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    
<script>
$( function() {
	$( "#sortable" ).sortable({
		placeholder: "ui-state-highlight",
		update: function(event, ui){
			var data = $(this).sortable('serialize');

			$.ajax({
				data: data,
				type: 'POST',
				url: '/photoadmin/order',
			});
		}
	});
	$( "#sortable" ).disableSelection();
} );
</script>

@endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading gray">
				<div class="row">
					<div class="col-md-10">
						<h3>Photo Administration</h3>
					</div>	
					<div class="col-md-2">
						<a href="{{ action('PhotoController@create') }}" class="btn btn-primary">Add Photo</a>
					</div>
				</div>
			</div>
			<div class="panel-body">
				<div class="panel-group" id="photos">
					<ul id="sortable">
					@foreach($photos as $photo)
						<li class="ui-state-default" id="item-{{ $photo->id }}">
						<div class="panel {{ $photo->statusText() }}">
							<div class="panel-heading">
								<div class="row">
									<div class="col-md-10">
										<a data-toggle="collapse" data-parent="photos" href="#collapse{{ $photo->id }}">
											{{ $photo->title }} - {{ $photo->caption }}	</a>
									</div>
									<div class="col-md-1">
										<a href="{{ action('PhotoController@edit', [$photo->id]) }}" class="btn btn-primary btn-sm">Edit</a>
									</div>
									<div class="col-md-1">
										{!! Form::open(['action' => ['PhotoController@destroy', $photo->id], 'method' => 'delete', 'onSubmit' => 'return confirm("Are you sure you want to delete this?")']) !!}
											<input type="submit" class="btn btn-default btn-sm" value="Delete" name="delete">											
										{!! Form::close() !!}
									</div>
								</div>
							</div>
							<div id="collapse{{ $photo->id }}" class="panel-collapse collapse">
								<img src="/storage/photos/{{ $photo->file }}" style="max-height: 300px;">
							</div>
						</div>
						</li>
					@endforeach
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection