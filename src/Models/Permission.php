<?php

namespace Eutranet\Setup\Models;

use Spatie\Translatable\HasTranslations;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

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
	 * This static function is essential for the documentation service provider
	 * The namespace is saved into doc_models table
	 * @return string
	 */
	public static function getNamespace(): string
	{
		return __NAMESPACE__;
	}

	public static function getClassLead(): string
	{
		return "The permissions can be associated with roles or be stand-alone.";
	}

	/**
	 * @return void
	 */
	public static function boot()
	{
		parent::boot();
	}

	/**
	 * The "booted" method of the model.
	 *
	 * @return void
	 */
	protected static function booted()
	{
		if(Schema::hasTable('model_docs'))
		{
			ModelDoc::firstOrCreate([
				'table_name' => (new Permission())->getTable(),
				'slug' => Str::slug((new Permission())->getTable()),
				'name' => Str::replace(Str::snake(Str::afterLast(__CLASS__, '\\')), '_', ' '),
				'namespace' => __NAMESPACE__,
				'description' => self::getClassLead(),
				'comment' => NULL,
				'default_role' => 'admin'
			]);
		}
	}
}
