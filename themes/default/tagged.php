<?php require 'header.php'; ?>


<div class="row">
	<div class="large-12 columns">
		<h4>
			Selected Tag: <strong><?php echo $tag?></strong>
		</h4>
	</div>
</div>

<?php foreach($posts as $post): ?>

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

			<br>

			<p>
				Post Tags <?php echo $this->postHandler->fetchTagLinks($post); ?>
			</p>

			<a href="<?php echo URL::to('post/'.$post->slug);?>">Read More</a> <br>

		</div>

	</div>

<?php endforeach; ?>

<?php require 'footer.php'; ?>