<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\ProfilPelamar;
use App\Models\ProfilUmkm;
use App\Mail\OtpMail; // <--- WAJIB IMPORT MAIL KITA
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail; // <--- WAJIB IMPORT FACADE MAIL
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Menampilkan halaman registrasi.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Menangani proses pendaftaran user baru.
     */
    public function store(Request $request): RedirectResponse
    {
        // 1. VALIDASI DATA
        // Kita validasi data akun wajib & data profil opsional (nullable)
        $request->validate([
            // Data Akun Utama
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'string', 'in:pelamar,umkm'],
            
            // Data Profil Tambahan (Step 3) - Dibuat nullable agar fleksibel
            'no_hp' => ['nullable', 'string', 'max:20'],
            'alamat' => ['nullable', 'string'],
            'nama_usaha' => ['nullable', 'string', 'max:255'],
            'bidang_usaha' => ['nullable', 'string', 'max:255'],
        ]);

        // 2. BUAT USER UTAMA
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            // Kita belum set email_verified_at karena butuh OTP dulu
        ]);

        // 3. SIMPAN PROFIL DETAIL (SESUAI ROLE)
        // Disini kita ambil data dari form Step 3 agar tersimpan ke database
        
        if ($user->role === 'pelamar') {
            
            $user->profilPelamar()->create([
                'nama_lengkap' => $user->name,
                // Ambil data dari Request, jika kosong isi '-'
                'no_hp' => $request->no_hp ?? '-', 
                'alamat' => $request->alamat ?? '-',
                'jenis_kelamin' => $request->jenis_kelamin ?? 'L',
                'pendidikan_terakhir' => $request->pendidikan_terakhir,
                'skill' => $request->skill,
                'pengalaman' => $request->pengalaman,
                // Kolom file biarkan null dulu
                'cv' => null,
                'foto' => null,
            ]);

        } elseif ($user->role === 'umkm') {
            
            $user->profilUmkm()->create([
                // Jika nama usaha tidak diisi, pakai nama user + Store
                'nama_usaha' => $request->nama_usaha ?? ($user->name . ' Store'),
                'pemilik' => $user->name,
                'alamat' => $request->alamat ?? '-',
                'no_hp' => $request->no_hp ?? '-',
                'bidang_usaha' => $request->bidang_usaha,
                'deskripsi' => $request->deskripsi,
                'logo' => null,
            ]);
        }

        // 4. PROSES OTP (One Time Password)
        
        // Generate kode acak 6 digit
        $otp = rand(100000, 999999);
        
        // Simpan kode ke tabel users
        $user->otp_code = $otp;
        $user->save();

        // Kirim Email OTP
        try {
            Mail::to($user->email)->send(new OtpMail($otp));
        } catch (\Exception $e) {
            // Jika internet mati/gagal kirim, biarkan lanjut agar tidak error 500
            // Log::error("Gagal kirim email: " . $e->getMessage());
        }

        event(new Registered($user));

        // 5. LOGIN OTOMATIS
        Auth::login($user);

        // 6. REDIRECT KE HALAMAN VERIFIKASI (BUKAN DASHBOARD)
        return redirect()->route('otp.verify');
    }

    /**
     * Cek apakah email sudah terdaftar (Untuk AJAX di Frontend).
     * Mencegah loading stuck saat registrasi.
     */
    public function checkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $exists = User::where('email', $request->email)->exists();

        return response()->json(['exists' => $exists]);
    }
}