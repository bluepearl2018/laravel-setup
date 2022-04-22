<?php

namespace Eutranet\Setup\Models;

use Spatie\Translatable\HasTranslations;

/**
 * The Permission class is an extension of the original
 * \Spatie\Permission\Models\Permission
 * It can be used / called in the role and permissiohs admin part
 * Please note THIS MODEL is called by App/config => permission.php
 */
class Permission extends \Spatie\Permission\Models\Permission
{
	use HasTranslations;

	protected $table = 'permissions';
	protected $fillable = ['name', 'guard_name', 'description'];
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
}
