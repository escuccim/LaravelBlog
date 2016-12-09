@extends('layouts.app')

@section('header')
<style>
	#sortable { list-style-type: none; margin: 0; padding: 0; width: 100%; }
	.ui-state-highlight { height: 1.5em; line-height: 1.2em; }
</style>

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    
<script>
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$( function() {
	$( "#sortable" ).sortable({
		placeholder: "ui-state-highlight",
		update: function(event, ui){
			var data = $(this).sortable('serialize');

			$.ajax({
				data: data,
				type: 'POST',
				url: '/cvadmin/order',
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
						<h3>CV Administration</h3>
					</div>
					<div class="col-md-2">
						<a href="{{ action('JobsController@create') }}" class="btn btn-primary btn-sm">Add Entry</a>
					</div>
				</div>
			</div>
			
			<div class="panel-body">
				<ul id="sortable" class="list-group">
					@foreach($jobs as $job)
						<li class="list-group-item ui-state-default" id="item-{{ $job->id }}">
						<a href="{{ action('JobsController@show', [$job->id]) }}">{{ $job->company }} - {{ $job->position }}</a>
						</li>
					@endforeach
				</ul>
			</div>
		</div>
@endsection