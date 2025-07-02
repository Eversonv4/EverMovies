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
        Schema::create('favorites', function (Blueprint $table) {
            $table->id();
            $table->integer('movie_id')->unique(); // TMDB ID
            $table->boolean('adult');
            $table->string('backdrop_path')->nullable();
            $table->json('genre_ids')->nullable();
            $table->string('original_language')->nullable();
            $table->string('original_title')->nullable();
            $table->text('overview')->nullable();
            $table->float('popularity')->default(0);
            $table->string('poster_path')->nullable();
            $table->date('release_date')->nullable();
            $table->string('title')->nullable();
            $table->string('name')->nullable();
            $table->boolean('video')->default(false);
            $table->float('vote_average')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('favorites');
    }
};
