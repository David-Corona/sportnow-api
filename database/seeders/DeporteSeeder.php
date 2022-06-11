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
        DB::table('deportes')->insert([
            'nombre' => 'Baloncesto',
            'max_participantes' => 10,
            'imagen' => '/deportes/dep_basket.jpg'
        ]);
        DB::table('deportes')->insert([
            'nombre' => 'Ciclismo',
            'imagen' => '/deportes/ciclismo_dep.jpg'
        ]);
        DB::table('deportes')->insert([
            'nombre' => 'Fútbol Sala',
            'max_participantes' => 10,
            'imagen' => '/deportes/dep_futbol.png'
        ]);
        DB::table('deportes')->insert([
            'nombre' => 'Padel',
            'max_participantes' => 4,
            'imagen' => '/deportes/dep_tenis.jpg'
        ]);
        DB::table('deportes')->insert([
            'nombre' => 'Running',
            'imagen' => '/deportes/run_dep.jpg'
        ]);
    }
}
