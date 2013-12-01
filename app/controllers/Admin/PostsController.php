<?php namespace Admin;

use Sadeghi85\Sanitize;
use Sadeghi85\Utility;

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
		$posts = \Post::newest()->search(\Input::get('s'))->with('slugHistories')->paginate(10);

		return \View::make('admin.posts', array('posts' => $posts));
	}

	public function showLists()
	{
		$posts = \Post::newest()->search(\Input::get('s'))->where('list', 1)->with('slugHistories')->paginate(10);

		return \View::make('admin.posts', array('posts' => $posts));
	}

	public function showFeatured()
	{
		$posts = \Post::newest()->search(\Input::get('s'))->where('featured', 1)->with('slugHistories')->paginate(10);

		return \View::make('admin.posts', array('posts' => $posts));
	}

	public function showDraft()
	{
		$posts = \Post::newest()->search(\Input::get('s'))->where('published', 0)->with('slugHistories')->paginate(10);

		return \View::make('admin.posts', array('posts' => $posts));
	}

	public function showEdit($id)
	{
		$post = \Post::with('tags')->with('media')->findOrFail($id);

		return \View::make('admin.edit', array('post' => $post));
	}

	public function doEdit($id)
	{
		// Get all the inputs
        $userData = array(
        	'task' => \Input::get('task'),
            'title' => \Input::get('title'),

            'main-tag' => \Input::get('main-tag'),
            'old_main-tag' => \Input::get('old_main-tag'),

            'content' => \Input::get('content'),
            
            'alias' => \Input::get('alias'),
            'old_alias' => \Input::get('old_alias'),

            'minor-tags' => \Input::get('minor-tags'),
            'old_minor-tags' => \Input::get('old_minor-tags'),

            'featured' => \Input::get('featured'),
            'list' => \Input::get('list'),
            'publish' => \Input::get('publish'),

            'attachment-id' => \Input::get('attachment-id', array()),
            'attachment-comment' => \Input::get('attachment-comment', array()),
        );
		
        // Declare the rules for the form validation.
        $rules = array(
        	'task'  => 'Required',
            'title'  => 'Required',

            'main-tag'  => 'Required',
            'old_main-tag'  => 'Required',

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
			$userData['old_main-tag'] = Sanitize::tag($userData['old_main-tag']);

			$tempTags = array_filter(explode(',', $userData['minor-tags']), 'strlen');
			$tempOldTags = array_filter(explode(',', $userData['old_minor-tags']), 'strlen');

            $tags = array();
            $oldTags = array();

            foreach ($tempTags as $tempTag)
			{
				$tags[] = Sanitize::tag($tempTag);
			}

			foreach ($tempOldTags as $tempOldTag)
			{
				$oldTags[] = Sanitize::tag($tempOldTag);
			}

			$tags[] = $userData['main-tag'];
			$oldTags[] = $userData['old_main-tag'];

			$tags = array_unique($tags);
			$oldTags = array_unique($oldTags);
            
            $tagsToBeRemoved = array_diff($oldTags, $tags);
			$tagsToBeAdded = array_diff($tags, $oldTags);

			######### Attachments
			$tempAttachmentIDs = array_unique(array_filter($userData['attachment-id'], 'strlen'));
			$tempAttachmentComments = array_filter($userData['attachment-comment'], 'strlen');

			$syncAttachments = array();

			foreach ($tempAttachmentIDs as $key => $tempAttachmentID)
			{
				$syncAttachments[$tempAttachmentID] = array('comment' => isset($tempAttachmentComments[$key]) ? $tempAttachmentComments[$key] : '');
			}

            ############

			$rules = array(
	            'alias'  => 'required',
	            'main-tag'  => 'Required',
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
			$oPost->featured = (int)(bool)($userData['featured']);
			$oPost->list = (int)(bool)($userData['list']);
			$oPost->title = ($userData['title']);
			$oPost->alias = ($userData['alias']);
			$oPost->main_tag = ($userData['main-tag']);
			$oPost->content = ($userData['content']);
			$oPost->search_content = Utility::setSearchContent($userData['content']);
			$oPost->search_title = Utility::setSearchContent($userData['title']);

			$oPost->save();

			$oldSlug = sprintf('/%s/%s_%s', $userData['old_main-tag'], $oPost->id, $userData['old_alias']);
        	$newSlug = sprintf('/%s/%s_%s', $userData['main-tag'], $oPost->id, $userData['alias']);

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

			$oPost->media()->sync($syncAttachments);

			switch ($userData['task'])
			{
				case 'apply':
					// Redirect to edit
            		return \Redirect::route('edit', array($id))->with('success', \Lang::get('site.post-edited'));
					break;
				case 'save':
					// Redirect to posts
            		return \Redirect::route('posts')->with('success', \Lang::get('site.post-edited'));
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

	public function showDelete($id)
	{
		$post = \Post::with('tags')->findOrFail($id);

		return \View::make('admin.delete', array('post' => $post));
	}

	public function doDelete($id)
	{
		$post = \Post::findOrFail($id);

		$post->delete();
		
		return \Redirect::route('posts')->with('success', \Lang::get('site.post-deleted'));
	}
}