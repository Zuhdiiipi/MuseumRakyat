<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Tabel Pivot untuk menghubungkan Artifacts <-> Tags
        Schema::create('artifact_tag', function (Blueprint $table) {
            // Tidak wajib pakai ID auto-increment, tapi boleh ada
            $table->id();

            // Relasi ke Artifact
            $table->foreignId('artifact_id')
                ->constrained('artifacts')
                ->cascadeOnDelete(); // Kalau benda dihapus, relasi tag juga hilang

            // Relasi ke Tag
            $table->foreignId('tag_id')
                ->constrained('tags')
                ->cascadeOnDelete(); // Kalau tag dihapus, relasi di benda hilang

            // Mencegah duplikasi: Satu benda tidak boleh punya tag yang sama 2 kali
            $table->unique(['artifact_id', 'tag_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('artifact_tag');
    }
};