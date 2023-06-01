<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\Nilai;
use Spipu\Html2Pdf\Html2Pdf;


class PerhitunganController extends Controller
{
    private function data(){
        $result = Nilai::select(
            "kriteria.id as kriteria_id",
            "kriteria.nama as nama_kriteria",
            "alternatif.nama as nama_alternatif",
            "parameter.bobot as bobot_parameter",
            "nilai.nilai as nilai_parameter"
        )
            ->join("kriteria", "kriteria.id", "=", "nilai.kriteria_id")
            ->join("parameter", "parameter.id", "=", "nilai.parameter_id")
            ->join("alternatif", "alternatif.id", "=", "nilai.alternatif_id")
            ->get();

        $kriteria_ = Kriteria::select('id', 'nama', 'bobot')->get();
        $kriteria_->map(function ($item) use ($kriteria_) {
            $item['normalisasi'] = ($item['bobot'] / $kriteria_->pluck('bobot')->sum());
            return $item;
        }); 

        $nilai = collect();
        foreach ($result->groupBy('nama_alternatif') as $keys => $value) {
            $total = collect();
            $bobot = collect();
            foreach ($value as $item) {
                $bobot->push($item->bobot_parameter);
                $total->push($item->bobot_parameter * $kriteria_->firstWhere('id', $item->kriteria_id)->normalisasi);
            }
            $nilai->push(collect([
                'nama_alternatif' => $keys,
                'bobot_parameter' => $bobot,
                'nilai_parameter' => $total,
                'total' => $total->sum(),
            ]));
        }
        return collect(['kriteria' => $kriteria_, 'nilai' => $nilai]);
    }
    private function dataAsli(){
        // ambil semua nilai dari tabel nilai
        $dataAsli = Nilai::get();
        return $dataAsli;
    }
    // step 1 normalisasi
    private function normalisasi(){
        // normalisasi kriteria
        $normalisasikriteria = Kriteria::select('id', 'nama', 'bobot')->get();
        $normalisasikriteria->map(function ($item) use ($normalisasikriteria) {
            $item['normalisasi'] = round(($item['bobot'] / $normalisasikriteria->pluck('bobot')->sum()),2);
            return $item;
        });  
        return $normalisasikriteria;
    }
    private function parameter(){
        $nilaiParameter = Nilai::select(
            "kriteria.id as kriteria_id",
            "kriteria.nama as nama_kriteria",
            "kriteria.tipe as tipe_kriteria",
            "alternatif.nama as nama_alternatif",
            "parameter.bobot as bobot_parameter",
        )
            ->join("kriteria", "kriteria.id", "=", "nilai.kriteria_id")
            ->join("parameter", "parameter.id", "=", "nilai.parameter_id")
            ->join("alternatif", "alternatif.id", "=", "nilai.alternatif_id")
            ->get();
        // dd($nilaiParameter[0]);
        return $nilaiParameter;
    }

    // step 2 perhitungan nilai utility
    private function utility(){
        $utility = collect([]);
        $nilaiParameter = $this->parameter();
        // dd($nilaiParameter);
        // step 2.1 mencari nilai max & min dari setiap kriteria
        $nilaiMax = $nilaiParameter->where('tipe_kriteria', 'benefit')->groupBy('nama_kriteria')->map(function($item){
            return $item->pluck('bobot_parameter')->max();
        });
        $nilaiMin = $nilaiParameter->where('tipe_kriteria', 'benefit')->groupBy('nama_kriteria')->map(function($item){
            return $item->pluck('bobot_parameter')->min();
        });
        $max = array_values($nilaiMax->toArray());
        $min = array_values($nilaiMin->toArray());
        // dd($max, $min);
        // step 2.2 perhitungan nilai utility(benefit & cost)
        
        foreach($nilaiParameter->groupBy('tipe_kriteria') as $key => $value){
            // step 2.2.1 perhitungan nilai utility benefit
            if($key == 'benefit'){
                $value->map(function ($item) use ($utility, $nilaiMax, $nilaiMin) {
                    $utility->push(collect([
                        'nama_alternatif' => $item->nama_alternatif,
                        'nama_kriteria' => $item->nama_kriteria,
                        'nilai_utility' => round(($item->bobot_parameter - $nilaiMin[$item->nama_kriteria]) / ($nilaiMax[$item->nama_kriteria] - $nilaiMin[$item->nama_kriteria]),2),
                        'max' => $nilaiMax[$item->nama_kriteria],
                        'min' => $nilaiMin[$item->nama_kriteria],
                        'bobot_parameter' => $item->bobot_parameter,
                    ]));
                });
            // step 2.2.2 perhitungan nilai utility cost
            }else{
                
            }
            // dd($utility);
        }
        return $utility;
    }

    // step 3 perhitungan nilai akhir
    private function nilaiAkhir(){
        $nilai = collect([]);
        $nilaiAkhir = collect([]);
        $utility = $this->utility();
        $normalisasi = $this->normalisasi();
        // setiap nilai utility dikalikan dengan normalisasi kriteria yang sesuai
        foreach($utility as $key => $value){
            $nilai->push(collect([
                'nama_alternatif' => $value['nama_alternatif'],
                'nama_kriteria' => $value['nama_kriteria'],
                'nilai_utility' => $value['nilai_utility'] * $normalisasi->firstWhere('nama', $value['nama_kriteria'])->normalisasi,
            ]));
        }
        dd($nilai);


        // foreach($utility->groupBy('nama_alternatif') as $key => $value){
        //     $sumUtility = $value->sum('nilai_utility');
        //     $nilaiAkhir->push(collect([
        //         'nama_alternatif' => $key,
        //         'nilai_akhir' => number_format($sumUtility,2)
        //     ]));
        // }
 
        return $nilaiAkhir;
    }
    // step 4 perankingan
    private function ranking(){
        $nilaiAkhir = $this->nilaiAkhir();
        $ranking = $nilaiAkhir->sortByDesc('nilai_akhir')->values();
        $result = collect([]);
        foreach($ranking as $key => $value){
            $result->push(collect([
                'nama_alternatif' => $value['nama_alternatif'],
                'nilai_akhir' => $value['nilai_akhir'],
                'ranking' => $key + 1
            ]));
        }
        return $result;
    }
    
    public function index()
    {   
        // dd($this->nilaiAkhir(), $this->ranking());
        // dd($this->utility());
        $data = $this->data();
        foreach ($data as $value) {
            if (count($value) == 0) {
                return redirect()->back()->with('status', 'warning')->with('pesan', "Tidak dapat melihat data Perhitungan jika terdapat data yang masih kosong!");
            }
        };
        // dd($this->parameter());
        return view('perhitungan.index', [
            'kriteria_' => $data['kriteria'], 
            'nilai' => $data['nilai'],
            'dataAsli' => $this->dataAsli(), // untuk menampilkan data asli dari tabel nilai
            'normalisasi' => $this->normalisasi(),
            'parameter' => $this->parameter(),
            'utility' => $this->utility(),
            'nilaiAkhir' => $this->nilaiAkhir(),
            'ranking' => $this->ranking(),
        ]);
    }

    public function cetak()
    {
        $data = $this->data();
        foreach ($data as $value) {
            if (count($value) == 0) {
                return redirect()->back()->with('status', 'warning')->with('pesan', "Tidak dapat mencetak data Perhitungan jika terdapat data yang masih kosong!");
            }
        };

        $content = view('perhitungan.cetak', ['kriteria_' => $data['kriteria'], 'nilai' => $data['nilai']]);
        $html2pdf = new Html2Pdf('P', 'A4', 'en', true, 'UTF-8', [10, 5, 10, 0]);
        $html2pdf->pdf->SetTitle('Cetak Data Perhitungan');
        $html2pdf->writeHTML($content);
        $html2pdf->output("perhitungan.pdf");
    }

    // contekan
    // public function hasilOperasi()
    // {
    //     $arrBobotKriteria = [];
    //     $criterias = Criteria::get();
    //     $alternatives = Alternative::get();
    //     foreach($criterias as $e){
    //         array_push($arrBobotKriteria, $e->weight/Criteria::sum('weight'));
    //     }

    //     // Nilai Utility
    //     NilaiUtility::where('id', '!=', null)->delete();
    //     $arrMinMax = [];
    //     foreach($criterias as $c){
    //         // var min & max dari c[$i]
    //         $max = AlternativeCriteria::where('criteria_id', $c->id)->max('score');
    //         $min = (AlternativeCriteria::where('criteria_id', $c->id)->count() == 1) ? 0 : AlternativeCriteria::where('criteria_id', $c->id)->min('score');
            
    //         $isBenefit = ($c->type === 'benefit') ? true : false;
    //         // for sebanyak a
    //         foreach($alternatives as $a){
    //             // proses utility dari a[$i] pada c[$i]
    //             if($isBenefit) {
    //                 // rumus benefit
    //                 if(AlternativeCriteria::where('criteria_id', $c->id)->where('alternative_id', $a->id)->count() > 0) {
    //                     $u = (AlternativeCriteria::where('criteria_id', $c->id)->where('alternative_id', $a->id)->first()->score - $min) / ($max - $min);
    //                 }else{
    //                     $u = 0;
    //                 }
    //                 NilaiUtility::create([
    //                     'utility_score' => $u,
    //                     'alternative_id' => $a->id,
    //                     'criteria_id' => $c->id,
    //                 ]);
    //             }else{
    //                 // rumus cost 
    //                 if(AlternativeCriteria::where('criteria_id', $c->id)->where('alternative_id', $a->id)->count() > 0) {
    //                     $u = ($max - AlternativeCriteria::where('criteria_id', $c->id)->where('alternative_id', $a->id)->first()->score) / ($max - $min);
    //                 }else{
    //                     $u = 0;
    //                 }
    //                 NilaiUtility::create([
    //                     'utility_score' => $u,
    //                     'alternative_id' => $a->id,
    //                     'criteria_id' => $c->id,
    //                 ]);
    //             }
    //         }
    //     }

        
    //     // Nilai Akhir
    //     NilaiAkhir::where('id', '!=', null)->delete();
    //     $nilaiAkhir = 0.0;
    //     foreach($alternatives as $a) {
    //         foreach($criterias as $i => $c) { 
    //             $nilaiAkhir += $arrBobotKriteria[$i] * NilaiUtility::where('alternative_id', $a->id)->where('criteria_id', $c->id)->first()->utility_score;
    //         }
    //         NilaiAkhir::create([
    //             'alternative_id' => $a->id,
    //             'nilai_akhir' => $nilaiAkhir
    //         ]);
    //         $nilaiAkhir = 0;
    //     }

    //     $data = NilaiAkhir::with('alternative')->orderBy('nilai_akhir', 'DESC')->get();

    //     return view('hasil', compact('data'));
    // }

    // public function showAddAlternative()
    // {
    //     $criterias = Criteria::get();
    //     return view('add-alternative', compact('criterias'));
    // }

    // public function addAlternative(Request $req)
    // {
    //     $a = Alternative::create([
    //         'name' => $req->name
    //     ]);

    //     foreach(Criteria::get() as $c){
    //         AlternativeCriteria::create([
    //             'score' => $req->{'score'.$c->id},
    //             'alternative_id' => $a->id,
    //             'criteria_id' => $c->id
    //         ]);
    //     }

    //     return redirect('/');
    // }

    // public function showAddCriteria()
    // {
    //     return view('add-criteria');
    // }

    // public function addCriteria(Request $req)
    // {
    //     if(Criteria::where('name', $req->name)->count() > 0) {
    //         Criteria::where('name', $req->name)->delete();
            
    //         Criteria::create([
    //             'name' => $req->name,
    //             'weight' => $req->weight,
    //             'type' => $req->type
    //         ]);
    //     }else{
    //         Criteria::create([
    //             'name' => $req->name,
    //             'weight' => $req->weight,
    //             'type' => $req->type
    //         ]);
    //     }

    //     return redirect('/');
    // }
}
