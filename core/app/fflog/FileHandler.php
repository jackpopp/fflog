<?php

class FileHandler 
{
	protected $postsPath;
	protected $siteSettingsPath;
	protected $themePath;
	protected $uploadPath;

	public function __construct()
	{
		$this->postsPath = realpath(__DIR__.'/../../../files/blog/posts.flg');
		$this->siteSettingsPath = realpath(__DIR__.'/../../../files/site_settings.flg');
		$this->themePath = realpath(__DIR__.'/../../../themes/');
		$this->uploadPath = realpath(__DIR__.'/../../../public/uploads');
	}

	public function getPostsPath()
	{
		return $this->postPath;
	}

	public function getSiteSettingsPath()
	{
		return $this->siteSettingsPath;
	}

	public function getThemePath()
	{
		return $this->themePath;
	}

	public function getUploadPath()
	{
		return $this->uploadPath;
	}

	public function fetchCurrentThemePath()
	{
		$theme = $this->fetchSiteSettings()->theme;
		return realpath(__DIR__.'/../../../themes/'.$theme);
	}

	public function fetchAssetsPath()
	{
		// get the current theme, use that to set the asset path
		$theme = $this->fetchSiteSettings()->theme;
		return realpath(__DIR__.'/../../../theme/'.$theme.'/assets');
	}

	public function fetchAllPosts()
	{
		$posts = $this->fetchJsonFile($this->postsPath);

		if (count($posts) == 0 || $posts == null)
			return array();
		else
			return $posts;
	}

	public function writePosts($posts)
	{
		return $this->writeJsonFile($this->postsPath, $posts);
	}

	public function fetchSinglePost($slug, $postKey, $posts)
	{
		foreach ($posts as $key => $post) {
			if ($post->slug == $slug && $key == $postKey)
				return $post;
		}
		return false;
	}

	public function fetchSiteSettings()
	{
		return $this->fetchJsonFile($this->siteSettingsPath);
	}

	public function writeSiteSettings($settings)
	{
		return $this->writeJsonFile($this->siteSettingsPath, $settings);
	}

	/**
	* Returns a json decoded file based on the path provided
	*
	* @return mixed
	*/

	public function fetchJsonFile($name)
	{
		if ( file_exists($name))
			return json_decode(file_get_contents($name));
		return false;
	}

	public function writeJsonFile($path, $data)
	{
		return file_put_contents($path, json_encode($data));
	}
}