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
            'avatar' => 'https://i.ibb.co/qM2fjx3/Mr-X.jpg',
            'latitude' => 39.54,
            'longitude' => 1.14,
            'activated' => true,
        ]);
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('123456'),
            'role' => 'admin',
            'avatar' => 'https://www.goodtherapy.org/blog/blog/wp-content/uploads/2017/08/solar-eclipse-300x300.jpg',
            'latitude' => 39.0,
            'longitude' => 0.005,
            'activated' => true,
        ]);
        DB::table('users')->insert([
            'name' => 'David User',
            'email' => 'corona_121@hotmail.com',
            'password' => Hash::make('123456'),
            'role' => 'user',
            'avatar' => 'https://i.ibb.co/WP2Km9s/breakingbad.jpg',
            'latitude' => 36.55,
            'longitude' => -0.054,
            'activated' => true,
        ]);
        DB::table('users')->insert([
            'name' => 'Eustaquio García',
            'email' => 'eustaquio@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'user',
            'avatar' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS91GJAtpnVSyOkOq4j0tjv1vjI7inuCs2C-g&usqp=CAU',
            'latitude' => 36.89,
            'longitude' => -0.056,
            'activated' => true,
        ]);
        DB::table('users')->insert([
            'name' => 'Max Powers',
            'email' => 'max@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'user',
            'avatar' => 'https://fotouser.miarroba.st/e70eadff/300/lawerspain.jpg',
            'latitude' => 37.55,
            'longitude' => -0.025,
            'activated' => true,
        ]);
        DB::table('users')->insert([
            'name' => 'Pepe Sánchez',
            'email' => 'pepe@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'user',
            'avatar' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQLOEWSHUXrGdJRESJGfAm6tWMoPytgcBiQmLPqeqV98v46xkytIenduH3GsBYnaytxPDM&usqp=CAU',
            'latitude' => 35.77,
            'longitude' => 0.0123,
            'activated' => true,
        ]);
        DB::table('users')->insert([
            'name' => 'Ana Pastor',
            'email' => 'ana@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'user',
            'avatar' => 'https://www.pafans.com/forum/download/file.php?avatar=7502_1571058150.png',
            'latitude' => 38.55,
            'longitude' => 0.01,
            'activated' => true,
        ]);
        DB::table('users')->insert([
            'name' => 'Miriam Pérez',
            'email' => 'miriam@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'user',
            'avatar' => 'https://marketplace.canva.com/EAEkB8aSmJU/1/0/1600w/canva-rosa-y-amarillo-gato-moderno-dibujado-a-mano-abstracto-imagen-de-perfil-de-twitch-R-0ekToDIBE.jpg',
            'latitude' => 37.47,
            'longitude' => -0.015,
            'activated' => true,
        ]);
        DB::table('users')->insert([
            'name' => 'Susana Rojo',
            'email' => 'susana@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'user',
            'avatar' => 'https://www.nacionflix.com/__export/1652107010670/sites/debate/img/2022/05/09/primer-trailer-oficial-avatar-the-way-of-water.jpg_136940629.jpg',
            'latitude' => 38.68,
            'longitude' => 0.034,
            'activated' => true,
        ]);
        DB::table('users')->insert([
            'name' => 'Johnny Vegas',
            'email' => 'johnny@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'user',
            'avatar' => 'https://i.pinimg.com/originals/d9/56/9b/d9569bbed4393e2ceb1af7ba64fdf86a.jpg',
            'latitude' => 37.98,
            'longitude' => -0.024,
            'activated' => true,
        ]);
    }
}
