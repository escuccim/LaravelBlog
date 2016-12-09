@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading gray">
				<h3>User Administration</h3>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-3 col-md-offset-1"><strong>Name</strong></div>
					<div class="col-md-3"><strong>Email</strong></div>
					<div class="col-md-2"><strong>Type</strong></div>
					<div class="col-md-2"><strong>Created Date</strong></div>
				</div>
				@foreach($users as $user)
					<div class="row {{ $user->active ? '' : 'bg-warning' }}">
						<div class="col-md-3 col-md-offset-1"><a href="{{ action('UserController@edit', [$user->id]) }}">{{ $user->name }}</a></div>
						<div class="col-md-3 danger">{{ $user->email }}</div>
						<div class="col-md-2">{{ $user->userType() }}</div>
						<div class="col-md-2">{{ date('Y-m-d G:i', strtotime($user->created_at)) }}</div>
					</div>
				@endforeach
			</div>
		</div>
	</div>
</div>
@endsection