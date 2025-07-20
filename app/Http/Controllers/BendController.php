<?php

namespace App\Http\Controllers;

use App\Models\Bend;
use App\Models\Pegawai;
use Illuminate\Http\Request;

class BendController extends Controller
{
    public function index(Request $request)
    {
        $bends = Bend::with('pegawai')->paginate(20);
        return view('bend.index', compact('bends'));
    }

    public function create()
    {
        $pegawais = Pegawai::all();
        return view('bend.create', compact('pegawais'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'pegawais_id' => 'required|exists:pegawais,id',
            'bendahara' => 'required|in:ipp,apbn,apbd',
        ]);

        Bend::create($validatedData);

        return redirect()->route('bends.index')->with('success', 'Bend berhasil ditambahkan.');
    }

    public function show($id)
    {
        $bend = Bend::with('pegawai')->findOrFail($id);
        return view('bend.show', compact('bend'));
    }

    public function edit($id)
    {
        $bend = Bend::findOrFail($id);
        $pegawais = Pegawai::all();
        return view('bend.edit', compact('bend', 'pegawais'));
    }

    public function update(Request $request, $id)
    {
        $bend = Bend::findOrFail($id);

        $validatedData = $request->validate([
            'pegawais_id' => 'required|exists:pegawais,id',
            'bendahara' => 'required|in:ipp,apbn,apbd',
        ]);

        $bend->update($validatedData);

        return redirect()->route('bends.index')->with('success', 'Bend berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $bend = Bend::findOrFail($id);
        $bend->delete();

        return redirect()->route('bends.index')->with('success', 'Bend berhasil dihapus.');
    }
}
