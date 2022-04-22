<?php

namespace Eutranet\Setup\Database\Seeders;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Seeder;
use Spatie\Permission\PermissionRegistrar;
use Eutranet\Setup\Models\Role;
use DB;

class GeneralTermSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		// Seeds with dummy emails
		if (Schema::hasTable('general_terms') && DB::table('general_terms')->get()->count() < 1) {
			@include('general-terms.php');
		}
	}
}
