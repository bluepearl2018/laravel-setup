<?php

namespace Eutranet\Setup\Models;

use Illuminate\Database\Eloquent\Model;

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
