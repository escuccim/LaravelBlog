@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col-md-8 col-md-offset-2">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3>User Profile</h3>
			</div>
			<div class="panel-body">
				@include('errors.list')
				
				<form class="form-horizontal" action="/user/profile" method="post" enctype="multipart/form-data">
				{{ csrf_field() }}
				{!! Form::hidden('id', $user->id) !!}
					<div class="form-group">
						{!! Form::label('name', 'Name:', ['class' => 'control-label col-md-2']) !!}
						<div class="col-md-9">
							{!! Form::text('name', $user->name, ['class' => 'form-control']) !!}
						</div>
					</div>
					
					<div class="form-group">
						{!! Form::label('email', 'Email:', ['class' => 'control-label col-md-2']) !!}
						<div class="col-md-9">
							{!! Form::text('email', $user->email, ['class' => 'form-control']) !!}
						</div>
					</div>
					
					<div class="form-group">
						{!! Form::label('password', 'Password:', ['class' => 'control-label col-md-2']) !!}
						<div class="col-md-9">
							{!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Only enter if you want to change your password']) !!}
						</div>
					</div>
					
					<div class="form-group">
						{!! Form::label('password_confirmation', 'Confirm Password:', ['class' => 'control-label col-md-2']) !!}
						<div class="col-md-9">
							{!! Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => '']) !!}
						</div>
					</div>
					
					<div class="form-group">
						{!! Form::label('image', 'Image:', ['class' => 'control-label col-md-2']) !!}
						<div class="col-md-9">
							@if($user->image)
								<img src="{{ $user->image }}" style="max-height: 75px;"><br/>
							@endif
							{!! Form::file('image', ['class' => 'form-control']) !!}
						</div>
					</div>
					
					@if(Auth::user()->isAdmin())
						<div class="form-group">
							{!! Form::label('active', 'Active:', ['class' => 'control-label col-md-2']) !!}
							<div class="col-md-9">
								{!! Form::checkbox('active', 1, $user->active) !!}
							</div>
						</div>
						
						<div class="form-group">
							{!! Form::label('type', 'User Type:', ['class' => 'control-label col-md-2']) !!}
							<div class="col-md-9">
								<select name="type" class="form-control">
									<option value="0" {{ !$user->isAdmin() ? 'selected' : '' }}>User
									<option value="1" {{ $user->isAdmin() ? 'selected' : '' }}>Admin
								</select>
							</div>
						</div>
					@endif
					
					<div class="form-group text-center">
							<input type="submit" name="Update" value="Update Profile" class="btn btn-primary">
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection