<?php

namespace Eutranet\Setup\Database\Seeders;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Seeder;
use DB;

class SetupProcessSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$setupSteps = [
			array(
				'name' => 'Fresh install',
			),
			array(
				'name' => 'File uploads',
			),
			array(
				'name' => 'Core setup',
			),
			array(
				'name' => 'Frontend Setup',
			),
			array(
				'name' => 'Corporate Setup',
			),
		];
		if (Schema::hasTable('setup_processes') && DB::table('setup_processes')->get()->count() < 1) {
			DB::table('setup_processes')->insert(
				$setupSteps
			);
		}
	}
}
