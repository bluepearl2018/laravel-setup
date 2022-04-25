<?php

namespace Eutranet\Setup\Database\Seeders;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Seeder;
use Spatie\Permission\PermissionRegistrar;
use Eutranet\Setup\Models\Role;
use DB;
use Eutranet\Setup\Models\Admin;

class AdminSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$initialArray = array(
			array(
				'id' => 1,
				'is_super' => true,
				'name' => 'Super Administrator',
				'email' => 'superadmin@admin.tld',
				'created_at' => now(),
				'updated_at' => now(),
			),
			array(
				'id' => 2,
				'is_super' => false,
				'name' => 'Data officer',
				'email' => 'gdpr@admin.tld',
				'created_at' => now(),
				'updated_at' => now(),
			),
			array(
				'id' => 3,
				'is_super' => false,
				'name' => 'Backend manager',
				'email' => 'backend@admin.tld',
				'created_at' => now(),
				'updated_at' => now(),
			),
			array(
				'id' => 4,
				'is_super' => false,
				'name' => 'Content manager',
				'email' => 'content@admin.tld',
				'created_at' => now(),
				'updated_at' => now(),
			),
		);
		if (Schema::hasTable('admins') && DB::table('admins')->get()->count() < 1) {
			DB::table('admins')->insert(
				$initialArray
			);
			Admin::find(1)->assignRole(['super-admin', 'backend-admin', 'content-manager']);
			Admin::find(2)->assignRole(['data-officer', 'content-manager']);
			Admin::find(3)->assignRole(['backend-admin']);
			Admin::find(4)->assignRole(['content-manager']);
		}
	}
}
