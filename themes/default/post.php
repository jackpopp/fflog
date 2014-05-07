<?php require 'header.php'; ?>

<div class="row">

	<div class="large-12 columns">

		<h2>
			<?php echo $post->title;?>
		</h2>

		<hr>

		<?php if ($post->image): ?>
			<div>
				<img src="<?php echo URL::to('uploads') ?><?php echo $post->image ?>" style="max-width:600px; max-height: 600px;margin: 10px 0; border:1px solid black;">
			</div>
		<?php endif; ?>

		<div>
			<p>
				<?php echo nl2br($post->content);?>
			</p>
		</div>

		<br>

		<p>
			Post Tags <?php echo $this->postHandler->fetchTagLinks($post); ?>
		</p>

		<hr>

	</div>

</div>

<?php require 'footer.php'; ?>