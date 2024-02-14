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
        Schema::create('equipos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre', 50);
            $table->string('representante', 50)->nullable();
            $table->boolean('estado')->default(true);
            $table->unsignedSmallInteger('categorys_id');
            $table->unsignedInteger('clubs_id');
            $table->unsignedInteger('entrenadors_id');
            
            $table->timestamps();
            //relacion con la tabla category
            $table->foreign('categorys_id')->references('id')->on('categorys');
            //relacion con la tabla club
            $table->foreign('clubs_id')->references('id')->on('clubs');
            //relacion con la tabla entrenador
            $table->foreign('entrenadors_id')->references('id')->on('entrenadors');


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipos');
    }
};
