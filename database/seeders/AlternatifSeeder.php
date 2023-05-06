<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AlternatifSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arr_values = ['Papuyu', 'Haruan', 'Patin', 'Saluang', 'Sapat', 'Sapat Siam', 'Lais', 'Nila', 'Lele', 'Jelawat', 'Gurame', 'Mujair', 'Mas', 'Bawal'];
        foreach ($arr_values as $values) {
            \App\Models\Alternatif::create([
                'nama' => $values,
            ]);
        }
    }
}
