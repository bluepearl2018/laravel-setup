<?php

namespace Eutranet\Setup\Database\Seeders;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Seeder;
use DB;

class DocSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{

		if (Schema::hasTable('doc_categories') && DB::table('docs')->get()->count() < 1) {
			@include('docs.php');
		}
	}
}
