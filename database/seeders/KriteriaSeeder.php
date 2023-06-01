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
            ['nama' => 'Usia','bobot'=> 12 ,'tipe' => 'benefit'],
            ['nama' => 'Berat Badan','bobot'=> 10 ,'tipe' => 'benefit'],
            ['nama' => 'Tekanan Darah','bobot'=> 12 ,'tipe' => 'benefit'],
            ['nama' => 'Temperatur Tubuh','bobot'=> 10 ,'tipe' => 'benefit'],
            ['nama' => 'Hemoglobin (HB) Darah','bobot' => 12 ,'tipe' => 'benefit'],
            ['nama' => 'Kadar Gula Darah','bobot' => 10 ,'tipe' => 'benefit'],
            ['nama' => 'Tindakan Medis Terakhir','bobot' => 8 ,'tipe' => 'benefit'],
            ['nama' => 'Konsumsi Obat','bobot' => 8 ,'tipe' => 'benefit'],
            ['nama' => 'Riwayat Kebiasaan Donor Darah','bobot' => 8 ,'tipe' => 'benefit'],
            ['nama' => 'Riwayat Tranfusi Darah','bobot' => 10 ,'tipe' => 'benefit'] 
        ];
        foreach ($arr as $key => $value) {
            Kriteria::create($value);
        }
    }
}
