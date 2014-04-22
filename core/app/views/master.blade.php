<!Doctype html>
<html>
<head>
	
	<title>Fflog</title>
	<link rel="stylesheet" type="text/css" href="{{URL::to('assets/css/normalize.css')}}">
	<link rel="stylesheet" type="text/css" href="{{URL::to('assets/css/foundation.min.css')}}">

</head>

<body>

	@if (Session::get('errorMessage'))
		<div>
			{{ Session::get('errorMessage')}}
		</div>
	@endif

	@if (Session::get('successMessage'))
		<div>
			{{ Session::get('successMessage')}}
		</div>
	@endif

	@if (Session::get('isLoggedIn'))
		<a href="admin/logout">Logout</a>
	@endif

	{{ $content }}

</body>

</html>