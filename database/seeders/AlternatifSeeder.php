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
        $arr_values = ['Papuyu', 'Haruan', 'Patin', 'Saluang', 'Sapat', 'Sapat Siam', 'Lais', 'Nila', 'Lele', 'Jelawat', 'Gurame', 'Mujair', 'Mas', 'Bawal'];
        foreach ($arr_values as $values) {
            \App\Models\Alternatif::create([
                'nama' => $values,
            ]);
        }
        // Alternatif::create(
        //     ['nama' => 'Andi Kusuma'],
        //     ['nama' => 'Bagus Pratama'],
        //     ['nama' => 'Cika Fitriani'],
        //     ['nama' => 'Dian Wahyuni'],
        //     ['nama' => 'Eko Santoso'],
        //     ['nama' => 'Fajar Wicaksono'],
        //     ['nama' => 'Gina Maulina'],
        //     ['nama' => 'Hadi Santoso'],
        //     ['nama' => 'Indra Permana'],
        //     ['nama' => 'Joko Setiawan'],
        //     ['nama' => 'Kusumo Wijaya'],
        //     ['nama' => 'Lenny Kurniawan'],
        //     ['nama' => 'Mita Kusuma'],
        //     ['nama' => 'Nindy Ayunda'],
        //     ['nama' => 'Dewi Setiana'],
        //     ['nama' => 'Putra Mahendra'],
        //     ['nama' => 'Qory Sandioriva'],
        //     ['nama' => 'Reza Pahlevi'],
        //     ['nama' => 'Siti Nurhaliza'],
        //     ['nama' => 'Teguh Santoso']
        // );
    }
}
