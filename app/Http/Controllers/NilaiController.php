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
        $result = Nilai::select(
            "alternatif.id as alternatif_id",
            "kriteria.nama as nama_kriteria",
            "parameter.nama as nama_parameter",
            "parameter.bobot as bobot_parameter",
            "alternatif.nama as nama_alternatif",
        )
            ->join("kriteria", "kriteria.id", "=", "nilai.kriteria_id")
            ->join("parameter", "parameter.id", "=", "nilai.parameter_id")
            ->join("alternatif", "alternatif.id", "=", "nilai.alternatif_id")
            ->get();
        if (count(Alternatif::all()) == 0 || count(Parameter::all()) == 0) {
            return redirect()->back()->with('status', 'warning')->with('pesan', "Tidak dapat mengisi data Nilai jika terdapat data yang masih kosong!");
        }
        return view('nilai.index', [
            'result' => $result,
            'alternatif_' => Alternatif::all()
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

        return view('nilai.create', ['result' => $result, 'nama_alternatif' => Alternatif::find(request('alternatif_id'))->nama]);
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
        // try {
        //     DB::beginTransaction();
        //     foreach ($request->kriteria_id as $key => $value) {
        //         Nilai::create([
        //             'kriteria_id' => $value,
        //             'alternatif_id' => $request->alternatif_id,
        //             'parameter_id' => $request->parameter_id[$key + 1],
        //             'nilai' => $request->nilai[$key + 1]
        //         ]);
        //     }
        //     DB::commit();
        //     return redirect()->route("nilai.index")->with('status', 'success')->with('pesan', 'Data Nilai Alternatif berhasil ditambahkan');
        // } catch (\Throwable $th) {
        //     DB::rollback();
        //     return redirect()->route('nilai.create', ['alternatif_id' => $request->alternatif_id])->with('status', 'warning')->with('pesan', 'Nilai Pilihan Kriteria tidak lengkap.');
        // }
        // ubah kode diatas mengunakan eloquent
        foreach ($request->kriteria_id as $key => $value) {
            Nilai::create([
                'kriteria_id' => $value,
                'alternatif_id' => $request->alternatif_id,
                'parameter_id' => $request->parameter_id[$key + 1],
                'nilai' => $request->nilai[$key + 1]
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Nilai  $nilai
     * @return \Illuminate\Http\Response
     */
    public function edit($alternatif_id)
    {
        $nilai = Nilai::where("alternatif_id", $alternatif_id)->get();
        $parameter_id = $nilai->pluck('parameter_id');
        $result = Parameter::select(
            "parameter.id",
            "parameter.kriteria_id",
            "kriteria.nama as nama_kriteria",
            "parameter.nama as nama_parameter",
        )
            ->join("kriteria", "kriteria.id", "=", "parameter.kriteria_id")->get();
        return view('nilai.edit', ['result' => $result, 'parameter_id' => $parameter_id, 'alternatif_id' => $alternatif_id, 'nama_alternatif' => Alternatif::firstWhere("id", $alternatif_id)->nama]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Nilai  $nilai
     * @return \Illuminate\Http\Response
     */
    public function update($alternatif_id, FormNilaiRequest $request)
    {
        $request->validated();
        try {
            DB::beginTransaction();
            $nilai = Nilai::where('alternatif_id', $alternatif_id)->get();
            foreach ($nilai as $key => $value) {
                $value->update([
                    'parameter_id' => $request->parameter_id[$key + 1],
                ]);
            }
            DB::commit();
            return redirect()->route("nilai.index")->with('status', 'success')->with('pesan', 'Data Nilai Alternatif berhasil diperbarui.');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route("nilai.edit", $alternatif_id)->with('status', 'warning')->with('pesan', 'Nilai Pilihan Kriteria tidak lengkap.');
        }
    }

    public function destroy($alternatif_id)
    {
        Nilai::where("alternatif_id", $alternatif_id)->delete();
        return redirect()->route('nilai.index')->with('status', 'success')->with('pesan', 'Data Nilai Alternatif berhasil dihapus.');
    }
}
