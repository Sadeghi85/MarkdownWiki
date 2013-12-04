<?php namespace Admin;

class MediaController extends \BaseController {

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

	public function showMedia()
	{
		$media = \Media::newest()->paginate(10);

		return \View::make('admin.media', array('media' => $media));
	}

	public function doUpload()
	{
		$files = array_filter(\Input::file('files', array()), 'strlen');
		$success = false;

		foreach ($files as $file)
		{
			try
			{
				$oMedia = new \Media;
				$oMedia->name = $file->getClientOriginalName();
				$oMedia->size = $file->getSize();
				
				$oMedia->content = file_get_contents($file->getRealPath());

				$oMedia->save();

				$success = true;
			}
			catch (Exception $e)
			{

			}
		}

		if ($success)
		{
			return \Redirect::route('media')->with('success', \Lang::get('site.media-uploaded'));
		}
		else
		{
			return \Redirect::route('media');
		}
	}

	public function mediaDownload($id)
	{
		$media = \Media::findOrFail($id);

		// check if the client validating cache and if it is current
		if ((\Request::header('If-Modified-Since'))  && (strtotime(\Request::header('If-Modified-Since'))) == strtotime($media->updated_at))
		{

		    // cache IS current, respond 304
		    $response = \Response::make('', 304);

		    //$response->header('Last-Modified', gmdate('D, d M Y H:i:s \G\M\T', strtotime($media->updated_at)));

		}
		else
		{
		    // not cached or client cache is older than server, respond 200 and output

		    $response = \Response::make($media->content, 200);

		    $expires = (7*24*60*60);

		    $response->header('Last-Modified', gmdate('D, d M Y H:i:s \G\M\T', strtotime($media->updated_at)));
		    $response->header('Cache-Control', 'max-age='.$expires);
		    $response->header('Expires', gmdate('D, d M Y H:i:s \G\M\T', time() + $expires));

		    $response->header('Content-Type', 'application/octet-stream');
			$response->header('Content-Disposition', sprintf('attachment; filename="%s"', $media->name));
		}

		return $response;
	}

	
}