<?php

class Fflog {

	private $baseDir = "/../../../";

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
		// find what theme is set
		// look in assets for the file
		// full path to look in would be along the flines of themes/default/assets/$path
		if (file_exists(__DIR__.$this->baseDir.'themes/'.$this->getDecodedFile(__DIR__.$this->baseDir.'files/site_settings.flg')->theme.'/assets/'.$path))
		{
			echo file_get_contents(__DIR__.$this->baseDir.'themes/'.$this->getDecodedFile(__DIR__.$this->baseDir.'files/site_settings.flg')->theme.'/assets/'.$path);
			return;
		}

		http_response_code(404);
		echo 'File not found';
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

}