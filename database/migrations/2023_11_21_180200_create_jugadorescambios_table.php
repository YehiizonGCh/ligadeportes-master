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
        Schema::create('jugadorescambios', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('partidos_id')->unsigned();
            $table->integer('jugador_entra_id')->unsigned();
            $table->integer('jugador_sale_id')->unsigned();
            $table->integer('minuto_cambio')->nullable();
            $table->string('observacion_cambio', 250)->nullable();
            $table->foreign('partidos_id')->references('id')->on('partidos');
            $table->foreign('jugador_entra_id')->references('id')->on('jugadors');
            $table->foreign('jugador_sale_id')->references('id')->on('jugadors');

            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jugadorescambios');
    }
};
