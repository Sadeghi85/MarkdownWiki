<?php namespace Admin;

use Sadeghi85\Path;
use Sadeghi85\Sanitize;

class DashboardController extends \BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function showDashboard()
	{
		return \View::make('admin.dashboard');
	}

	public function showNew()
	{
		return \View::make('admin.new');
	}

	public function doNew()
	{
		// Get all the inputs
        $userData = array(
        	'task' => \Input::get('task'),
            'title' => \Input::get('title'),
            'main_tag' => \Input::get('main_tag'),
            'content' => \Input::get('content'),
            
            'slug' => \Input::get('slug'),
            'minor_tags' => \Input::get('minor_tags'),
            'publish' => \Input::get('publish'),
            'list' => \Input::get('list'),
        );
		
        // Declare the rules for the form validation.
        $rules = array(
        	'task'  => 'Required',
            'title'  => 'Required',
            'main_tag'  => 'Required',
            'content'  => 'Required',
        );

        if ($userData['task'] == 'cancel')
        {
        	// Redirect to dashboard
            return \Redirect::route('dashboard');
        }

        // Validate the inputs.
        $validator = \Validator::make($userData, $rules);

        // Check if the form validates with success.
        if ($validator->passes())
        {
        	########## Title
        	$userData['title'] = Sanitize::title($userData['title']);

        	########## Slug
        	if ( ! $userData['slug'])
        	{
        		$userData['slug'] = $userData['title'];
        	}

        	$userData['slug'] = Sanitize::slug($userData['slug']);

            ######### Tags
			$userData['main_tag'] = Sanitize::tag($userData['main_tag']);

			$temp_tags = array_filter(explode(',', $userData['minor_tags']), 'strlen');

            $tags = array();

            foreach ($temp_tags as $temp_tag)
			{
				$tags[] = Sanitize::tag($temp_tag);
			}

			$tags[] = $userData['main_tag'];
			$tags = array_unique($tags);
            
            ############

            $rules = array(
	            'slug'  => 'required|unique:posts,slug',
	            'main_tag'  => 'Required',
	        );

	        $validator = \Validator::make($userData, $rules);

	        if ( ! $validator->passes())
	        {
	        	return \Redirect::route('new')->withErrors($validator)->withInput($userData);
	        }

			############ Post
			$userData['content'] = Sanitize::content($userData['content']);

			$oPost = new \Post;
			$oPost->published = (int)(bool)($userData['publish']);
			$oPost->list = (int)(bool)($userData['list']);
			$oPost->title = ($userData['title']);
			$oPost->slug = $userData['slug'];
			$oPost->main_tag = ($userData['main_tag']);
			$oPost->content = ($userData['content']);

			$oPost->save();

			$oSlug = new \SlugHistories;
			$oSlug->post_id = $oPost->id;
			$oSlug->slug = sprintf('/%s/%s_%s', $userData['main_tag'], $oPost->id, $userData['slug']);
			$oSlug->save();

			foreach ($tags as $tag)
			{
				$oTag = \Tag::where('tag', '=', $tag)->first();

				if ($oTag)
				{
					$oPost->tags()->attach($oTag->id);
				}
				else
				{
					$oTag = new \Tag;
					$oTag->tag = $tag;
					$oTag->save();

					$oPost->tags()->attach($oTag->id);
				}
			}
			
			switch ($userData['task'])
			{
				// case 'apply':
				// 	// Redirect to edit
    //         		return \Redirect::route('do-edit', array($id))->with('success', 'Post is saved.');
				// 	break;
				case 'save':
					// Redirect to posts
            		return \Redirect::route('dashboard')->with('success', 'Post is created.');
					break;

				default:
					// Redirect to dashboard
            		return \Redirect::route('dashboard');
					break;
			}
        }

        // Something went wrong.
        return \Redirect::route('new')->withErrors($validator)->withInput($userData);
	}
}