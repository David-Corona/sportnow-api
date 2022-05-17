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
            'created_at' => '2022-06-17 10:39:58',
        ]);
        DB::table('evento_usuarios')->insert([
            'evento_id' => 1,
            'user_id' => 3,
            'created_at' => '2022-06-17 11:47:02',
        ]);
        DB::table('evento_usuarios')->insert([
            'evento_id' => 1,
            'user_id' => 4,
            'created_at' => '2022-06-17 13:51:45',
        ]);
        DB::table('evento_usuarios')->insert([
            'evento_id' => 1,
            'user_id' => 5,
            'created_at' => '2022-06-17 14:02:28',
        ]);
        DB::table('evento_usuarios')->insert([
            'evento_id' => 2,
            'user_id' => 2,
            'created_at' => '2022-06-18 11:32:58',
        ]);
        DB::table('evento_usuarios')->insert([
            'evento_id' => 2,
            'user_id' => 3,
            'created_at' => '2022-06-18 14:12:44',
        ]);
        DB::table('evento_usuarios')->insert([
            'evento_id' => 2,
            'user_id' => 4,
            'created_at' => '2022-06-18 17:30:25',
        ]);
        DB::table('evento_usuarios')->insert([
            'evento_id' => 3,
            'user_id' => 2,
            'created_at' => '2022-06-15 10:37:58',
        ]);
        DB::table('evento_usuarios')->insert([
            'evento_id' => 3,
            'user_id' => 3,
            'created_at' => '2022-06-16 12:55:33',
        ]);
        DB::table('evento_usuarios')->insert([
            'evento_id' => 3,
            'user_id' => 4,
            'created_at' => '2022-06-16 14:44:22',
        ]);

    }
}
