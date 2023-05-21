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
            [49, 70, '120/75', 36.6, 15, 120, 'Tidak Ada', 'Mengonsumsi : Sesuai Anjuran Dokter', 'Donor Darah Teratur', 'Tidak Ada'],
            [40, 68, '110/60', 36.9, 13, 100, 'Tidak Ada', 'Tidak Mengonsumsi', 'Pernah, Namun Tidak Teratur', 'Tidak Ada'],
            [58, 54, '114/60', 36.8, 14, 80, 'Tindakan Medis Minor', 'Mengonsumsi : Tidak Sesuai Anjuran Dokter', 'Tidak Pernah', 'Lebih Dari Satu Tahun'],
            [33, 75, '113/75', 37, 17, 85, 'Tidak Ada', 'Tidak Mengonsumsi', 'Donor Darah Teratur', 'Tidak Ada'],
            [35, 85, '115/75', 36.9, 18, 130, 'Tidak Ada', 'Mengonsumsi : Sesuai Anjuran Dokter', 'Tidak Pernah', 'Tidak Ada'],
            [35, 55, '130/80', 36.8, 13, 110, 'Tindakan Medis Mayor', 'Mengonsumsi : Sesuai Anjuran Dokter', 'Tidak Pernah', 'Tidak Ada'],
            [22, 50, '117/85', 37.2, 15, 90, 'Tidak Ada', 'Tidak Mengonsumsi', 'Pernah, Namun Tidak Teratur', 'Tidak Ada'],
            [32, 48, '130/75', 36.8, 13, 150, 'Tidak Ada', 'Mengonsumsi : Sesuai Anjuran Dokter', 'Tidak Pernah', 'Tidak Ada'],
            [26, 46, '115/80', 36.8, 16, 110, 'Tidak Ada', 'Tidak Mengonsumsi', 'Pernah, Namun Tidak Teratur', 'Tidak Ada'],
            [34, 57, '115/75', 37, 14, 95, 'Tidak Ada', 'Mengonsumsi : Sesuai Anjuran Dokter', 'Tidak Pernah', 'Tidak Ada'],
            [80, 55, '120/80', 36.5, 17, 110, 'Tidak Ada', 'Mengonsumsi : Sesuai Anjuran Dokter', 'Donor Darah Teratur', 'Tidak Ada'],
            [27, 62, '118/80', 37, 14, 120, 'Tidak Ada', 'Mengonsumsi : Tidak Sesuai Anjuran Dokter', 'Pernah, Namun Tidak Teratur', 'Tidak Ada'],
            [40, 75, '115/75', 36.6, 16, 80, 'Tidak Ada', 'Tidak Mengonsumsi', 'Tidak Pernah', 'Tidak Ada'],
            [50, 80, '118/78', 36.8, 18, 140, 'Tidak Ada', 'Mengonsumsi : Sesuai Anjuran Dokter', 'Donor Darah Teratur', 'Tidak Ada'],
            [30, 50, '113/75', 37.3, 12, 90, 'Tindakan Medis Minor', 'Mengonsumsi : Tidak Sesuai Anjuran Dokter', 'Pernah, Namun Tidak Teratur', 'Tidak Ada'],
            [45, 70, '117/78', 36.7, 15, 95, 'Tidak Ada', 'Tidak Mengonsumsi', 'Donor Darah Teratur', 'Tidak Ada'],
            [20, 56, '115/80', 37.1, 14, 120, 'Tidak Ada', 'Mengonsumsi : Sesuai Anjuran Dokter', 'Pernah, Namun Tidak Teratur', 'Tidak Ada'],
            [63, 68, '118/78', 37.3, 13, 110, 'Tindakan Medis Minor', 'Mengonsumsi : Sesuai Anjuran Dokter', 'Tidak Pernah', 'Tidak Ada'],
            [55, 80, '120/75', 36.6, 16, 80, 'Tidak Ada', 'Tidak Mengonsumsi', 'Pernah, Namun Tidak Teratur', 'Tidak Ada'],
            [37, 75, '117/78', 37, 17, 95, 'Tidak Ada', 'Tidak Mengonsumsi', 'Donor Darah Teratur', 'Tidak Ada']
        ];
        $bobotParameter = [
            [80, 25, 25, 100, 50, 75, 100, 75, 100, 100],
            [90, 25, 100, 90, 50, 75, 100, 100, 75, 100],
            [70, 75, 75, 90, 50, 100, 75, 50, 50, 75],
            [90, 25, 100, 90, 75, 100, 100, 100, 100, 100],
            [90, 25, 75, 90, 75, 50, 100, 75, 50, 100],
            [90, 75, 25, 90, 50, 75, 25, 75, 50, 100],
            [90, 75, 50, 80, 50, 100, 100, 100, 75, 100],
            [90, 75, 25, 90, 50, 50, 100, 75, 50, 100],
            [90, 100, 75, 90, 75, 75, 100, 100, 75, 100],
            [90, 50, 75, 90, 50, 100, 100, 75, 50, 100],
            [70, 75, 25, 100, 75, 75, 100, 75, 100, 100],
            [90, 50, 50, 90, 50, 75, 100, 50, 75, 100],
            [90, 25, 75, 100, 75, 100, 100, 100, 50, 100],
            [80, 25, 50, 90, 75, 50, 100, 75, 100, 100],
            [90, 75, 100, 80, 25, 100, 75, 50, 75, 100],
            [80, 25, 50, 100, 50, 100, 100, 100, 100, 100],
            [90, 75, 75, 80, 50, 75, 100, 75, 75, 100],
            [70, 25, 50, 80, 50, 75, 75, 75, 50, 100],
            [70, 25, 25, 100, 75, 100, 100, 100, 75, 100],
            [90, 25, 50, 90, 75, 100, 100, 100, 100, 100]
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
