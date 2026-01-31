<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\ProfilPelamar;
use App\Models\ProfilUmkm;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Facades\Mail;
use App\Mail\OtpMail;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
public function store(Request $request): RedirectResponse
    {
        // 1. Validasi Dasar
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'in:pelamar,umkm'],
            'no_hp' => ['required', 'string', 'max:15'],
            'alamat' => ['required', 'string'],
        ];

        // Validasi Tambahan Berdasarkan Role
        if ($request->role == 'pelamar') {
            $rules['pendidikan_terakhir'] = ['required', 'string'];
            $rules['skill'] = ['required', 'string'];
            $rules['jenis_kelamin'] = ['required', 'in:L,P'];
        } elseif ($request->role == 'umkm') {
            $rules['nama_usaha'] = ['required', 'string'];
            $rules['bidang_usaha'] = ['required', 'string'];
        }

        $request->validate($rules);

        $otpCode = rand(100000, 999999);

        // 2. Buat User Login
        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'otp_code' => $otpCode,
        ]);

        // 3. Simpan Data Detail ke Tabel Profil
        if ($request->role === 'pelamar') {
            ProfilPelamar::create([
                'user_id' => $user->id,
                'nama_lengkap' => $request->name,
                'no_hp' => $request->no_hp,
                'alamat' => $request->alamat,
                'pendidikan_terakhir' => $request->pendidikan_terakhir,
                'skill' => $request->skill,
                'jenis_kelamin' => $request->jenis_kelamin,
                'pengalaman' => $request->pengalaman, // Opsional
            ]);
        } elseif ($request->role === 'umkm') {
            ProfilUmkm::create([
                'user_id' => $user->id,
                'nama_usaha' => $request->nama_usaha,
                'pemilik' => $request->name,
                'alamat' => $request->alamat,
                'no_hp' => $request->no_hp,
                'bidang_usaha' => $request->bidang_usaha,
                'deskripsi' => $request->deskripsi, // Opsional
            ]);
        }

        // 4. Kirim Email OTP
        try {
            Mail::to($user->email)->send(new OtpMail($otpCode));
        } catch (\Exception $e) {
            // Log error
        }

        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('otp.verify');
    }
}
