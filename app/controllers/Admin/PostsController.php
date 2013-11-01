<?php namespace Admin;

use Sadeghi85\Path;
use Sadeghi85\Sanitize;

class PostsController extends \BaseController {

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

	public function showPosts()
	{
		$posts = \DB::table('posts')->where('list', 0)->paginate(10);

		return \View::make('admin.posts', array('posts' => $posts));
	}

	public function showLists()
	{
		$posts = \DB::table('posts')->where('list', 1)->paginate(10);

		return \View::make('admin.posts', array('posts' => $posts));
	}

	public function showEdit($id)
	{
		$post = \Post::with('tags')->findOrFail($id);

		return \View::make('admin.edit', array('post' => $post));
	}

	public function doEdit($id)
	{
		// Get all the inputs
        $userData = array(
        	'task' => \Input::get('task'),
            'title' => \Input::get('title'),

            'main_tag' => \Input::get('main_tag'),
            'old_main_tag' => \Input::get('old_main_tag'),

            'content' => \Input::get('content'),
            
            'slug' => \Input::get('slug'),
            'old_slug' => \Input::get('old_slug'),

            'minor_tags' => \Input::get('minor_tags'),
            'old_minor_tags' => \Input::get('old_minor_tags'),

            'publish' => \Input::get('publish'),
            'list' => \Input::get('list'),
        );
		
        // Declare the rules for the form validation.
        $rules = array(
        	'task'  => 'Required',
            'title'  => 'Required',

            'main_tag'  => 'Required',
            'old_main_tag'  => 'Required',

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
			$userData['old_main_tag'] = Sanitize::tag($userData['old_main_tag']);

			$temp_tags = array_filter(explode(',', $userData['minor_tags']), 'strlen');
			$temp_old_tags = array_filter(explode(',', $userData['old_minor_tags']), 'strlen');

            $tags = array();
            $old_tags = array();

            foreach ($temp_tags as $temp_tag)
			{
				$tags[] = Sanitize::tag($temp_tag);
			}
			foreach ($temp_old_tags as $temp_old_tag)
			{
				$old_tags[] = Sanitize::tag($temp_old_tag);
			}

			$tags[] = $userData['main_tag'];
			$old_tags[] = $userData['old_main_tag'];

			$tags = array_unique($tags);
			$old_tags = array_unique($old_tags);
            
            $tagsToBeRemoved = array_diff($old_tags, $tags);
			$tagsToBeAdded = array_diff($tags, $old_tags);

			#############

			$rules = array(
	            'slug'  => 'required',
	            'main_tag'  => 'Required',
	        );

	        $validator = \Validator::make($userData, $rules);

	        if ( ! $validator->passes())
	        {
	        	return \Redirect::route('edit', array($id))->withErrors($validator)->withInput($userData);
	        }

			############ Post
			$userData['content'] = Sanitize::content($userData['content']);

			$oPost = \Post::findOrFail($id);
			$oPost->published = (int)(bool)($userData['publish']);
			$oPost->list = (int)(bool)($userData['list']);
			$oPost->title = ($userData['title']);
			$oPost->slug = $userData['slug'];
			$oPost->main_tag = ($userData['main_tag']);
			$oPost->content = ($userData['content']);
			$oPost->save();

			$oldSlug = sprintf('/%s/%s_%s', $userData['old_main_tag'], $oPost->id, $userData['old_slug']);
        	$newSlug = sprintf('/%s/%s_%s', $userData['main_tag'], $oPost->id, $userData['slug']);

			if ($oldSlug != $newSlug)
			{
				$oSlug = new \SlugHistories;
				$oSlug->post_id = $oPost->id;
				$oSlug->slug = $newSlug;
				$oSlug->save();
			}

			foreach ($tagsToBeRemoved as $tag)
			{
				$oPost->tags()->detach(\Tag::where('tag', $tag)->select('id')->first());
			}

			foreach ($tagsToBeAdded as $tag)
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
            		return \Redirect::route('do-edit', array($id))->with('success', 'Post is saved.');
					break;
				case 'save':
					// Redirect to posts
            		return \Redirect::route('posts')->with('success', 'Post is saved.');
					break;

				default:
					// Redirect to dashboard
            		return \Redirect::route('dashboard');
					break;
			}

			
        }

        // Something went wrong.
        return \Redirect::route('edit', array($id))->withErrors($validator)->withInput($userData);
	}
}