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
        Schema::create('jugadors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('apellido_paterno', 45);
            $table->string('apellido_materno', 45);
            $table->string('nombres', 45);
            $table->string('dni', 8);
            $table->string('departamento', 50);
            $table->string('provincia', 50);
            $table->string('distrito', 50);
            $table->string('estado_civil', 50);
            $table->enum('trabaja', ['SI', 'NO']);
            $table->enum('estudia', ['SI', 'NO']);
            $table->string('talla', 45);
            $table->string('peso', 45);
            $table->string('domicilio', 45);
            $table->string('nombre_padre', 50);
            $table->string('nombre_madre', 50);
            $table->string('ficha_medica', 150)->nullable();
            $table->string('grupo_sanguineo', 45)->nullable();
            $table->date('fecha_nacimiento');
            $table->string('edad', 10);
            $table->string('posicion', 20);
            $table->string('dorsal', 10)->nullable();
            $table->string('documentos', 150)->nullable();
            $table->string('club_origen', 45);
            $table->unsignedInteger('equipos_id');
            $table->string('foto', 150)->nullable();
            $table->boolean('estado')->default(true);
            $table->timestamps();
            //relacion con la tabla equipos
            $table->foreign('equipos_id')->references('id')->on('equipos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jugadors');
    }
};
