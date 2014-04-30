<?php 

class BlogController extends BaseController 
{

	private $totalPosts = 0;
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

	public function setTotalPosts($totalPosts)
	{
		$this->totalPosts = $totalPosts;
		return $this;
	}

	public function getTotalPosts()
	{
		return $this->totalPosts;
	}

	/**
	* Renders the index page from the selected template with posts
	* If request is ajax then we return a json posts array
	*
	*/

	public function index($page = 1, $limit = null)
	{
		if (Request::isJson())
		{
		    // look for a limit value, and if there is one set it
		    $posts = $this->postHandler->page($page)->paginate();

		    if (Input::get('limit') && intval(Input::get('limit')))
		    	$posts = $posts->limit(Input::get('limit'));

		   	if ($limit != null && is_numeric(intval($limit)))
		   		$posts = $posts->limit(intval($limit));

		    return Response::json($posts->get());
		}
		else 
		{
			//$posts = $this->postHandler->paginate()->page($page)->limit(1)->get();
			// lets hand the postHanlder over to the template as a post variable and set the current page var
			$posts = $this->postHandler->page($page);
			$blogName = $this->getBlogName();
			$fflog = $this->fflog;
			require $this->fileHandler->fetchCurrentThemePath().'/index.php';
		}
	}

	public function singlePost($slug)
	{
		$post = $this->postHandler->single($slug);
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
		if ( ! file_exists($this->fileHandler->fetchCurrentThemePath()))
			throw new Exception("No theme '{$this->getTheme()}' found!");
	}

}