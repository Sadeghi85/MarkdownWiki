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

		$response = \Response::make($media->content, 200);

		$response->header('Content-Type', 'application/octet-stream');
		$response->header('Content-Disposition', sprintf('attachment; filename="%s"', $media->name));

		return $response;
	}

	
}