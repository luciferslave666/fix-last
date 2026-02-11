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
        // 1. AKUN PELAMAR (Sendi - Mahasiswa)
        // ==========================================
        // PERBAIKAN: Menghapus 'name' dari User::create
        $pelamar = User::create([
            'name' => 'Sendi Dwi Putra',
            'email' => 'sendi@student.unikom.ac.id',
            'password' => Hash::make('password'),
            'role' => 'pelamar',
            'email_verified_at' => now(),
            'otp_code' => null,
        ]);

        ProfilPelamar::create([
            'user_id' => $pelamar->id,
            'nama_lengkap' => 'Sendi Dwi Putra', // Nama disimpan di sini
            'no_hp' => '08123456789',
            'jenis_kelamin' => 'L',
            'alamat' => 'Jl. Dipati Ukur No. 112, Bandung',
            'pendidikan_terakhir' => 'S1 Teknik Informatika (Semester 5)',
            'skill' => 'Barista, Microsoft Office, Komunikasi, Stir Mobil',
            'pengalaman' => 'Pernah bekerja part-time di kedai kopi selama 1 tahun.',
        ]);

        // ==========================================
        // 2. AKUN UMKM 1 (Soto Betawi Asli)
        // ==========================================
        $umkm1 = User::create([
            'name' => 'Soto Betawi Asli',
            'email' => 'soto@betawi.com',
            'password' => Hash::make('password'),
            'role' => 'umkm',
            'email_verified_at' => now(),
        ]);

        $profilUmkm1 = ProfilUmkm::create([
            'user_id' => $umkm1->id,
            'nama_usaha' => 'Soto Betawi Asli', // Nama Usaha di sini
            'pemilik' => 'Bapak Haji Sobari',
            'bidang_usaha' => 'Kuliner',
            'alamat' => 'Jl. Dago No. 88, Bandung',
            'no_hp' => '08987654321',
            'deskripsi' => 'Warung soto betawi legendaris di Bandung sejak 1990. Selalu ramai pengunjung setiap jam makan siang.',
        ]);

        // Buat Lowongan untuk UMKM 1
        $loker1 = Lowongan::create([
            'profil_umkm_id' => $profilUmkm1->id,
            'judul_pekerjaan' => 'Part-time Waiter/Waitress',
            'jenis_pekerjaan' => 'Part Time',
            'gaji' => 1500000,
            'lokasi' => 'Bandung, Dago',
            'jam_kerja' => '17.00 - 22.00 WIB',
            'jumlah_kebutuhan' => 2,
            'deskripsi' => 'Kami membutuhkan pelayan paruh waktu untuk shift malam. Tugas meliputi mencatat pesanan, mengantar makanan, dan menjaga kebersihan area makan.',
            'status' => 'aktif',
        ]);

        Lowongan::create([
            'profil_umkm_id' => $profilUmkm1->id,
            'judul_pekerjaan' => 'Cuci Piring (Dishwasher)',
            'jenis_pekerjaan' => 'Part Time',
            'gaji' => 1200000,
            'lokasi' => 'Bandung, Dago',
            'jam_kerja' => '18.00 - 23.00 WIB',
            'jumlah_kebutuhan' => 1,
            'deskripsi' => 'Dicari tenaga cuci piring yang gesit dan bersih. Makan malam ditanggung.',
            'status' => 'aktif',
        ]);

        // ==========================================
        // 3. AKUN UMKM 2 (Kopi Senja)
        // ==========================================
        $umkm2 = User::create([
            'email' => 'admin@kopisenja.com',
            'password' => Hash::make('password'),
            'role' => 'umkm',
            'email_verified_at' => now(),
        ]);

        $profilUmkm2 = ProfilUmkm::create([
            'user_id' => $umkm2->id,
            'nama_usaha' => 'Kopi Senja Community',
            'pemilik' => 'Mas Dimas',
            'bidang_usaha' => 'Kafe & F&B',
            'alamat' => 'Jl. Riau No. 45, Bandung',
            'no_hp' => '0857123123',
            'deskripsi' => 'Tempat nongkrong anak muda dengan konsep industrial garden.',
        ]);

        // Buat Lowongan untuk UMKM 2
        Lowongan::create([
            'profil_umkm_id' => $profilUmkm2->id,
            'judul_pekerjaan' => 'Admin Sosial Media',
            'jenis_pekerjaan' => 'Freelance',
            'gaji' => 1000000,
            'lokasi' => 'Remote / WFH',
            'jam_kerja' => 'Fleksibel',
            'jumlah_kebutuhan' => 1,
            'deskripsi' => 'Dicari mahasiswa kreatif untuk mengelola Instagram & TikTok kami. Bisa kerja dari rumah, yang penting konten beres.',
            'status' => 'aktif',
        ]);

        // ==========================================
        // 4. SIMULASI LAMARAN
        // ==========================================
        
        // Sendi melamar jadi Waiter di Soto Betawi
        Lamaran::create([
            'lowongan_id' => $loker1->id,
            'profil_pelamar_id' => $pelamar->profilPelamar->id,
            'status' => 'menunggu', 
        ]);
    }
}