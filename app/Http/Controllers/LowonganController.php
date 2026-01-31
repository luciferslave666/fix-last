<?php

namespace App\Http\Controllers;

use App\Models\Lowongan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LowonganController extends Controller
{
    // UC-15: Melihat Daftar Lowongan (Milik Sendiri)
    public function index()
    {
        // Pastikan user adalah UMKM
        if (Auth::user()->role !== 'umkm') {
            abort(403, 'Akses Ditolak. Halaman ini khusus UMKM.');
        }

        // Ambil lowongan milik UMKM yang sedang login
        $lowongans = Auth::user()->profilUmkm->lowongans()->latest()->get();

        return view('lowongan.index', compact('lowongans'));
    }

    // Menampilkan Form Buat Lowongan
    public function create()
    {
        if (Auth::user()->role !== 'umkm') {
            abort(403);
        }
        return view('lowongan.create');
    }

    // UC-18: Simpan Lowongan Baru
    public function store(Request $request)
    {
        // Validasi Input sesuai Class Diagram (Hal 38)
        $request->validate([
            'judul_pekerjaan' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'jenis_pekerjaan' => 'required|string', // Part-time / Harian
            'gaji' => 'required|numeric|min:0',
            'lokasi' => 'required|string',
            'jam_kerja' => 'required|string',
            'jumlah_kebutuhan' => 'required|integer|min:1',
        ]);

        // Simpan ke database lewat relasi profilUmkm
        Auth::user()->profilUmkm->lowongans()->create([
            'judul_pekerjaan' => $request->judul_pekerjaan,
            'deskripsi' => $request->deskripsi,
            'jenis_pekerjaan' => $request->jenis_pekerjaan,
            'gaji' => $request->gaji,
            'lokasi' => $request->lokasi,
            'jam_kerja' => $request->jam_kerja,
            'jumlah_kebutuhan' => $request->jumlah_kebutuhan,
            'status' => 'aktif',
            'tanggal_posting' => now(), // Otomatis hari ini
        ]);

        return redirect()->route('lowongan.index')->with('success', 'Lowongan berhasil diterbitkan!');
    }

    // Menampilkan Form Edit
    public function edit(Lowongan $lowongan)
    {
        // Keamanan: Pastikan yang edit adalah pemilik lowongan itu
        if ($lowongan->profil_umkm_id !== Auth::user()->profilUmkm->id) {
            abort(403);
        }

        return view('lowongan.edit', compact('lowongan'));
    }

    // UC-16: Update Lowongan
    public function update(Request $request, Lowongan $lowongan)
    {
        if ($lowongan->profil_umkm_id !== Auth::user()->profilUmkm->id) {
            abort(403);
        }

        $request->validate([
            'judul_pekerjaan' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'jenis_pekerjaan' => 'required|string',
            'gaji' => 'required|numeric',
            'lokasi' => 'required|string',
            'jam_kerja' => 'required|string',
            'jumlah_kebutuhan' => 'required|integer',
            'status' => 'required|in:aktif,tutup',
        ]);

        $lowongan->update($request->all());

        return redirect()->route('lowongan.index')->with('success', 'Lowongan berhasil diperbarui!');
    }

    // UC-17: Hapus Lowongan
    public function destroy(Lowongan $lowongan)
    {
        if ($lowongan->profil_umkm_id !== Auth::user()->profilUmkm->id) {
            abort(403);
        }

        $lowongan->delete();

        return redirect()->route('lowongan.index')->with('success', 'Lowongan dihapus.');
    }
}