<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tracks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('artist')->nullable();
            $table->text('description')->nullable();
            $table->string('file_path');
            $table->string('artwork_path')->nullable();
            $table->integer('duration')->comment('Duration in seconds');
            $table->string('key')->nullable()->comment('Musical key');
            $table->integer('bpm')->nullable()->comment('Beats per minute');
            $table->unsignedInteger('plays_count')->default(0);
            $table->unsignedInteger('likes_count')->default(0);
            $table->boolean('is_featured')->default(false);
            $table->enum('status', ['draft', 'active', 'inactive'])->default('active');
            $table->decimal('price', 8, 2)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    
        // Tabel pentru genuri
        Schema::create('genres', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    
        // Tabel pentru mood-uri
        Schema::create('moods', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    
        // Tabel pivot pentru relația many-to-many între tracks și genres
        Schema::create('genre_track', function (Blueprint $table) {
            $table->id();
            $table->foreignId('genre_id')->constrained()->onDelete('cascade');
            $table->foreignId('track_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    
        // Tabel pivot pentru relația many-to-many între tracks și moods
        Schema::create('mood_track', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mood_id')->constrained()->onDelete('cascade');
            $table->foreignId('track_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    
        // Tabel pentru favorite
        Schema::create('favorites', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('track_id')->constrained()->onDelete('cascade');
            $table->timestamps();
    
            $table->unique(['user_id', 'track_id']);
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('favorites');
        Schema::dropIfExists('mood_track');
        Schema::dropIfExists('genre_track');
        Schema::dropIfExists('moods');
        Schema::dropIfExists('genres');
        Schema::dropIfExists('tracks');
    }
};