<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\ProfilUmkm;

class ProfilUmkmFactory extends Factory
{
    protected $model = ProfilUmkm::class;

    public function definition(): array
    {
        return [
            'nama_usaha' => $this->faker->company(),
            'pemilik' => $this->faker->name(),
            'bidang_usaha' => $this->faker->randomElement(['Kuliner', 'Retail', 'Jasa', 'Fashion', 'Teknologi']),
            'alamat' => $this->faker->address(),
            'no_hp' => $this->faker->phoneNumber(),
            'deskripsi' => $this->faker->paragraph(),
            // 'logo' left null
        ];
    }
}
