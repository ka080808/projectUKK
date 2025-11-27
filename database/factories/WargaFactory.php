<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Warga>
 */
class WargaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nik' => $this->faker->unique()->numerify('################'),
            'no_kk' => $this->faker->unique()->numerify('################'),
            'nama_lengkap' => $this->faker->name(),
            'alamat' => $this->faker->address(),
            'rt' => $this->faker->numberBetween(1, 20),
            'rw' => $this->faker->numberBetween(1, 15),
            'jenis_kelamin' => $this->faker->randomElement(['Laki-laki', 'Perempuan']),
            'tempat_lahir' => $this->faker->city(),
            'tanggal_lahir' => $this->faker->dateTimeBetween('-80 years', '-5 years'),
            'no_telp' => $this->faker->phoneNumber(),
            'agama' => $this->faker->randomElement(['Islam', 'Kristen', 'Hindu', 'Buddha', 'Kong Hu Cu']),
        ];
    }
}
