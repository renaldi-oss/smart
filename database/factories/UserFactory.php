<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $daftar_nama = ['admin', 'user'];
        $nama = $this->faker->unique()->randomElement($daftar_nama);
        return [
            'nama' => $nama,
            'email' => $nama . '@gmail.com',
            'password' => bcrypt('1234'),
            'level' => $nama == 'admin' ? 'admin' : 'user',
        ];
    }
}
