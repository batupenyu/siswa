<?php

namespace App\Http\Controllers;

use App\Models\Cuti;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class CutiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $cuti = Cuti::with('pegawai')
            ->when($search, function ($query, $search) {
                return $query->whereHas('pegawai', function ($q) use ($search) {
                    $q->where('nama', 'like', '%' . $search . '%');
                });
            })
            ->get();

        return view('cuti.index', compact('cuti', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pegawais = \App\Models\Pegawai::all();
        $penilais = \App\Models\Penilai::all();
        $kpas = \App\Models\Kpa::all();
        return view('cuti.create', compact('pegawais', 'penilais', 'kpas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'pegawais_id' => 'required|exists:pegawais,id',
            'penilai_id' => 'required|exists:penilai,id',
            'kpa_id' => 'required|exists:kpa,id',
            'jenis_cuti' => 'required|in:tahunan,besar,sakit,melahirkan,alasan_penting,luar_tanggungan',
            'status_penilai' => 'nullable|in:disetujui,perubahan,ditangguhkan,tidak_disetujui',
            'status_kpa' => 'nullable|in:disetujui,perubahan,ditangguhkan,tidak_disetujui',
            'alasan' => 'required|string',
            'lama_cuti' => 'required|integer',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'telepon' => 'required|string',
            'alamat_selama_cuti' => 'required|string',
        ]);

        Cuti::create($request->all());

        return redirect()->route('cuti.index')->with('success', 'Cuti created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cuti $cuti)
    {
        $pdf = Pdf::loadView('cuti.show', compact('cuti'));
        return $pdf->stream('cuti.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cuti $cuti)
    {
        $pegawais = \App\Models\Pegawai::all();
        $penilais = \App\Models\Penilai::all();
        $kpas = \App\Models\Kpa::all();
        return view('cuti.edit', compact('cuti', 'pegawais', 'penilais', 'kpas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cuti $cuti)
    {
        $request->validate([
            'pegawais_id' => 'required|exists:pegawais,id',
            'penilai_id' => 'required|exists:penilai,id',
            'kpa_id' => 'required|exists:kpa,id',
            'jenis_cuti' => 'required|in:tahunan,besar,sakit,melahirkan,alasan_penting,luar_tanggungan',
            'status_penilai' => 'nullable|in:disetujui,perubahan,ditangguhkan,tidak_disetujui',
            'status_kpa' => 'nullable|in:disetujui,perubahan,ditangguhkan,tidak_disetujui',
            'alasan' => 'required|string',
            'lama_cuti' => 'required|integer',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'telepon' => 'required|string',
            'alamat_selama_cuti' => 'required|string',
            'sisa_cuti_n' => 'nullable|integer',
            'sisa_cuti_n_1' => 'nullable|integer',
            'sisa_cuti_n_2' => 'nullable|integer',
        ]);

        $cuti->update($request->all());

        return redirect()->route('cuti.index')->with('success', 'Cuti updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cuti $cuti)
    {
        $cuti->delete();

        return redirect()->route('cuti.index')->with('success', 'Cuti deleted successfully.');
    }

    public function rekapPegawai($pegawai_id)
    {
        $cuti = Cuti::where('pegawais_id', $pegawai_id)->with('pegawai')->get();
        $cutiFirst = Cuti::where('pegawais_id', $pegawai_id)->with('pegawai')->first();
        $pegawai = \App\Models\Pegawai::find($pegawai_id);
        $penilai = \App\Models\Penilai::first();
        $pdf = Pdf::loadView('cuti.rekap', compact('cuti', 'pegawai', 'penilai', 'cutiFirst'));
        $pdf->setPaper('a4', 'landscape');
        return $pdf->stream('rekap-cuti-' . optional($pegawai)->nama . '.pdf');
    }
}
