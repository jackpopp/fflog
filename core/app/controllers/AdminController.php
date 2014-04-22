<?php 

class AdminController extends BaseController
{

	protected $layout = 'master';
	private $baseDir = "/../../../";
	// go to admin dasbhoard

	public function dashboard()
	{
		$data = array(
			'themesFolder' => array_diff(scandir(__DIR__.$this->baseDir.'themes'), array('.', '..')),
			'siteSettings' => json_decode(file_get_contents(__DIR__.$this->baseDir.'files/site_settings.flg'))
		);

		$this->layout->content = View::make('admin.dashboard', $data);
	}

	public function login()
	{
		if (! Session::get('isLoggedIn') )
			return $this->layout->content = View::make('admin.login');

		return Redirect::to('admin');
	}

	public function logout()
	{
		Session::put('isLoggedIn', false);
		Session::put('user', null);
		return Redirect::to('admin');
	}

	public function startAdminSession()
	{
		$username = Input::get('username');
		$password = Input::get('password');

		$users = $this->getDecodedFile(__DIR__.$this->baseDir.'files/site_settings.flg')->users;
		foreach ($users as $key => $user) {
			if ($user->username == $username && Hash::check($password, $user->password) )
			{
				Session::put('user', $key);
				Session::put('isLoggedIn', true);
				return Redirect::to('admin');
			}
		}
		Session::flash('errorMessage', 'Username or password incorrect.');
		return Redirect::to('admin/login');
	}

	public function createPost()
	{
		// add check for blog folder and add check for posts file
		$posts = $this->getDecodedFile(__DIR__.$this->baseDir.'files/blog/posts.flg');

		$date = new DateTime();

		// make out slug
		$slug = $this->makeSlug($posts, Input::get('title'));

		// upload file if one is found
		$image = null;
		if (Input::hasFile('image'))
		{
		    Input::file('image')->move(__DIR__.$this->baseDir.'public/uploads', "{$slug}.".Input::file('image')->getClientOriginalExtension());
		    $image = Input::file('image')->getRealPath().'/'.$slug.'.'.Input::file('image')->getClientOriginalExtension();
		}

		// need to auto generate slug
		$newPost = array(
			array(
				'title'     => Input::get('title'),
				'slug'      => $slug,
				'timestamp' => $date->getTimestamp(),
				"user"      => 0,
				"image"     => $image,
				"content"   => Input::get('content')
			)
		);

		// do an array union if post count over 0
		if (count($posts) > 0)
			$mergedPosts = array_merge($newPost, $posts);
		else
			$mergedPosts = $newPost;
		//write posts to file
		file_put_contents(__DIR__.$this->baseDir.'files/blog/posts.flg', json_encode($mergedPosts));

		Session::flash('successMessage', 'Blog post added.');

		return Redirect::to(URL::to('admin'));
	}

	public function delete()
	{

	}

	public function edit()
	{

	}

	/**
	* Returns a json decoded file based on the path provided
	*
	* @return mixed
	*/

	public function getDecodedFile($name)
	{
		if ( file_exists($name))
			return json_decode(file_get_contents($name));
		return false;
	}

	/**
	* Creates a slug based on the page title and makes sure it doesnt clash with current slugs
	*
	* @return String
	*/

	public function makeSlug($posts, $title)
	{
		// todo remove any disallowed chars
		$slug = strtolower($title);
		$slug = str_replace(' ', '-', $slug);

		// check if slug already exsists, if it does append a number to it
		$duplicateValue = 0;

		if (count($posts) > 0)
		{
			foreach ($posts as $key => $post) {
				if ($post->slug == $slug)
					$duplicateValue++;
			}
		}
		
		if ($duplicateValue > 0)
			$slug = $slug.'-'.$duplicateValue;

		return $slug;
	}

}