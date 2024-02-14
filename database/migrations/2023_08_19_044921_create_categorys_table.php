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
        Schema::create('categorys', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->string('nombre', 50);
            $table->string('abreviatura', 10)->nullable();
            $table->string('edad_minima');
            $table->string('edad_maxima');
            $table->string('sexo', 50);
            $table->unsignedInteger('torneos_id');
            $table->boolean('estado')->default(true);
            $table->timestamps();
            //relacion con la tabla torneo
            $table->foreign('torneos_id')->references('id')->on('torneos');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categorys');
    }
};
