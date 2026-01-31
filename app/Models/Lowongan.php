<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lowongan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // Lowongan dimiliki oleh satu UMKM
    public function umkm()
    {
        return $this->belongsTo(ProfilUmkm::class, 'profil_umkm_id');
    }

    // Satu lowongan bisa dilamar banyak orang
    public function lamarans()
    {
        return $this->hasMany(Lamaran::class, 'lowongan_id');
    }
}