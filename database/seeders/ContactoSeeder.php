<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContactoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('contacto')->insert([
            'user_id' => 3,
            'created_at' => '2022-05-30 09:30:00',
            'asunto' => 'Editar Actividad',
            'motivo' => 'Actividades',
            'mensaje' => 'Buenos días, ¿Podríais editar la hora de la ruta de senderismo a las 09:00? Gracias!',
            'telefono' => '(+34)666777888'
        ]);
        DB::table('contacto')->insert([
            'user_id' => 8,
            'created_at' => '2022-06-02 12:35:17',
            'asunto' => 'Torneo Beach Volley',
            'motivo' => 'Noticias',
            'mensaje' => 'Hola, se va a producir un torneo de volley en la playa de Oliva. Os lo comento por si os interesa anunciarlo. Un saludo'
        ]);
        DB::table('contacto')->insert([
            'user_id' => 8,
            'created_at' => '2022-06-17 10:33:12',
            'asunto' => 'Apuntar a actividad',
            'motivo' => 'Actividades',
            'mensaje' => 'Hola, estoy teniendo problemas para unirme al partido de pádel del día 30 a las 20h en La Nucía, podríais meterme a la partida? Gracias'
        ]);
        DB::table('contacto')->insert([
            'user_id' => 3,
            'created_at' => '2022-05-30 18:10:12',
            'asunto' => 'Max Powers',
            'motivo' => 'Quejas',
            'mensaje' => 'Otra vez llegó tarde al partido de hoy, siempre hace lo mismo. Podríais hacer algo? Darle un toque..'
        ]);
        DB::table('contacto')->insert([
            'user_id' => 9,
            'created_at' => '2022-06-10 17:10:12',
            'asunto' => 'Publicidad',
            'motivo' => 'Otros',
            'mensaje' => 'Hola, estoy interesado en anunciarme en vuestra web, podríais poneros en contacto conmigo? Gracias',
            'telefono' => '(+34)666555444'
        ]);



    }
}
