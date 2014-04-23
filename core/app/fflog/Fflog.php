<?php

class Fflog {

	private $baseDir = "/../../../";

	public function asset()
	{
		echo "asset";
	}

	public function css($filename)
	{
		echo '<link rel="stylesheet" type="text/css" href="http://fflog.dev/theme/assets/css/'.$filename.'">';
	}

	public function javascript()
	{
		echo "javascript";
	}

	public function image()
	{
		echo "image";
	}

	/**
	* Resolves the asset path provided based on the current theme.
	* Opens the found file and echos it's contents, if no file found throws exception.
	*
	* @param string
	* @return mixed
	*/

	public function resolveAssetPath($path)
	{
		// find what theme is set
		// look in assets for the file
		// full path to look in would be along the flines of themes/default/assets/$path
		echo file_get_contents(__DIR__.$this->baseDir.'themes/'.$this->getDecodedFile(__DIR__.$this->baseDir.'files/site_settings.flg')->theme.'/assets/'.$path);
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