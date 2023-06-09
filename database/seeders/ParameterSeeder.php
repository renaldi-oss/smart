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
        // $arr_values = [
        //     [['<= 17', 100], ['31 - 40', 90], ['41 - 50', 80], ['> 50', 70]], 
        //     [['<= 46', 100], ['51 - 56', 75], ['57 - 62', 50], ['> 62', 25]],
        //     [['<=113/75 mmHg', 100], ['115/75 mmHg - 115/80 mmHg', 75], ['117/78 mmHg - 118/78 mmHg', 50], ['> 118/78 mmHg', 25]],
        //     [['36,5 *C - 36,7 *C', 100], ['36,8 *C - 37,0 *C', 90], ['37,1 *C - 37,3 *C', 80], ['> 37,3 *C', 70]],
        //     [['> 18 gr/dL', 100], ['18 - 16 gr/dL', 75], ['15 - 13 gr/dL', 50], ['<= 13 gr/dL', 25]],
        //     [['< 100 mg/dL', 100], ['100 - 125 mg/dL', 75], ['>= 125 mg/dL', 50]],
        //     [['Tidak ada', 100], ['Tindakan Medis Minor', 75], ['Tindakan Medis Sedang', 50],['Tindakan Medis Major', 25]],
        //     [['Tidak Mengonsumsi', 100], ['Mengonsumsi : Sesuai Anjuran Dokter', 75], ['Mengonsumsi : Tidak Sesuai Anjuran Dokter', 50]],
        //     [['Donor Darah Teratur', 100], ['Pernah, Namun Tidak Teratur', 75], ['Tidak Pernah', 50]],
        //     [['Tidak Ada', 100], ['> 1 tahun', 75],['< 1 tahun', 50],['< 1 bulan', 25]]
        // ];
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
