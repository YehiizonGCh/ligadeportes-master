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
        Schema::create('arbitros', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre',45);
            $table->string('apellido_paterno', 45);
            $table->string('apellido_materno', 45);
            $table->string('edad', 10);
            $table->string('dni', 8);
            $table->string('telefono', 9);
            $table->string('tipo_arbitro', 45);
            $table->boolean('estado')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('arbitros');
    }
};
