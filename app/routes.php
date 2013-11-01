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

################# Frontend #################
// Front page home
Route::get('/', 'Front\HomeController@showHome');

// Search
Route::get('search', array('as' => 'search', 'uses' => 'Front\HomeController@showSearch'));

// Log in
Route::get('administrator', array('as' => 'login', 'uses' => 'Front\HomeController@showLogin'));
Route::post('administrator', array('before' => 'csrf', 'as' => 'do-login', 'uses' => 'Front\HomeController@doLogin'));

// Tags
Route::get('tag/{tag}', array('as' => 'tag', 'uses' => 'Front\HomeController@showTagPosts'))
->where('tag', '[0-9a-z\p{S}-]+');

// Zip contents
Route::get('zip', array('as' => 'zip', 'uses' => 'Front\HomeController@zipContents'));

################# Backend  #################
// Auth filter on backend
Route::when('administrator/*', 'auth');

// Log out
Route::get('administrator/logout', array('as' => 'logout', function() {

	// Log out
	Auth::logout();

	// Redirect to homepage
	return Redirect::to('');
}));

// Dashboard home
Route::get('administrator/dashboard', array('as' => 'dashboard', 'uses' => 'Admin\DashboardController@showDashboard'));


