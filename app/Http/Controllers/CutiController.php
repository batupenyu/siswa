<?php

namespace App\Http\Controllers;

use App\Models\Cuti;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
<<<<<<< HEAD
=======
use App\Helpers\DateHelper;
>>>>>>> 0da78d7 (commit)

class CutiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
<<<<<<< HEAD
    public function index()
    {
        $cuti = Cuti::all();
        return view('cuti.index', compact('cuti'));
=======
    public function index(Request $request)
    {
        $search = $request->input('search');

        $cuti = Cuti::with('pegawai.sisaCuti', 'sisaCuti')
            ->when($search, function ($query, $search) {
                return $query->whereHas('pegawai', function ($q) use ($search) {
                    $q->where('nama', 'like', '%' . $search . '%');
                });
            })
            ->get();

        return view('cuti.index', compact('cuti', 'search'));
>>>>>>> 0da78d7 (commit)
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pegawais = \App\Models\Pegawai::all();
<<<<<<< HEAD
        $penilais = \App\Models\Penilai::all();
        $kpas = \App\Models\Kpa::all();
        return view('cuti.create', compact('pegawais', 'penilais', 'kpas'));
=======
        return view('cuti.create', compact('pegawais'));
>>>>>>> 0da78d7 (commit)
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'pegawais_id' => 'required|exists:pegawais,id',
<<<<<<< HEAD
            'penilai_id' => 'required|exists:penilai,id',
            'kpa_id' => 'required|exists:kpa,id',
=======
>>>>>>> 0da78d7 (commit)
            'jenis_cuti' => 'required|in:tahunan,besar,sakit,melahirkan,alasan_penting,luar_tanggungan',
            'status_penilai' => 'nullable|in:disetujui,perubahan,ditangguhkan,tidak_disetujui',
            'status_kpa' => 'nullable|in:disetujui,perubahan,ditangguhkan,tidak_disetujui',
            'alasan' => 'required|string',
<<<<<<< HEAD
            'lama_cuti' => 'required|integer',
=======
>>>>>>> 0da78d7 (commit)
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'telepon' => 'required|string',
            'alamat_selama_cuti' => 'required|string',
<<<<<<< HEAD
        ]);

        Cuti::create($request->all());
=======
            'sisa_cuti_n' => 'nullable|integer',
            'sisa_cuti_n_1' => 'nullable|integer',
            'sisa_cuti_n_2' => 'nullable|integer',
        ]);

        $data = $request->all();
        $data['lama_cuti'] = DateHelper::calculateWorkingDays($request->tanggal_mulai, $request->tanggal_selesai);

        Cuti::create($data);
>>>>>>> 0da78d7 (commit)

        return redirect()->route('cuti.index')->with('success', 'Cuti created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cuti $cuti)
    {
<<<<<<< HEAD
=======
        $cuti->load('sisaCuti');
>>>>>>> 0da78d7 (commit)
        $pdf = Pdf::loadView('cuti.show', compact('cuti'));
        return $pdf->stream('cuti.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cuti $cuti)
    {
        $pegawais = \App\Models\Pegawai::all();
<<<<<<< HEAD
        $penilais = \App\Models\Penilai::all();
        $kpas = \App\Models\Kpa::all();
        return view('cuti.edit', compact('cuti', 'pegawais', 'penilais', 'kpas'));
=======
        return view('cuti.edit', compact('cuti', 'pegawais'));
>>>>>>> 0da78d7 (commit)
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cuti $cuti)
    {
        $request->validate([
            'pegawais_id' => 'required|exists:pegawais,id',
<<<<<<< HEAD
            'penilai_id' => 'required|exists:penilai,id',
            'kpa_id' => 'required|exists:kpa,id',
=======
>>>>>>> 0da78d7 (commit)
            'jenis_cuti' => 'required|in:tahunan,besar,sakit,melahirkan,alasan_penting,luar_tanggungan',
            'status_penilai' => 'nullable|in:disetujui,perubahan,ditangguhkan,tidak_disetujui',
            'status_kpa' => 'nullable|in:disetujui,perubahan,ditangguhkan,tidak_disetujui',
            'alasan' => 'required|string',
<<<<<<< HEAD
            'lama_cuti' => 'required|integer',
=======
>>>>>>> 0da78d7 (commit)
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'telepon' => 'required|string',
            'alamat_selama_cuti' => 'required|string',
<<<<<<< HEAD
        ]);

        $cuti->update($request->all());
=======
            'sisa_cuti_n' => 'nullable|integer',
            'sisa_cuti_n_1' => 'nullable|integer',
            'sisa_cuti_n_2' => 'nullable|integer',
        ]);

        $data = $request->all();
        $data['lama_cuti'] = DateHelper::calculateWorkingDays($request->tanggal_mulai, $request->tanggal_selesai);

        $cuti->update($data);
>>>>>>> 0da78d7 (commit)

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
<<<<<<< HEAD
=======

    public function rekapPegawai($pegawai_id)
    {
        $cuti = Cuti::where('pegawais_id', $pegawai_id)->with('pegawai', 'sisaCuti', 'penilai')->get();
        $cutiFirst = Cuti::where('pegawais_id', $pegawai_id)->with('pegawai', 'sisaCuti', 'penilai')->first();
        $pegawai = \App\Models\Pegawai::find($pegawai_id);
        $penilai = \App\Models\Penilai::first();

        // Calculate working days for each cuti record
        $cuti->transform(function ($item) {
            $item->lama_cuti_working = DateHelper::calculateWorkingDays($item->tanggal_mulai, $item->tanggal_selesai);
            return $item;
        });

        $pdf = Pdf::loadView('cuti.rekap', compact('cuti', 'pegawai', 'cutiFirst', 'penilai'));
        $pdf->setPaper('a4', 'landscape');
        return $pdf->stream('rekap-cuti-' . optional($pegawai)->nama . '.pdf');
    }
>>>>>>> 0da78d7 (commit)
}
