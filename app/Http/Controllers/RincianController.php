<?php

namespace App\Http\Controllers;

use App\Models\Rincian;
use App\Models\StPegawai;
use Illuminate\Http\Request;

class RincianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rincians = Rincian::all();
        return view('rincian_surat.index', compact('rincians'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $stPegawai = StPegawai::all();
        return view('rincian_surat.create', compact('stPegawai'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'biaya_transportasi' => 'nullable|numeric',
            'biaya_penginapan' => 'nullable|numeric',
            'biaya_tiket' => 'nullable|numeric',
            'transport_lokal' => 'nullable|numeric',
            'uang_makan' => 'nullable|numeric',
            'uang_saku' => 'nullable|numeric',
            'uang_representasi' => 'nullable|numeric',
            'uang_kediklatan' => 'nullable|numeric',
            'korek' => 'nullable|numeric',
        ]);

        Rincian::create($request->all());

        return redirect()->route('rincians.index')
            ->with('success', 'Rincian created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Rincian $rincian)
    {
        // return view('rincians.show', compact('rincian'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rincian $rincian)
    {
        return view('rincians.edit', compact('rincian'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Rincian $rincian)
    {
        $request->validate([
            'biaya_transportasi' => 'nullable|numeric',
            'biaya_penginapan' => 'nullable|numeric',
            'biaya_tiket' => 'nullable|numeric',
            'transport_lokal' => 'nullable|numeric',
            'uang_makan' => 'nullable|numeric',
            'uang_saku' => 'nullable|numeric',
            'uang_representasi' => 'nullable|numeric',
            'uang_kediklatan' => 'nullable|numeric',
            'korek' => 'nullable|numeric',
        ]);

        $rincian->update($request->all());

        return redirect()->route('rincians.index')
            ->with('success', 'Rincian updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rincian $rincian)
    {
        $rincian->delete();

        return redirect()->route('rincians.index')
            ->with('success', 'Rincian deleted successfully');
    }
}
