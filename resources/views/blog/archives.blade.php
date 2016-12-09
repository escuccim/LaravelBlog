<?php 
	$currentYear = 0;
	$currentMonth = 0;
?>

<div class="panel panel-info">
	<div class="panel-heading">
		Archives
	</div>	
	
	<ul class="list-group">
		@foreach($links as $year => $months)
			<li class="list-group-item"><a href="#c{{ $year }}" data-toggle="collapse">{{ $year }}</a>
				<div class="panel-collapse collapse" id="c{{ $year }}">
				<ul class="smallindent">
					@foreach($months as $month => $posts)
						<li class="small"><a href="#c{{ $year }}m{{$month}}" data-toggle="collapse">{{ $month }}</a>
						<div class="panel-collapse collapse" id="c{{$year}}m{{$month}}">
						<ul class="smallindent">
							@foreach($posts as $post)
								<li class="smalltext"><a href="{{ action('BlogController@show', $post['slug']) }}">{{ $post['title'] }}</a>
							@endforeach
						</ul>
						</div>
					@endforeach
				</ul>
				</div>
		@endforeach
	</ul>
</div>	