<?php

namespace App\Http\Controllers;

use App\Models\Penilai;
use Illuminate\Http\Request;

class PenilaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $penilai = Penilai::all();
        return view('penilai.index', compact('penilai'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('penilai.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'nip' => 'required|string|max:255|unique:penilai,nip',
            'pangkat' => 'required|string|max:255',
            'unitkerja' => 'required|string|max:255',
            'instansi' => 'required|string|max:255',
        ]);

        Penilai::create($request->all());

        return redirect()->route('penilai.index')->with('success', 'Penilai created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Penilai $penilai)
    {
        return view('penilai.show', compact('penilai'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Penilai $penilai)
    {
        return view('penilai.edit', compact('penilai'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Penilai $penilai)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'nip' => 'required|string|max:255|unique:penilai,nip,' . $penilai->id,
            'pangkat' => 'required|string|max:255',
            'unitkerja' => 'required|string|max:255',
            'instansi' => 'required|string|max:255',
        ]);

        $penilai->update($request->all());

        return redirect()->route('penilai.index')->with('success', 'Penilai updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Penilai $penilai)
    {
        $penilai->delete();

        return redirect()->route('penilai.index')->with('success', 'Penilai deleted successfully.');
    }
}
