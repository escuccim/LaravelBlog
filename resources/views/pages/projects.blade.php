@extends('layouts.app')

@section('content')
    <div class="row">
    	<div class="col-md-12">
	    	<h3>Some of My Personal Projects:</h3>
    		<hr>
    	</div>
    </div>
    
   
	<div class="panel-group">
		<div class="panel panel-default">
        	<div class="panel-heading gray">
            	<a href="{{ action('RecordsController@index') }}">My Record Collection</a>
			</div>
            <div class="panel-body">
            	I have lots of vinyl. To keep track of my records I put them into a database, which is searchable and sortable.
			</div>
		</div>
        
        <div class="panel panel-default">
        	<div class="panel-heading gray">
            	<a href="{{ action('PagesController@recordapi') }}">My Record Collection API</a>
			</div>
            <div class="panel-body">
            	For no good reason, I made an API interface for my record collection. It's basically exactly the same as the HTML
            	search page, except it returns the data as JSON instead of as HTML. I thought about setting up an Oauth2 server 
            	for this purpose, but it didn't seem worth the trouble.
            	
            	<p>The <a href="{{ action('PagesController@recordapi') }}">documentation on how to use the API is here</a>.
			</div>
		</div>
        
        <div class="panel panel-default">	
        	<div class="panel-heading gray">
				<a href="{{ url('/projects/sudoku') }}">Sudoku Solver</a>
			</div>
			<div class="panel-body">
				A simple interface to solve Sudoku puzzles based on a PHP class and a simple algorithm.
			</div>
		</div>
		
		<div class="panel panel-default">
			<div class="panel-heading gray">
				More to Come
			</div>
			<div class="panel-body">
				More stuff coming soon...
			</div>
		</div>
	</div>
       
@endsection
