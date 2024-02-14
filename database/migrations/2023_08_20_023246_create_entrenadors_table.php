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
        Schema::create('entrenadors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('dni', 8);
            $table->string('nombre', 45);
            $table->string('apellido_materno', 45);
            $table->string('apellido_paterno', 45);
            $table->string('direccion', 100);
            $table->string('firma', 255);
             $table->string('foto', 255);
            $table->boolean('estado')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entrenadors');
    }
};
