<?php

namespace App\Http\Controllers;

use App\Models\SiswaProfil;
use Illuminate\Http\Request;
use App\Http\Requests\SiswaProfilRequest;
use App\Models\Penilai;
use App\Models\Siswa;
use Barryvdh\DomPDF\Facade\Pdf;

class SiswaProfilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = SiswaProfil::query();

        if ($request->has('search_nama') && !empty($request->search_nama)) {
            $searchNama = $request->search_nama;
            $query->where('nama_lengkap', 'like', '%' . $searchNama . '%');
        }

        $siswaProfils = $query->paginate(10);
        return view('siswa_profil.index', compact('siswaProfils'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $siswas = Siswa::all();
        return view('siswa_profil.create', compact('siswas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SiswaProfilRequest $request)
    {
        $validatedData = $request->validated();

        $siswaProfil = SiswaProfil::create($validatedData);

        return redirect()->route('siswa-profil.index')->with('success', 'Siswa Profil created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $penilai = Penilai::first();
        $siswaProfil = SiswaProfil::findOrFail($id);
        $pdf = Pdf::loadView('siswa_profil.show', compact('siswaProfil', 'penilai'));
        return $pdf->stream('siswa_profil_' . $id . '.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $siswaProfil = SiswaProfil::findOrFail($id);
        $siswas = Siswa::all();
        return view('siswa_profil.edit', compact('siswaProfil', 'siswas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SiswaProfilRequest $request, $id)
    {
        $siswaProfil = SiswaProfil::findOrFail($id);

        $validatedData = $request->validated();

        $siswaProfil->update($validatedData);

        return redirect()->route('siswa-profil.show', $siswaProfil->id)->with('success', 'Siswa Profil updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $siswaProfil = SiswaProfil::findOrFail($id);
        $siswaProfil->delete();

        return redirect()->route('siswa-profil.index')->with('success', 'Siswa Profil deleted successfully.');
    }
}
