<?php

namespace Eutranet\Setup\Traits;

use Eutranet\Frontend\Models\Article;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Eutranet\Setup\Models\Admin;

/**
 * Has Articles is intended to frontend that have blogs
 */
trait HasArticles
{
	/**
	 * Returns articles whose authors is an Admin, a staff or user...
	 * @return MorphMany|null
	 */
	public function articles(): MorphMany|null
	{
		if(class_exists('Eutranet\Frontend\Models\Article'))
		{
			return $this->morphMany(Article::class, 'author');
		}
		return NULL;
	}
}
