<?php require 'header.php'; ?>

<?php foreach($posts as $post): ?>

	<h1>
		<?php echo $post->title;?>
	</h1>

	<div>
		<?php echo substr($post->content, 0, 50);?>...
	</div>

	<a href="posts/<? echo $post->slug;?>">Read More</a> <br>

<?php endforeach; ?>

<?php require 'footer.php'; ?>