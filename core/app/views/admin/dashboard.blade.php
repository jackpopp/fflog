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

<div>
	<h1>Blog Settings</h1>
	<div>
		<form>
			<div class="">
				<label>Blog name</label>
				<input type="text" value="<?php echo $siteSettings->blog_name?>">
			</div>
			<div class="">
				<label>Theme</label>
				<select name="theme">
					<?foreach ($themesFolder as $key => $theme):?>
						<option value="<?php echo $theme?>" <?php echo (($siteSettings->theme == $theme) ? 'selected' : '')?>><?php echo $theme; ?></option>
					<?endforeach;?>
				</select>
			</div>
			<button>Submit</button>
		</form>
	</div>
</div>