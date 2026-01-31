<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfilUmkm extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // Kebalikan Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Satu UMKM bisa buka banyak lowongan
    public function lowongans()
    {
        return $this->hasMany(Lowongan::class, 'profil_umkm_id');
    }
}