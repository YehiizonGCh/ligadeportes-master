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
        Schema::create('category_details', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->unsignedSmallInteger('categorys_id');
            $table->unsignedInteger('clubs_id');

            $table->timestamps();
            //relacion con la tabla category
            $table->foreign('categorys_id')->references('id')->on('categorys');
            //relacion con la tabla club
            $table->foreign('clubs_id')->references('id')->on('clubs');

            
            

            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('category_details');
    }
};
