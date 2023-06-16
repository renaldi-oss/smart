<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use App\Models\Parameter;
use App\Models\Alternatif;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\FormNilaiRequest;
use Illuminate\Http\Request;

class NilaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        if (count(Alternatif::all()) == 0 || count(Parameter::all()) == 0) {
            return redirect()->back()->with('status', 'warning')->with('pesan', "Tidak dapat mengisi data Nilai jika terdapat data yang masih kosong!");
        }
        return view('nilai.index', [
            'result' => Nilai::select(
                "nilai.id",
                "alternatif.nama as nama_alternatif",
                "kriteria.nama as nama_kriteria",
                "parameter.nama as nama_parameter",
                "nilai.nilai",
            )->join("alternatif", "alternatif.id", "=", "nilai.alternatif_id")
                ->join("kriteria", "kriteria.id", "=", "nilai.kriteria_id")
                ->join("parameter", "parameter.id", "=", "nilai.parameter_id")
                ->get(),
            'alternatif' => Alternatif::all(),
            'parameter' => Parameter::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (request('alternatif_id') === null) {
            return redirect()->route("nilai.index")->with('status', 'warning')->with('pesan', 'Alternatif harus dipilih.');
        }
        $alternatif =  Nilai::where('alternatif_id', request('alternatif_id'))->count();
        if ($alternatif > 0) {
            return redirect()->route("nilai.index")->with('status', 'warning')->with('pesan', 'Alternatif sudah terdaftar.');
        }
        $result = Parameter::select(
            "parameter.id",
            "parameter.kriteria_id",
            "kriteria.nama as nama_kriteria",
            "parameter.nama as nama_parameter",
        )->join("kriteria", "kriteria.id", "=", "parameter.kriteria_id")->get();

        return view('nilai.create', ['result' => $result, 'nama_alternatif' => Alternatif::find(request('alternatif_id'))->nama, 'alternatif_id' => '']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FormNilaiRequest $request)
    {
        $request->validated();
        try {
            DB::beginTransaction();
            foreach ($request->id_kriteria as $key => $value) {
                Nilai::create([
                    'id_kriteria' => $value,
                    'id_alternatif' => $request->id_alternatif,
                    'id_parameter' => $request->id_parameter[$key + 1],
                ]);
            }
            DB::commit();
            return redirect()->route("nilai.index")->with('status', 'success')->with('pesan', 'Data Nilai Alternatif berhasil ditambahkan');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('nilai.create', ['id_alternatif' => $request->id_alternatif])->with('status', 'warning')->with('pesan', 'Nilai Pilihan Kriteria tidak lengkap.');
        }
    }
//     public function store(FormNilaiRequest $request)
//    {
//     $request->validated();

//     try {
//         DB::beginTransaction();

//         $kriteriaData = $request->input('kriteria_id', []);
//         $nilaiData = $request->input('nilai_', []);
//         $parameterData = $request->input('parameter_id', []);

//         foreach ($kriteriaData as $key => $value) {
//             if (isset($parameterData[$key+1]) && isset($nilaiData[$key+1])) {
//                 Nilai::create([
//                     'kriteria_id' => $value,
//                     'alternatif_id' => $request->alternatif_id,
//                     'parameter_id' => $parameterData[$key+1],
//                     'nilai' => $nilaiData[$key+1]
//                 ]);
//             }
//         }

//         DB::commit();
//         return redirect()->route("nilai.index")->with('status', 'success')->with('pesan', 'Data Nilai Alternatif berhasil ditambahkan');
//     } catch (\Throwable $th) {
//         DB::rollback();
//         return redirect()->route('nilai.create', ['alternatif_id' => $request->alternatif_id])->with('status', 'warning')->with('pesan', 'Nilai Pilihan Kriteria tidak lengkap.');
//     }
// }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Nilai  $nilai
     * @return \Illuminate\Http\Response
     */
    public function edit($id_alternatif)
    {
        // dd($id_alternatif);
        $alternatif = Alternatif::firstWhere("nama", $id_alternatif);
        $nilai = Nilai::where("alternatif_id", $alternatif->id)->get();
        $id_parameter = $nilai->pluck('parameter_id');
        $result = Parameter::select(
            "parameter.id",
            "parameter.kriteria_id",
            "kriteria.nama as nama_kriteria",
            "parameter.nama as nama_parameter",
        )
            ->join("kriteria", "kriteria.id", "=", "parameter.kriteria_id")->get();
        return view('nilai.edit', ['result' => $result, 'parameter_id' => $id_parameter, 'alternatif_id' => $id_alternatif, 'nama_alternatif' => $alternatif->nama]);
    }
    // public function edit($nama_alternatif)
    // {
    //     $alternatif_id = Alternatif::firstWhere("nama", $nama_alternatif)->id;
    //     $nilai = Nilai::where('alternatif_id', $alternatif_id)->get();

    //     $nilai = Nilai::select(
    //         'nilai.id',
    //         'nilai.alternatif_id',
    //         'nilai.kriteria_id',
    //         'nilai.parameter_id',
    //         'nilai.nilai',
    //         'alternatif.nama as nama_alternatif',
    //         'kriteria.nama as nama_kriteria',
    //         'parameter.nama as nama_parameter',
    //     )
    //         ->join("alternatif", "alternatif.id", "=", "nilai.alternatif_id")
    //         ->join("kriteria", "kriteria.id", "=", "nilai.kriteria_id")
    //         ->join("parameter", "parameter.id", "=", "nilai.parameter_id")
    //         ->where('nilai.alternatif_id', $alternatif_id)
    //         ->get();
    //     $result = Parameter::select(
    //         "parameter.id",
    //         "parameter.kriteria_id",
    //         "kriteria.nama as nama_kriteria",
    //         "parameter.nama as nama_parameter",
    //         "parameter.bobot as bobot_parameter",
    //     )
    //         ->join("kriteria", "kriteria.id", "=", "parameter.kriteria_id")->get();
    //     return view('nilai.edit',[
    //         'alternatif_id' => $alternatif_id,
    //         'nilai' => $nilai,
    //         'result' => $result, 
    //         'nama_alternatif' => Alternatif::firstWhere("id", $alternatif_id)->nama,
    //         'alternatif_id' => $alternatif_id
    //     ]);
    // }
    // public function edit($nama_alternatif)
    // {
    //     $alternatif_id = Alternatif::firstWhere("nama", $nama_alternatif)->id;
    //     $nilai = Nilai::where('alternatif_id', $alternatif_id)->get();
        
    //     $parameter_id = $nilai->pluck('parameter_id');
    //     $result = Parameter::select(
    //         "parameter.id",
    //         "parameter.kriteria_id",
    //         "kriteria.nama as nama_kriteria",
    //         "parameter.nama as nama_parameter",
    //         "parameter.bobot as bobot_parameter",
    //     )
    //         ->join("kriteria", "kriteria.id", "=", "parameter.kriteria_id")->get();
        
    //     return view('nilai.edit', [
    //         'nilai' => $nilai,

    //         'result' => $result, 
    //         'parameter_id' => $parameter_id, 
    //         'alternatif_id' => $alternatif_id, 
    //         'nama_alternatif' => Alternatif::firstWhere("id", $alternatif_id)->nama]);
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Nilai  $nilai
     * @return \Illuminate\Http\Response
     */
    public function update($id_alternatif, Request $request)
    {
        try {
            DB::beginTransaction();
            $alternatif = Alternatif::where('nama', $id_alternatif)->first();
            $nilai = Nilai::where('alternatif_id', $alternatif->id)->get();
            // dd($nilai);
            // dd($request->id_parameter);
            foreach ($nilai as $key => $value) {
                $value->update([
                    'parameter_id' => $request->id_parameter[$key],
                ]);
            }
            DB::commit();
            return redirect()->route("nilai.index")->with('status', 'success')->with('pesan', 'Data Nilai Alternatif berhasil diperbarui.');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route("nilai.edit", $id_alternatif)->with('status', 'warning')->with('pesan', 'Nilai Pilihan Kriteria tidak lengkap.');
        }
    }
    // public function update($alternatif_id, FormNilaiRequest $request)
    // {
    // //     $nilai = Nilai::where('alternatif_id', $alternatif_id)->get();
    // // DB::beginTransaction();

    // // $nilaiData = $request->input('nilai_', []);
    // // $parameterData = $request->input('parameter_id', []);

    // // foreach ($nilai as $key => $value) {
    // //     if (isset($nilaiData[$key+1]) && isset($parameterData[$key+1])) {
    // //         $value->update([
    // //             'parameter_id' => $parameterData[$key+1],
    // //             'nilai' => $nilaiData[$key+1]
    // //         ]);
    // //     }
    // // }

    // // DB::commit();
    // // return redirect()->route("nilai.index")->with('status', 'success')->with('pesan', 'Data Nilai Alternatif berhasil diperbarui.');
    //     try {
    //         DB::beginTransaction();
    //         $nilai = Nilai::where('alternatif_id', $alternatif_id)->get();
    //         foreach ($nilai as $key => $value) {
    //             $value->update([
    //                 'parameter_id' => $request->parameter_id[$key++],
    //             ]);
    //         }
    //         DB::commit();
    //         return redirect()->route("nilai.index")->with('status', 'success')->with('pesan', 'Data Nilai Alternatif berhasil diperbarui.');
    //     } catch (\Throwable $th) {
    //         DB::rollback();
    //         $nama_alternatif = Alternatif::firstWhere("id", $alternatif_id)->nama;
    //         return redirect()->route("nilai.edit", $nama_alternatif)->with('status', 'warning')->with('pesan', 'Nilai Pilihan Kriteria tidak lengkap.');
    //     }
    // }

    public function destroy($nama_alternatif)
    {
        $alternatif_id = Alternatif::firstWhere("nama", $nama_alternatif)->id;
        Nilai::where("alternatif_id", $alternatif_id)->delete();
        return redirect()->route('nilai.index')->with('status', 'success')->with('pesan', 'Data Nilai Alternatif berhasil dihapus.');
    }
}
