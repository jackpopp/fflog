<?php

class PostHandler 
{
	protected $post;
	protected $posts = array();
	protected $pagination = false;
	protected $limit = 10;
	protected $page = 1;
	protected $slug;
	protected $postKey;

	public function __construct(FileHandler $fileHandler)
	{
		$this->fileHandler = $fileHandler;
	}

	public function setPage($page)
	{
		$this->page = $page;
		return $this;
	}

	public function getPage()
	{
		return $this->page;
	}

	public function setLimit($limit)
	{
		$this->limit = $limit;
		return $this;
	}

	public function getLimit()
	{
		return $this->limit;
	}

	public function setPagination($pagination)
	{
		$this->pagination = $pagination;
		return $this;
	}

	public function getPagination()
	{
		return $this->pagination;
	}

	public function page($page)
	{
		$this->setPage($page);
		return $this;
	}

	public function limit($limit)
	{
		$this->setLimit($limit);
		return $this;
	}

	public function paginate()
	{
		$this->pagination = true;
		return $this;
	}

	/**
	* Returns a array of posts, if pagination is on then we will be paginate the result
	* based on current page setting and 
	*
	* 
	*/

	public function get()
	{
		$posts = $this->fileHandler->fetchAllPosts();
		if ( count($posts) > 0 && $this->getPagination())
			$posts = array_slice($posts, ($this->getPage()-1)*$this->getLimit(), $this->getLimit());
		return $posts;
	}	

	/**
	* Fetches all posts even if pagination is true
	*
	* @return array
	*/

	public function all()
	{
		return $this->fileHandler->fetchAllPosts();
	}

	/**
	* Fetches a single post based ona slug, throws exception if none is found
	*
	* @return mixed
	*/

	public function single($slug)
	{
		$posts = $this->all();
		foreach ($posts as $key => $post) {
			if ($post->slug == $slug)
				return $post;
		}
		// page missing or exception, probably exception
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

	/**
	* Builds a paginator
	*
	*/

	public function paginator()
	{
		$page = $this->getPage();
		$limit = $this->getLimit();
		$total = count($this->all());

		// remove two as we dont loop the first and last sections
		$links = array();
		

		// only if we're not on the first one
		if ( $page != 1)
		{
			$links[] = "<li><a href='".URL::to('page/1')."'>First</a></li>";
			$links[] = "<li><a href='".URL::to('page/'.($page - 1))."'>Prev</a></li>";
		}
		else 
		{
			$links[] = "<li><a class='active' href='".URL::to('page/1')."'>1</a></li>";
		}
			

		$loopAmount = ($total/$limit);
		for ($i=2; $i < $loopAmount; $i++) 
		{ 
			$links[] = "<li><a href='".URL::to('page/'.$i)."'>{$i}</a></li>";
		}

		// only if we're not on the last one
		if ( $page != ($total/$limit))
		{
			$links[] = "<li><a href='".URL::to('page/'.($page + 1))."'>Next</a></li>";
			$links[] = "<li><a href='".URL::to('page/'.($total/$limit))."'>Last</a></li>";
		}
		else 
		{
			$links[] = "<li><a class='active' href='".URL::to('page/'.($total/$limit))."'>".($total/$limit)."</a></li>";
		}
			
		echo '<ul class="paginator">'.implode('', $links).'</ul>';
	}
}