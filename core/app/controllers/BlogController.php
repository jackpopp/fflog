<?php 

class BlogController extends BaseController 
{

	private $baseDir = "/../../../";
	private $theme = '';
	private $posts = array();
	private $totalPosts = 0;
	private $post = null;

	public function __construct()
	{
		$this->beforeFilter('@resolveTheme', array('only' => array('index', 'single')));
	}

	public function setTheme($theme)
	{
		$this->theme = $theme;
		return $this;
	}

	public function getTheme()
	{
		return $this->theme;
	}

	public function setPosts($posts)
	{
		$this->posts = $posts;
		return $this;
	}

	public function getPosts()
	{
		return $this->posts;
	}

	public function setTotalPosts($totalPosts)
	{
		$this->totalPosts = $totalPosts;
		return $this;
	}

	public function getTotalPosts()
	{
		return $this->totalPosts;
	}

	public function setPost($post)
	{
		$this->post = $post;
		return $this;
	}

	public function getPost()
	{
		return $this->post;
	}
	
	public function index()
	{
		$this->fetchPosts();
	}

	public function singlePost($id)
	{

	}

	/**
	* Checks if the currently set theme folder is available throws an exception if not
	* Checks for single and index views and thows exception if not found
	*
	* @return void
	*/

	public function resolveTheme()
	{
		$this->setTheme($this->getDecodedFile(__DIR__.$this->baseDir.'files/site_settings.flg')->theme);
		if ( ! file_exists(__DIR__.$this->baseDir.'themes/'.$this->getTheme()))
			throw new Exception("No theme '{$this->getTheme()}' found!");
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

	public function fetchPosts()
	{
		$posts = $this->getDecodedFile(__DIR__.$this->baseDir.'files/blog/posts.flg');

		if (count($posts) == 0)
		{
			$this->setPosts(array());
		}
		else
		{
			$this->setPosts($posts);
		}

		// require correct view here and pass it out variables
		$posts = $this->getPosts();
		require __DIR__.$this->baseDir.'themes/'.$this->getTheme().'/index.php';

	}

	public function fetchPost($id)
	{

	}

}