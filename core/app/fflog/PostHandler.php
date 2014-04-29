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

	public function setLimit($limit)
	{
		$this->limit = $limit;
		return $this;
	}

	public function getLimit()
	{
		return $this->limit;
	}

	public function limit($limit)
	{
		$this->setLimit($limit)
		return $this;
	}

	public function paginate()
	{

	}

	public function get()
	{

	}	

	public function all()
	{
		
	}

	public function single()
	{

	}
}