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
        Schema::create('comments', function (Blueprint $table) {
            $table->id('id_comment');
            $table->string('isi_komentar');
            $table->date('created_at')->nullable();

            $table->unsignedBigInteger('user_id_user');
            $table->unsignedBigInteger('film_id_film');

            $table->foreign('user_id_user')->references('id_user')->on('users')->onDelete('cascade');
            $table->foreign('film_id_film')->references('id_film')->on('films')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
