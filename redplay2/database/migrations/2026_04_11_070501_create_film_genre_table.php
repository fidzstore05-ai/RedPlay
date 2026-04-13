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
        Schema::create('film_genre', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('film_id_film');
            $table->unsignedBigInteger('genres_id_genre');

            $table->foreign('film_id_film')->references('id_film')->on('films')->onDelete('cascade');
            $table->foreign('genres_id_genre')->references('id_genre')->on('genres')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('film_genre');
    }
};
