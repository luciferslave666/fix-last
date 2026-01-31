<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BiodataController extends Controller
{
    // Menampilkan Form Edit Profil
public function index()
    {
        $user = Auth::user();

        // --- TAMBAHKAN KODE INI SEMENTARA ---
        // Kita cek apa isi role dan relasinya
        // dd() akan menghentikan program dan menampilkan data
        // dd([
        //     'role_user' => $user->role,
        //     'apakah_pelamar' => $user->role === 'pelamar',
        //     'apakah_umkm' => $user->role === 'umkm',
        //     'data_profil_pelamar' => $user->profilPelamar,
        //     'data_profil_umkm' => $user->profilUmkm
        // ]);
        // -------------------------------------

        if ($user->role === 'pelamar') {
            $profil = $user->profilPelamar;
            // Pencegahan error jika profil belum terbuat (Data User Lama)
            if (!$profil) {
                return "Error: Data Profil Pelamar tidak ditemukan di database. Coba Register user baru.";
            }
            return view('biodata.pelamar', compact('user', 'profil'));
        } 
        
        elseif ($user->role === 'umkm') {
            $profil = $user->profilUmkm;
             // Pencegahan error jika profil belum terbuat
            if (!$profil) {
                return "Error: Data Profil UMKM tidak ditemukan di database. Coba Register user baru.";
            }
            return view('biodata.umkm', compact('user', 'profil'));
        }

        // Jika sampai sini, berarti role tidak dikenali
        return "Error: Role User Anda terbaca sebagai: " . $user->role . ". Seharusnya 'pelamar' atau 'umkm'.";
        
        // return redirect()->route('dashboard'); // <-- Komentar dulu baris ini
    }

    // Menyimpan Perubahan Profil
    public function update(Request $request)
    {
        $user = Auth::user();

        if ($user->role === 'pelamar') {
            return $this->updatePelamar($request, $user);
        } elseif ($user->role === 'umkm') {
            return $this->updateUmkm($request, $user);
        }
    }

    // Logika Khusus Update Pelamar (Termasuk Upload CV & Foto)
    private function updatePelamar($request, $user)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'no_hp' => 'required|string',
            'pendidikan_terakhir' => 'required|string',
            'alamat' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'cv' => 'nullable|mimes:pdf|max:2048', // Sesuai UC-05 Upload Dokumen
        ]);

        $data = $request->only(['nama_lengkap', 'nik', 'tempat_lahir', 'tanggal_lahir', 'alamat', 'no_hp', 'pendidikan_terakhir', 'pengalaman_kerja']);

        // Handle Upload Foto
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($user->profilPelamar->foto) {
                Storage::delete($user->profilPelamar->foto);
            }
            $data['foto'] = $request->file('foto')->store('foto_profil', 'public');
        }

        // Handle Upload CV (UC-05)
        if ($request->hasFile('cv')) {
            if ($user->profilPelamar->cv) {
                Storage::delete($user->profilPelamar->cv);
            }
            $data['cv'] = $request->file('cv')->store('dokumen_cv', 'public');
        }

        $user->profilPelamar->update($data);

        return redirect()->back()->with('success', 'Profil pelamar berhasil diperbarui!');
    }

    // Logika Khusus Update UMKM
    private function updateUmkm($request, $user)
    {
        $request->validate([
            'nama_usaha' => 'required|string|max:255',
            'pemilik' => 'required|string',
            'bidang_usaha' => 'required|string',
            'alamat' => 'required|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->only(['nama_usaha', 'pemilik', 'bidang_usaha', 'alamat', 'no_hp', 'deskripsi']);

        // Handle Upload Logo
        if ($request->hasFile('logo')) {
            if ($user->profilUmkm->logo) {
                Storage::delete($user->profilUmkm->logo);
            }
            $data['logo'] = $request->file('logo')->store('logo_umkm', 'public');
        }

        $user->profilUmkm->update($data);

        return redirect()->back()->with('success', 'Profil UMKM berhasil diperbarui!');
    }
}