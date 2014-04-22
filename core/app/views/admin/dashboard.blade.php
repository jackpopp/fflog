<div class="row">
	<h1>
		Add a blog post
	</h1>
	<form action="{{ URL::to('admin/post') }}" method="post" enctype="multipart/form-data">
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

<div class="row">
	<h1>
		Edit Blog Settings
	</h1>
	<div>
		<form action="{{ URL::to('admin/site-settings') }}" method="post">
			<div class="">
				<label>Blog name</label>
				<input type="text" name="blog_name" value="<?php echo $siteSettings->blog_name?>">
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

<div class="row">
	<h1>
		Edit Posts
	</h1>
	<ul>
		<?php foreach ($posts as $key => $post): ?>
		<li>
			<a href="<?php echo URL::to('post').'/'.$post->slug?>"> <?php echo $post->title?></a>
			- <a href="<?php echo URL::to('admin/posts/edit').'/'.$post->slug.'/'.$key?>">Edit</a>
			- <a href="<?php echo URL::to('admin/posts/delete').'/'.$post->slug.'/'.$key?>">Delete</a>
		</li>
		<?php endforeach;?>
	</ul>
</div>