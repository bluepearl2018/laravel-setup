<?php

namespace Eutranet\Setup\Database\Seeders;

use Eutranet\Setup\Models\ModelDoc;
use Illuminate\Database\Seeder;
use Spatie\Permission\PermissionRegistrar;
use Eutranet\Setup\Models\Permission;

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
		$cruds = ['create', 'read', 'update', 'delete', 'translate'];

		// Get the available App/models...
		$modelDocs = ModelDoc::all();
		$guards = array('admin', 'staff', 'web');

		// If we have model documentation...
		if ($modelDocs->count() > 0) {
			// Generate default permissions for each App/models/folders...
			foreach ($modelDocs as $modelDoc) {
				// If the namespace is App\Models\Admin
				foreach ($guards as $guard) {
					foreach ($cruds as $operation) {
						Permission::firstOrCreate([
							'name' => $operation . '-' . $modelDoc->slug,
							'guard_name' => $guard
						]);
					}
				}
			}
		}
//		$this->call(RoleDefaultPermissionsSeeder::class);
	}
}
