<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Http\Requests\FormKriteriaRequest;

class KriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kriteria =  Kriteria::all();
        return view('kriteria.index', ['kriteria_' => $kriteria]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kriteria.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FormKriteriaRequest $request)
    {
        Kriteria::create($request->validated());

        return redirect()->route('kriteria.index')->with('status', 'success')->with('pesan', "Data $request->nama berhasil ditambahkan.");
    }

    /**
     * Show
     * the form for editing the specified resource.
     *
     * @param  \App\Models\Kriteria  $kriteria
     * @return \Illuminate\Http\Response
     */
    public function edit(Kriteria $kriterium)
    {
        return view('kriteria.edit', ['kriteria' => $kriterium]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kriteria  $kriteria
     * @return \Illuminate\Http\Response
     */
    public function update(Kriteria $kriterium, FormKriteriaRequest $request)
    {
        $kriterium->update($request->validated());

        return redirect()->route('kriteria.index')->with('status', 'success')->with('pesan', "Data $request->nama berhasil diperbarui.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kriteria  $kriteria
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kriteria $kriterium)
    {
        $kriterium->delete();

        return redirect()->route('kriteria.index')->with('status', 'success')->with('pesan', "Data $kriterium->nama berhasil dihapus.");
    }
}
