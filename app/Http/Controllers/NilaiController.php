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
            "alternatif.id as id_alternatif",
            "kriteria.nama as nama_kriteria",
            "parameter.nama as nama_parameter",
            "parameter.bobot as bobot_parameter",
            "alternatif.nama as nama_alternatif",
        )
            ->join("kriteria", "kriteria.id", "=", "nilai.id_kriteria")
            ->join("parameter", "parameter.id", "=", "nilai.id_parameter")
            ->join("alternatif", "alternatif.id", "=", "nilai.id_alternatif")
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
        if (request('id_alternatif') === null) {
            return redirect()->route("nilai.index")->with('status', 'warning')->with('pesan', 'Alternatif harus dipilih.');
        }
        $alternatif =  Nilai::where('id_alternatif', request('id_alternatif'))->count();
        if ($alternatif > 0) {
            return redirect()->route("nilai.index")->with('status', 'warning')->with('pesan', 'Alternatif sudah terdaftar.');
        }
        $result = Parameter::select(
            "parameter.id",
            "parameter.id_kriteria",
            "kriteria.nama as nama_kriteria",
            "parameter.nama as nama_parameter",
        )->join("kriteria", "kriteria.id", "=", "parameter.id_kriteria")->get();

        return view('nilai.create', ['result' => $result, 'nama_alternatif' => Alternatif::find(request('id_alternatif'))->nama]);
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Nilai  $nilai
     * @return \Illuminate\Http\Response
     */
    public function edit($id_alternatif)
    {
        $nilai = Nilai::where("id_alternatif", $id_alternatif)->get();
        $id_parameter = $nilai->pluck('id_parameter');
        $result = Parameter::select(
            "parameter.id",
            "parameter.id_kriteria",
            "kriteria.nama as nama_kriteria",
            "parameter.nama as nama_parameter",
        )
            ->join("kriteria", "kriteria.id", "=", "parameter.id_kriteria")->get();
        return view('nilai.edit', ['result' => $result, 'id_parameter' => $id_parameter, 'id_alternatif' => $id_alternatif, 'nama_alternatif' => Alternatif::firstWhere("id", $id_alternatif)->nama]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Nilai  $nilai
     * @return \Illuminate\Http\Response
     */
    public function update($id_alternatif, FormNilaiRequest $request)
    {
        $request->validated();
        try {
            DB::beginTransaction();
            $nilai = Nilai::where('id_alternatif', $id_alternatif)->get();
            foreach ($nilai as $key => $value) {
                $value->update([
                    'id_parameter' => $request->id_parameter[$key + 1],
                ]);
            }
            DB::commit();
            return redirect()->route("nilai.index")->with('status', 'success')->with('pesan', 'Data Nilai Alternatif berhasil diperbarui.');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route("nilai.edit", $id_alternatif)->with('status', 'warning')->with('pesan', 'Nilai Pilihan Kriteria tidak lengkap.');
        }
    }

    public function destroy($id_alternatif)
    {
        Nilai::where("id_alternatif", $id_alternatif)->delete();
        return redirect()->route('nilai.index')->with('status', 'success')->with('pesan', 'Data Nilai Alternatif berhasil dihapus.');
    }
}
