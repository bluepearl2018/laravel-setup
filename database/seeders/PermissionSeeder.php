<?php

namespace Eutranet\Setup\Database\Seeders;

use Eutranet\Setup\Models\ModelDoc;
use Illuminate\Database\Seeder;
use Spatie\Permission\PermissionRegistrar;
use Eutranet\Setup\Models\Permission;
use Str;

class PermissionSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		app()[PermissionRegistrar::class]->forgetCachedPermissions();
		// Set the crud verbs
		$cruds = ['list', 'create', 'read', 'update', 'delete', 'translate'];
		$guards = array('admin', 'staff', 'web');
		$tables = config('eutranet-setup.tables');
		// If we have model documentation...
		// Generate default permissions for each App/models/folders...
		foreach ($tables as $tableName) {
			// If the namespace is App\Models\Admin
			foreach ($guards as $guard) {
				foreach ($cruds as $operation) {
					Permission::updateOrCreate(
						[
							'name' => $operation . '-' . Str::slug($tableName),
							'guard_name' => $guard
						],
						[
							'name' => $operation . '-' . Str::slug($tableName),
							'guard_name' => $guard
						]
					);
				}
			}
		}

	}
}
