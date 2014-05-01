<div class="row input-form">
		<div class="large-12 columns">
		<h1>
			Edit Post
		</h1>
		<form class="js-validate-form" action="{{ URL::to('admin/posts/edit') }}/{{ $post->slug }}/{{ $key }}" method="post" enctype="multipart/form-data">
			<div class="">
				<label class="hidden">Title</label>
				<input class="js-focus-input required" type="text" placeholder="Title" name="title" value="{{ $post->title }}" autocomplete="off">
			</div>
			<div class="">
				<input class="js-tags-input" type="text" placeholder="Enter Tags" autocomplete="off">
				<div class="tag-holder">
					@if (isset($post->tags))
						<?php foreach (explode('|<>|', $post->tags) as $tag): ?>
							<div class="tag-name" data-tag="{{$tag}}">{{$tag}}<span class="js-tag-remove"> x</span></div>
						<?php endforeach; ?>
					@endif
				</div>
				<input class="js-tags" type="hidden" name="tags" value="<?php echo (isset($post->tags) ? $post->tags : '') ?>">
			</div>
			<div class="">
				@if ($post->image != null)
					<div>
						<img src="{{ URL::to('uploads') }}{{ $post->image }}" style="width:300px; height: 300px;margin: 10px 0; border:1px solid black;">
					</div>
				@endif
				<div class="input-file">
					<label>Update Image</label> <input type="file" name="image">
				</div>
			</div>
			<div class="">
				<label class="hidden">Content</label>
				<textarea class="required" name="content">{{$post->content}}</textarea>
			</div>
			<button>Update</button>
		</form>
	</div>
</div>