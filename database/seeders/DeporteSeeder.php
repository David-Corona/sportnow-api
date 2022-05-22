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
            'nombre' => 'Padel',
            'max_participantes' => 4,
            'imagen' => 'imagenPadel' //TODO
        ]);
        DB::table('deportes')->insert([
            'nombre' => 'Tenis',
            'max_participantes' => 2,
            'imagen' => 'imagenTenis'
        ]);
        DB::table('deportes')->insert([
            'nombre' => 'Senderismo',
            'imagen' => 'imagenSenderismo'
        ]);
    }
}
