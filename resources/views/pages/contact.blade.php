@extends('layouts.app')

@section('content')
<div class="row" id="app">
	<div class="col-md-12">
		<div class="panel panel-info">
			<div class="panel-heading">
				<h2>Contact Me</h2>
			</div>
			
			@include('errors.list')
			
			<div class="panel-body">
				{!! Form::open(['url' => '/about/contact', 'class' => 'form-horizontal']) !!}
					<div class="form-group	">
						{!! Form::label('name', 'Name:', ['class' => 'control-label col-md-1']) !!}
						<div class="col-md-10">
							{!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Your name', 'v-model' => 'name']) !!}
						</div>
					</div>
					<div class="form-group">
						{!! Form::label('email', 'Email:', ['class' => 'control-label col-md-1']) !!}
						<div class="col-md-10">
							{!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Your email', 'v-model' => 'email']) !!}
						</div>
					</div>
					<div class="form-group">
						{!! Form::label('body', 'Body:', ['class' => 'control-label col-md-1']) !!}
						<div class="col-md-10">
							{!! Form::textarea('body', null, ['class' => 'form-control', 'placeholder' => 'Your message', 'v-model' => 'body']) !!}
						</div>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary center-block" :disabled="!(email && body && name)">Send Message</button>
					</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>	

<script>
new Vue({
	el: '#app',
	data: {
		name: '',
		email: '',
		body: '',
	},
});
</script>
@endsection