<?php

namespace Eutranet\Setup\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Guard extends Model
{
	use HasTranslations;

	protected $table = 'guards';
	protected $fillable = ['slug', 'name', 'description'];
	protected array $translatable = ['name', 'description'];

	/**
	 * @return void
	 */
	public static function boot()
	{
		parent::boot();
	}

	/**
	 * This static function is essential for the documentation service provider
	 * The namespace is saved into doc_models table
	 * @return string
	 */
	public static function getNamespace(): string
	{
		return __NAMESPACE__;
	}

	/**
	 * Get the route key for the model.
	 *
	 * @return string
	 */
	public function getRouteKeyName(): string
	{
		return 'slug';
	}
}
