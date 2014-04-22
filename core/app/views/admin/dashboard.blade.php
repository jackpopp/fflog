<div class="">
	<h1>Add a blog post</h1>
	<form action="<?=URL::to('admin/post')?>" method="post" enctype="multipart/form-data">
		<div class="">
			<label>Title</label>
			<input type="text" placeholder="Title" name="title">
		</div>
		<div class="">
			<label>Image</label>
			<input type="file" name="image">
		</div>
		<div class="">
			<label>Content</label>
			<textarea name="content"></textarea>
		</div>
		<button>Submit</button>
	</form>
</div>