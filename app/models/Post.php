<?php

class Post extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'posts';
	
	protected $softDelete = true;

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
	public function tags()
    {
		// Second argument is the name of pivot table.
		// Third & forth arguments are the names of foreign keys.
        return $this->belongsToMany('Tag', 'post_tag', 'post_id', 'tag_id')->withTimestamps();
        
    }

    public function search($terms)
    {
    	$terms = trim($terms);

        $escapedTerms = DB::connection()->getPdo()->quote($terms);

        return $this->select(array('*', DB::raw(sprintf('MATCH (title, content) AGAINST (%s IN BOOLEAN MODE) AS score', $escapedTerms))))
        ->whereRaw('MATCH (title,content) AGAINST (? IN BOOLEAN MODE)', array($terms))
        ->orderBy('score', 'desc')
        ->with('slugHistories')
        ->paginate(10);
    }


    public function slugHistories()
    {
        return $this->hasMany('SlugHistories', 'post_id');
    }
}