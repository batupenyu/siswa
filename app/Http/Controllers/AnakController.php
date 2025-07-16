<?php

namespace App\Http\Controllers;

use App\Models\Anak;
use Illuminate\Http\Request;
use PDF;

class AnakController extends Controller
{
    // API methods
    public function index()
    {
        $anakList = Anak::paginate(5);
        return view('anak.index', compact('anakList'));
    }

    public function show($id)
    {
        $anak = Anak::find($id);
        if (!$anak) {
            return view('anak.index', compact('anak'), 404);
        }
        return view('anak.index', compact('anak'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'pegawais_id' => 'required|exists:pegawais,id',
            'nama' => 'required|string|max:255',
            'tgl_lahir' => 'required|date',
            'tempat_lahir' => 'required|string|max:255',
            'status_pekerjaan' => 'required|in:bekerja,belum bekerja',
            'status_pernikahan' => 'required|in:menikah,belum menikah',
            'pendidikan' => 'required|string|max:255',
            'nama_sekolah' => 'required|string|max:255',
        ]);

        Anak::create($validated);
        return redirect()->route('anak.index')->with('success', 'Data anak berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $anak = Anak::find($id);
        if (!$anak) {
            return response()->json(['message' => 'Anak not found'], 404);
        }

        $validated = $request->validate([
            'pegawais_id' => 'sometimes|required|exists:pegawais,id',
            'nama' => 'sometimes|required|string|max:255',
            'tgl_lahir' => 'sometimes|required|date',
            'tempat_lahir' => 'sometimes|required|string|max:255',
            'status_pekerjaan' => 'sometimes|required|in:bekerja,belum bekerja',
            'status_pernikahan' => 'sometimes|required|in:menikah,belum menikah',
            'pendidikan' => 'sometimes|required|string|max:255',
            'nama_sekolah' => 'sometimes|required|string|max:255',
        ]);

        $anak->update($validated);
        return redirect()->route('anak.index')->with('success', 'Data anak berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $anak = Anak::find($id);
        if (!$anak) {
            return redirect()->route('anak.index')->with('error', 'Data anak tidak ditemukan.');
        }

        $anak->delete();
        return redirect()->route('anak.index')->with('success', 'Data anak berhasil dihapus.');
    }

    // Web view methods
    public function viewIndex()
    {
        $anakList = Anak::paginate(5);
        return view('anak.index', compact('anakList'));
    }

    public function viewShowWeb($id)
    {
        $pegawai = \App\Models\Pegawai::with('anak')->findOrFail($id);
        $anak = $pegawai->anak;
        $penilai = \App\Models\Penilai::first();
        if (!$anak) {
            return redirect()->route('anak.index')->with('error', 'Data anak tidak ditemukan.');
        }
        return view('anak.show', compact('pegawai', 'anak', 'penilai'));
    }

    // Removed duplicate viewShow method to fix redeclaration error

    public function pdf($id)
    {
        $pegawai = \App\Models\Pegawai::with('anak')->findOrFail($id);
        $anak = $pegawai->anak;
        $penilai = \App\Models\Penilai::first();
        if (!$anak) {
            return redirect()->route('anak.index')->with('error', 'Data anak tidak ditemukan.');
        }
        $pdf = PDF::loadView('anak.show', compact('pegawai', 'anak','penilai'));
        return $pdf->stream('anak_'.$id.'.pdf');
    }

    public function viewEdit($id)
    {
        $anak = Anak::findOrFail($id);
        return view('anak.edit', compact('anak'));
    }

    public function updateWeb(Request $request, $id)
    {
        $anak = Anak::findOrFail($id);

        $validated = $request->validate([
            'pegawais_id' => 'required|exists:pegawais,id',
            'nama' => 'required|string|max:255',
            'tgl_lahir' => 'required|date',
            'tempat_lahir' => 'required|string|max:255',
            'status_pekerjaan' => 'required|in:bekerja,belum bekerja',
            'status_pernikahan' => 'required|in:menikah,belum menikah',
            'pendidikan' => 'required|string|max:255',
            'nama_sekolah' => 'required|string|max:255',
        ]);

        $anak->update($validated);

        return redirect()->route('anak.index')->with('success', 'Data anak berhasil diperbarui.');
    }

    public function viewCreate()
    {
        $pegawais = \App\Models\Pegawai::all();
        return view('anak.create', compact('pegawais'));
    }
}
