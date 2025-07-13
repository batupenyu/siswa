<?php

namespace App\Http\Controllers;

use App\Models\Kpa;
use Illuminate\Http\Request;

class KpaController extends Controller
{
    public function index()
    {
        $kpas = Kpa::all();
        return view('kpa.index', compact('kpas'));
    }

    public function create()
    {
        return view('kpa.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'nip' => 'required|string|max:255|unique:kpa,nip',
            'pangkat' => 'required|string|max:255',
            'unitkerja' => 'required|string|max:255',
            'instansi' => 'required|string|max:255',
        ]);

        Kpa::create($request->all());

        return redirect()->route('kpa.index')->with('success', 'Kpa created successfully.');
    }

    public function show(Kpa $kpa)
    {
        return view('kpa.show', compact('kpa'));
    }

    public function edit(Kpa $kpa)
    {
        return view('kpa.edit', compact('kpa'));
    }

    public function update(Request $request, Kpa $kpa)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'nip' => 'required|string|max:255|unique:kpa,nip,' . $kpa->id,
            'pangkat' => 'required|string|max:255',
            'unitkerja' => 'required|string|max:255',
            'instansi' => 'required|string|max:255',
        ]);

        $kpa->update($request->all());

        return redirect()->route('kpa.index')->with('success', 'Kpa updated successfully.');
    }

    public function destroy(Kpa $kpa)
    {
        $kpa->delete();

        return redirect()->route('kpa.index')->with('success', 'Kpa deleted successfully.');
    }
}
