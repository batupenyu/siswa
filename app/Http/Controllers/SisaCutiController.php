<?php

namespace App\Http\Controllers;

use App\Models\SisaCuti;
use App\Models\Pegawai;
use Illuminate\Http\Request;

class SisaCutiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $sisaCutis = SisaCuti::with('pegawai')
            ->when($search, function ($query, $search) {
                return $query->whereHas('pegawai', function ($q) use ($search) {
                    $q->where('nama', 'like', '%' . $search . '%');
                });
            })
            ->get();

        return view('sisa_cuti.index', compact('sisaCutis', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pegawais = Pegawai::all();
        return view('sisa_cuti.create', compact('pegawais'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'pegawais_id' => 'required|exists:pegawais,id',
            'sisa_tahun_n' => 'required|integer',
            'sisa_tahun_n_1' => 'required|integer',
            'sisa_tahun_n_2' => 'required|integer',
        ]);

        SisaCuti::create($request->all());

        return redirect()->route('sisa_cuti.index')->with('success', 'Sisa Cuti created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SisaCuti $sisaCuti)
    {
        $pegawais = Pegawai::all();
        return view('sisa_cuti.edit', compact('sisaCuti', 'pegawais'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SisaCuti $sisaCuti)
    {
        $request->validate([
            'pegawais_id' => 'required|exists:pegawais,id',
            'sisa_tahun_n' => 'required|integer',
            'sisa_tahun_n_1' => 'required|integer',
            'sisa_tahun_n_2' => 'required|integer',
        ]);

        $sisaCuti->update($request->all());

        return redirect()->route('sisa_cuti.index')->with('success', 'Sisa Cuti updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SisaCuti $sisaCuti)
    {
        $sisaCuti->delete();

        return redirect()->route('sisa_cuti.index')->with('success', 'Sisa Cuti deleted successfully.');
    }
}
