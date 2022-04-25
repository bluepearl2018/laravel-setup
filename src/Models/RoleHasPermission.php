<?php

namespace Eutranet\Setup\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

/**
 * The Role class is an extension of the original
 * \Spatie\Permission\Models\Role
 * It can be used / called in the role and permissiohs admin part
 * Please note THIS MODEL is called by App/config => permission.php
 */
class RoleHasPermission extends Model
{

	protected $table = 'role_has_permissions';
	protected $fillable = ['role_id', 'permission_id'];

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
	 * This static function is essential for the documentation service provider
	 * The namespace is saved into doc_models table
	 * @return string
	 */
	public static function getClassLead(): string
	{
		return "Role has permissions";
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
				'table_name' => (new RoleHasPermission())->getTable(),
				'slug' => Str::slug((new RoleHasPermission())->getTable()),
				'name' => Str::replace(Str::snake(Str::afterLast(__CLASS__, '\\')), '_', ' '),
				'namespace' => __NAMESPACE__,
				'description' => self::getClassLead(),
				'comment' => NULL,
				'default_role' => 'admin'
			]);
		}
	}
}