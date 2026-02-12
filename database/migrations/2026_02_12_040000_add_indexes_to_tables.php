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
        Schema::table('users', function (Blueprint $table) {
            $table->index('role');
        });

        Schema::table('lowongans', function (Blueprint $table) {
            $table->index('status');
            $table->index(['status', 'created_at']); // Compound index for filtering + sorting
        });

        Schema::table('lamarans', function (Blueprint $table) {
            $table->index('status');
            $table->index(['profil_pelamar_id', 'status']); // For history lookup
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex(['role']);
        });

        Schema::table('lowongans', function (Blueprint $table) {
            $table->dropIndex(['status']);
            $table->dropIndex(['status', 'created_at']);
        });

        Schema::table('lamarans', function (Blueprint $table) {
            $table->dropIndex(['status']);
            $table->dropIndex(['profil_pelamar_id', 'status']);
        });
    }
};
