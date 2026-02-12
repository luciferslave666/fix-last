<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Lowongan;

class LowonganFactory extends Factory
{
    protected $model = Lowongan::class;

    public function definition(): array
    {
        return [
            'judul_pekerjaan' => $this->faker->jobTitle(),
            'jenis_pekerjaan' => $this->faker->randomElement(['Full-time', 'Part-time', 'Harian']),
            'gaji' => $this->faker->numberBetween(1000000, 10000000),
            'lokasi' => $this->faker->city(),
            'jam_kerja' => '08:00 - 17:00',
            'jumlah_kebutuhan' => $this->faker->numberBetween(1, 5),
            'deskripsi' => $this->faker->paragraph(),
            'status' => 'aktif',
            'tanggal_posting' => $this->faker->dateTimeBetween('-1 month', 'now'),
        ];
    }
}
