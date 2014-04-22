<!Doctype html>
<html>
<head>
	
	<title>Fflog</title>
	<link rel="stylesheet" type="text/css" href="{{URL::to('assets/css/normalize.css')}}">
	<link rel="stylesheet" type="text/css" href="{{URL::to('assets/css/foundation.min.css')}}">

</head>

<body>

	<header>
		<nav class="top-bar" data-topbar>
			<ul class="title-area">
				<li class="name">
					<h1><a href="{{ URL::to('admin')}}">Fflog</a></h1>
				</li>
			</ul>

			<section class="top-bar-section">
				<!-- Left Nav Section -->
				<ul class="left">
					
				</ul>

				<!-- Right Nav Section -->
				@if (Session::get('isLoggedIn'))
					<ul class="right">
						<li>
							<a href="{{ URL::to('admin/logout') }}">Logout</a>
						</li>
					</ul>
				@endif
			</section>
		</nav>
	</header>

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

	{{ $content }}

</body>

</html>