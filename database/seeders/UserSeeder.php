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
            'avatar' => '/avatares/Mr X.jpg',
            'latitude' => 39.54,
            'longitude' => 1.14,
            'activated' => true,
        ]);
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('123456'),
            'role' => 'admin',
            'avatar' => '/avatares/eclipse.jpg',
            'latitude' => 39.0,
            'longitude' => 0.005,
            'activated' => true,
        ]);
        DB::table('users')->insert([
            'name' => 'David User',
            'email' => 'corona_121@hotmail.com',
            'password' => Hash::make('123456'),
            'role' => 'user',
            'avatar' => '/avatares/breakingbad.jpg',
            'latitude' => 36.55,
            'longitude' => -0.054,
            'activated' => true,
        ]);
        DB::table('users')->insert([
            'name' => 'Eustaquio García',
            'email' => 'eustaquio@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'user',
            'avatar' => '/avatares/monstruo.png',
            'latitude' => 36.89,
            'longitude' => -0.056,
            'activated' => true,
        ]);
        DB::table('users')->insert([
            'name' => 'Max Powers',
            'email' => 'max@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'user',
            'avatar' => '/avatares/bart.png',
            'latitude' => 37.55,
            'longitude' => -0.025,
            'activated' => true,
        ]);
        DB::table('users')->insert([
            'name' => 'Pepe Sánchez',
            'email' => 'pepe@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'user',
            'avatar' => '/avatares/star-wars.png',
            'latitude' => 35.77,
            'longitude' => 0.0123,
            'activated' => true,
        ]);
        DB::table('users')->insert([
            'name' => 'Ana Pastor',
            'email' => 'ana@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'user',
            'avatar' => '/avatares/gato.webp',
            'latitude' => 38.55,
            'longitude' => 0.01,
            'activated' => true,
        ]);
        DB::table('users')->insert([
            'name' => 'Miriam Pérez',
            'email' => 'miriam@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'user',
            'avatar' => '/avatares/gato2.png',
            'latitude' => 37.47,
            'longitude' => -0.015,
            'activated' => true,
        ]);
        DB::table('users')->insert([
            'name' => 'Susana Rojo',
            'email' => 'susana@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'user',
            'avatar' => '/avatares/avatar.webp',
            'latitude' => 38.68,
            'longitude' => 0.034,
            'activated' => true,
        ]);
        DB::table('users')->insert([
            'name' => 'Johnny Vegas',
            'email' => 'johnny@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'user',
            'avatar' => '/avatares/corbata.jpg',
            'latitude' => 37.98,
            'longitude' => -0.024,
            'activated' => true,
        ]);
    }
}
