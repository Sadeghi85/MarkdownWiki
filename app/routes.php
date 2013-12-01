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

// Posts
Route::get('posts', array('as' => 'front-posts', 'uses' => 'Front\HomeController@showPosts'));
// Lists
Route::get('lists', array('as' => 'front-lists', 'uses' => 'Front\HomeController@showLists'));
// Tags
Route::get('tags', array('as' => 'front-tags', 'uses' => 'Front\HomeController@showTags'));
// Tag-Post
Route::get('tag/{tag}', array('as' => 'front-tag', 'uses' => 'Front\HomeController@showTagPosts'))
->where('tag', '[^\/_]+');

Route::get('media-download/{id}', array('as' => 'media-download', 'uses' => 'Admin\MediaController@mediaDownload'))->where('id', '\d+');

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

// New post
Route::get('administrator/new', array('as' => 'new', 'uses' => 'Admin\DashboardController@showNew'));
Route::post('administrator/new', array('before' => 'csrf', 'as' => 'do-new', 'uses' => 'Admin\DashboardController@doNew'));

// List posts
Route::get('administrator/posts', array('as' => 'posts', 'uses' => 'Admin\PostsController@showPosts'));
// List lists
Route::get('administrator/lists', array('as' => 'lists', 'uses' => 'Admin\PostsController@showLists'));
// List featured
Route::get('administrator/featured', array('as' => 'featured', 'uses' => 'Admin\PostsController@showFeatured'));
// List draft
Route::get('administrator/draft', array('as' => 'draft', 'uses' => 'Admin\PostsController@showDraft'));

// Edit post
Route::get('administrator/edit/{id}', array('as' => 'edit', 'uses' => 'Admin\PostsController@showEdit'))
->where('id', '\d+');
Route::post('administrator/edit/{id}', array('before' => 'csrf', 'as' => 'do-edit', 'uses' => 'Admin\PostsController@doEdit'))
->where('id', '\d+');

// Delete post
Route::get('administrator/delete/{id}', array('as' => 'delete', 'uses' => 'Admin\PostsController@showDelete'))
->where('id', '\d+');
Route::post('administrator/delete/{id}', array('before' => 'csrf', 'as' => 'do-delete', 'uses' => 'Admin\PostsController@doDelete'))
->where('id', '\d+');

// Media manager
Route::get('administrator/media', array('as' => 'media', 'uses' => 'Admin\MediaController@showMedia'));
Route::post('administrator/media', array('before' => 'csrf', 'as' => 'upload', 'uses' => 'Admin\MediaController@doUpload'));


// Catch all
Route::get('{main_tag}/{post_id}_{slug}', function($main_tag, $post_id, $slug)
{
	$thisSlug = SlugHistories::where('post_id', $post_id)->where('slug', sprintf('/%s/%s_%s', $main_tag, $post_id, $slug))->select('slug')->first();
	$lastSlug = SlugHistories::where('post_id', $post_id)->orderBy('id', 'desc')->select('slug')->first();

	if ($thisSlug->slug == $lastSlug->slug)
	{
		$post = Post::where('id', $post_id)->where('published', 1)->first();

		if ($post)
		{
			return View::make('front.show_post', array('post' => $post));
		}
	}
	elseif ($thisSlug and $lastSlug)
	{
		return Redirect::to($lastSlug->slug);
	}

	App::abort(404, 'Page not found');
})
->where('main_tag', '[^\/_]+')->where('post_id', '\d+')->where('slug', '[^\/_]+');

