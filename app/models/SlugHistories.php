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
}