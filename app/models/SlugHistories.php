<?php

class SlugHistories extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'slug_histories';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	// protected $hidden = array('password');

    public function post()
    {
        return $this->belongsTo('Post');
    }

    public static function lastSlug($id)
    {
    	$oSlug = self::where('post_id', $id)->orderBy('id', 'desc')->select('slug')->first();

		return $oSlug->slug;
    }
}