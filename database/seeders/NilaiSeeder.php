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
