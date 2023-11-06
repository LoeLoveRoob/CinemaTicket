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
        Schema::create('cinema_movie', function (Blueprint $table) {
            $table->id();
            $table->foreignId("cinema_id")->constrained();
            $table->foreignId("movie_id")->constrained();
            $table->json("salons");
            $table->unique(["cinema_id", "movie_id"]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cinema_movie');
    }
};
