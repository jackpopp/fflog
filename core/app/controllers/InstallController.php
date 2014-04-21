<?php

class InstallController extends BaseController 
{
	protected $layout = 'master';
	private $baseFile = "/../../../files/";

	/**
	* Renders the installer view
	*
	* @return View
	*/

	public function installer()
	{
		$this->layout->content = View::make('install.installer');
	}

	/**
	* Writes the installer settings to the site_settings json file
	*
	* @return Redirect
	*/

	public function writeSettings()
	{
		file_put_contents(__DIR__.$this->basePath.'site_settings.flg', $this->makeSettingsFile(Input::all()));
		return Redirect::to('/');
	}

	private function makeSettingsFile($input)
	{
		$settings = array(
			'blog_name' => $input['blog_name'],
			'users' 	=> array(
							array(
								'name'     => $input['name'],
								'username' => $input['username'],
								'email'    => $input['email'],
								'password' => Hash::make($input['password'])
							)
						),
			'theme'     => 'default'
		);
		return json_encode($settings);
	}
}