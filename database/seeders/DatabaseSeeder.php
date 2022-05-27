<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(DeporteSeeder::class);
        $this->call(EventoSeeder::class);
        $this->call(EventoComentariosSeeder::class);
        $this->call(EventoUsuariosSeeder::class);
        $this->call(ContactoSeeder::class);
    }
}
