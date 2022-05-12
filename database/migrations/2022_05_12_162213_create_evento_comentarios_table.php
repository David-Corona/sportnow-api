<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventoComentariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evento_comentarios', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('evento_id')->constrained('eventos')->onDelete('cascade');
            $table->integer('evento_id');
            // $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->integer('user_id');
            // $table->timestamp('fecha');
            $table->string('mensaje');
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('evento_comentarios');
    }
}
