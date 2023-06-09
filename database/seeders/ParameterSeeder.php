<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kriteria;
class ParameterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kriteria_ = Kriteria::all();
        $arr_values = [
            [
                ['> 95', 5],
                ['81 - 95', 4],
                ['66 - 80', 3],
                ['50 - 65', 2],
                ['< 50', 1]
            ],
            [
                ['> 3.75', 5],
                ['3.51 - 3.75', 4],
                ['3.26 - 3.50', 3],
                ['3.00 - 3.25', 2],
                ['< 3', 1]
            ],
            [
                ['Ada', 5],
                ['Tidak Ada', 1]
            ],
            [
                ['Ada', 5],
                ['Tidak Ada', 1]
            ],
            [
                ['> 1,500,000', 5],
                ['1,000,000 - 1,499,000', 4],
                ['500,000 - 999,000', 3],
                ['< 500,000', 2],
                ['0', 1]
            ],
            [
                ['> 1,500,000', 5],
                ['1,000,000 - 1,499,000', 4],
                ['500,000 - 999,000', 3],
                ['< 500,000', 2],
                ['0', 1]
            ],
            [
                ['Sendiri', 4],
                ['Sewa Tahunan', 3],
                ['Sewa Bulanan', 2],
                ['Menumpang', 1]
            ],
            [
                ['> 1300 W', 4],
                ['1300 W', 3],
                ['900 W', 2],
                ['450 W', 1]
            ],
            [
                ['> 200', 5],
                ['100 - 200', 4],
                ['50 - 99', 3],
                ['25 - 50', 2],
                ['< 25', 1]
            ],
            [
                ['Air PAM', 3],
                ['Air Sumur', 2],
                ['Air Sungai', 1]
            ]
        ];
        
        foreach ($kriteria_ as $key => $kriteria) {
            foreach ($arr_values[$key] as $values) {
                \App\Models\Parameter::create([
                    'nama' => $values[0],
                    'bobot' => $values[1],
                    'kriteria_id' => $kriteria->id,
                ]);
            }
        }
    }
}
