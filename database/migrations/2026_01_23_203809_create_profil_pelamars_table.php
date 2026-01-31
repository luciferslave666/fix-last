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
        Schema::create('profil_pelamars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('nama_lengkap');
            $table->string('no_hp');
            $table->enum('jenis_kelamin', ['L', 'P']); // <--- INI YANG TADI ERROR
            $table->text('alamat');
            $table->string('pendidikan_terakhir')->nullable();
            $table->string('skill')->nullable();
            $table->text('pengalaman')->nullable();
            $table->string('foto')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profil_pelamars');
    }
};
