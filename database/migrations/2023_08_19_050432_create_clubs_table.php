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
        Schema::create('clubs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre', 50)->required();
            $table->string('abreviatura', 10)->nullable();
            $table->string('descripcion', 150)->nullable();
            $table->string('logo', 255);
            $table->boolean('estado')->default(true);
            $table->string('temporada', 50);
            $table->string('domicilio', 100)->nullable();
            $table->string('representante', 50);
            $table->string('dni_representante', 8);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clubs');
    }
};
