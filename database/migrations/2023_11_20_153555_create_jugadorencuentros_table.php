<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('jugadorencuentros', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('jugadores_id');
            $table->unsignedInteger('partidos_id');
            $table->boolean('titular');
            $table->integer('goles')->nullable();
            $table->integer('autogoles')->nullable();
            $table->text('minuto_gol')->nullable();
            $table->text('minuto_autogol')->nullable();
            $table->integer('asistencias')->nullable();
            $table->integer('amarillas')->nullable();
            $table->integer('rojas')->nullable();  
            $table->string('observacion_goles')->nullable();
            $table->string('observacion_targeta_amarilla')->nullable();   
            $table->string('observacion_targeta_roja')->nullable();
            $table->timestamps();
            //relacion con la tabla jugadores
            $table->foreign('jugadores_id')->references('id')->on('jugadors');
            //relacion con la tabla partidos
            $table->foreign('partidos_id')->references('id')->on('partidos');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jugadorencuentros');
    }
};
