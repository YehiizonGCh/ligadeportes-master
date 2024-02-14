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
        Schema::create('estadistica_partidos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('goles_visitante');
            $table->integer('goles_local'); 
            $table->integer('corners_visitante')->nullable();
            $table->integer('corners_local')->nullable();
            $table->integer('faltas_visitante')->nullable();
            $table->integer('faltas_local')->nullable();
            $table->integer('tarjetas_amarillas_visitante')->nullable();
            $table->integer('tarjetas_amarillas_local')->nullable();
            $table->integer('tarjetas_rojas_visitante')->nullable();
            $table->integer('tarjetas_rojas_local')->nullable();
            $table->unsignedInteger('partidos_id');

            $table->timestamps();
            // relacion con la tabla partido
            $table->foreign('partidos_id')->references('id')->on('partidos');
           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estadistica_partidos');
    }
};
