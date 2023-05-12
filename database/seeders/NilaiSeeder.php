<?php

namespace Database\Seeders;

use App\Models\Nilai;
use App\Models\Kriteria;
use App\Models\Alternatif;
use App\Models\Parameter;
use Illuminate\Database\Seeder;

class NilaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $alternatifCount = Alternatif::count();
        $kriteriaCount = Kriteria::count();
        for ($i = 1; $i <= $alternatifCount; $i++) {
            for ($j = 1; $j <= $kriteriaCount; $j++) {
                Nilai::create([
                    'alternatif_id' => $i,
                    'kriteria_id' => $j,
                    
                ]);
            }
        }
        
    }
}
