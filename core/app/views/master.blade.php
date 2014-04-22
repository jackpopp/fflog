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