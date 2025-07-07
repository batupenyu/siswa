<?php

namespace App\Http\Controllers;

use App\Models\Mutasi;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class MutasiController extends Controller
{
    public function index()
    {
        $mutasis = Mutasi::with('siswa')->paginate(10);
        return view('mutasi.index', compact('mutasis'));
    }

    public function create()
    {
        $siswas = Siswa::all();
        return view('mutasi.create', compact('siswas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'siswas_id' => 'required|exists:siswas,id',
            'alasan_pindah' => 'required|string',
            'created_at' => 'nullable|date',
            'updated_at' => 'nullable|date',
        ]);

        try {
            Mutasi::create($request->all());
            return redirect()->route('mutasi.index')->with('success', 'Mutasi created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Failed to create Mutasi: ' . $e->getMessage()]);
        }
    }

    public function show(Mutasi $mutasi)
    {
        return view('mutasi.show', compact('mutasi'));
    }

    public function edit(Mutasi $mutasi)
    {
        $siswas = Siswa::all();
        return view('mutasi.edit', compact('mutasi', 'siswas'));
    }

    public function update(Request $request, Mutasi $mutasi)
    {
        $request->validate([
            'siswas_id' => 'required|exists:siswas,id',
            'alasan_pindah' => 'required|string',
        ]);

        $mutasi->update($request->all());

        return redirect()->route('mutasi.index')->with('success', 'Mutasi updated successfully.');
    }

    public function destroy(Mutasi $mutasi)
    {
        $mutasi->delete();

        return redirect()->route('mutasi.index')->with('success', 'Mutasi deleted successfully.');
    }

    public function viewPdf(Mutasi $mutasi)
    {
        $mutasi->load('siswa');

        // Fetch variables for header and other info, update as per your app context
        $stPegawai = \App\Models\StPegawai::with('pegawais')->first();
        $penilai = \App\Models\Penilai::first();
        $headerIconImage = \App\Models\HeaderIconImage::first();

        // Additional variables as per feedback example
        $kpa = null; // Add logic to fetch $kpa if applicable
        $pegawai_first = null; // Add logic to fetch $pegawai_first if applicable
        $atasanNama = null; // Add logic to fetch $atasanNama if applicable
        $atasanNip = null; // Add logic to fetch $atasanNip if applicable
        $atasanPangkat = null; // Add logic to fetch $atasanPangkat if applicable
        $atasanUnitkerja = null; // Add logic to fetch $atasanUnitkerja if applicable
        $atasanJabatan = null; // Add logic to fetch $atasanJabatan if applicable
        $kpaNama = null; // Add logic to fetch $kpaNama if applicable
        $kpaNip = null; // Add logic to fetch $kpaNip if applicable
        $kpaPangkat = null; // Add logic to fetch $kpaPangkat if applicable
        $kpaUnitkerja = null; // Add logic to fetch $kpaUnitkerja if applicable
        $kpaJabatan = null; // Add logic to fetch $kpaJabatan if applicable

        $pdf = Pdf::loadView('mutasi.suratMutasi', compact(
            'mutasi',
            'stPegawai',
            'penilai',
            'headerIconImage',
            'kpa',
            'pegawai_first',
            'atasanNama',
            'atasanNip',
            'atasanPangkat',
            'atasanUnitkerja',
            'atasanJabatan',
            'kpaNama',
            'kpaNip',
            'kpaPangkat',
            'kpaUnitkerja',
            'kpaJabatan'
        ))->setOption('margin-top', 0);

        $name = preg_replace('/[^A-Za-z0-9_\-]/', '_', $mutasi->siswa->name ?? 'mutasi');
        return $pdf->stream("Mutasi-{$name}.pdf");
    }
}
