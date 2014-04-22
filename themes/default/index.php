<?php require 'header.php'; ?>

<?php foreach($posts as $post): ?>

	<h1>
		<?php echo $post->title;?>
	</h1>

	<?php if ($post->image): ?>
		<div>
			<img src="<?php echo URL::to('uploads') ?><?php echo $post->image ?>" style="width:300px; height: 300px;margin: 10px 0; border:1px solid black;">
		</div>
	<?php endif; ?>

	<div>
		<?php echo substr($post->content, 0, 50);?>...
	</div>

	<a href="post/<? echo $post->slug;?>">Read More</a> <br>

<?php endforeach; ?>

<?php require 'footer.php'; ?>