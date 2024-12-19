<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('albums', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('artwork_path')->nullable();
            
            // Metadata
            $table->integer('total_duration')->default(0)->comment('Total duration in seconds');
            $table->integer('tracks_count')->default(0);
            $table->json('tags')->nullable();
            $table->string('category')->nullable();
            
            // Prețuri și licențe
            $table->decimal('standard_license_price', 8, 2)->nullable();
            $table->decimal('premium_license_price', 8, 2)->nullable();
            $table->decimal('exclusive_license_price', 8, 2)->nullable();
            
            // Status și statistici
            $table->enum('status', ['draft', 'active', 'inactive'])->default('active');
            $table->boolean('is_featured')->default(false);
            $table->unsignedInteger('plays_count')->default(0);
            $table->unsignedInteger('downloads_count')->default(0);
            
            // SEO
            $table->text('seo_description')->nullable();
            $table->text('seo_keywords')->nullable();
            
            $table->timestamps();
            $table->softDeletes();
        });
    
        // Tabela pivot pentru track-uri în album
        Schema::create('album_track', function (Blueprint $table) {
            $table->id();
            $table->foreignId('album_id')->constrained()->onDelete('cascade');
            $table->foreignId('track_id')->constrained()->onDelete('cascade');
            $table->integer('position')->default(0); // Pentru ordinea track-urilor în album
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('album_track');
        Schema::dropIfExists('albums');
    }
};
