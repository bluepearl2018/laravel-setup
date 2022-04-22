<?php

namespace Eutranet\Setup\Models;

use Spatie\Translatable\HasTranslations;

/**
 * The Role class is an extension of the original
 * \Spatie\Permission\Models\Role
 * It can be used / called in the role and permissiohs admin part
 * Please note THIS MODEL is called by App/config => permission.php
 */
class Role extends \Spatie\Permission\Models\Role
{
	use HasTranslations;

	protected $table = 'roles';
	protected $fillable = ['name', 'guard_name', 'description'];

	/**
	 * @var array|string[]
	 */
	protected array $translatable = ['description'];

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
		return 'name';
	}
}
