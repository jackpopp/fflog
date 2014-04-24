<?php

class InstallController extends BaseController 
{
	protected $layout = 'master';
	private $baseDir = "/../../../";

	/**
	* Renders the installer view
	*
	* @return View
	*/

	public function installer()
	{
		// check if there is a site settings folder and if there is return redirect to admin to log in

		// flush any session data, if they are reinstaling and were logged in at the time
		Session::flush();
		$this->layout->content = View::make('install.installer');
	}

	/**
	* Writes the installer settings to the site_settings json file
	*
	* @return Redirect
	*/

	public function writeSettings()
	{
		// generate folders if they dont exists
		$this->generateFolders();
		// write the settings to file
		file_put_contents(__DIR__.$this->baseDir.'files/site_settings.flg', $this->makeSettingsFile(Input::all()));
		// log the user in, key will always be 0 at this point as we've just written a single user
		Session::put('user', 0);
		Session::put('isLoggedIn', true);
		// redirect to the admin panel
		return Redirect::to('/admin');
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

	/**
	* Checks for specific folders and if not found generates them
	*
	* @return void
	*/

	private function generateFolders()
	{
		//files
		if ( ! file_exists(__DIR__.$this->baseDir.'files'))
			mkdir(__DIR__.$this->baseDir.'files');

		//blog
		if ( ! file_exists(__DIR__.$this->baseDir.'files/blog'))
			mkdir(__DIR__.$this->baseDir.'files/blog');

		//public/uploads
		if ( ! file_exists(__DIR__.$this->baseDir.'public/uploads'))
			mkdir(__DIR__.$this->baseDir.'public/uploads');
	}
}