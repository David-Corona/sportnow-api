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
            'deporte_id' => 4,
            'fecha' => '2022-06-30 09:30:00',
            'titulo' => 'Pádel 4ª categoría',
            'descripcion' => 'Bienvenidos todos aquellos que sean de 4ª categoría aproximadamente',
            'direccion' => 'Club Pádel La Nucia',
            'latitud' => 38.602013,
            'longitud' => -0.121925,
            'created_at' => '2022-06-17 10:39:58'
        ]);
        DB::table('eventos')->insert([
            'deporte_id' => 4,
            'fecha' => '2022-07-01 18:30:00',
            'titulo' => 'Cualquier bienvenido',
            'descripcion' => 'Partido para pasarlo bien, sin requisitos.',
            'direccion' => 'Club Pádel La Nucia',
            'latitud' => 38.602013,
            'longitud' => -0.121925,
            'created_at' => '2022-06-18 11:32:58'
        ]);
        DB::table('eventos')->insert([
            'deporte_id' => 5,
            'fecha' => '2022-07-04 10:00:00',
            'titulo' => 'Ruta del Faro',
            'descripcion' => 'Gran quedada para cualquiera que quiera apuntarse, todas las edades.',
            'direccion' => 'Ruta del Faro, Albir',
            'latitud' => 38.567910,
            'longitud' => -0.062958,
            'created_at' => '2022-06-15 10:37:58'
        ]);
    }
}
