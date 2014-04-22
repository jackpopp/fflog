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