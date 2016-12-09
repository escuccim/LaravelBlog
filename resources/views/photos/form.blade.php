<div class="form-group">
	{!! Form::label('title', 'Title:', ['class' => 'control-label col-md-1']) !!}
	<div class="col-md-10">
		{!! Form::text('title', null, ['class' => 'form-control']) !!}
	</div>
</div>

<div class="form-group">
	{!! Form::label('caption', 'Caption:', ['class' => 'control-label col-md-1']) !!}
	<div class="col-md-10">
		{!! Form::text('caption', null, ['class' => 'form-control']) !!}
	</div>
</div>

<div class="form-group">
	{!! Form::label('file', 'File:', ['class' => 'control-label col-md-1']) !!}
	@if(!Request::is('*edit*'))
		<div class="col-md-10">
			{!! Form::file('file', null, ['class' => 'form-control']) !!}
		</div>
	@else
		<div class="col-md-10">
			<img src="/images/uploads/{{$photo->file}}" style="max-height: 250px;">
		</div>
	@endif
</div>

<div class="form-group">
	{!! Form::label('active', 'Active:', ['class' => 'control-label col-md-1']) !!}
	<div class="col-md-1">
		{!! Form::radio('active', '1') !!} Yes
	</div>
	<div class="col-md-1">
		{!! Form::radio('active', '0') !!} No
	</div>
</div>

<div class="form-group">
	{!! Form::label('order', 'Order:', ['class' => 'control-label col-md-1']) !!}
	<div class="col-md-2">
		{!! Form::text('order', null, ['class' => 'form-control']) !!}
	</div>
</div>

<div class="form-group">
	<div class="col-md-12 text-center">
		{!! Form::submit($submitButtonText, ['class' => 'btn btn-primary']) !!}
	</div>
</div>