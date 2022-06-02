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
            'created_at' => '2022-05-28 18:30:12',
            'mensaje' => 'Hola a todos!',
        ]);
        DB::table('evento_comentarios')->insert([
            'evento_id' => 1,
            'user_id' => 3,
            'created_at' => '2022-05-28 19:44:02',
            'mensaje' => 'Buenas!',
        ]);
        DB::table('evento_comentarios')->insert([
            'evento_id' => 1,
            'user_id' => 4,
            'created_at' => '2022-05-28 19:56:59',
            'mensaje' => 'Hola, como hacemos los equipos?',
        ]);
        DB::table('evento_comentarios')->insert([
            'evento_id' => 1,
            'user_id' => 2,
            'created_at' => '2022-05-29 10:32:58',
            'mensaje' => 'Como la última vez? Eus y yo juntos?',
        ]);
        DB::table('evento_comentarios')->insert([
            'evento_id' => 1,
            'user_id' => 4,
            'created_at' => '2022-05-28 11:55:59',
            'mensaje' => 'Me parece genial',
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

        DB::table('evento_comentarios')->insert([
            'evento_id' => 4,
            'user_id' => 8,
            'created_at' => '2022-06-17 12:39:15',
            'mensaje' => 'Hola Ana, cuanto tiempo! Como estás?',
        ]);
        DB::table('evento_comentarios')->insert([
            'evento_id' => 4,
            'user_id' => 6,
            'created_at' => '2022-06-17 13:44:18',
            'mensaje' => 'Hola! Muy bien y tu?',
        ]);
        DB::table('evento_comentarios')->insert([
            'evento_id' => 4,
            'user_id' => 8,
            'created_at' => '2022-06-17 15:02:23',
            'mensaje' => 'Genial! Voy a comentárselo a Silvia, a ver si se anima a jugar',
        ]);

        DB::table('evento_comentarios')->insert([
            'evento_id' => 5,
            'user_id' => 9,
            'created_at' => '2022-06-14 15:55:12',
            'mensaje' => 'Buenas a todos! Avisad a vuestros amigos, aver si llenamos la partida cuanto antes',
        ]);

        DB::table('evento_comentarios')->insert([
            'evento_id' => 6,
            'user_id' => 5,
            'created_at' => '2022-06-15 10:19:55',
            'mensaje' => 'Hola! Llevaba tiempo querienda hacer esta ruta, me han dicho que está muy chula, aunque hay bastante pendiente, no?',
        ]);
        DB::table('evento_comentarios')->insert([
            'evento_id' => 6,
            'user_id' => 2,
            'created_at' => '2022-06-15 11:02:15',
            'mensaje' => 'Sí, hay bastante subida, pero hay bastante sombra y podemos parar sin problema',
        ]);





    }
}
