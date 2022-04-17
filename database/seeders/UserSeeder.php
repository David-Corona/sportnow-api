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
        ]);
        DB::table('users')->insert([
            'name' => 'David User',
            'email' => 'corona_121@hotmail.com',
            'password' => Hash::make('123456'),
            'role' => 'user',
        ]);
    }
}
