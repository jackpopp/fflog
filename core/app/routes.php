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

/*
Route::get('/', function()
{
	return View::make('hello');
});
*/

Route::get('/', array('before' => 'installCheck', 'uses' => 'BlogController@index'));
Route::get('admin', array('before' => array('installCheck', 'auth'), 'uses' => 'AdminController@dashboard'));

Route::get('installer', 'InstallController@installer');
Route::post('installer/setup', 'InstallController@writeSettings');