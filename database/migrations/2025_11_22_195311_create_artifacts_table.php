<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('artifacts', function (Blueprint $table) {
            $table->id();

            // 1. RELASI
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('museum_id')->nullable()->constrained('museums')->onDelete('set null');

            // 2. DATA UMUM
            $table->string('title');
            $table->text('description')->nullable();
            // Kategori ini yang membedakan: 'BENDA' (Keris) vs 'TAK_BENDA' (Rekaman Suara)
            $table->enum('category', ['BENDA', 'TAK_BENDA', 'SITUS'])->default('BENDA');

            // Detail Benda (Nullable karena Tak Benda tidak punya material)
            $table->string('material')->nullable();
            $table->string('function')->nullable();
            $table->string('origin_region')->nullable();

            // 3. ASET FILE (GABUNGAN)
            $table->string('image_path')->nullable(); // Foto (Wajib untuk BENDA, Opsional untuk TAK_BENDA)
            $table->string('audio_path')->nullable(); // File Audio (Wajib untuk TAK_BENDA)
            $table->string('video_path')->nullable();

            // 4. FITUR VOICE ARCHIVE (PINDAHAN DARI TABEL AUDIO_ARCHIVES)
            $table->longText('transcript')->nullable(); // Hasil transkripsi AI
            $table->string('language')->nullable(); // Bahasa (Mandar/Indonesia)

            // 5. INTEGRASI TRIPO AI (3D)
            $table->string('tripo_task_id')->nullable()->index();
            $table->text('model_path')->nullable();
            $table->enum('ai_status', ['PENDING', 'PROCESSING', 'SUCCESS', 'FAILED'])->default('PENDING');

            // 6. KURASI
            $table->enum('curation_status', ['PENDING', 'APPROVED', 'REJECTED'])->default('PENDING');
            $table->text('curator_note')->nullable();
            $table->foreignId('curator_id')->nullable()->constrained('users')->onDelete('set null');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('artifacts');
    }
};