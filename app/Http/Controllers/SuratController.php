<?php

namespace App\Http\Controllers;

use App\Models\Configurasi;
use App\Models\HeaderIconImage;
use App\Models\Image;
use App\Models\Siswa;
use App\Models\Surat;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;

use Dompdf\Dompdf;

use Terbilang;

class SuratController extends Controller
{
    // Menampilkan semua data surat
    public function index()
    {
        Config::set('terbilang.locale', 'id');
        $surats = Surat::with('siswa')->get();
        return view('surats.index', compact('surats'));
    }

    // Menampilkan form untuk membuat data baru
    public function create()
    {
        $siswas = Siswa::all(); // Data siswa untuk dropdown atau checkbox
        return view('surats.create', compact('siswas'));
    }

    // Menyimpan data baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'siswas_id' => 'required|array|exists:siswas,id', // Validasi untuk array
            'dasar_surat' => 'required|string|max:255',
            'nama_kegiatan' => 'required',
            'tgl_kegiatan' => 'required|date',
            'tgl_akhir_kegiatan' => 'required|date',
            'tempat_kegiatan' => 'required|string|max:255',
            'jam_kegiatan' => 'required|date_format:H:i',
            'ditetapkan_di' => 'required|string|max:255',
            'tgl_ditetapkan' => 'required|date',
        ]);

        // Membuat surat baru
        $surat = Surat::create($request->except('siswas_id'));

        // Menyimpan relasi many-to-many dengan siswa
        $surat->siswa()->attach($request->siswas_id);

        return redirect()->route('surats.index')->with('success', 'Data berhasil ditambahkan.');
    }

    // Menampilkan detail data surat
    public function show(Surat $surat)
    {
        return view('surats.show', compact('surat'));
    }

    // Menampilkan form untuk mengedit data
    public function edit(Surat $surat)
    {
        $siswas = Siswa::all();
        if (!$surat) {
            abort(404, 'surat not found');
        }

        $selectedSiswaIds = $surat->siswa()->pluck('id')->toArray();
        return view('surats.edit', compact('surat', 'siswas', 'selectedSiswaIds'));
    }

    public function update(Request $request, Surat $surat)
    {
        // Log incoming request data
        Log::info('Incoming Request Data: ' . json_encode($request->all()));

        // Normalize jam_kegiatan to H:i format
        $request->merge([
            'jam_kegiatan' => date('H:i', strtotime(trim($request->input('jam_kegiatan')))),
        ]);

        // Validate the incoming request data
        try {
            $request->validate([
                'siswas_id' => 'required|array|exists:siswas,id',
                'dasar_surat' => 'required|string|max:255',
                'nama_kegiatan' => 'required',
                'tgl_kegiatan' => 'required|date',
                'tgl_akhir_kegiatan' => 'required|date',
                'tempat_kegiatan' => 'required|string|max:255',
                'jam_kegiatan' => 'required|date_format:H:i',
                'ditetapkan_di' => 'required|string|max:255',
                'tgl_ditetapkan' => 'required|date',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation Failed:', $e->errors());
            return response()->json($e->errors(), 422);
        }

        // Update the Surat model instance
        $surat->update($request->only([
            'dasar_surat',
            'nama_kegiatan',
            'tgl_kegiatan',
            'tgl_akhir_kegiatan',
            'tempat_kegiatan',
            'jam_kegiatan',
            'ditetapkan_di',
            'tgl_ditetapkan',
        ]));

        // Sync the related siswa (many-to-many relationship)
        $surat->siswa()->sync($request->siswas_id);

        // Redirect with success message
        return redirect()->route('surats.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy(Surat $surat)
    {
        $surat->delete();
        return redirect()->route('surats.index')->with('success', 'Data berhasil dihapus.');
    }

    public function pdf($id)
    {
        $atasanNama = Configurasi::valueOf('atasan.nama');
        $atasanJabatan = Configurasi::valueOf('atasan.jabatan');
        $atasanNip = Configurasi::valueOf('atasan.nip');
        $atasanPangkat = Configurasi::valueOf('atasan.pangkat');
        $atasanUnitkerja = Configurasi::valueOf('atasan.unitkerja');
        $headerIconImage = HeaderIconImage::latest()->first();
        $penilai = \App\Models\Penilai::first(); // Assuming first penilai, adjust as needed

        $surats = Surat::find($id);
        $pdf = Pdf::loadView('surats.pdf', compact('headerIconImage', 'surats', 'atasanNama', 'atasanNip', 'atasanPangkat', 'atasanUnitkerja', 'atasanJabatan', 'penilai'));

        return $pdf->stream('surats.pdf');
    }


    public function printImages($id)
    {
        $surat = Surat::with('images')->findOrFail($id);

        $pdf = new Dompdf();
        $pdf->loadHtml(view('surats.print-images', compact('surat'))->render());
        $pdf->setPaper('A4', 'portrait');
        $pdf->render();

        return $pdf->stream("surat_images.pdf");
    }


    public function uploadFile(Request $request, $id)
    {
        $surat = Surat::find($id);

        if (!$surat) {
            return redirect()->back()->with('error', 'Record not found.');
        }

        if ($request->hasFile('file')) {
            try {
                if ($surat->file) {
                    Storage::delete('public/' . $surat->file);
                }

                $file = $request->file('file');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->storeAs('public', $filename);

                $surat->file = $filename;
                $surat->save();
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'File upload failed: ' . $e->getMessage());
            }
        } else {
            return redirect()->back()->with('error', 'No file selected for upload.');
        }

        return redirect()->back()->with('success', 'File uploaded successfully');
    }
}
