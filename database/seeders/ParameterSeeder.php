<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ParameterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kriteria_ = \App\Models\Kriteria::all();
        $arr_values = [
            [['Ph air < 5', 25], ['Ph air 5 - 8', 50], ['Ph air > 8', 25]],
            [['< 28°C', 50], ['28-31°C', 35], ['> 31°C', 15]],
            [['> 3 mg/l', 70], ['< 3 mg/l', 30]],
            [['< 0,1 mg/l', 70], ['> 0,1 mg/l', 30]],
            [['< 1 mg/l', 70], ['> 1 mg/l', 30]],
            [['> 20 cm', 70], ['< 20 cm', 30]],
        ];

        foreach ($kriteria_ as $key => $kriteria) {
            foreach ($arr_values[$key] as $values) {
                \App\Models\Parameter::create([
                    'nama' => $values[0],
                    'bobot' => $values[1],
                    'id_kriteria' => $kriteria->id,
                ]);
            }
        }
    }
}
