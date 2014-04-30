<?php require 'header.php'; ?>

<?php foreach($posts->paginate()->limit(3)->get() as $post): ?>

	<div class="row">

		<div class="large-12 columns">

			<h2>
				<?php echo $post->title;?>
			</h2>

			<?php if ($post->image): ?>
				<div>
					<img src="<?php echo URL::to('uploads') ?><?php echo $post->image ?>" style="width:300px; height: 300px;margin: 10px 0; border:1px solid black;">
				</div>
			<?php endif; ?>

			<div>
				<?php echo substr($post->content, 0, 150);?>...
			</div>

			<a href="post/<? echo $post->slug;?>">Read More</a> <br>

		</div>

	</div>

<?php endforeach; ?>

<div class="row">

	<div class="large-12">
		<?php $posts->paginator(); ?>
	</div>

</div>

<?php require 'footer.php'; ?>