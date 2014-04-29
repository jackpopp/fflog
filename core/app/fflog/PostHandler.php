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
	*
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

	public function all()
	{
		return $this->fileHandler->fetchAllPosts();
	}

	public function single()
	{

	}
}