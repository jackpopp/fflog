<?php 

class BlogController extends BaseController 
{

	private $baseDir = "/../../../";
	private $theme = '';
	private $posts = array();
	private $totalPosts = 0;
	private $post = null;
	protected $fflog;
	protected $fileHandler;
	protected $postHandler;
	protected $blogName;

	public function __construct(Fflog $fflog, FileHandler $fileHandler, PostHandler $postHandler)
	{
		$this->beforeFilter('@resolveTheme', array('only' => array('index', 'singlePost')));
		$this->fflog = $fflog;
		$this->fileHandler = $fileHandler;
		$this->postHandler = $postHandler;
		$this->blogName = $this->fileHandler->fetchSiteSettings()->blog_name;
	}

	public function getBlogName()
	{
		return $this->blogName;
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
	
	public function index($page = 1)
	{
		//$posts = $this->postHandler->paginate()->page($page)->limit(1)->get();
		// lets hand the postHanlder over to the template as a post variable and set the current page var
		$posts = $this->postHandler->page($page);
		$blogName = $this->getBlogName();
		$fflog = $this->fflog;

		require $this->fileHandler->fetchCurrentThemePath().'/index.php';
	}

	public function singlePost($slug)
	{
		$this->setPost($this->fetchPost($slug, $this->fetchPosts()));
		$post = $this->getPost();
		$blogName = $this->getBlogName();
		$fflog = $this->fflog;
		require $this->fileHandler->fetchCurrentThemePath().'/post.php';
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

		if (count($posts) == 0 || $posts == null)
			return array();
		else
			return $posts;
	}

	public function fetchPost($slug, $posts)
	{
		foreach ($posts as $key => $post) {
			if ($post->slug == $slug)
				return $post;
		}
		return false;
	}

}