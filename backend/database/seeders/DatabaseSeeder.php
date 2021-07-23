<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       DB::table('division')->insert([
            ['name' => 'Division 1'],
            ['name' => 'Division 2'],
            ['name' => 'Division 3'],
            ['name' => 'Phòng hành chính'],
            ['name' => 'Ban giám đốc'],
       ]);
    }
}
