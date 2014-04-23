<?php

class Fflog {

	public function asset()
	{
		echo "asset";
	}

	public function css()
	{
		echo "css";
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

	public function resolvePath($path)
	{

	}

}