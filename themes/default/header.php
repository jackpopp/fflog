<!DOCTYPE html>
<html>
	<head>
		<link href='http://fonts.googleapis.com/css?family=Merriweather:300' rel='stylesheet' type='text/css'>
		<?php $fflog->css('normalize.css');?>
		<?php $fflog->css('foundation.min.css');?>
		<?php $fflog->css('main.css');?>
		<?php $fflog->css('default.css');?>
		<?php $fflog->js('core.js');?>
		<?php $fflog->js('highlight.js');?>
		<script>hljs.initHighlightingOnLoad();</script>

		<title>
			<?echo $blogName?> <?php echo ( isset($post) ? '- '.$post->title : '' ) ?>
		</title>
	</head>
	<body>

		<header class="heading">
			<div class="row">
				<div class="large-12 columns">
					<h1>
						<?echo $blogName?>
					</h1>
				</div>
			</div>
		</header>