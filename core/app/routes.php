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

Route::get('installer', 'InstallController@installer');
Route::post('installer/setup', 'InstallController@writeSettings');

Route::group(array('before' => 'installCheck'), function()
{

	Route::get('/', 'BlogController@index');

	Route::get('admin/login', 'AdminController@login');
	Route::post('admin/login', 'AdminController@startAdminSession');
	Route::get('admin/logout', 'AdminController@logout');

	// auth group checks

	Route::group(array('before' => 'adminAuth'), function(){

		Route::post('admin/post', 'AdminController@createPost');
		Route::get('admin', 'AdminController@dashboard');

	});

});