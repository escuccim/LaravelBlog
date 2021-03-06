<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Description>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="google-signin-client_id" content="556265380008-lap52g9fj0qsdn4c47lsdnr7ap3bi1g2.apps.googleusercontent.com">
    
    <title>{{ config('app.name', 'Laravel Blog') }} {{ isset($title) ? ' - ' . $title : '' }}</title>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">
	<link rel="stylesheet" href="/css/select2.min.css">
	<script src="/js/app.js"></script>
	<script src="https://apis.google.com/js/platform.js?onload=onLoad" async defer></script>
	 
    <!-- Scripts -->
    <script>
	    $.ajaxSetup({
	        headers: {
	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        }
	    });
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
    
    @yield('header')
</head>
<body>
    <div id="app">
        @include('includes.navbar')
		
		<div class="container">
			@include('flash::message')
        	@yield('content')
        </div>
    </div>

    <!-- Scripts -->
 
    <script>
		$('div.alert').not('.alert-important').delay(3000).slideUp(300);
    </script>
    @yield('footer')
</body>
</html>
