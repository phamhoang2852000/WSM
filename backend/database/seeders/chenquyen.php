<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class chenquyen extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permission')->insert([
            ['name' => 'Kiểm duyệt yêu cầu của user'],
            ['name' => 'Xem danh sách thành viên D1'],
            ['name' => 'Xem danh sách thành viên D2'],
            ['name' => 'Xem danh sách thành viên D3'],
            ['name' => 'Xem danh sách thành viên Phòng hành chính'],
            ['name' => 'Được xem profile của thành viên D1'],
            ['name' => 'Được xem profile của thành viên D2'],
            ['name' => 'Được xem profile của thành viên D3'],
            ['name' => 'Được sửa profile của thành viên D1'],
            ['name' => 'Được sửa profile của thành viên D2'],
            ['name' => 'Được sửa profile của thành viên D3'],
        ]);
    }
}
