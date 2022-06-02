<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DeporteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // TODO?
        DB::table('deportes')->insert([
            'nombre' => 'Baloncesto',
            'max_participantes' => 10,
            'imagen' => 'https://i.ibb.co/W3zt49v/dep-basket.jpg'
        ]);
        DB::table('deportes')->insert([
            'nombre' => 'Ciclismo',
            'imagen' => 'https://i.ibb.co/G3KYyGR/ciclismo-dep.jpg'
        ]);
        DB::table('deportes')->insert([
            'nombre' => 'Fútbol Sala',
            'max_participantes' => 10,
            'imagen' => 'https://i.ibb.co/ZdZThG6/dep-futbol.png'
        ]);
        DB::table('deportes')->insert([
            'nombre' => 'Padel',
            'max_participantes' => 4,
            'imagen' => 'https://i.ibb.co/1znz6yX/dep-tenis.jpg'
        ]);
        DB::table('deportes')->insert([
            'nombre' => 'Running',
            'imagen' => 'https://i.ibb.co/bFpDST1/run-dep.jpg'
        ]);
    }
}
