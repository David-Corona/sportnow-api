<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'David Corona',
            'email' => 'dcoronacollis@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'admin',
            'avatar' => 'defaultstringavatar',
            'latitude' => 40,
            'longitude' => 1,
            'activated' => true,
        ]);
        DB::table('users')->insert([
            'name' => 'David User',
            'email' => 'corona_121@hotmail.com',
            'password' => Hash::make('123456'),
            'role' => 'user',
            'avatar' => 'defaultstringavatar',
            'latitude' => 35,
            'longitude' => -1,
            'activated' => true,
        ]);
    }
}
