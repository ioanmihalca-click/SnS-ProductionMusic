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
            $table->string('slug')->unique();
            $table->string('artist')->nullable();
            $table->text('description')->nullable();
            
            // Fișiere audio
            $table->string('original_file_path');
            $table->string('preview_file_path');
            $table->string('artwork_path')->nullable();
            
            // Durată și metadata
            $table->integer('duration')->comment('Durata totală în secunde');
            $table->integer('preview_duration')->default(60)->comment('Durata preview în secunde');
            $table->string('key')->nullable()->comment('Musical key');
            $table->integer('bpm')->nullable()->comment('Beats per minute');
            
            // Categorizare și taguri
            $table->json('tags')->nullable();
            $table->string('category')->nullable();
            
            // Statistici și status
            $table->unsignedInteger('plays_count')->default(0);
            $table->unsignedInteger('likes_count')->default(0);
            $table->unsignedInteger('downloads_count')->default(0);
            $table->boolean('is_featured')->default(false);
            $table->enum('status', ['draft', 'active', 'inactive'])->default('active');
            
            // Prețuri pentru licențe
            $table->decimal('standard_license_price', 8, 2)->nullable();
            $table->decimal('premium_license_price', 8, 2)->nullable();
            $table->decimal('exclusive_license_price', 8, 2)->nullable();
            
            // SEO
            $table->text('seo_description')->nullable();
            $table->text('seo_keywords')->nullable();
            
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('genres', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('moods', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('genre_track', function (Blueprint $table) {
            $table->id();
            $table->foreignId('genre_id')->constrained()->onDelete('cascade');
            $table->foreignId('track_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('mood_track', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mood_id')->constrained()->onDelete('cascade');
            $table->foreignId('track_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });

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