<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminUser extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name'=>'Admin Admin',
            'email'=>'admin@gmail.com',
            'roleId'=>1,
            'password'=>Hash::make('admin2022'),
            'provinceId'=>1,
            'idNumber'=>Str::random(16),
            'created_at'=>now(),
            'updated_at'=>now(),
        ]);
    }
}
