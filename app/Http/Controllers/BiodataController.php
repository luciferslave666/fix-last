<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BiodataController extends Controller
{
    // MENAMPILKAN FORM BIODATA
    public function index()
    {
        $user = Auth::user();

        // 1. Cek Role Pelamar
        if ($user->role === 'pelamar') {
            $profil = $user->profilPelamar;
            
            // Auto-create jika belum ada (Safe guard)
            if (!$profil) {
                $user->profilPelamar()->create(['user_id' => $user->id, 'nama_lengkap' => $user->name, 'no_hp' => '-', 'jenis_kelamin' => 'L', 'alamat' => '-']);
                $profil = $user->profilPelamar;
            }
            
            // Panggil View khusus Pelamar
            return view('biodata.pelamar', compact('user', 'profil'));
        } 
        
        // 2. Cek Role UMKM
        elseif ($user->role === 'umkm') {
            $profil = $user->profilUmkm;
            
            // Auto-create jika belum ada (Safe guard)
            if (!$profil) {
                $user->profilUmkm()->create(['user_id' => $user->id, 'nama_usaha' => 'Nama Usaha', 'pemilik' => $user->name, 'alamat' => '-', 'no_hp' => '-']);
                $profil = $user->profilUmkm;
            }

            // Panggil View khusus UMKM
            return view('biodata.umkm', compact('user', 'profil'));
        }

        return redirect()->route('dashboard');
    }

    // MENYIMPAN PERUBAHAN
    public function update(Request $request)
    {
        $user = Auth::user();

        if ($user->role === 'pelamar') {
            return $this->updatePelamar($request, $user);
        } elseif ($user->role === 'umkm') {
            return $this->updateUmkm($request, $user);
        }
    }

    // LOGIKA PELAMAR
private function updatePelamar($request, $user)
    {
        // Validasi kita buat 'nullable' (boleh kosong) untuk file, 
        // karena user mungkin cuma mau update nama, tidak update foto/cv.
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'no_hp'        => 'required|string',
            'jenis_kelamin'=> 'required|in:L,P',
            'alamat'       => 'required|string',
            
            // Validasi File: Maksimal 5MB (5120 KB) biar tidak gampang error
            'foto'         => 'nullable|image|max:5120', 
            'cv'           => 'nullable|mimes:pdf|max:5120',
        ]);

        // Ambil data teks
        $data = $request->only([
            'nama_lengkap', 'no_hp', 'jenis_kelamin', 
            'pendidikan_terakhir', 'skill', 'pengalaman', 'alamat'
        ]);

        // 1. LOGIKA UPLOAD FOTO
        if ($request->hasFile('foto')) {
            // Hapus yang lama kalau ada & filenya eksis
            if ($user->profilPelamar->foto && Storage::exists('public/' . $user->profilPelamar->foto)) {
                Storage::delete('public/' . $user->profilPelamar->foto);
            }
            // Simpan yang baru
            $data['foto'] = $request->file('foto')->store('foto_profil', 'public');
        }

        // 2. LOGIKA UPLOAD CV
        if ($request->hasFile('cv')) {
            // Hapus yang lama kalau ada & filenya eksis
            if ($user->profilPelamar->cv && Storage::exists('public/' . $user->profilPelamar->cv)) {
                Storage::delete('public/' . $user->profilPelamar->cv);
            }
            // Simpan yang baru
            $data['cv'] = $request->file('cv')->store('cv_pelamar', 'public');
        }

        // Update Database
        // Kita gunakan update pada relasi untuk memastikan ID yang benar
        $user->profilPelamar()->update($data);

        return redirect()->back()->with('success', 'Profil pelamar berhasil diperbarui!');
    }

    // LOGIKA UMKM
    private function updateUmkm($request, $user)
    {
        $request->validate([
            'nama_usaha' => 'required|string|max:255',
            'pemilik' => 'required|string',
            'bidang_usaha' => 'nullable|string',
            'alamat' => 'required|string',
            'no_hp' => 'required|string',
            'deskripsi' => 'nullable|string',
            'logo' => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['nama_usaha', 'pemilik', 'bidang_usaha', 'alamat', 'no_hp', 'deskripsi']);

        if ($request->hasFile('logo')) {
            if ($user->profilUmkm->logo && Storage::exists('public/' . $user->profilUmkm->logo)) {
                Storage::delete('public/' . $user->profilUmkm->logo);
            }
            $data['logo'] = $request->file('logo')->store('logo_umkm', 'public');
        }

        $user->profilUmkm->update($data);

        return redirect()->back()->with('success', 'Profil UMKM berhasil diperbarui!');
    }
}