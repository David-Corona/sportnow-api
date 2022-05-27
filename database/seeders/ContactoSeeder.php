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
            'user_id' => 2,
            'created_at' => '2022-05-30 09:30:00',
            'asunto' => 'Editar Actividad',
            'motivo' => 'Actividades',
            'mensaje' => 'Buenos días, ¿Podríais editar la hora de la ruta de senderismo a las 09:00? Gracias!',
            'telefono' => '(+34)666777888'
        ]);
    }
}
