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
            'avatar' => '/images/default-avatar.jpg',
            'latitude' => 40,
            'longitude' => 1,
            'activated' => true,
        ]);
        DB::table('users')->insert([
            'name' => 'David User',
            'email' => 'corona_121@hotmail.com',
            'password' => Hash::make('123456'),
            'role' => 'user',
            'avatar' => '/images/default-avatar.jpg',
            'latitude' => 35,
            'longitude' => -1,
            'activated' => true,
        ]);
        DB::table('users')->insert([
            'name' => 'Eustaquio García',
            'email' => 'eustaquio@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'user',
            'avatar' => '/images/default-avatar.jpg',
            'latitude' => 36,
            'longitude' => -2,
            'activated' => true,
        ]);
        DB::table('users')->insert([
            'name' => 'Max Powers',
            'email' => 'max@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'user',
            'avatar' => '/images/default-avatar.jpg',
            'latitude' => 34,
            'longitude' => -1,
            'activated' => true,
        ]);
        DB::table('users')->insert([
            'name' => 'Pepe Sánchez',
            'email' => 'pepe@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'user',
            'avatar' => '/images/default-avatar.jpg',
            'latitude' => 32,
            'longitude' => 0,
            'activated' => true,
        ]);
    }
}
