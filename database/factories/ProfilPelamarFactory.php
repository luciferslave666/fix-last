<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\ProfilPelamar;

class ProfilPelamarFactory extends Factory
{
    protected $model = ProfilPelamar::class;

    public function definition(): array
    {
        return [
            'nama_lengkap' => $this->faker->name(),
            'no_hp' => $this->faker->phoneNumber(),
            'jenis_kelamin' => $this->faker->randomElement(['L', 'P']),
            'alamat' => $this->faker->address(),
            'pendidikan_terakhir' => $this->faker->randomElement(['SMA', 'SMK', 'D3', 'S1', 'S2']),
            'skill' => $this->faker->words(3, true),
            'pengalaman' => $this->faker->sentence(),
            // 'foto' and 'cv' left null intentionally or could reference a placeholder
        ];
    }
}
