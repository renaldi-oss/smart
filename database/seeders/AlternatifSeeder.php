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
            ['nama' => 'AM'],
            ['nama' => 'SM'],
            ['nama' => 'SL'],
            ['nama' => 'SA'],
            ['nama' => 'TY'],
            ['nama' => 'NA'],
            ['nama' => 'SW'],
            ['nama' => 'VA'],
            ['nama' => 'AF'],
            ['nama' => 'AS'],
            ['nama' => 'SZ'],
            ['nama' => 'AK'],
            ['nama' => 'AP'],
            ['nama' => 'AA'],
            ['nama' => 'TF'],
            ['nama' => 'MR'],
            ['nama' => 'DP'],
            ['nama' => 'RD'],
            ['nama' => 'DN'],
            ['nama' => 'RM'],
        ]; 
        foreach ($arr as $key => $value) {
            Alternatif::create($value);
        }
    }
}
