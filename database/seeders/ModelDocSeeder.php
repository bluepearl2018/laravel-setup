<?php

namespace Eutranet\Setup\Database\Seeders;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Seeder;
use Spatie\Permission\PermissionRegistrar;
use Eutranet\Setup\Models\Role;
use DB;

class ModelDocSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		if (Schema::hasTable('model_docs') && DB::table('model_docs')->get()->count() < 1) {
			DB::table('model_docs')->insert(
				include('model-docs.php')
			);
		}
	}
}
