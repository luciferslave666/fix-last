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
        Schema::create('lamarans', function (Blueprint $table) {
            $table->id();
            // Pastikan relasi ke lowongan dan pelamar benar
            $table->foreignId('lowongan_id')->constrained()->onDelete('cascade');
            $table->foreignId('profil_pelamar_id')->constrained('profil_pelamars')->onDelete('cascade');
            
            // PERBAIKAN DISINI: Tambahkan default(now())
            $table->date('tanggal_lamar')->default(now()); 
            
            $table->string('status')->default('menunggu'); // menunggu, diterima, ditolak
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lamarans');
    }
};
