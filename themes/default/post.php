<?php require 'header.php'; ?>

<div class="row">

	<div class="large-12 columns">

		<h1>
			<?php echo $post->title;?>
		</h1>

		<?php if ($post->image): ?>
			<div>
				<img src="<?php echo URL::to('uploads') ?><?php echo $post->image ?>" style="max-width:600px; max-height: 600px;margin: 10px 0; border:1px solid black;">
			</div>
		<?php endif; ?>

		<div>
			<?php echo $post->content;?>
		</div>

		<br>

		<p>
			Post Tags <?php echo $this->postHandler->fetchTagLinks($post); ?>
		</p>

	</div>

</div>

<?php require 'footer.php'; ?>