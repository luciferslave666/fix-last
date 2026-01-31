<?php

namespace App\Http\Controllers;

use App\Models\Lowongan;
use App\Models\User;
use App\Models\Lamaran;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // 1. Ambil 3 Lowongan Terbaru yang Statusnya 'aktif'
        // Kita gunakan 'with' agar query ke relasi umkm lebih efisien (Eager Loading)
        $lowonganTerbaru = Lowongan::with('umkm')
            ->where('status', 'aktif')
            ->latest() // Urutkan dari yang paling baru
            ->take(3)  // Ambil cuma 3
            ->get();

        // 2. Ambil Statistik untuk Counter (Agar angkanya asli)
        $totalLowongan = Lowongan::where('status', 'aktif')->count();
        $totalMitra = User::where('role', 'umkm')->count();
        $totalTersalurkan = Lamaran::where('status', 'diterima')->count();

        // 3. Kirim data ke view 'welcome'
        return view('welcome', compact(
            'lowonganTerbaru', 
            'totalLowongan', 
            'totalMitra', 
            'totalTersalurkan'
        ));
    }
}