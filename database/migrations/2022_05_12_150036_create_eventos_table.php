<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use phpDocumentor\Reflection\Types\Nullable;

class CreateEventosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eventos', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('deporte_id')->constrained('deportes')->onDelete('cascade'); //TODO
            $table->integer('deporte_id');
            $table->string('titulo');
            $table->string('descripcion')->nullable();
            $table->timestamp('fecha');
            $table->string('direccion');
            $table->double('latitud');
            $table->double('longitud');
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
        Schema::dropIfExists('eventos');
    }
}
