<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Alternatif;
class AlternatifSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arr = [
            ['nama' => 'Ibnu Hajar'],
            ['nama' => 'Endah Eva Yanti'],
            ['nama' => 'Mhd. Ridwan'],
            ['nama' => 'Hengki Syahputra'],
            ['nama' => 'Paiman'],
            ['nama' => 'Hasmiyanti'],
            ['nama' => 'Ditha Gusmita'],
            ['nama' => 'Widi Asri'],
            ['nama' => 'Siti Sundari'],
            ['nama' => 'Deswita Andayani'],
            ['nama' => 'Kusumo Wijaya'],
            ['nama' => 'Lenny Kurniawan'],
            ['nama' => 'Mita Kusuma'],
            ['nama' => 'Nindy Ayunda'],
            ['nama' => 'Dewi Setiana'],
            ['nama' => 'Putra Mahendra'],
            ['nama' => 'Qory Sandioriva'],
            ['nama' => 'Reza Pahlevi'],
            ['nama' => 'Siti Nurhaliza'],
            ['nama' => 'Teguh Santoso']
        ];
        foreach ($arr as $key => $value) {
            Alternatif::create($value);
        }
    }
}
