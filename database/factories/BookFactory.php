<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'judul' => $this->faker->sentence(),
            'pengarang' => $this->faker->name(),
            'penerbit' => $this->faker->word(),
            'tahun_terbit' => $this->faker->numberBetween(2000, 2022),
            'jumlah_buku' => $this->faker->randomNumber(2, false),
            'deskripsi' => $this->faker->paragraph(),
            'gambar' => 'default.jpg'
        ];
    }
}
