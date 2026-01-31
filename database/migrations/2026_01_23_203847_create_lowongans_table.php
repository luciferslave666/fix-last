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
        Schema::create('lowongans', function (Blueprint $table) {
            $table->id();
            // Pastikan foreign key ini mengarah ke tabel profil_umkms
            $table->foreignId('profil_umkm_id')->constrained('profil_umkms')->onDelete('cascade');
            
            $table->string('judul_pekerjaan');
            $table->string('jenis_pekerjaan');
            $table->bigInteger('gaji'); // Ganti integer ke bigInteger untuk gaji > 2 Milyar (jaga-jaga)
            $table->string('lokasi');
            $table->string('jam_kerja');
            $table->integer('jumlah_kebutuhan');
            $table->text('deskripsi');
            $table->string('status')->default('aktif'); 
            
            // PERBAIKAN DISINI: Tambahkan default(now())
            $table->date('tanggal_posting')->default(now()); 
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lowongans');
    }
};
