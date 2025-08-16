<?php

namespace App\Http\Controllers;

use App\Models\Spmt;
use App\Models\Pegawai;
use Illuminate\Http\Request;

class SpmtController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $spmts = Spmt::with('pegawai')->get();
        return view('spmts.index', compact('spmts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pegawais = Pegawai::all();
        return view('spmts.create', compact('pegawais'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'pegawai_id' => 'required|exists:pegawais,id',
            'dasar_surat' => 'required',
            'nomor_surat' => 'required',
            'tgl_surat' => 'required|date',
            'hal_surat' => 'required',
            'tgl_ditetapkan' => 'required|date',
            'tempat_ditetapkan' => 'required',
        ]);

        Spmt::create($request->all());

        return redirect()->route('spmts.index')
            ->with('success', 'SPMT created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Spmt $spmt)

    {
        $penilai = \App\Models\Penilai::first();
        $pdf = \PDF::loadView('spmts.pdf', compact('spmt', 'penilai'));
        return $pdf->stream('spmt.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Spmt $spmt)
    {
        $pegawais = Pegawai::all();
        return view('spmts.edit', compact('spmt', 'pegawais'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Spmt $spmt)
    {
        $request->validate([
            'pegawai_id' => 'required|exists:pegawais,id',
            'dasar_surat' => 'required',
            'nomor_surat' => 'required',
            'tgl_surat' => 'required|date',
            'hal_surat' => 'required',
            'tgl_ditetapkan' => 'required|date',
            'tempat_ditetapkan' => 'required',
        ]);

        $spmt->update($request->all());

        return redirect()->route('spmts.index')
            ->with('success', 'SPMT updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Spmt $spmt)
    {
        $spmt->delete();

        return redirect()->route('spmts.index')
            ->with('success', 'SPMT deleted successfully');
    }
}
