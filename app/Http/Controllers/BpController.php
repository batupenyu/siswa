<?php

namespace App\Http\Controllers;

use App\Models\Bp;
use Illuminate\Http\Request;

class BpController extends Controller
{
    public function index()
    {
        $bps = Bp::all();
        return view('bp.index', compact('bps'));
    }

    public function create()
    {
        return view('bp.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'nip' => 'required|string|max:255|unique:bp,nip',
            'pangkat' => 'required|string|max:255',
            'unitkerja' => 'required|string|max:255',
            'instansi' => 'required|string|max:255',
        ]);

        Bp::create($request->all());

        return redirect()->route('bp.index')->with('success', 'Bp created successfully.');
    }

    public function show(Bp $bp)
    {
        return view('bp.show', compact('bp'));
    }

    public function edit(Bp $bp)
    {
        return view('bp.edit', compact('bp'));
    }

    public function update(Request $request, Bp $bp)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'nip' => 'required|string|max:255|unique:bp,nip,' . $bp->id,
            'pangkat' => 'required|string|max:255',
            'unitkerja' => 'required|string|max:255',
            'instansi' => 'required|string|max:255',
        ]);

        $bp->update($request->all());

        return redirect()->route('bp.index')->with('success', 'Bp updated successfully.');
    }

    public function destroy(Bp $bp)
    {
        $bp->delete();

        return redirect()->route('bp.index')->with('success', 'Bp deleted successfully.');
    }
}
