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
        Schema::create('partidos', function (Blueprint $table) {
            $table->increments('id');
            $table->date('fecha_partido');
            $table->time('hora_partido');
            $table->string('lugar', 50);
            $table->string('observacion', 150)->nullable();
            $table->boolean('estado')->default(true);
            $table->unsignedInteger('equipos_id');
            $table->unsignedInteger('equipos_id1');
            $table->unsignedInteger('estadios_id');
            $table->unsignedInteger('arbitros_id');
            $table->unsignedSmallInteger('categorys_id');
            $table->unsignedInteger('ligas_id');
            

            $table->timestamps();
            // relacion con la tabla equipos
            $table->foreign('equipos_id')->references('id')->on('equipos');
            // relacion con la tabla equipos
            $table->foreign('equipos_id1')->references('id')->on('equipos');
            // relacion con la tabla estadios
            $table->foreign('estadios_id')->references('id')->on('estadios');
            // relacion con la tabla arbitros
            $table->foreign('arbitros_id')->references('id')->on('arbitros');
            // relacion con la tabla categoria
            $table->foreign('categorys_id')->references('id')->on('categorys');
            // relacion con la tabla ligas
            $table->foreign('ligas_id')->references('id')->on('ligas');



        });
        

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partidos');
    }
};
