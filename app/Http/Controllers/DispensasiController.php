<?php

namespace App\Http\Controllers;

use App\Models\Configurasi;
use App\Models\Dispensasi;
use App\Models\HeaderIconImage;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class DispensasiController extends Controller
{
    /**
     * Display a listing of the dispensasi.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $dispensasi = Dispensasi::paginate(5);
        return view('dispensasi.index', compact('dispensasi'));
    }

    /**
     * Show the form for creating a new dispensasi.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('dispensasi.create');
    }

    /**
     * Store a newly created dispensasi in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'siswas_id' => 'required|array|exists:siswas,id', // Validasi untuk array
            'nama_kegiatan' => 'required|string|max:255',
            'tgl_kegiatan' => 'required|date',
            'waktu_kegiatan' => 'required|date_format:H:i',
            'tgl_ditetapkan' => 'required|date',
        ]);

        // Create a single dispensasi record
        $dispensasi = Dispensasi::create([
            'nama_kegiatan' => $request->nama_kegiatan,
            'tgl_kegiatan' => $request->tgl_kegiatan,
            'waktu_kegiatan' => $request->waktu_kegiatan,
            'tgl_ditetapkan' => $request->tgl_ditetapkan,
        ]);

        // Attach siswas to dispensasi
        $dispensasi->siswa()->attach($request->siswas_id);

        return redirect()->route('dispensasi.index')->with('success', 'Dispensasi created successfully.');
    }

    /**
     * Show the form for editing the specified dispensasi.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $dispensasi = Dispensasi::findOrFail($id);
        return view('dispensasi.edit', compact('dispensasi'));
    }

    /**
     * Update the specified dispensasi in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'siswas_id' => 'required|array|exists:siswas,id', // Validasi untuk array
            'nama_kegiatan' => 'required|string|max:255',
            'tgl_kegiatan' => 'required|date',
            'waktu_kegiatan' => 'required|date_format:H:i',
            'tgl_ditetapkan' => 'required|date',
        ]);

        $dispensasi = Dispensasi::findOrFail($id);
        $dispensasi->nama_kegiatan = $request->nama_kegiatan;
        $dispensasi->tgl_kegiatan = $request->tgl_kegiatan;
        $dispensasi->waktu_kegiatan = $request->waktu_kegiatan;
        $dispensasi->tgl_ditetapkan = $request->tgl_ditetapkan;
        $dispensasi->save();

        // Sync siswas in pivot table
        $dispensasi->siswa()->sync($request->siswas_id);

        return redirect()->route('dispensasi.index')->with('success', 'Dispensasi updated successfully.');
    }

    /**
     * Remove the specified dispensasi from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $dispensasi = Dispensasi::findOrFail($id);

        // Detach related siswas in pivot table
        $dispensasi->siswa()->detach();

        $dispensasi->delete();

        return redirect()->route('dispensasi.index')->with('success', 'Dispensasi deleted successfully.');
    }

    /**
     * Generate and return PDF for the specified dispensasi.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function pdf($id)
    {

        $atasanNama = Configurasi::valueOf('atasan.nama');
        $atasanJabatan = Configurasi::valueOf('atasan.jabatan');
        $atasanNip = Configurasi::valueOf('atasan.nip');
        $atasanPangkat = Configurasi::valueOf('atasan.pangkat');
        $atasanUnitkerja = Configurasi::valueOf('atasan.unitkerja');
        $dispensasi = Dispensasi::with('siswa')->findOrFail($id);
        $headerIconImage = HeaderIconImage::latest()->first();


        // Assuming you have a view 'dispensasi.pdf' for PDF layout
        $pdf = Pdf::loadView('dispensasi.pdf', compact('headerIconImage', 'dispensasi', 'atasanNama', 'atasanJabatan', 'atasanNip', 'atasanPangkat', 'atasanUnitkerja'));

        return $pdf->stream('dispensasi_' . $id . '.pdf');
    }

    public function tabeldispensasi($id)
    {

        $atasanNama = Configurasi::valueOf('atasan.nama');
        $atasanJabatan = Configurasi::valueOf('atasan.jabatan');
        $atasanNip = Configurasi::valueOf('atasan.nip');
        $atasanPangkat = Configurasi::valueOf('atasan.pangkat');
        $atasanUnitkerja = Configurasi::valueOf('atasan.unitkerja');
        $dispensasi = Dispensasi::with('siswa')->findOrFail($id);
        $headerIconImage = HeaderIconImage::latest()->first();

        // Assuming you have a view 'dispensasi.pdf' for PDF layout
        $pdf = Pdf::loadView('dispensasi.tabelDispensasi', compact('dispensasi', 'atasanNama', 'atasanJabatan', 'atasanNip', 'atasanPangkat', 'atasanUnitkerja', 'headerIconImage'));

        return $pdf->stream('dispensasi_' . $id . '.pdf');
    }
}
