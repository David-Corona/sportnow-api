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
            'fecha' => '2022-05-30 09:30:00',
            'titulo' => 'Pádel 4ª categoría',
            'descripcion' => 'Bienvenidos todos aquellos que sean de 4ª categoría aproximadamente.
            Jugamos a las 09:30, la pista está reservada hasta las 11:00. Aquellos que no sean socios tendrán que pagar la cuota.',
            'direccion' => 'Club Pádel La Nucia',
            'latitud' => 38.602013,
            'longitud' => -0.121925,
            'created_at' => '2022-05-27 10:39:58'
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
            'fecha' => '2022-07-04 9:00:00',
            'titulo' => 'Ruta del Faro',
            'descripcion' => 'Quedada para cualquiera que quiera apuntarse, todas las edades.',
            'direccion' => 'Ruta del Faro, Albir',
            'latitud' => 38.567910,
            'longitud' => -0.062958,
            'created_at' => '2022-06-15 10:37:58'
        ]);
        DB::table('eventos')->insert([
            'deporte_id' => 4,
            'fecha' => '2022-06-30 20:00:00',
            'titulo' => 'Pádel chicas',
            'descripcion' => 'Partido sólo para chicas, nivel intermedio',
            'direccion' => 'Club Pádel La Nucia',
            'latitud' => 38.602013,
            'longitud' => -0.121925,
            'created_at' => '2022-06-17 09:33:58'
        ]);
        DB::table('eventos')->insert([
            'deporte_id' => 3,
            'fecha' => '2022-07-15 21:00:00',
            'titulo' => 'Partidito de fútbol sala',
            'descripcion' => 'Partido amisotoso de fútbol sala, buen rollo ante todo.',
            'direccion' => 'Ciudad Deportiva Camilo Cano, La Nucia, La Nucía, Provincia de Alicante 03530, España',
            'latitud' => 38.602711,
            'longitud' => -0.123834,
            'created_at' => '2022-06-12 10:19:58'
        ]);
        DB::table('eventos')->insert([
            'deporte_id' => 2,
            'fecha' => '2022-07-12 08:00:00',
            'titulo' => 'Ruta a Fuentes del Algar',
            'descripcion' => 'Salida desde el parking del hotel Cap Negret. Subida a las fuentes del algar siguiendo el camino del rio Algar.',
            'direccion' => 'Hotel Cap Negret Altea, Partida Cap Negret, 7, Altea, Provincia de Alicante 03590, España',
            'latitud' => 38.609335,
            'longitud' => -0.038592,
            'created_at' => '2022-06-14 10:10:22'
        ]);
        DB::table('eventos')->insert([
            'deporte_id' => 1,
            'fecha' => '2022-07-10 21:00:00',
            'titulo' => 'Pachanga basket',
            'descripcion' => 'Todos bienvenidos! Uníos a la pachanga de basket. La idea es hacer un partido todas las semanas',
            'direccion' => 'Polideportivo Municipal de Alfaz del Pi',
            'latitud' => 38.580711,
            'longitud' => -0.100057,
            'created_at' => '2022-06-10 09:11:11'
        ]);


    }
}
