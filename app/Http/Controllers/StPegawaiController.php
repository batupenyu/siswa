<?php

namespace App\Http\Controllers;

use App\Models\Configurasi;
use App\Models\StPegawai;
use App\Models\Pegawai;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Helpers\NumberHelper; // Import kelas NumberHelper
use App\Models\HeaderIconImage;

class StPegawaiController extends Controller
{
    // Display all records
    public function index()
    {

        $stPegawaiList = StPegawai::with('pegawais')->get();
        return view('st_pegawai.index', compact('stPegawaiList'));
    }

    // Show form to create a new record
    public function create()
    {
        $pegawais = Pegawai::all();
        return view('st_pegawai.create', compact('pegawais'));
    }

    // Store a new record
    public function store(Request $request)
    {
        $validatedData = $request->validate([
<<<<<<< HEAD
=======
            'no_surat' => 'nullable|string',
>>>>>>> 0da78d7 (commit)
            'dasar_surat' => 'required|string',
            'tempat_kegiatan' => 'required|string',
            'tgl_awal' => 'required|date',
            'tgl_akhir' => 'required|date',
            'nama_kegiatan' => 'required|string',
            'tgl_kegiatan' => 'required|date',
            'jam_kegiatan' => 'required|date_format:H:i',
            'tgl_ditetapkan' => 'required|date',
            'tempat_ditetapkan' => 'required|string',
            'maksud_tujuan' => 'nullable|string',
            'materi_narsum' => 'nullable|string',
            'hasil' => 'nullable|string',
            'kesimpulan' => 'nullable|string',
            'pegawai_id' => 'nullable|array',
            'biaya_transportasi' => 'nullable|string',
            'biaya_penginapan' => 'nullable|string',
            'biaya_tiket' => 'nullable|string',
            'transport_lokal' => 'nullable|string',
            'uang_makan' => 'nullable|string',
            'uang_saku' => 'nullable|string',
            'uang_representasi' => 'nullable|string',
            'uang_kediklatan' => 'nullable|string',
            'korek' => 'nullable|string',
        ]);

<<<<<<< HEAD
=======
        if (empty($validatedData['no_surat'])) {
            $validatedData['no_surat'] = '421.5/ ........... /SMKN1 Kb/Dindik/';
        }

>>>>>>> 0da78d7 (commit)
        $stPegawai = StPegawai::create($validatedData);

        if ($request->has('pegawai_id')) {
            $stPegawai->pegawais()->attach($request->input('pegawai_id'));
        }

        return redirect()->route('st-pegawai.index')->with('success', 'Record created successfully.');
    }

    // Show a single record
    public function show(StPegawai $stPegawai)
    {
        $stPegawai->load('pegawais');
        return view('st_pegawai.show', compact('stPegawai'));
    }

    // Show form to edit a record

    public function edit(StPegawai $stPegawai)
    {
        $pegawais = Pegawai::all();
        $penilai = \App\Models\Penilai::first();
        $kpa = \App\Models\Kpa::first();
        $bp = \App\Models\Bp::first();

        if (!$stPegawai) {
            abort(404, 'StPegawai not found');
        }

        $selectedPegawaiIds = $stPegawai->pegawais()->pluck('id')->toArray();
        return view('st_pegawai.edit', compact('stPegawai', 'pegawais', 'selectedPegawaiIds', 'penilai', 'kpa', 'bp'));
    }



    // Update a record
    public function update(Request $request, StPegawai $stPegawai)
    {
        $validatedData = $request->validate([
<<<<<<< HEAD
=======
            'no_surat' => 'nullable|string',
>>>>>>> 0da78d7 (commit)
            'dasar_surat' => 'required|string',
            'tempat_kegiatan' => 'required|string',
            'tgl_awal' => 'required|date',
            'tgl_akhir' => 'required|date',
            'nama_kegiatan' => 'required|string',
            'tgl_kegiatan' => 'required|date',
            'jam_kegiatan' => 'required|date_format:H:i',
            'tgl_ditetapkan' => 'required|date',
            'tempat_ditetapkan' => 'required|string',
            'maksud_tujuan' => 'nullable|string',
            'materi_narsum' => 'nullable|string',
            'hasil' => 'nullable|string',
            'kesimpulan' => 'nullable|string',
            'pegawai_id' => 'nullable|array',
            'biaya_transportasi' => 'nullable|string',
            'biaya_penginapan' => 'nullable|string',
            'biaya_tiket' => 'nullable|string',
            'transport_lokal' => 'nullable|string',
            'uang_makan' => 'nullable|string',
            'uang_saku' => 'nullable|string',
            'uang_representasi' => 'nullable|string',
            'uang_kediklatan' => 'nullable|string',
            'korek' => 'nullable|string',
        ]);

<<<<<<< HEAD
=======
        if (empty($validatedData['no_surat'])) {
            $validatedData['no_surat'] = '421.5/ ........... /SMKN1 Kb/Dindik/';
        }

>>>>>>> 0da78d7 (commit)
        $stPegawai->update($validatedData);

        if ($request->has('pegawai_id')) {
            $stPegawai->pegawais()->sync($request->input('pegawai_id'));
        } else {
            $stPegawai->pegawais()->detach();
        }

        return redirect()->route('st-pegawai.index')->with('success', 'Record updated successfully.');
    }


    // Delete a record
    public function destroy(StPegawai $stPegawai)
    {
        $stPegawai->delete();
        return redirect()->route('st-pegawai.index')->with('success', 'Record deleted successfully.');
    }

    public function pdf($id)
    {
        // fetch header_icon_image
        $penilai = \App\Models\Penilai::first();
        $kpa = \App\Models\Kpa::first();
        $bp = \App\Models\Bp::first();
        $headerIconImage = HeaderIconImage::latest()->first();
        $atasanNama = Configurasi::valueOf('atasan.nama');
        $atasanJabatan = Configurasi::valueOf('atasan.jabatan');
        $atasanNip = Configurasi::valueOf('atasan.nip');
        $atasanPangkat = Configurasi::valueOf('atasan.pangkat');
        $atasanUnitkerja = Configurasi::valueOf('atasan.unitkerja');

        $kpaNama = Configurasi::valueOf('kpa.nama');
        $kpaJabatan = Configurasi::valueOf('kpa.jabatan');
        $kpaNip = Configurasi::valueOf('kpa.nip');
        $kpaPangkat = Configurasi::valueOf('kpa.pangkat');
        $kpaUnitkerja = Configurasi::valueOf('kpa.unitkerja');

        $stPegawai = StPegawai::find($id);
        $pegawai_first = StPegawai::with('pegawais')->first();
        $pdf = Pdf::loadView('st_pegawai.pdf_fixed', compact('penilai', 'kpa', 'headerIconImage', 'pegawai_first', 'stPegawai', 'atasanNama', 'atasanNip', 'atasanPangkat', 'atasanUnitkerja', 'atasanJabatan', 'kpaNama', 'kpaNip', 'kpaPangkat', 'kpaUnitkerja', 'kpaJabatan'))
            ->setOption('margin-top', 0);

        // ->setPaper('a4', 'landscape'); // Set the paper size and orientation

        return $pdf->stream('st_pegawai.pdf');
    }



    public function uploadFile(Request $request, $id)
    {
        $stPegawai = StPegawai::find($id);

        if (!$stPegawai) {
            return redirect()->back()->with('error', 'Record not found.');
        }

        if ($request->hasFile('file')) {
            if ($stPegawai->file) {
                Storage::delete('public/' . $stPegawai->file);
            }

            $file = $request->file('file');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public', $filename);

            $stPegawai->file = $filename;
            $stPegawai->save();
        }

        return redirect()->back()->with('success', 'File uploaded successfully');
    }

    public function rincianPdf($id)
    {
        $atasanNama = Configurasi::valueOf('atasan.nama');
        $atasanJabatan = Configurasi::valueOf('atasan.jabatan');
        $atasanNip = Configurasi::valueOf('atasan.nip');
        $atasanPangkat = Configurasi::valueOf('atasan.pangkat');
        $atasanUnitkerja = Configurasi::valueOf('atasan.unitkerja');

        $kpaNama = Configurasi::valueOf('kpa.nama');
        $kpaJabatan = Configurasi::valueOf('kpa.jabatan');
        $kpaNip = Configurasi::valueOf('kpa.nip');
        $kpaPangkat = Configurasi::valueOf('kpa.pangkat');
        $kpaUnitkerja = Configurasi::valueOf('kpa.unitkerja');

        $pptkNama = Configurasi::valueOf('pptk.nama');
        $pptkJabatan = Configurasi::valueOf('pptk.jabatan');
        $pptkNip = Configurasi::valueOf('pptk.nip');
        $pptkPangkat = Configurasi::valueOf('pptk.pangkat');
        $pptkUnitkerja = Configurasi::valueOf('pptk.unitkerja');

        $bpNama = Configurasi::valueOf('bp.nama');
        $bpJabatan = Configurasi::valueOf('bp.jabatan');
        $bpNip = Configurasi::valueOf('bp.nip');
        $bpPangkat = Configurasi::valueOf('bp.pangkat');
        $bpUnitkerja = Configurasi::valueOf('bp.unitkerja');

        $stPegawai = StPegawai::with('pegawais')->find($id);
        if (!$stPegawai) {
            abort(404, 'Record not found');
        }

        $pdf = Pdf::loadView('st_pegawai.rincian_pdf', compact(
            'stPegawai',
            'atasanNama',
            'atasanNip',
            'atasanPangkat',
            'atasanUnitkerja',
            'atasanJabatan',
            'kpaNama',
            'kpaJabatan',
            'kpaNip',
            'kpaPangkat',
            'kpaUnitkerja',
            'pptkNama',
            'pptkJabatan',
            'pptkNip',
            'pptkPangkat',
            'pptkUnitkerja',
            'bpNama',
            'bpJabatan',
            'bpNip',
            'bpPangkat',
            'bpUnitkerja'
        ));

        return $pdf->stream('rincian.pdf');
    }

    public function spbPdf($id)
    {
        $atasanNama = Configurasi::valueOf('atasan.nama');
        $atasanJabatan = Configurasi::valueOf('atasan.jabatan');
        $atasanNip = Configurasi::valueOf('atasan.nip');
        $atasanPangkat = Configurasi::valueOf('atasan.pangkat');
        $atasanUnitkerja = Configurasi::valueOf('atasan.unitkerja');

        $kpaNama = Configurasi::valueOf('kpa.nama');
        $kpaJabatan = Configurasi::valueOf('kpa.jabatan');
        $kpaNip = Configurasi::valueOf('kpa.nip');
        $kpaPangkat = Configurasi::valueOf('kpa.pangkat');
        $kpaUnitkerja = Configurasi::valueOf('kpa.unitkerja');

        $pptkNama = Configurasi::valueOf('pptk.nama');
        $pptkJabatan = Configurasi::valueOf('pptk.jabatan');
        $pptkNip = Configurasi::valueOf('pptk.nip');
        $pptkPangkat = Configurasi::valueOf('pptk.pangkat');
        $pptkUnitkerja = Configurasi::valueOf('pptk.unitkerja');

        $bpNama = Configurasi::valueOf('bp.nama');
        $bpJabatan = Configurasi::valueOf('bp.jabatan');
        $bpNip = Configurasi::valueOf('bp.nip');
        $bpPangkat = Configurasi::valueOf('bp.pangkat');
        $bpUnitkerja = Configurasi::valueOf('bp.unitkerja');

        $stPegawai = StPegawai::with('pegawais')->find($id);
        if (!$stPegawai) {
            abort(404, 'Record not found');
        }

        $pdf = Pdf::loadView('st_pegawai.spb_pdf', compact(
            'stPegawai',
            'atasanNama',
            'atasanNip',
            'atasanPangkat',
            'atasanUnitkerja',
            'atasanJabatan',
            'kpaNama',
            'kpaJabatan',
            'kpaNip',
            'kpaPangkat',
            'kpaUnitkerja',
            'pptkNama',
            'pptkJabatan',
            'pptkNip',
            'pptkPangkat',
            'pptkUnitkerja',
            'bpNama',
            'bpJabatan',
            'bpNip',
            'bpPangkat',
            'bpUnitkerja'
        ));

        return $pdf->stream('spb.pdf');
    }

    public function kwitansiPdf($id)
    {
        $atasanNama = Configurasi::valueOf('atasan.nama');
        $atasanJabatan = Configurasi::valueOf('atasan.jabatan');
        $atasanNip = Configurasi::valueOf('atasan.nip');
        $atasanPangkat = Configurasi::valueOf('atasan.pangkat');
        $atasanUnitkerja = Configurasi::valueOf('atasan.unitkerja');

        $kpaNama = Configurasi::valueOf('kpa.nama');
        $kpaJabatan = Configurasi::valueOf('kpa.jabatan');
        $kpaNip = Configurasi::valueOf('kpa.nip');
        $kpaPangkat = Configurasi::valueOf('kpa.pangkat');
        $kpaUnitkerja = Configurasi::valueOf('kpa.unitkerja');

        $pptkNama = Configurasi::valueOf('pptk.nama');
        $pptkJabatan = Configurasi::valueOf('pptk.jabatan');
        $pptkNip = Configurasi::valueOf('pptk.nip');
        $pptkPangkat = Configurasi::valueOf('pptk.pangkat');
        $pptkUnitkerja = Configurasi::valueOf('pptk.unitkerja');

        $bpNama = Configurasi::valueOf('bp.nama');
        $bpJabatan = Configurasi::valueOf('bp.jabatan');
        $bpNip = Configurasi::valueOf('bp.nip');
        $bpPangkat = Configurasi::valueOf('bp.pangkat');
        $bpUnitkerja = Configurasi::valueOf('bp.unitkerja');

        $stPegawai = StPegawai::with('pegawais')->find($id);
        if (!$stPegawai) {
            abort(404, 'Record not found');
        }

        $pdf = Pdf::loadView('st_pegawai.kwitansi_pdf', compact(
            'stPegawai',
            'atasanNama',
            'atasanNip',
            'atasanPangkat',
            'atasanUnitkerja',
            'atasanJabatan',
            'kpaNama',
            'kpaJabatan',
            'kpaNip',
            'kpaPangkat',
            'kpaUnitkerja',
            'pptkNama',
            'pptkJabatan',
            'pptkNip',
            'pptkPangkat',
            'pptkUnitkerja',
            'bpNama',
            'bpJabatan',
            'bpNip',
            'bpPangkat',
            'bpUnitkerja'
        ))->setPaper('a4')->setOption('margin-top', 0)->setOption('margin-bottom', 0)->setOption('margin-left', 0)->setOption('margin-right', 0);

        return $pdf->stream('kwitansi.pdf');
    }
    public function sppdPdf($id)
    {
        $atasanNama = Configurasi::valueOf('atasan.nama');
        $atasanJabatan = Configurasi::valueOf('atasan.jabatan');
        $atasanNip = Configurasi::valueOf('atasan.nip');
        $atasanPangkat = Configurasi::valueOf('atasan.pangkat');
        $atasanUnitkerja = Configurasi::valueOf('atasan.unitkerja');

        $kpaNama = Configurasi::valueOf('kpa.nama');
        $kpaJabatan = Configurasi::valueOf('kpa.jabatan');
        $kpaNip = Configurasi::valueOf('kpa.nip');
        $kpaPangkat = Configurasi::valueOf('kpa.pangkat');
        $kpaUnitkerja = Configurasi::valueOf('kpa.unitkerja');

        $pptkNama = Configurasi::valueOf('pptk.nama');
        $pptkJabatan = Configurasi::valueOf('pptk.jabatan');
        $pptkNip = Configurasi::valueOf('pptk.nip');
        $pptkPangkat = Configurasi::valueOf('pptk.pangkat');
        $pptkUnitkerja = Configurasi::valueOf('pptk.unitkerja');

        $bpNama = Configurasi::valueOf('bp.nama');
        $bpJabatan = Configurasi::valueOf('bp.jabatan');
        $bpNip = Configurasi::valueOf('bp.nip');
        $bpPangkat = Configurasi::valueOf('bp.pangkat');
        $bpUnitkerja = Configurasi::valueOf('bp.unitkerja');

        $st_pegawai = StPegawai::with('pegawais')->find($id);
        $penilai = \App\Models\Penilai::first();
        $kpa = \App\Models\Kpa::first();
        $bp = \App\Models\Bp::first();

        $stPegawai = StPegawai::with('pegawais')->find($id);
        if (!$stPegawai) {
            abort(404, 'Record not found');
        }

        $pdf = Pdf::loadView('st_pegawai.sppdPdf', compact(
            'penilai',
            'stPegawai',
            'atasanNama',
            'atasanNip',
            'atasanPangkat',
            'atasanUnitkerja',
            'atasanJabatan',
            'kpa',
            'kpaNama',
            'kpaJabatan',
            'kpaNip',
            'kpaPangkat',
            'kpaUnitkerja',
            'pptkNama',
            'pptkJabatan',
            'pptkNip',
            'pptkPangkat',
            'pptkUnitkerja',
            'bpNama',
            'bpJabatan',
            'bpNip',
            'bpPangkat',
            'bpUnitkerja'
        ))->setPaper('legal');

        return $pdf->stream('sppd.pdf');
    }

    public function laporan($id)
    {
        $st_pegawai = StPegawai::with('pegawais')->find($id);
        $penilai = \App\Models\Penilai::first();
        $kpa = \App\Models\Kpa::first();
        $bp = \App\Models\Bp::first();
        $headerIconImage = HeaderIconImage::latest()->first();
        // $headerIconImage = Configurasi::valueOf('header_icon_image');

        if (!$st_pegawai) {
            abort(404, 'Record not found');
        }

        // Wrap the single record in an array to be compatible with the blade expecting a collection
        $st_pegawai_collection = collect([$st_pegawai]);

        $pdf = Pdf::loadView('st_pegawai.laporan', ['headerIconImage' => $headerIconImage, 'stPegawai' => $st_pegawai_collection, 'penilai' => $penilai, 'kpa' => $kpa, 'bp' => $bp])
            ->setOption('margin-top', 0);

        return $pdf->stream('laporan_perjalanan_dinas.pdf');
    }

    public function sppd_depan($id)
    {
        $st_pegawai = StPegawai::with('pegawais')->find($id);
        $penilai = \App\Models\Penilai::first();
        $kpa = \App\Models\Kpa::first();
        $bp = \App\Models\Bp::first();


        $atasanNama = Configurasi::valueOf('atasan.nama');
        $atasanJabatan = Configurasi::valueOf('atasan.jabatan');
        $atasanNip = Configurasi::valueOf('atasan.nip');
        $atasanPangkat = Configurasi::valueOf('atasan.pangkat');
        $atasanUnitkerja = Configurasi::valueOf('atasan.unitkerja');

        if (!$st_pegawai) {
            abort(404, 'Record not found');
        }

        $pdf = Pdf::loadView('st_pegawai.sppd_depan', [
            'stPegawai' => $st_pegawai,
            'penilai' => $penilai,
            'kpa' => $kpa,
            'bp' => $bp,
            'atasanNama' => $atasanNama,
            'atasanJabatan' => $atasanJabatan,
            'atasanNip' => $atasanNip,
            'atasanPangkat' => $atasanPangkat,
            'atasanUnitkerja' => $atasanUnitkerja,
        ])->setOption('margin-top', 0);

        return $pdf->stream('laporan_perjalanan_dinas.pdf');
    }
}
