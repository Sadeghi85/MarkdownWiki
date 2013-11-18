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

    public function scopeNewest($query)
    {
        return $query->orderBy('updated_at', 'desc');
    }

    public function scopeSearch($query, $str)
    {
    	$str = trim($str);

        if ( ! $str)
        {
            return $query;
        }

    	$terms = array();
    	$explodedTerms = explode(' ', $str);

    	foreach ($explodedTerms as $explodedTerm)
    	{
    		$terms[] = preg_replace('#(\(|^)([^\(\)]{2,3})(\)|$)#iu', '\1\2*\3', $explodedTerm);
    	}

    	$terms = implode(' ', $terms);

        return $query
                    ->whereRaw('MATCH (search_title, search_content) AGAINST (? IN BOOLEAN MODE)', array($terms));

        // $escapedTerms = DB::connection()->getPdo()->quote($terms);

        // return self::select(array('*', DB::raw(sprintf('MATCH (search_title, search_content) AGAINST (%s IN BOOLEAN MODE) AS score', $escapedTerms))))
        // ->whereRaw('MATCH (search_title, search_content) AGAINST (? IN BOOLEAN MODE)', array($terms))
        // ->orderBy('score', 'desc')
        // ->with('slugHistories')
        // ->paginate(10);
    }


    public function slugHistories()
    {
        return $this->hasMany('SlugHistories', 'post_id');
    }
}