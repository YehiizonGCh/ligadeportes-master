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
        Schema::create('torneos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre', 100);
            $table->string('abreviatura', 10)->nullable();
            $table->string('descripcion', 150)->nullable();
            $table->string('logo', 100);
            $table->string('temporada', 10);
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->unsignedInteger('ligas_id');
            $table->boolean('estado')->default(true);
            $table->timestamps();
            //relacion con la tabla ligas
            $table->foreign('ligas_id')->references('id')->on('ligas');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('torneos');
    }
};
