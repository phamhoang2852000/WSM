<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class chenuser extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'email' => 'phamhoang2852000@gmail.com',
            'password' => Hash::make('123456'),
            'fullname' => 'pham van hoang',
            'sex' => '1',
            'avatar' => '',
            'role' => 1,
            'division' => 1,
            'chuc_vu' => 8,
            'phonenumber' => '354368934543',
            'status' => 1,
            'id_leader' => 2,
            'address' => 'Hà Nội',
            'date_of_birth' => '2000-05-28',
            'permission' => '1,2,3,4,5',
        ]);
    }
}
