<?php

namespace Database\Seeders;

use App\Models\Nilai;
use App\Models\Kriteria;
use App\Models\Alternatif;
use App\Models\Parameter;
use Illuminate\Database\Seeder;
use PhpParser\Builder\Param;

class NilaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $alternatif = Alternatif::get();
        $kriteria = Kriteria::get();
        $parameter = Parameter::where('kriteria_id', 3)->pluck('id','nama');
        $nilai = [
            [49, 70, '110/80', 36.6, '15 gr/dL', '120 mg/dL', 'Non-menular', 'Mengonsumsi', 'Donor teratur', 'Ya'],
            [40, 68, '130/90', 36.9, '13 gr/dL', '100 mg/dL', 'Non-menular', 'Tidak mengonsumsi', 'Pernah donor', 'Ya'],
            [58, 54, '140/95', 36.8, '14 gr/dL', '80 mg/dL', 'Menular', 'Mengonsumsi', 'Tidak pernah', 'Ya'],
            [33, 75, '160/100', 37, '17 gr/dL', '85 mg/dL', 'Non-menular', 'Tidak mengonsumsi', 'Donor teratur', 'Ya'],
            [35, 85, '115/75', 36.9, '18 gr/dL', '130 mg/dL', 'Menular', 'Mengonsumsi', 'Tidak pernah', 'Tidak'],
            [35, 55, '135/88', 36.8, '13 gr/dL', '110 mg/dL', 'Non-menular', 'Mengonsumsi', 'Donor teratur', 'Ya'],
            [22, 50, '145/92', 37.2, '15 gr/dL', '90 mg/dL', 'Menular', 'Tidak mengonsumsi', 'Pernah donor', 'Tidak'],
            [32, 48, '165/105', 36.8, '13 gr/dL', '150 mg/dL', 'Non-menular', 'Mengonsumsi', 'Tidak pernah', 'Ya'],
            [26, 46, '112/78', 36.8, '16 gr/dL', '110 mg/dL', 'Non-menular', 'Tidak Mengonsumsi', 'Pernah, Tidak Teratur', 'Ya'],
            [34, 57, '128/85', 37, '14 gr/dL', '95 mg/dL', 'Non-menular', 'Mengonsumsi Sesuai Anjuran', 'Tidak Pernah', 'Ya'],
            [80, 55, '138/92', 36.5, '17 gr/dL', '110 mg/dL', 'Non Menular', 'Mengonsumsi: Sesuai anjuran dokter', 'Donor Darah Teratur', 'Memiliki'],
            [27, 62, '158/98', 37, '14 gr/dL', '120 mg/dL', 'Menular', 'Mengonsumsi: Tidak sesuai anjuran dokter', 'Pernah donor darah', 'Tidak memiliki'],
            [40, 75, '105/70', 36.6, '16 gr/dL', '80 mg/dL', 'Non Menular', 'Tidak mengonsumsi', 'Tidak pernah donor darah', 'Memiliki'],
            [50, 80, '125/82', 36.8, '18 gr/dL', '140 mg/dL', 'Menular', 'Mengonsumsi: Sesuai anjuran dokter', 'Donor darah teratur', 'Tidak memiliki'],
            [30, 50, '142/95', 37.3, '12 gr/dL', '90 mg/dL', 'Non Menular', 'Mengonsumsi: Tidak sesuai anjuran dokter', 'Pernah donor darah', 'Memiliki'],
            [45, 70, '162/102', 36.7, '15 gr/dL', '95 mg/dL', 'Non Menular', 'Tidak mengonsumsi', 'Donor darah teratur', 'Tidak memiliki'],
            [20, 56, '100/65', 37.1, '14 gr/dL', '120 mg/dL', 'Non Menular', 'Mengonsumsi: Sesuai anjuran dokter', 'Pernah donor darah', 'Memiliki'],
            [63, 68, '120/78', 37.3, '13 gr/dL', '110 mg/dL', 'Non Menular', 'Mengonsumsi: Sesuai anjuran dokter', 'Tidak pernah donor darah', 'Tidak memiliki'],
            [55, 80, '137/90', 36.6, '16 gr/dL', '80 mg/dL', 'Menular', 'Tidak mengonsumsi', 'Pernah donor darah', 'Memiliki'],
            [37, 75, '155/100', 37, '17 gr/dL', '95 mg/dL', 'Non Menular', 'Tidak mengonsumsi', 'Donor darah teratur', 'Tidak memiliki']
        ];
        $bobotParameter = [
            [80, 25, 100, 90, 100, 90, 75, 75, 100, 100],
            [50, 25, 75, 90, 75, 75, 50, 100, 75, 100],
            [70, 50, 50, 90, 80, 50, 75, 50, 100, 50],
            [50, 75, 25, 100, 100, 90, 75, 75, 50, 100],
            [50, 75, 100, 90, 70, 80, 50, 100, 50, 100],
            [50, 50, 75, 90, 90, 75, 75, 100, 100, 100],
            [25, 25, 50, 70, 80, 80, 50, 75, 75, 50],
            [25, 25, 25, 90, 75, 75, 100, 100, 50, 100],
            [25, 25, 100, 90, 90, 90, 50, 50, 75, 100],
            [50, 50, 75, 100, 75, 90, 75, 50, 100, 75],
            [70, 25, 50, 90, 100, 70, 75, 100, 100, 50],
            [25, 25, 25, 100, 90, 80, 50, 75, 75, 50],
            [50, 75, 100, 90, 80, 50, 75, 100, 50, 50],
            [80, 25, 75, 90, 70, 90, 75, 100, 100, 50],
            [50, 50, 50, 70, 80, 80, 25, 75, 75, 50],
            [50, 75, 25, 90, 90, 75, 75, 100, 100, 50],
            [25, 50, 100, 90, 70, 90, 75, 75, 75, 50],
            [70, 50, 75, 90, 90, 75, 75, 100, 50, 50],
            [70, 75, 50, 90, 70, 90, 75, 100, 75, 100],
            [50, 75, 25, 100, 100, 90, 75, 75, 100, 50]
        ];
        for($i=0; $i<count($alternatif); $i++){
            for($j=0; $j<count($kriteria); $j++){
                Nilai::create([
                    'alternatif_id' => $alternatif[$i]->id,
                    'kriteria_id' => $kriteria[$j]->id,
                    'parameter_id' => Parameter::where('bobot', $bobotParameter[$i][$j])->first()->id,
                    'nilai' => $nilai[$i][$j]
                ]);
            }
        }
    }
}
