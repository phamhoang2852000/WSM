<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class chennoidung extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('requestType')->insert([
            ['name' => 'Nghỉ phép có lương'],
            ['name' => 'Nghỉ phép không lương'],
            ['name' => 'Mang thiết bị về nhà'],
            ['name' => 'Làm thêm giờ'],
            ['name' => 'Quên checkin/checkout'],
        ]);
    }
}
