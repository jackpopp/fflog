<div class="row">
	<h1>Login</h1>
	<form action="<?=URL::to('admin/login')?>" method="post">
		<div class="">
			<label>Username</label>
			<input type="text" placeholder="Username" name="username">
		</div>
		<div class="">
			<label>Password</label>
			<input type="password" placeholder="Password" name="password">
		</div>
		<button>Submit</button>
	</form>
</div>