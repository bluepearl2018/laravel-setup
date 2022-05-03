<?php

namespace Eutranet\Setup\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class MediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Schema::hasTable('media') && DB::table('media')->get()->count() < 1) {
            @include('media.php');
        }
    }
}
