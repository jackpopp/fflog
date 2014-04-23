<div class="row">
	<h1>Welcome to Flogg</h1>
	<h3>Lets set you up</h3>
	<form action="<?=URL::to('installer/setup')?>" method="post">
		<div class="">
			<label>Blog Name</label>
			<input type="text" placeholder="Blog Name" name="blog_name">
		</div>
		<div class="">
			<label>Name</label>
			<input type="text" placeholder="Name" name="name">
		</div>
		<div class="">
			<label>Username</label>
			<input type="text" placeholder="Username" name="username">
		</div>
		<div class="">
			<label>Email</label>
			<input type="email" placeholder="Email" name="email">
		</div>
		<div class="">
			<label>Password</label>
			<input type="password" placeholder="Password" name="password">
		</div>
		<button class="btn tiny">Submit</button>
	</form>
</div>