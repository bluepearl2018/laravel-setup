<?php

namespace Eutranet\Setup\Database\Seeders;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Seeder;
use DB;

class EmailSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		// Seeds with dummy emails
		if (Schema::hasTable('emails') && DB::table('emails')->get()->count() < 1) {
			@include('emails.php');
		}
	}
}
