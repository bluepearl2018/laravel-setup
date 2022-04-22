<?php

namespace Eutranet\Setup\Database\Seeders;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Eutranet\Setup\Database\Seeders\AgreementSeeder;

class DatabaseSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{

		if (Schema::hasTable('install_statuses') &&
			DB::table('install_statuses')
				->where('package_name', 'setup')->get()->first() === NULL) {
			DB::table('install_statuses')->insert(
				[
					'package_name' => 'setup',
					'installed' => 'false',
					'created_at' => Carbon::now()
				]
			);
		}

		$this->call(AgreementSeeder::class);
		$this->call(RoleSeeder::class);
		$this->call(PermissionSeeder::class);
		$this->call(AdminSeeder::class);
		$this->call(SuperStaffSeeder::class);
		$this->call(DocCategorySeeder::class);
		$this->call(DocSeeder::class);
		$this->call(MediaSeeder::class);

		Model::unguard();
		User::factory()
			->count(25)
			->create();
		Model::reguard();
	}
}
