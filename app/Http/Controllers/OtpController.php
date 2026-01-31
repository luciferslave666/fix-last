<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OtpController extends Controller
{
    // Menampilkan Form Input OTP
    public function show()
    {
        return view('auth.verify-otp');
    }

    // Proses Cek Kode
    public function verify(Request $request)
    {
        $request->validate([
            'otp' => 'required|numeric',
        ]);

        $user = Auth::user();

        // Cek apakah kode sama dengan di database
        if ($request->otp == $user->otp_code) {
            
            // Jika benar, update status verified
            $user->email_verified_at = now();
            $user->otp_code = null; // Hapus OTP agar tidak bisa dipakai lagi
            $user->save();

            return redirect()->route('dashboard')->with('success', 'Akun berhasil diverifikasi!');
        }

        // Jika salah
        return back()->withErrors(['otp' => 'Kode OTP salah. Silakan coba lagi.']);
    }
}