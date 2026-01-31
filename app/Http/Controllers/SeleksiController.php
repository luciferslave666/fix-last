<?php

namespace App\Http\Controllers;

use App\Models\Lamaran;
use App\Models\Lowongan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SeleksiController extends Controller
{
    // Menampilkan Daftar Pelamar untuk Lowongan Tertentu
    public function index(Lowongan $lowongan)
    {
        // Keamanan: Pastikan UMKM yang login adalah pemilik lowongan ini
        if ($lowongan->profil_umkm_id !== Auth::user()->profilUmkm->id) {
            abort(403, 'Anda tidak berhak mengakses data ini.');
        }

        // Ambil semua lamaran untuk lowongan ini, urutkan dari terbaru
        $pelamars = $lowongan->lamarans()->with('pelamar')->latest()->get();

        return view('seleksi.index', compact('lowongan', 'pelamars'));
    }

    // Menampilkan Detail Pelamar (Preview CV & Tombol Aksi)
    public function show($id)
    {
        $lamaran = Lamaran::with(['pelamar', 'lowongan'])->findOrFail($id);

        // Keamanan: Cek kepemilikan
        if ($lamaran->lowongan->profil_umkm_id !== Auth::user()->profilUmkm->id) {
            abort(403);
        }

        return view('seleksi.show', compact('lamaran'));
    }

    // Memproses Keputusan (Terima / Tolak)
    public function update(Request $request, $id)
    {
        $lamaran = Lamaran::with('lowongan')->findOrFail($id);

        // Keamanan
        if ($lamaran->lowongan->profil_umkm_id !== Auth::user()->profilUmkm->id) {
            abort(403);
        }

        $request->validate([
            'status' => 'required|in:diterima,ditolak',
        ]);

        $lamaran->update([
            'status' => $request->status,
            'updated_at' => now(), // Catat waktu keputusan
        ]);

        return redirect()->route('seleksi.index', $lamaran->lowongan_id)
            ->with('success', 'Status pelamar berhasil diubah menjadi: ' . ucfirst($request->status));
    }
}