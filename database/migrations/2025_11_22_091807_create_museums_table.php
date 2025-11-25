<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('museums', function (Blueprint $table) {
            $table->id();

            // 1. Identitas Lokasi
            $table->string('name'); // Contoh: "Museum Mandar" atau "Makam Raja-Raja"
            $table->enum('type', [
                'MUSEUM',   // Gedung Museum
                'SITUS',    // Situs Sejarah / Candi / Makam
                'SANGGAR',  // Sanggar Seni
                'LAINNYA'
            ])->default('MUSEUM'); // <-- INI TAMBAHAN DARI TABEL LOCATIONS

            // 2. Informasi Detail
            $table->text('description')->nullable();
            $table->string('address')->nullable();
            $table->string('district')->nullable(); // Kecamatan (Berguna untuk filter)
            $table->string('province')->default('Sulawesi Barat');
            $table->string('photo_url')->nullable(); // Foto Thumbnail di Peta

            // 3. Koordinat GIS (Wajib untuk Peta)
            $table->decimal('latitude', 10, 8);
            $table->decimal('longitude', 11, 8);

            // 4. Data Tambahan
            $table->json('meta')->nullable(); // Untuk data jam buka, harga tiket, dll.

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('museums');
    }
};
