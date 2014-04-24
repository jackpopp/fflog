<div class="row input-form js-new-post ">
	<div class="large-12 columns">
		<h1>
			New Post
		</h1>
		<form action="{{ URL::to('admin/post') }}" method="post" enctype="multipart/form-data">
			<div class="">
				<input class="js-focus-input" type="text" placeholder="Enter Title" name="title" autocomplete="off">
			</div>
			<div class="input-file">
				<label>Add Image</label> <input type="file" name="image">
			</div>
			<div class="">
				<textarea name="content" placeholder="Enter Content"></textarea>
			</div>
			<button>Add</button>
		</form>
	</div>
</div>

<div class="row input-form js-blog-settings blog-settings">
	<div class="large-12 columns">
		<h1>
			Blog Settings
		</h1>
		<div>
			<form action="{{ URL::to('admin/site-settings') }}" method="post">
				<div class="">
					<label>Blog name</label>
					<input class="js-blog-name" type="text" name="blog_name" value="<?php echo $siteSettings->blog_name?>">
				</div>
				<div class="">
					<label>Theme</label>
					<select name="theme">
						<?foreach ($themesFolder as $key => $theme):?>
							<option value="<?php echo $theme?>" <?php echo (($siteSettings->theme == $theme) ? 'selected' : '')?>><?php echo $theme; ?></option>
						<?endforeach;?>
					</select>
				</div>
				<button>Save</button>
			</form>
		</div>
	</div>
</div>

<div class="row input-form js-edit-posts edit-posts">
	<div class="large-12 columns">
		<h1>
			Edit Posts
		</h1>
	</div>
	<ul>
		<li class="large-12 columns">
			Post Count: {{count($posts)}}
		</li>
		<?php foreach ($posts as $key => $post): ?>
		<li>
			<a class="large-6 small-12 columns" href="<?php echo URL::to('post').'/'.$post->slug?>"> <?php echo $post->title?></a>
			<a class="large-2 large-offset-2 small-6 columns editable" href="<?php echo URL::to('admin/posts/edit').'/'.$post->slug.'/'.$key?>">Edit</a>
			<a class="large-2 small-6 columns editable" href="<?php echo URL::to('admin/posts/delete').'/'.$post->slug.'/'.$key?>">Delete</a>
		</li>
		<?php endforeach;?>
	</ul>
</div>