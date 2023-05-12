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
        // seed data kriteria
        Kriteria::create(
            ['nama' => 'Usia','bobot'=> 10 ,'tipe' => 'benefit'],
            ['nama' => 'Berat Badan','bobot'=> 10 ,'tipe' => 'benefit'],
            ['nama' => 'Tekanan','bobot'=> 15 ,'tipe' => 'benefit'],
            ['nama' => 'Temperatur Tubuh','bobot'=> 12 ,'tipe' => 'benefit'],
            ['nama' => 'Hemoglobin (HB) Darah','bobot' => 15 ,'tipe' => 'benefit'],
            ['nama' => 'Kadar Gula Darah','bobot' => 8 ,'tipe' => 'benefit'],
            ['nama' => 'Riwayat Penyakit','bobot' => 10 ,'tipe' => 'benefit'],
            ['nama' => 'Konsumsi Obat','bobot' => 5 ,'tipe' => 'benefit'],
            ['nama' => 'Riwayat Kebiasaan Donor Darah','bobot' => 10 ,'tipe' => 'benefit'],
            ['nama' => 'Penyakit Menular','bobot' => 10 ,'tipe' => 'benefit'],  
        );
    }
}
