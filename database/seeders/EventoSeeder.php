<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('eventos')->insert([
            'deporte_id' => 1,
            'fecha' => '2022-07-01 09:30:00',
            'direccion' => 'Club Pádel La Nucia',
            'latitud' => 38.602013,
            'longitud' => -0.121925,
        ]);
        DB::table('eventos')->insert([
            'deporte_id' => 1,
            'fecha' => '2022-09-01 18:30:00',
            'direccion' => 'Club Pádel La Nucia',
            'latitud' => 38.602013,
            'longitud' => -0.121925,
        ]);
        DB::table('eventos')->insert([
            'deporte_id' => 3,
            'fecha' => '2022-08-01 10:00:00',
            'direccion' => 'Ruta del Faro, Albir',
            'latitud' => 38.567910,
            'longitud' => -0.062958,
        ]);
    }
}
