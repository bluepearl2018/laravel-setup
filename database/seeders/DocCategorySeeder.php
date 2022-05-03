<?php

namespace Eutranet\Setup\Database\Seeders;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Seeder;
use DB;

class DocCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Schema::hasTable('doc_categories') && DB::table('doc_categories')->get()->count() < 1) {
            @include('doc-categories.php');
        }
    }
}
