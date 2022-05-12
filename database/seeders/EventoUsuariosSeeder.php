<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventoUsuariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('evento_usuarios')->insert([
            'evento_id' => 1,
            'user_id' => 2,
        ]);
        DB::table('evento_usuarios')->insert([
            'evento_id' => 1,
            'user_id' => 3,
        ]);
        DB::table('evento_usuarios')->insert([
            'evento_id' => 1,
            'user_id' => 4,
        ]);
        DB::table('evento_usuarios')->insert([
            'evento_id' => 1,
            'user_id' => 5,
        ]);
        DB::table('evento_usuarios')->insert([
            'evento_id' => 2,
            'user_id' => 2,
        ]);
        DB::table('evento_usuarios')->insert([
            'evento_id' => 2,
            'user_id' => 3,
        ]);
        DB::table('evento_usuarios')->insert([
            'evento_id' => 2,
            'user_id' => 4,
        ]);
        DB::table('evento_usuarios')->insert([
            'evento_id' => 2,
            'user_id' => 5,
        ]);
        DB::table('evento_usuarios')->insert([
            'evento_id' => 3,
            'user_id' => 2,
        ]);
        DB::table('evento_usuarios')->insert([
            'evento_id' => 3,
            'user_id' => 3,
        ]);
        DB::table('evento_usuarios')->insert([
            'evento_id' => 3,
            'user_id' => 4,
        ]);

    }
}
