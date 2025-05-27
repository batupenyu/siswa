<?php

namespace App\Http\Controllers;

use App\Models\SuratDispensasi;
use Illuminate\Http\Request;

class SuratDispensasiController extends Controller
{
    /**
     * Display a listing of the surat_dispensasi.
     */
    public function index()
    {
        $suratDispensasi = SuratDispensasi::all();
        return response()->json($suratDispensasi);
    }

    /**
     * Store a newly created surat_dispensasi in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'siswas_id' => 'required|exists:siswas,id',
            'nama_kegiatan' => 'required|string|max:255',
            'tgl_kegiatan' => 'required|date',
            'waktu_kegiatan' => 'required|date_format:H:i',
            'tgl_ditetapkan' => 'required|date',
        ]);

        $suratDispensasi = SuratDispensasi::create($validated);

        return response()->json($suratDispensasi, 201);
    }

    /**
     * Display the specified surat_dispensasi.
     */
    public function show($id)
    {
        $suratDispensasi = SuratDispensasi::findOrFail($id);
        return response()->json($suratDispensasi);
    }

    /**
     * Update the specified surat_dispensasi in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'siswas_id' => 'sometimes|exists:siswas,id',
            'nama_kegiatan' => 'sometimes|string|max:255',
            'tgl_kegiatan' => 'sometimes|date',
            'waktu_kegiatan' => 'sometimes|date_format:H:i',
            'tgl_ditetapkan' => 'sometimes|date',
        ]);

        $suratDispensasi = SuratDispensasi::findOrFail($id);
        $suratDispensasi->update($validated);

        return response()->json($suratDispensasi);
    }

    /**
     * Remove the specified surat_dispensasi from storage.
     */
    public function destroy($id)
    {
        $suratDispensasi = SuratDispensasi::findOrFail($id);
        $suratDispensasi->delete();

        return response()->json(null, 204);
    }
}
