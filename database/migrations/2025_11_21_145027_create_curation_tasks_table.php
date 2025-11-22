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
        Schema::create('curation_tasks', function (Blueprint $table) {
             $table->id();

            $table->foreignId('artifact_id')
                ->constrained('artifacts')
                ->cascadeOnDelete();

            $table->foreignId('curator_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->enum('status', [
                'PENDING',
                'IN_REVIEW',
                'APPROVED',
                'REJECTED',
            ])->default('PENDING');

            $table->text('note')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('curation_tasks');
    }
};
