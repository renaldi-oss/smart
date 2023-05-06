<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class KriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arr_values = [
            ['Ph Air', 60],
            ['Suhu', 50],
            ['Oksigen Terlarut', 50],
            ['Kandungan Amoniak', 50],
            ['Kandungan Nitrit', 50],
            ['Kecerahan Air', 50]
        ];

        foreach ($arr_values as $value) {
            \App\Models\Kriteria::create([
                'nama' => $value[0],
                'bobot' => $value[1],
            ]);
        }
    }
}
