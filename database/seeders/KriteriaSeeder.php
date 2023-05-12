<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kriteria;
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
            
        // seed data kriteria
        // Kriteria::create(
        //     ['nama' => 'Usia','bobot'=> 10 ,'tipe' => 'benefit'],
        //     ['nama' => 'Berat Badan','bobot'=> 10 ,'tipe' => 'benefit'],
        //     ['nama' => 'Tekanan','bobot'=> 15 ,'tipe' => 'benefit'],
        //     ['nama' => 'Temperatur Tubuh','bobot'=> 12 ,'tipe' => 'benefit'],
        //     ['nama' => 'Hemoglobin (HB) Darah','bobot' => 15 ,'tipe' => 'benefit'],
        //     ['nama' => 'Kadar Gula Darah','bobot' => 8 ,'tipe' => 'benefit'],
        //     ['nama' => 'Riwayat Penyakit','bobot' => 10 ,'tipe' => 'benefit'],
        //     ['nama' => 'Konsumsi Obat','bobot' => 5 ,'tipe' => 'benefit'],
        //     ['nama' => 'Riwayat Kebiasaan Donor Darah','bobot' => 10 ,'tipe' => 'benefit'],
        //     ['nama' => 'Penyakit Menular','bobot' => 10 ,'tipe' => 'benefit'],  
        // );
    }
}
