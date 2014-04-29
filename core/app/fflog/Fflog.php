<?php

class Fflog {

	private $baseDir = "/../../../";
	protected $mimeTypes = array('js'  => 'text/javascript','css' => 'text/css');
	protected $fileHandler;
	protected $postHandler;

	public function __construct()
	{

	}

	/**
	* Returns an asset path that the router can use to resolve an asset from our theme
	*
	* @param string
	* @return void
	*/

	public function assetPath($filename)
	{
		echo URL::to('/theme/assets/'.$filename);
	}

	/**
	* Returns a stylesheet tag with the asset path that the router can use to resolve the correct asset
	*
	* @param string
	* @return void
	*/

	public function css($filename)
	{
		$url = URL::to('/theme/assets/css/'.$filename);
		echo '<link rel="stylesheet" type="text/css" href="'.$url.'">';
	}

	/**
	* Returns a javascript tag with the asset path that the router can use to resolve the correct asset
	*
	* @param string
	* @return void
	*/

	public function js($filename)
	{
		$url = URL::to('/theme/assets/js/'.$filename);
		echo '<script src="'.$url.'"></script>';
	}

	/**
	* Returns a img tag with the asset path that the router can use to resolve the correct asset
	*
	* @param string
	* @return void
	*/

	public function img($filename)
	{
		$url = URL::to('/theme/assets/img/'.$filename);
		echo '<img src="'.$url.'">';
	}

	/**
	* Resolves the asset path provided based on the current theme.
	* Opens the found file and echos it's contents, if no file found throws exception.
	*
	* @param string
	* @return void
	*/

	public function resolveAssetPath($path)
	{
		$fullPath = __DIR__.$this->baseDir.'themes/'.$this->getDecodedFile(__DIR__.$this->baseDir.'files/site_settings.flg')->theme.'/assets/'.$path;
		// find what theme is set
		// look in assets for the file
		// full path to look in would be along the flines of themes/default/assets/$path
		if (file_exists($fullPath))
		{
			$this->setMimeType($path);
			echo file_get_contents($fullPath);
			return;
		}

		http_response_code(404);
		echo 'File not found';
	}

	public function setMimeType($path)
	{
		$type = last(explode('.', $path));
		if (array_key_exists($type, $this->mimeTypes))
			header("Content-type: ".$this->mimeTypes[$type]."");
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
	* Look for a theme missing page and show that.
	* If none is found then we'll just print out a error and set 404 header.
	*
	* @return mixed
	*/

	public function pageMissing()
	{
		if (file_exists( __DIR__.$this->baseDir.'themes/'.$this->getDecodedFile(__DIR__.$this->baseDir.'files/site_settings.flg')->theme.'/missing.php'))
		{
			ob_start();
				$fflog = new Self();
				$blogName = $this->getDecodedFile(__DIR__.$this->baseDir.'files/site_settings.flg')->blog_name;
				include_once __DIR__.$this->baseDir.'themes/'.$this->getDecodedFile(__DIR__.$this->baseDir.'files/site_settings.flg')->theme.'/missing.php';
			$html = ob_get_clean();

			return Response::make($html, 404);
		}
		else
		{
			return Response::make('No page found', 404);
		}
		
	}

}