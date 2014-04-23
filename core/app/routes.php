<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/


// need to add installer check to see if we have already installed and redirect to admin
Route::get('installer', 'InstallController@installer');
Route::post('installer/setup', 'InstallController@writeSettings');

Route::group(array('before' => 'installCheck'), function()
{

	Route::get('/', 'BlogController@index');
	Route::get('post/{slug}', 'BlogController@singlePost');

	Route::get('admin/login', 'AdminController@login');
	Route::post('admin/login', 'AdminController@startAdminSession');
	Route::get('admin/logout', 'AdminController@logout');

	// match asset paths
	// credit Eelke van den Bos @ http://stackoverflow.com/a/15586240/1797053
	Route::get('theme/assets/{path}', function($path){
		$fflog = new Fflog();
		return $fflog->resolveAssetPath($path);
	})->where('path', '([A-z\d-\/_.]+)?');

	// auth group checks

	Route::group(array('before' => 'adminAuth'), function(){

		Route::post('admin/post', 'AdminController@createPost');
		Route::get('admin', 'AdminController@dashboard');
		Route::get('admin/posts/edit/{slug}/{key}', 'AdminController@editPost');
		Route::post('admin/posts/edit/{slug}/{key}', 'AdminController@updatePost');
		Route::get('admin/posts/delete/{slug}/{key}', 'AdminController@deletePost');
		Route::post('admin/site-settings', 'AdminController@updateSiteSettings');

	});

});