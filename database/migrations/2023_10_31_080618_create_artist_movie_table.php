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
        Schema::create('artist_movie', function (Blueprint $table) {
            $table->id();
            $table->foreignId("artist_id")->constrained("users");
            $table->foreignId("movie_id")->constrained();
            $table->unsignedBigInteger("salary");
            $table->unique(["artist_id", "movie_id"]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('artist_movie');
    }
};
