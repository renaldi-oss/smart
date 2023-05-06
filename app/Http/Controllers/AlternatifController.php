<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Http\Requests\FormAlternatifRequest;

class AlternatifController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $alternatif =  Alternatif::all();
        return view('alternatif.index', ['alternatif_' => $alternatif]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('alternatif.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FormAlternatifRequest $request)
    {
        Alternatif::create($request->validated());

        return redirect()->route('alternatif.index')->with('status', 'success')->with('pesan', "Data $request->nama berhasil ditambahkan.");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Alternatif  $alternatif
     * @return \Illuminate\Http\Response
     */
    public function edit(Alternatif $alternatif)
    {
        return view('alternatif.edit', ['alternatif' => $alternatif]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Alternatif  $alternatif
     * @return \Illuminate\Http\Response
     */
    public function update(Alternatif $alternatif, FormAlternatifRequest $request)
    {
        $alternatif->update($request->validated());

        return redirect()->route('alternatif.index')->with('status', 'success')->with('pesan', "Data $request->nama berhasil diperbarui.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Alternatif  $alternatif
     * @return \Illuminate\Http\Response
     */
    public function destroy(Alternatif $alternatif)
    {
        $alternatif->delete();

        return redirect()->route('alternatif.index')->with('status', 'success')->with('pesan', "Data $alternatif->nama berhasil dihapus.");
    }
}
