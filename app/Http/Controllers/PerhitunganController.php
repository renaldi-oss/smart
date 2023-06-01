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
        foreach($utility as $key => $value){
            $nilai->push(collect([
                'nama_alternatif' => $value['nama_alternatif'],
                'nama_kriteria' => $value['nama_kriteria'],
                'normalisasi' => $normalisasi->firstWhere('nama', $value['nama_kriteria'])->normalisasi, // ambil nilai normalisasi dari kriteria
                'nilai_utility' => $value['nilai_utility'],
                'hasil' => $value['nilai_utility'] * $normalisasi->firstWhere('nama', $value['nama_kriteria'])->normalisasi,
            ]));
        }
        // dd($nilai);
        foreach($nilai->groupBy('nama_alternatif') as $key => $value){
            $sumUtility = $value->sum('hasil');
            $nilaiAkhir->push(collect([
                'nama_alternatif' => $key,
                'nilai_akhir' => number_format($sumUtility,2)
            ]));
        }
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

        $content = view('perhitungan.cetak', 
        [
            'kriteria_' => $data['kriteria'], 
            'nilai' => $data['nilai'],
            'dataAsli' => $this->dataAsli(), // untuk menampilkan data asli dari tabel nilai
            'normalisasi' => $this->normalisasi(),
            'parameter' => $this->parameter(),
            'utility' => $this->utility(),
            'nilaiAkhir' => $this->nilaiAkhir(),
            'ranking' => $this->ranking(),
        ]);
        // $html2pdf = new Html2Pdf('P', 'A4', 'en', true, 'UTF-8', [10, 5, 10, 0]);
        $html2pdf = new Html2Pdf('L', 'A4', 'en', true, 'UTF-8', [10, 5, 10, 0]);
        $html2pdf->pdf->SetTitle('Cetak Data Perhitungan');
        $html2pdf->writeHTML($content);
        $html2pdf->output("perhitungan.pdf");
    }
}
