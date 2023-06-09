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
        $arr = [
            ['nama' => 'Hasil Proses Wawancara','bobot'=> 5 ,'tipe' => 'benefit'],
            ['nama' => 'Index Prestasi Kumulatif (IPK)','bobot'=> 3 ,'tipe' => 'benefit'],
            ['nama' => 'Status Kepemilikan KIP','bobot'=> 2 ,'tipe' => 'benefit'],
            ['nama' => 'Status Kepemilikan KKS','bobot'=> 2 ,'tipe' => 'benefit'],
            ['nama' => 'Penghasilan Orang Tua (ayah)','bobot' => 2 ,'tipe' => 'cost'],
            ['nama' => 'Penghasilan Orang tua (ibu)','bobot' => 2 ,'tipe' => 'cost'],
            ['nama' => 'Status Kepemilikan Rumah','bobot' => 1 ,'tipe' => 'cost'],
            ['nama' => 'Besaran Daya Listrik','bobot' => 1 ,'tipe' => 'cost'],
            ['nama' => 'Besaran Luas Tanah','bobot' => 1 ,'tipe' => 'cost'],
            ['nama' => 'Jenis Sumber Air','bobot' => 1 ,'tipe' => 'cost'] 
        ];
        foreach ($arr as $key => $value) {
            Kriteria::create($value);
        }
    }
}
