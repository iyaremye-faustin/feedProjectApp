<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('users')->insert([
            'name' => 'akiri',
            'email' => 'akiri@olivier.com',
            'password' => Hash::make('password'),
            'national_id'=> Hash::make(' '),
            'provinceId' => 'provinceId',
           'districtId' => 'districtId',
          'sectorId' =>'sectorId',
          'sectorId' =>'sectorId',




        ]);
    }
}
