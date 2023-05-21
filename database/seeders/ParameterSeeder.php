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
            [['<= 17', 100], ['31 - 40', 90], ['41 - 50', 80], ['> 50', 70]], 
            [['<= 46', 100], ['51 - 56', 75], ['57 - 62', 50], ['> 62', 25]],
            [['<=113/75 mmHg', 100], ['115/75 mmHg - 115/80 mmHg', 75], ['117/78 mmHg - 118/78 mmHg', 50], ['> 118/78 mmHg', 25]],
            [['36,5 *C - 36,7 *C', 100], ['36,8 *C - 37,0 *C', 90], ['37,1 *C - 37,3 *C', 80], ['> 37,3 *C', 70]],
            [['> 18 gr/dL', 100], ['18 - 16 gr/dL', 75], ['15 - 13 gr/dL', 50], ['<= 13 gr/dL', 25]],
            [['< 100 mg/dL', 100], ['100 - 125 mg/dL', 75], ['>= 125 mg/dL', 50]],
            [['Tidak ada', 100], ['Tindakan Medis Minor', 75], ['Tindakan Medis Sedang', 50],['Tindakan Medis Major', 25]],
            [['Tidak Mengonsumsi', 100], ['Mengonsumsi : Sesuai Anjuran Dokter', 75], ['Mengonsumsi : Tidak Sesuai Anjuran Dokter', 50]],
            [['Donor Darah Teratur', 100], ['Pernah, Namun Tidak Teratur', 75], ['Tidak Pernah', 50]],
            [['Tidak Ada', 100], ['> 1 tahun', 75],['< 1 tahun', 50],['< 1 bulan', 25]]
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
