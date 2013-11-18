<?php namespace Admin;

use Sadeghi85\Sanitize;
use Sadeghi85\Utility;

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
            'main-tag' => \Input::get('main-tag'),
            'content' => \Input::get('content'),
            
            'alias' => \Input::get('alias'),
            'minor-tags' => \Input::get('minor-tags'),
            'featured' => \Input::get('featured'),
            'list' => \Input::get('list'),
            'publish' => \Input::get('publish'),
        );
		
        // Declare the rules for the form validation.
        $rules = array(
        	'task'  => 'Required',
            'title'  => 'Required',
            'main-tag'  => 'Required',
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

        	########## Alias
        	if ( ! $userData['alias'])
        	{
        		$userData['alias'] = $userData['title'];
        	}

        	$userData['alias'] = Sanitize::alias($userData['alias']);

            ######### Tags
			$userData['main-tag'] = Sanitize::tag($userData['main-tag']);

			$tempTags = array_filter(explode(',', $userData['minor-tags']), 'strlen');

            $tags = array();

            foreach ($tempTags as $tempTag)
			{
				$tags[] = Sanitize::tag($tempTag);
			}

			$tags[] = $userData['main-tag'];
			$tags = array_unique($tags);
            
            ############

            $rules = array(
	            'alias'  => 'required|unique:posts,alias',
	            'main-tag'  => 'Required',
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
			$oPost->featured = (int)(bool)($userData['featured']);
			$oPost->list = (int)(bool)($userData['list']);
			$oPost->title = ($userData['title']);
			$oPost->alias = ($userData['alias']);
			$oPost->main_tag = ($userData['main-tag']);
			$oPost->content = ($userData['content']);
			$oPost->search_content = Utility::setSearchContent($userData['content']);
			$oPost->search_title = Utility::setSearchContent($userData['title']);

			$oPost->save();

			$oSlug = new \SlugHistories;
			$oSlug->post_id = $oPost->id;
			$oSlug->slug = sprintf('/%s/%s_%s', $userData['main-tag'], $oPost->id, $userData['alias']);

			$oSlug->save();

			foreach ($tags as $tag)
			{
				$oTag = \Tag::where('tag', $tag)->first();

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
				case 'apply':
					// Redirect to edit
            		return \Redirect::route('new')->with('success', \Lang::get('site.post-created'));
					break;
				case 'save':
					// Redirect to posts
            		return \Redirect::route('dashboard')->with('success', \Lang::get('site.post-created'));
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