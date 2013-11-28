<?php

class Media extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'media';
	
	//protected $softDelete = true;

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
	// public function posts()
 //    {
	// 	// Second argument is the name of pivot table.
	// 	// Third & forth arguments are the names of foreign keys.
 //        return $this->belongsToMany('Post', 'media_post', 'post_id', 'media_id')->withTimestamps();
        
 //    }

	public function scopeNewest($query)
    {
        return $query->orderBy('updated_at', 'desc');
    }

   
}