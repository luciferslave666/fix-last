<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Lamaran;
use App\Models\Lowongan;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'pelamar') {
            // Data untuk Dashboard Pelamar
            $profilId = $user->profilPelamar->id ?? 0;
            
            $totalLamaran = Lamaran::where('profil_pelamar_id', $profilId)->count();
            $diterima = Lamaran::where('profil_pelamar_id', $profilId)->where('status', 'diterima')->count();
            $menunggu = Lamaran::where('profil_pelamar_id', $profilId)->where('status', 'menunggu')->count();
            $ditolak = Lamaran::where('profil_pelamar_id', $profilId)->where('status', 'ditolak')->count();

            // Lowongan terbaru untuk rekomendasi (opsional)
            $lowonganTerbaru = Lowongan::with('umkm')->where('status', 'aktif')->latest()->take(3)->get();

            return view('dashboard', compact('totalLamaran', 'diterima', 'menunggu', 'ditolak', 'lowonganTerbaru'));
        } 
        
        elseif ($user->role === 'umkm') {
            // Data untuk Dashboard UMKM
            $profilId = $user->profilUmkm->id ?? 0;

            $totalLowongan = Lowongan::where('profil_umkm_id', $profilId)->count();
            $lowonganAktif = Lowongan::where('profil_umkm_id', $profilId)->where('status', 'aktif')->count();
            
            // Menghitung total pelamar yang masuk ke semua lowongan milik UMKM ini
            $totalPelamar = Lowongan::where('profil_umkm_id', $profilId)
                ->withCount('lamarans')
                ->get()
                ->sum('lamarans_count');

            // Ambil pelamar terbaru yang masuk (cross relation)
            $pelamarTerbaru = Lamaran::whereHas('lowongan', function($q) use ($profilId) {
                $q->where('profil_umkm_id', $profilId);
            })->with(['pelamar', 'lowongan'])->latest()->take(5)->get();

            return view('dashboard', compact('totalLowongan', 'lowonganAktif', 'totalPelamar', 'pelamarTerbaru'));
        }

        // Fallback untuk Admin atau error
        return view('dashboard');
    }
}