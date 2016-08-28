<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Diskourse</title>

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	    <link rel="stylesheet" href="{{ URL::asset('public/css/bootstrap.min.css') }}">
	    <link rel="stylesheet" href="{{ URL::asset('public/css/bootstrap.css') }}">
	    <link rel="stylesheet" href="{{ URL::asset('public/css/bootstrap.min.css') }}">
	    <link rel="stylesheet" href="{{ URL::asset('public/css/style.css') }}">
	    <link href="{{ URL::asset('public/css/landing-page.css')}}" rel="stylesheet">
        <!-- Custom CSS -->
      
    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">



</head>

<body>
	@include('templates.partials.navigation')
	<div class="container">
		@include('templates.partials.alerts')
		@yield('content')

<script async="async" src="{{ URL::asset('public/js/bootstrap.js')}}"></script>
<script async="async" src="{{ URL::asset('public/js/bootstrap.min.js')}}"></script>
<script async="async" src="{{ URL::asset('public/js/jquery.js')}}"></script>

	</div>
</body>
	</html>

