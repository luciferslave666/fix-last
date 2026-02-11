<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfilPelamar extends Model
{
    use HasFactory;

    protected $guarded = ['id']; // Semua kolom bisa diisi kecuali ID

    // Kebalikan Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Satu pelamar bisa punya banyak lamaran
    public function lamarans()
    {
        return $this->hasMany(Lamaran::class, 'profil_pelamar_id');
    }
}