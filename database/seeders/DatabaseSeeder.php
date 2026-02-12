<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\ProfilPelamar;
use App\Models\ProfilUmkm;
use App\Models\Lowongan;
use App\Models\Lamaran;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // ==========================================
        // 1. AKUN UTAMA (Supaya Login Gampang)
        // ==========================================
        
        // Akun Pelamar Utama
        $pelamarUtama = User::factory()->create([
            'name' => 'Sendi Dwi Putra',
            'email' => 'sendi@student.unikom.ac.id',
            'role' => 'pelamar',
        ]);
        
        ProfilPelamar::factory()->create([
            'user_id' => $pelamarUtama->id,
            'nama_lengkap' => 'Sendi Dwi Putra',
            'no_hp' => '08123456789',
            'jenis_kelamin' => 'L',
            'skill' => 'Barista, Driver, Admin',
        ]);

        // Akun UMKM Utama
        $umkmUtama = User::factory()->create([
            'name' => 'Soto Betawi Asli',
            'email' => 'soto@betawi.com',
            'role' => 'umkm',
        ]);

        $profilUmkmUtama = ProfilUmkm::factory()->create([
            'user_id' => $umkmUtama->id,
            'nama_usaha' => 'Soto Betawi Asli',
        ]);

        Lowongan::factory()->count(3)->create([
            'profil_umkm_id' => $profilUmkmUtama->id,
        ]);

        // ==========================================
        // 2. GENERATE DUMMY MASSAL
        // ==========================================
        
        // Buat 50 Akun Pelamar
        $dummyPelamars = User::factory()->count(50)->create(['role' => 'pelamar']);
        
        foreach ($dummyPelamars as $p) {
            ProfilPelamar::factory()->create(['user_id' => $p->id]);
        }

        // Buat 20 Akun UMKM
        $dummyUmkms = User::factory()->count(20)->create(['role' => 'umkm']);
        
        foreach ($dummyUmkms as $u) {
            $profil = ProfilUmkm::factory()->create(['user_id' => $u->id]);
            
            // Setiap UMKM posting 2-5 Lowongan
            Lowongan::factory()->count(rand(2, 5))->create([
                'profil_umkm_id' => $profil->id
            ]);
        }

        // ==========================================
        // 3. SIMULASI LAMARAN KERJA
        // ==========================================
        
        // Ambil semua lowongan dan id profil pelamar
        $allLowongans = Lowongan::all();
        $allProfilPelamars = ProfilPelamar::all();

        // Acak lowongan dan pelamar agar terjadi lamaran
        foreach ($allLowongans as $loker) {
            // Ambil 0-5 pelamar random untuk setiap lowongan
            $applicants = $allProfilPelamars->random(rand(0, 5));
            
            foreach ($applicants as $applicant) {
                // Cek agar tidak duplikat (meski kemungkinan kecil di seeder)
                $exists = Lamaran::where('lowongan_id', $loker->id)
                    ->where('profil_pelamar_id', $applicant->id)
                    ->exists();

                if (!$exists) {
                    Lamaran::create([
                        'lowongan_id' => $loker->id,
                        'profil_pelamar_id' => $applicant->id,
                        'status' => fake()->randomElement(['menunggu', 'diterima', 'ditolak']),
                        'tanggal_lamar' => fake()->dateTimeBetween('-1 month', 'now'),
                    ]);
                }
            }
        }
    }
}