<?php

class Tag extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'tags';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	// protected $hidden = array('password');

	/**
	 * Many to many relationship.
	 *
	 * @return Model
	 */
	public function posts()
    {
		// Second argument is the name of pivot table.
		// Third & forth arguments are the names of foreign keys.
        return $this->belongsToMany('Post', 'post_tag', 'tag_id', 'post_id')->withTimestamps();
    }

}