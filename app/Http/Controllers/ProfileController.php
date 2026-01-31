<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
/**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();

        // 1. Validasi Dasar (Bawaan Breeze)
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        // 2. Update Data Tambahan Sesuai Role
        if ($user->role === 'pelamar') {
            
            // Validasi Input Tambahan
            $request->validate([
                'no_hp' => 'nullable|string|max:15',
                'pendidikan_terakhir' => 'nullable|string',
                'alamat' => 'nullable|string',
                'cv' => 'nullable|mimes:pdf|max:2048', // Maksimal 2MB
            ]);

            $dataPelamar = [
                'nama_lengkap' => $request->name, // Sinkronkan nama user dgn profil
                'no_hp' => $request->no_hp,
                'pendidikan_terakhir' => $request->pendidikan_terakhir,
                'alamat' => $request->alamat,
            ];

            // Logika Ganti CV
            if ($request->hasFile('cv')) {
                // Hapus CV lama jika ada
                if ($user->profilPelamar->cv && \Illuminate\Support\Facades\Storage::exists('public/' . $user->profilPelamar->cv)) {
                    \Illuminate\Support\Facades\Storage::delete('public/' . $user->profilPelamar->cv);
                }
                
                // Simpan CV baru
                $path = $request->file('cv')->store('cv_pelamar', 'public');
                $dataPelamar['cv'] = $path;
            }

            // Simpan ke tabel profil_pelamars
            $user->profilPelamar()->update($dataPelamar);

        } elseif ($user->role === 'umkm') {
            
            $request->validate([
                'nama_usaha' => 'required|string',
                'alamat' => 'required|string',
                'no_hp' => 'required|string',
            ]);

            $user->profilUmkm()->update([
                'pemilik' => $request->name,
                'nama_usaha' => $request->nama_usaha,
                'alamat' => $request->alamat,
                'no_hp' => $request->no_hp,
            ]);
        }

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
