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
        Schema::create('estadios', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre', 50);
            $table->string('direccion', 100);
            $table->string('departamento', 100);
            $table->unsignedInteger('clubs_id');
            $table->string('imagen',100);
            //relacion con la tabla clubs
            $table->foreign('clubs_id')->references('id')->on('clubs');
            $table->boolean('estado')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estadio');
    }
};
