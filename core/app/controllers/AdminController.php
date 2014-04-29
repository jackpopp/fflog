<?php 

class AdminController extends BaseController
{

	protected $layout = 'master';
	protected $fflog;
	protected $fileHandler;

	public function __construct(Fflog $fflog, FileHandler $fileHandler)
	{
		$this->fflog = $fflog;
		$this->fileHandler = $fileHandler;
	}

	// go to admin dasbhoard

	public function dashboard()
	{
		View::share('onDashboard', true);
		$data = array(
			'themesFolder' => array_diff(scandir($this->fileHandler->getThemePath()), array('.', '..', '.DS_Store')),
			'siteSettings' => $this->fileHandler->fetchSiteSettings(),
			'posts' => $this->fileHandler->fetchAllPosts()
		);

		$this->layout->content = View::make('admin.dashboard', $data);
	}

	public function login()
	{
		if (! Session::get('isLoggedIn') )
			$this->layout->content = View::make('admin.login');
		else
			return Redirect::to(URL::to('admin'));
	}

	public function logout()
	{
		Session::put('isLoggedIn', false);
		Session::put('user', null);
		return Redirect::to(URL::to('admin'));
	}

	public function startAdminSession()
	{
		$username = Input::get('username');
		$password = Input::get('password');

		$users = $this->fileHandler->fetchSiteSettings()->users;
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
		$posts = $this->fileHandler->fetchAllPosts();

		$date = new DateTime();

		// make out slug
		$slug = $this->makeSlug($posts, Input::get('title'));

		// upload file if one is found
		$image = $this->uploadImage($slug);

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
		if ( count($posts) > 0 && $posts != null)
			$mergedPosts = array_merge($newPost, $posts);
		else
			$mergedPosts = $newPost;
		//write posts to file
		$this->fileHandler->writePosts($mergedPosts);

		Session::flash('successMessage', 'Blog post added.');

		return Redirect::to(URL::to('admin'));
	}

	public function editPost($slug, $key)
	{
		$post = $this->fileHandler->fetchSinglePost($slug, $key, $this->fileHandler->fetchAllPosts());
		$this->layout->content = View::make('admin.edit_post', array('post' => $post, 'key' => $key));
	}

	public function updatePost($slug, $key)
	{
		$posts = $this->fileHandler->fetchAllPosts();
		$post = $this->fileHandler->fetchSinglePost($slug, $key, $posts);

		// update the posts title and content
		$post->title = Input::get('title');
		$post->content = Input::get('content');
		$post->slug = $this->makeSlug($posts, Input::get('title'));

		// if image isnt null then update the image
		$image = $this->uploadImage($slug);
		if ($image != null)
			$post->image = $image;

		//update the post at this point
		$posts[$key] = $post;

		//save the post and redirect to the dashboard
		$this->fileHandler->writePosts($posts);

		Session::flash('successMessage', 'Blog post updated.');

		return Redirect::to('admin');

	}

	public function deletePost($slug, $key)
	{
		// unset the post and reindex the array
		$posts = $this->fileHandler->fetchAllPosts();
		unset($posts[$key]);
		$posts = array_values($posts);
		// save the new posts array
		$this->fileHandler->writePosts($posts);

		Session::flash('successMessage', 'Blog post deleted.');
		// return us back to admin
		return Redirect::to('admin');
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

		if ( count($posts) > 0 && $posts != null)
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

	public function savePosts($posts)
	{
		$this->fileHandler->writePosts($posts);
	}

	public function uploadImage($slug)
	{
		$image = null;
		if (Input::hasFile('image'))
		{
		    Input::file('image')->move($this->fileHandler->getUploadPath(), "{$slug}.".Input::file('image')->getClientOriginalExtension());
		    $image = Input::file('image')->getRealPath().'/'.$slug.'.'.Input::file('image')->getClientOriginalExtension();
		}

		return $image;
	}

	public function updateSiteSettings()
	{
		$settings = $this->fileHandler->fetchSiteSettings();
		$settings->blog_name = Input::get('blog_name');
		$settings->theme = Input::get('theme');
		$this->fileHandler->writeSiteSettings($settings);

		return Redirect::to('admin');
	}

}