<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lamaran extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // Lamaran tertuju ke satu lowongan
    public function lowongan()
    {
        return $this->belongsTo(Lowongan::class, 'lowongan_id');
    }

    // Lamaran dikirim oleh satu pelamar
    public function pelamar()
    {
        return $this->belongsTo(ProfilPelamar::class, 'profil_pelamar_id');
    }
}