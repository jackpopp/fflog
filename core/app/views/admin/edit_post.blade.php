<div>
	<h1>
		Edit Post
	</h1>
	<form action="{{ URL::to('admin/posts/edit') }}/{{ $post->slug }}/{{ $key }}" method="post" enctype="multipart/form-data">
		<div class="">
			<label>Title</label>
			<input type="text" placeholder="Title" name="title" value="{{ $post->title }}">
		</div>
		<div class="">
			@if ($post->image != null)
				<div>
					<img src="{{ URL::to('uploads') }}{{ $post->image }}" style="width:300px; height: 300px;margin: 10px 0; border:1px solid black;">
				</div>
			@endif
			<label>Image</label>
			<input type="file" name="image">
		</div>
		<div class="">
			<label>Content</label>
			<textarea name="content">{{$post->content}}</textarea>
		</div>
		<button>Submit</button>
	</form>
</div>