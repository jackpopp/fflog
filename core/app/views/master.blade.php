<!Doctype html>
<html>
<head>
	
	<title>Fflog</title>
	<link href='http://fonts.googleapis.com/css?family=Merriweather:300' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="{{URL::to('assets/css/normalize.css')}}">
	<link rel="stylesheet" type="text/css" href="{{URL::to('assets/css/foundation.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{URL::to('assets/css/fflog.css')}}">

</head>

<body>

	<header>
		<nav class="main-nav">
			<section class="row">
				<div class="large-12 columns">
					<ul class="left show-for-small">
						<li>
							<a href="{{ URL::to('')}}">Fflog</a>
						</li>
					</ul>

					<ul class="left hide-for-small">
						<li>
							<a href="{{ URL::to('')}}">Fflog</a>
						</li>
						@if ( Session::get('isLoggedIn') && ( ! Session::get('editMode')) )
						<li>
							<a class="js-show-section js-new-post-a active" href="#">New Post</a>
						</li>
						<li>
							<a class="js-show-section js-blog-settings-a" href="#">Blog Settings</a>
						</li>
						<li>
							<a class="js-show-section js-edit-posts-a" href="#">Edit Posts</a>
						</li>
						@endif
					</ul>

					@if (Session::get('isLoggedIn'))
					<ul class="right">
						<li>
							<a href="{{ URL::to('admin/logout') }}">Logout</a>
						</li>
					</ul>
					@endif
				</div>
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

	<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
	<script src="{{URL::to('assets/js/autosize.js')}}"></script>
	<script src="{{URL::to('assets/js/fflog.js')}}"></script>

</body>

</html>