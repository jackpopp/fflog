<div class="row input-form">
	<div class="large-12 columns">
		<h1>Login</h1>
		<form action="<?=URL::to('admin/login')?>" method="post">
			<div class="">
				<input class="js-focus-input" type="text" placeholder="Username" name="username" autocomplete="off">
			</div>
			<div class="">
				<input type="password" name="password" placeholder="Password">
			</div>
			<button>Submit</button>
		</form>
	</div>
</div>