@extends('layouts.app')

@section('content')

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading gray">
				<h3>Add Photo</h3>
			</div>
			<div class="panel-body">
				@include('errors.list')
			
				{!! Form::model($photo, ['action' => ['PhotoController@update', $photo->id], 'method' => 'patch', 'class' => 'form-horizontal', 'files' => true]) !!}
					@include('photos.form')
				{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>

@endsection