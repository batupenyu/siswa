<?php

namespace App\Http\Controllers;

use App\Models\Pasangan;
use App\Models\Pegawai;
use Illuminate\Http\Request;

class PasanganController extends Controller
{
    // API methods
    public function index()
    {
        $pasanganList = Pasangan::paginate(5);
        return view('pasangan.index', compact('pasanganList'));
    }

    public function show($id)
    {
        $pasangan = Pasangan::find($id);
        if (!$pasangan) {
            return view('pasangan.index', compact('pasangan'), 404);
        }
        return view('pasangan.index', compact('pasangan'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'pegawais_id' => 'required|exists:pegawais,id',
            'nama' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tgl_lahir' => 'required|date',
            'tgl_perkawinan' => 'required|date',
            'pekerjaan' => 'required|string|max:255',
            'status_pernikahan' => 'required|in:menikah,belum menikah',
            'status_tunjangan' => 'required|in:ya,tidak',
        ]);

        Pasangan::create($validated);
        return redirect()->route('pasangan.index')->with('success', 'Data pasangan berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $pasangan = Pasangan::find($id);
        if (!$pasangan) {
            return response()->json(['message' => 'Pasangan not found'], 404);
        }

        $validated = $request->validate([
            'pegawais_id' => 'sometimes|required|exists:pegawais,id',
            'nama' => 'sometimes|required|string|max:255',
            'tempat_lahir' => 'sometimes|required|string|max:255',
            'tgl_lahir' => 'sometimes|required|date',
            'tgl_perkawinan' => 'sometimes|required|date',
            'pekerjaan' => 'sometimes|required|string|max:255',
            'status_pernikahan' => 'sometimes|required|in:menikah,belum menikah',
            'status_tunjangan' => 'sometimes|required|in:ya,tidak',
        ]);

        $pasangan->update($validated);
        return redirect()->route('pasangan.index')->with('success', 'Data pasangan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pasangan = Pasangan::find($id);
        if (!$pasangan) {
            return redirect()->route('pasangan.index')->with('error', 'Data pasangan tidak ditemukan.');
        }

        $pasangan->delete();
        return redirect()->route('pasangan.index')->with('success', 'Data pasangan berhasil dihapus.');
    }

    // Web view methods
    public function viewIndex()
    {
        $pasanganList = Pasangan::paginate(5);
        return view('pasangan.index', compact('pasanganList'));
    }

    public function viewShowWeb($id)
    {
        $pasangan = Pasangan::with('pegawai')->findOrFail($id);
        if (!$pasangan) {
            return redirect()->route('pasangan.index')->with('error', 'Data pasangan tidak ditemukan.');
        }
        return view('pasangan.show', compact('pasangan'));
    }

    public function surat($pegawai_id)
    {
        $pegawai = \App\Models\Pegawai::with('pasangan')->findOrFail($pegawai_id);
        $penilai = \App\Models\Penilai::first();
        if (!$pegawai) {
            return redirect()->route('pasangan.index')->with('error', 'Data pegawai tidak ditemukan.');
        }
        return view('pasangan.surat', compact('pegawai', 'penilai'));
    }

    public function viewCreate()
    {
        $pegawais = Pegawai::all();
        return view('pasangan.create', compact('pegawais'));
    }

    public function viewEdit($id)
    {
        $pasangan = Pasangan::findOrFail($id);
        $pegawais = Pegawai::all();
        return view('pasangan.edit', compact('pasangan', 'pegawais'));
    }

    public function updateWeb(Request $request, $id)
    {
        $pasangan = Pasangan::findOrFail($id);

        $validated = $request->validate([
            'pegawais_id' => 'required|exists:pegawais,id',
            'nama' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tgl_lahir' => 'required|date',
            'tgl_perkawinan' => 'required|date',
            'pekerjaan' => 'required|string|max:255',
            'status_pernikahan' => 'required|in:menikah,belum menikah',
            'status_tunjangan' => 'required|in:ya,tidak',
        ]);

        $pasangan->update($validated);

        return redirect()->route('pasangan.index')->with('success', 'Data pasangan berhasil diperbarui.');
    }

    public function create()
    {
        $pegawais = Pegawai::all();
        return view('pasangan.create', compact('pegawais'));
    }

    public function edit($id)
    {
        $pasangan = Pasangan::findOrFail($id);
        $pegawais = Pegawai::all();
        return view('pasangan.edit', compact('pasangan', 'pegawais'));
    }
}
