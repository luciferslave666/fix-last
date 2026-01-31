<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail; // Uncomment jika ingin pakai fitur verifikasi email bawaan
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', // Nama User (untuk login)
        'email',
        'password',
        'role', // PENTING: Role harus ada disini
        'otp_code',
        'email_verified_at', // Tambahkan ini agar bisa diupdate manual
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // --- TAMBAHKAN RELASI INI ---

    // Relasi ke Profil Pelamar
    public function profilPelamar(): HasOne
    {
        return $this->hasOne(ProfilPelamar::class, 'user_id');
    }

    // Relasi ke Profil UMKM
    public function profilUmkm(): HasOne
    {
        return $this->hasOne(ProfilUmkm::class, 'user_id');
    }
}