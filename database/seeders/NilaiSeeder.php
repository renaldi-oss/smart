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
        // $nilai = [
        //     [49, 70, '120/75', 36.6, 15, 120, 'Tidak Ada', 'Mengonsumsi : Sesuai Anjuran Dokter', 'Donor Darah Teratur', 'Tidak Ada'],
        //     [40, 68, '110/60', 36.9, 13, 100, 'Tidak Ada', 'Tidak Mengonsumsi', 'Pernah, Namun Tidak Teratur', 'Tidak Ada'],
        //     [58, 54, '114/60', 36.8, 14, 80, 'Tindakan Medis Minor', 'Mengonsumsi : Tidak Sesuai Anjuran Dokter', 'Tidak Pernah', 'Lebih Dari Satu Tahun'],
        //     [33, 75, '113/75', 37, 17, 85, 'Tidak Ada', 'Tidak Mengonsumsi', 'Donor Darah Teratur', 'Tidak Ada'],
        //     [35, 85, '115/75', 36.9, 18, 130, 'Tidak Ada', 'Mengonsumsi : Sesuai Anjuran Dokter', 'Tidak Pernah', 'Tidak Ada'],
        //     [35, 55, '130/80', 36.8, 13, 110, 'Tindakan Medis Mayor', 'Mengonsumsi : Sesuai Anjuran Dokter', 'Tidak Pernah', 'Tidak Ada'],
        //     [22, 50, '117/85', 37.2, 15, 90, 'Tidak Ada', 'Tidak Mengonsumsi', 'Pernah, Namun Tidak Teratur', 'Tidak Ada'],
        //     [32, 48, '130/75', 36.8, 13, 150, 'Tidak Ada', 'Mengonsumsi : Sesuai Anjuran Dokter', 'Tidak Pernah', 'Tidak Ada'],
        //     [26, 46, '115/80', 36.8, 16, 110, 'Tidak Ada', 'Tidak Mengonsumsi', 'Pernah, Namun Tidak Teratur', 'Tidak Ada'],
        //     [34, 57, '115/75', 37, 14, 95, 'Tidak Ada', 'Mengonsumsi : Sesuai Anjuran Dokter', 'Tidak Pernah', 'Tidak Ada'],
        //     [80, 55, '120/80', 36.5, 17, 110, 'Tidak Ada', 'Mengonsumsi : Sesuai Anjuran Dokter', 'Donor Darah Teratur', 'Tidak Ada'],
        //     [27, 62, '118/80', 37, 14, 120, 'Tidak Ada', 'Mengonsumsi : Tidak Sesuai Anjuran Dokter', 'Pernah, Namun Tidak Teratur', 'Tidak Ada'],
        //     [40, 75, '115/75', 36.6, 16, 80, 'Tidak Ada', 'Tidak Mengonsumsi', 'Tidak Pernah', 'Tidak Ada'],
        //     [50, 80, '118/78', 36.8, 18, 140, 'Tidak Ada', 'Mengonsumsi : Sesuai Anjuran Dokter', 'Donor Darah Teratur', 'Tidak Ada'],
        //     [30, 50, '113/75', 37.3, 12, 90, 'Tindakan Medis Minor', 'Mengonsumsi : Tidak Sesuai Anjuran Dokter', 'Pernah, Namun Tidak Teratur', 'Tidak Ada'],
        //     [45, 70, '117/78', 36.7, 15, 95, 'Tidak Ada', 'Tidak Mengonsumsi', 'Donor Darah Teratur', 'Tidak Ada'],
        //     [20, 56, '115/80', 37.1, 14, 120, 'Tidak Ada', 'Mengonsumsi : Sesuai Anjuran Dokter', 'Pernah, Namun Tidak Teratur', 'Tidak Ada'],
        //     [63, 68, '118/78', 37.3, 13, 110, 'Tindakan Medis Minor', 'Mengonsumsi : Sesuai Anjuran Dokter', 'Tidak Pernah', 'Tidak Ada'],
        //     [55, 80, '120/75', 36.6, 16, 80, 'Tidak Ada', 'Tidak Mengonsumsi', 'Pernah, Namun Tidak Teratur', 'Tidak Ada'],
        //     [37, 75, '117/78', 37, 17, 95, 'Tidak Ada', 'Tidak Mengonsumsi', 'Donor Darah Teratur', 'Tidak Ada']
        // ];
        
        // $bobotParameter = [
        //     [80, 25, 25, 100, 50, 75, 100, 75, 100, 100],
        //     [90, 25, 100, 90, 50, 75, 100, 100, 75, 100],
        //     [70, 75, 75, 90, 50, 100, 75, 50, 50, 75],
        //     [90, 25, 100, 90, 75, 100, 100, 100, 100, 100],
        //     [90, 25, 75, 90, 75, 50, 100, 75, 50, 100],
        //     [90, 75, 25, 90, 50, 75, 25, 75, 50, 100],
        //     [90, 75, 50, 80, 50, 100, 100, 100, 75, 100],
        //     [90, 75, 25, 90, 50, 50, 100, 75, 50, 100],
        //     [90, 100, 75, 90, 75, 75, 100, 100, 75, 100],
        //     [90, 50, 75, 90, 50, 100, 100, 75, 50, 100],
        //     [70, 75, 25, 100, 75, 75, 100, 75, 100, 100],
        //     [90, 50, 50, 90, 50, 75, 100, 50, 75, 100],
        //     [90, 25, 75, 100, 75, 100, 100, 100, 50, 100],
        //     [80, 25, 50, 90, 75, 50, 100, 75, 100, 100],
        //     [90, 75, 100, 80, 25, 100, 75, 50, 75, 100],
        //     [80, 25, 50, 100, 50, 100, 100, 100, 100, 100],
        //     [90, 75, 75, 80, 50, 75, 100, 75, 75, 100],
        //     [70, 25, 50, 80, 50, 75, 75, 75, 50, 100],
        //     [70, 25, 25, 100, 75, 100, 100, 100, 75, 100],
        //     [90, 25, 50, 90, 75, 100, 100, 100, 100, 100]
        // ];
        $bobotParameter = [
            [4, 3, 5, 5, 1, 1, 4, 1, 4, 2],
            [4, 3, 1, 1, 3, 1, 1, 1, 1, 2],
            [4, 4, 5, 5, 3, 1, 1, 1, 4, 1],
            [4, 2, 1, 1, 2, 1, 4, 1, 4, 2],
            [4, 3, 5, 5, 3, 2, 4, 1, 1, 2],
            [4, 4, 1, 1, 5, 1, 4, 1, 4, 2],
            [4, 3, 1, 1, 1, 1, 4, 1, 2, 2],
            [3, 3, 5, 5, 5, 1, 3, 1, 3, 3],
            [4, 3, 1, 5, 3, 1, 4, 1, 4, 2],
            [4, 3, 1, 1, 2, 1, 1, 1, 4, 2],
            [4, 2, 1, 1, 2, 1, 4, 1, 1, 2],
            [4, 2, 5, 5, 3, 3, 4, 1, 1, 2],
            [4, 2, 1, 1, 3, 1, 4, 1, 3, 2],
            [4, 5, 5, 5, 1, 2, 4, 1, 5, 2],
            [4, 3, 1, 1, 3, 3, 4, 1, 3, 2],
            [4, 4, 1, 1, 5, 1, 1, 1, 3, 3],
            [4, 5, 1, 1, 1, 3, 4, 2, 3, 2],
            [4, 4, 1, 1, 3, 1, 4, 2, 4, 2],
            [4, 3, 1, 1, 5, 1, 4, 1, 1, 2],
            [4, 4, 1, 1, 3, 4, 4, 1, 5, 2]
        ];
        $nilai = [];
        for ($i = 0; $i < count($bobotParameter); $i++) {
            $atribut = [];
            for ($j = 0; $j < count($bobotParameter[$i]); $j++) {
                // nilai random diberikan pada setiap atribut
                if ($j == 0) {
                    //C1: Hasil Proses Wawancara
                    $value = rand(96, 100);
                } elseif ($j == 1) {
                    // C2: Index Prestasi Kumulatif (IPK)
                    $value = number_format(rand(300, 375) / 100, 2);
                } elseif ($j == 2) {
                    //C3: Status Kepemilikan KIP
                    $value = rand(0, 1) == 0 ? 'Ada' : 'Tidak Ada';
                } elseif ($j == 3) {
                    //C4: Status Kepemilikan KKS
                    $value = rand(0, 1) == 0 ? 'Ada' : 'Tidak Ada';
                } elseif ($j == 4 || $j == 5) {
                    //C5, C6: Penghasilan Orang Tua (ayah, ibu)
                    $penghasilan = [
                        '> 1,500,000',
                        '1,000,000 - 1,499,000',
                        '500,000 - 999,000',
                        '< 500,000',
                        '0',
                    ];
                    $value = $penghasilan[rand(0, 4)];
                } elseif ($j == 6) {
                    //C7: Status Kepemilikan Rumah
                    $statuses = ['Sendiri', 'Sewa tahunan', 'Sewa bulanan', 'Menumpang'];
                    $value = $statuses[rand(0, 3)];
                } elseif ($j == 7) {
                    //C8: Besaran Daya Listrik
                    $powerRanges = ['> 1300 W', '1300 W', '900 W', '450 W'];
                    $value = $powerRanges[rand(0, 3)];
                } elseif ($j == 8) {
                    //C9: Besaran Luas Tanah
                    $landSizes = ['> 200', '100 - 200', '50 - 99', '25 - 50', '< 25'];
                    $value = $landSizes[rand(0, 4)];
                } elseif ($j == 9) {
                    //C10: Jenis Sumber Air
                    $waterSources = ['Air PAM', 'Air Sumur', 'Air Sungai'];
                    $value = $waterSources[rand(0, 2)];
                }

                $atribut[] = $value;
            }

            $nilai[] = $atribut;
        }
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
