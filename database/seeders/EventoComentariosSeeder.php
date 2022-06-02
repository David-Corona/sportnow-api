<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventoComentariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('evento_comentarios')->insert([
            'evento_id' => 1,
            'user_id' => 2,
            'created_at' => '2022-06-18 18:30:12',
            'mensaje' => 'Hola a todos!',
        ]);
        DB::table('evento_comentarios')->insert([
            'evento_id' => 1,
            'user_id' => 3,
            'created_at' => '2022-06-18 19:44:02',
            'mensaje' => 'Buenas!',
        ]);
        DB::table('evento_comentarios')->insert([
            'evento_id' => 1,
            'user_id' => 4,
            'created_at' => '2022-06-18 19:56:59',
            'mensaje' => 'Hola, como hacemos los equipos?',
        ]);
        DB::table('evento_comentarios')->insert([
            'evento_id' => 1,
            'user_id' => 2,
            'created_at' => '2022-06-19 10:32:58',
            'mensaje' => 'Como la última vez? Eus y yo juntos?',
        ]);
        DB::table('evento_comentarios')->insert([
            'evento_id' => 3,
            'user_id' => 3,
            'created_at' => '2022-06-05 19:30:12',
            'mensaje' => 'Hola, que dificultad tiene la ruta?',
        ]);
        DB::table('evento_comentarios')->insert([
            'evento_id' => 3,
            'user_id' => 4,
            'created_at' => '2022-06-05 21:44:58',
            'mensaje' => 'Hola Eustaquio, es una ruta bastante corta y el camino es asfaltado, pero tiene subidas y bajadas',
        ]);
        DB::table('evento_comentarios')->insert([
            'evento_id' => 3,
            'user_id' => 3,
            'created_at' => '2022-06-06 09:12:03',
            'mensaje' => 'Vale, gracias!',
        ]);
    }
}
