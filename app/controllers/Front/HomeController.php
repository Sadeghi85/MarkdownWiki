<?php namespace Front;

use Sadeghi85\Path;
use Sadeghi85\ZipStream;
use Sadeghi85\Utility;

class HomeController extends \BaseController {

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

	public function showHome()
	{
        $posts = \Post::where('featured', 1)->where('published', 1)->paginate(10);

        return \View::make('front.show_posts', array('posts' => $posts));
		//return \View::make('front.home', array('posts' => $posts));
	}

     public function showSearch()
    {
        $results = \Post::newest()->search(\Input::get('s'))->where('published', 1)->with('slugHistories')->paginate(10);

        return \View::make('front.show_search', array('results' => $results));
    }
	
	public function showLogin()
	{
		// Check if we already logged in
        if (\Auth::check())
        {
            // Redirect to homepage
            return \Redirect::route('dashboard');
        }

        // Show the login page
		return \View::make('front.login');
	}
	
	public function doLogin()
	{
        // Get all the inputs
        $userData = array(
            'username' => \Input::get('username'),
            'password' => \Input::get('password'),
        );
		
		$rememberMe = \Input::get('remember-me');
		
        // Declare the rules for the form validation.
        $rules = array(
            'username'  => 'Required',
            'password'  => 'Required'
        );

        // Validate the inputs.
        $validator = \Validator::make($userData, $rules);

        // Check if the form validates with success.
        if ($validator->passes())
        {
            // Try to log the user in.
            if (\Auth::attempt($userData, (bool)$rememberMe))
            {
                // Redirect to dashboard
				return \Redirect::intended(route('dashboard'));
            }
            else
            {
                // Redirect to the login page.
                return \Redirect::route('login')->withErrors(array('password' => \Lang::get('site.password-incorrect')))->withInput(\Input::except('password'));
            }
        }

        // Something went wrong.
        return \Redirect::route('login')->withErrors($validator)->withInput(\Input::except('password'));
	}

    public function zipContents()
    {
        $zip = new ZipStream(\Config::get('site.name').'_'.date('Y-m-d_H-i-s').'.zip');
        $zip->setComment(sprintf('Downloaded from "%s" on "%s".', \Config::get('site.domain'), date('l jS \of F Y h:i:s A')));

        $posts = \Post::where('published', '1')->get();

        foreach ($posts as $post)
        {
            $content = sprintf('### %s%s%s', html_entity_decode($post->title, ENT_QUOTES, 'UTF-8'), "\r\n\r\n", html_entity_decode($post->content, ENT_QUOTES, 'UTF-8'));
            $path    = trim(Utility::getSlug($post->id), '/').'.md';

            $zip->addFile($content, $path);
        }

        $zip->finalize();
    }

    public function showPosts()
    {
        $posts = \Post::where('list', 0)->where('published', 1)->paginate(10);

        return \View::make('front.show_posts', array('posts' => $posts));
    }

    public function showLists()
    {
        $posts = \Post::where('list', 1)->where('published', 1)->paginate(10);

        return \View::make('front.show_posts', array('posts' => $posts));
    }

    public function showTags()
    {
        return \View::make('front.show_tags');
    }

    public function showTagPosts($tag)
    {
        $oTag = \Tag::where('tag', $tag)->firstOrFail();
        $posts = $oTag->posts()->where('published', 1)->paginate(10);

        return \View::make('front.show_posts', array('posts' => $posts));
    }

   
}