<div class="row input-form">
	<div class="large-12 columns">
		<h1>Lets get you started</h1>
		<form class="js-validate-form" action="<?=URL::to('installer/setup')?>" method="post">
			<div class="">
				<input class="js-focus-input" type="text" placeholder="Blog Name" name="blog_name" autocomplete="off">
			</div>
			<div class="">
				<input type="text" placeholder="Name" name="name" autocomplete="off">
			</div>
			<div class="">
				<input type="text" placeholder="Username" name="username" autocomplete="off">
			</div>
			<div class="">
				<input type="email" placeholder="Email" name="email" autocomplete="off">
			</div>
			<div class="">
				<input type="password" placeholder="Password" name="password">
			</div>
			<button>Submit</button>
		</form>
	</div>
</div>