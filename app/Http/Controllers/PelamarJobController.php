<?php

namespace App\Http\Controllers;

use App\Models\Lowongan;
use App\Models\Lamaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PelamarJobController extends Controller
{
    // UC-06 & UC-07: Cari dan Filter Lowongan
    public function index(Request $request)
    {
        // Query Dasar: Hanya tampilkan lowongan yang statusnya 'aktif'
        $query = Lowongan::with('umkm')->where('status', 'aktif');

        // Logic Pencarian (Search)
        if ($request->filled('search')) {
            $query->where('judul_pekerjaan', 'like', '%' . $request->search . '%')
                  ->orWhere('lokasi', 'like', '%' . $request->search . '%');
        }

        // Logic Filter Tipe Pekerjaan (Part-time / Harian)
        if ($request->filled('tipe')) {
            $query->where('jenis_pekerjaan', $request->tipe);
        }

        // Ambil data terbaru
        $lowongans = $query->latest()->get();

        return view('pelamar.lowongan.index', compact('lowongans'));
    }

    // Menampilkan Detail Lowongan
    public function show(Lowongan $lowongan)
    {
        // Cek apakah pelamar sudah pernah melamar lowongan ini
        $sudahMelamar = false;
        if (Auth::check() && Auth::user()->role === 'pelamar') {
            $sudahMelamar = Lamaran::where('lowongan_id', $lowongan->id)
                ->where('profil_pelamar_id', Auth::user()->profilPelamar->id)
                ->exists();
        }

        return view('pelamar.lowongan.show', compact('lowongan', 'sudahMelamar'));
    }

    // UC-08: Proses Lamar Pekerjaan
    public function store(Request $request, Lowongan $lowongan)
    {
        $user = Auth::user();

        // 1. Validasi Role
        if ($user->role !== 'pelamar') {
            return redirect()->back()->with('error', 'Hanya pelamar yang bisa melamar kerja.');
        }

        // 2. Cek Syarat (Precondition UC-08): Harus sudah upload CV
        if (!$user->profilPelamar->cv) {
            return redirect()->route('biodata.index')
                ->with('error', 'Gagal melamar! Anda wajib mengunggah CV terlebih dahulu di menu Profil Saya.');
        }

        // 3. Cek apakah sudah pernah melamar (Double submit protection)
        $exists = Lamaran::where('lowongan_id', $lowongan->id)
            ->where('profil_pelamar_id', $user->profilPelamar->id)
            ->exists();

        if ($exists) {
            return redirect()->back()->with('error', 'Anda sudah melamar pekerjaan ini sebelumnya.');
        }

        // 4. Simpan Lamaran (Status default: menunggu)
        Lamaran::create([
            'lowongan_id' => $lowongan->id,
            'profil_pelamar_id' => $user->profilPelamar->id,
            'status' => 'menunggu', // Sesuai UC-08 Postcondition
            'tanggal_lamar' => now(),
        ]);

        return redirect()->route('lamaran.history')->with('success', 'Lamaran berhasil dikirim! Tunggu kabar dari UMKM.');
    }

    // UC-09: Melihat Status Lamaran (History)
    public function history()
    {
        $user = Auth::user();

        if ($user->role !== 'pelamar') {
            abort(403);
        }

        // Ambil data lamaran beserta info lowongannya
        $lamarans = Lamaran::with(['lowongan.umkm'])
            ->where('profil_pelamar_id', $user->profilPelamar->id)
            ->latest()
            ->get();

        return view('pelamar.lamaran.history', compact('lamarans'));
    }
}