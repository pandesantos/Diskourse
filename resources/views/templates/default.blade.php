<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Diskourse</title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
</head>
<body>
	<style type="text/css">

   body { background: #00000!important; } /* Adding !important forces the browser to overwrite the default style applied by Bootstrap */
</style>
	@include('templates.partials.navigation')
	<div class="container">

		
		@include('templates.partials.alerts')

		@yield('content')

	</div>

	</body>
	</html>

