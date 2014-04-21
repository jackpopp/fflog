<?php 

class AdminController extends BaseController
{

	/*
	We hit install check when the app is first launched, if we havent installed we go to the install function to set stuff up.
	If we have installed then redirect to the dashbaord and delete installer stuff.
	*/
	
	public function installCheck()
	{
		// check for site settings and install folder, if none found we go to install
		if (file_exists(__DIR__.'/../files/site_settings.json'))
			return dashboard();
		return install();
	}

	// install sets up our first user, name of blog etc

	public function install()
	{
		echo 'install';
	}

	// go to admin dasbhoard

	public function dashboard()
	{
		echo 'dashboard';
	}

}
 