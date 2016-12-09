@extends('layouts.app') @section('content')
	
<div class="row">
	<div class="col-md-12">
		<h4>Professional Experience</h4>

		<div class="panel-group" id="experience">
		
			@foreach($jobs as $job)
				<div class="panel panel-default">
					<div class="panel-heading">
						<h5 class="panel-title">
						<a data-toggle="collapse" data-parent="#experience" href="#collapse{{ $job->id }}">
							{{ $job->company }} - {{ $job->position }}</a>
						</h4>
					</div>
					
					<div id="collapse{{ $job->id }}" class="panel-collapse collapse">
						<div class="panel-body">
							<p><strong>{{ date('m/Y', strtotime($job->startdate)) }} - {{ date('m/Y', strtotime($job->enddate)) }}</strong>
							
							{!! $job->description !!}
						</div>
					</div>
				</div>
			@endforeach
			
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<h4>Education</h4>

		<div class="panel-group" id="education">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a data-toggle="collapse" data-parent="#education"
							href="#education1">Marist College - MBA</a>
					</h4>
				</div>
				<div id="education1" class="panel-collapse collapse">
					<div class="panel-body">
						<p>Poughkeepsie, NY, USA
						<p>Concentration in Finance, 5/2003
						
					</div> 
				</div>
			</div>
			
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a data-toggle="collapse" data-parent="#education"
							href="#education2">Oberlin College - BA</a>
					</h4>
				</div>
				<div id="education2" class="panel-collapse collapse">
					<div class="panel-body">
						<p>Oberlin, OH, USA
						<p>Major in Computer Science, 5/1998
					</div>
				</div>
			</div>
			
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a data-toggle="collapse" data-parent="#education"
							href="#education3">Universit&eacute; de Lausanne</a>
					</h4>
				</div>
				<div id="education3" class="panel-collapse collapse">
					<div class="panel-body">
						<p>Cours de Vacance de francais, niveau C1-C2, &eacute;t&eacute; 2016
						<p>Chimie Generale, automne 2016
					</div>
				</div>
			</div>
		</div>	
	</div>
</div>
@endsection
