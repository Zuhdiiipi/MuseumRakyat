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
        Schema::create('artifact_images', function (Blueprint $table) {
            $table->id();

            $table->foreignId('artifact_session_id')
                ->constrained('artifact_sessions')
                ->cascadeOnDelete();

            $table->enum('view', [
                'FRONT',
                'BACK',
                'LEFT',
                'RIGHT',
                'DETAIL',
            ]);

            $table->string('object_key');
            $table->json('meta')->nullable();

            $table->timestamps();

            $table->unique(['artifact_session_id', 'view']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('artifact_images');
    }
};
