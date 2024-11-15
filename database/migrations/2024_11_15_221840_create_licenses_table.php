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
         // Licenses
         Schema::create('licenses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('track_id')->constrained()->onDelete('cascade');
            $table->string('license_type'); // e.g., 'standard', 'premium', 'exclusive'
            $table->decimal('price', 10, 2);
            $table->string('transaction_id')->nullable();
            $table->json('license_details')->nullable(); // Stochează detalii specifice licenței
            $table->timestamp('valid_from');
            $table->timestamp('valid_until')->nullable();
            $table->string('status')->default('active'); // active, expired, revoked
            $table->text('usage_terms')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['user_id', 'track_id', 'status']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('licenses');
        Schema::dropIfExists('playlist_track');
        Schema::dropIfExists('playlists');
    }
};