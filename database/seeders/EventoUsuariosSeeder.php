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
            'user_id' => 3,
            'created_at' => '2022-05-27 10:39:58',
        ]);
        DB::table('evento_usuarios')->insert([
            'evento_id' => 1,
            'user_id' => 4,
            'created_at' => '2022-05-27 11:47:02',
        ]);
        DB::table('evento_usuarios')->insert([
            'evento_id' => 1,
            'user_id' => 5,
            'created_at' => '2022-05-27 13:51:45',
        ]);
        DB::table('evento_usuarios')->insert([
            'evento_id' => 1,
            'user_id' => 6,
            'created_at' => '2022-05-27 14:02:28',
        ]);

        DB::table('evento_usuarios')->insert([
            'evento_id' => 2,
            'user_id' => 6,
            'created_at' => '2022-06-18 11:32:58',
        ]);
        DB::table('evento_usuarios')->insert([
            'evento_id' => 2,
            'user_id' => 4,
            'created_at' => '2022-06-18 14:12:44',
        ]);
        DB::table('evento_usuarios')->insert([
            'evento_id' => 2,
            'user_id' => 5,
            'created_at' => '2022-06-18 17:30:25',
        ]);

        DB::table('evento_usuarios')->insert([
            'evento_id' => 3,
            'user_id' => 3,
            'created_at' => '2022-06-15 10:37:58',
        ]);
        DB::table('evento_usuarios')->insert([
            'evento_id' => 3,
            'user_id' => 4,
            'created_at' => '2022-06-16 12:55:33',
        ]);
        DB::table('evento_usuarios')->insert([
            'evento_id' => 3,
            'user_id' => 5,
            'created_at' => '2022-06-16 14:44:22',
        ]);

        DB::table('evento_usuarios')->insert([
            'evento_id' => 4,
            'user_id' => 7,
            'created_at' => '2022-06-17 09:33:58',
        ]);
        DB::table('evento_usuarios')->insert([
            'evento_id' => 4,
            'user_id' => 9,
            'created_at' => '2022-06-17 12:37:58',
        ]);
        DB::table('evento_usuarios')->insert([
            'evento_id' => 4,
            'user_id' => 8,
            'created_at' => '2022-06-17 17:29:00',
        ]);

        DB::table('evento_usuarios')->insert([
            'evento_id' => 5,
            'user_id' => 10,
            'created_at' => '2022-06-12 10:19:58',
        ]);
        DB::table('evento_usuarios')->insert([
            'evento_id' => 5,
            'user_id' => 5,
            'created_at' => '2022-06-12 17:22:58',
        ]);
        DB::table('evento_usuarios')->insert([
            'evento_id' => 5,
            'user_id' => 3,
            'created_at' => '2022-06-13 10:22:55',
        ]);
        DB::table('evento_usuarios')->insert([
            'evento_id' => 5,
            'user_id' => 6,
            'created_at' => '2022-06-13 11:18:18',
        ]);
        DB::table('evento_usuarios')->insert([
            'evento_id' => 5,
            'user_id' => 7,
            'created_at' => '2022-06-14 15:01:09',
        ]);

        DB::table('evento_usuarios')->insert([
            'evento_id' => 6,
            'user_id' => 3,
            'created_at' => '2022-06-14 10:10:22',
        ]);
        DB::table('evento_usuarios')->insert([
            'evento_id' => 6,
            'user_id' => 6,
            'created_at' => '2022-06-15 10:18:18',
        ]);
        DB::table('evento_usuarios')->insert([
            'evento_id' => 6,
            'user_id' => 7,
            'created_at' => '2022-06-15 14:01:09',
        ]);

        DB::table('evento_usuarios')->insert([
            'evento_id' => 7,
            'user_id' => 4,
            'created_at' => '2022-06-10 09:11:11',
        ]);
        DB::table('evento_usuarios')->insert([
            'evento_id' => 7,
            'user_id' => 3,
            'created_at' => '2022-06-11 19:18:27',
        ]);
        DB::table('evento_usuarios')->insert([
            'evento_id' => 7,
            'user_id' => 5,
            'created_at' => '2022-06-12 10:13:11',
        ]);
        DB::table('evento_usuarios')->insert([
            'evento_id' => 7,
            'user_id' => 8,
            'created_at' => '2022-06-12 09:55:11',
        ]);




    }
}
