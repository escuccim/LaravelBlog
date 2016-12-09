@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-info">
			<div class="panel-heading">
				<h2>Contact Me - Success</h2>
			</div>

			<div class="panel-body">
				<div class="alert alert-success alert-important">
					<p>Your message has successfully been sent!</p>
				</div>
				
				<div class="text-center">
					<a href="/about" class="btn btn-primary">Go Back</a>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection