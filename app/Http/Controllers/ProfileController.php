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
     * Menampilkan form edit profil akun (Nama & Email).
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Menyimpan perubahan akun (Nama & Email).
     */
public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        // Ambil user saat ini
        $user = $request->user();

        // Isi data user (Name & Email) dari input yang sudah divalidasi
        $user->fill($request->validated());

        // Jika email berubah, reset verifikasi email
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        // Simpan ke tabel USERS saja
        $user->save();

        // Redirect kembali dengan pesan sukses
        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Menghapus akun.
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