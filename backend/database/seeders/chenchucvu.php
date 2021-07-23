<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class chenchucvu extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('position')->insert([
            ['name' => 'Giám đốc', 'id_role' => '1'],
            ['name' => 'Phó giám đốc', 'id_role' => '1'],
            ['name' => 'Trưởng phòng hành chính', 'id_role' => '2'],
            ['name' => 'Trưởng phòng D1', 'id_role' => '2'],
            ['name' => 'Trưởng phòng D2', 'id_role' => '2'],
            ['name' => 'Trưởng phòng D3', 'id_role' => '2'],
            ['name' => 'Nhân viên chonhs thức', 'id_role' => '3'],
            ['name' => 'Thực tập sinh', 'id_role' => '3'],
        ]);
    }
}
