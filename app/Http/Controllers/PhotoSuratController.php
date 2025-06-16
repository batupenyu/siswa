<?php

namespace App\Http\Controllers;

use App\Models\GambarSurat;
use App\Models\PhotoSurat;
use App\Models\StPegawai;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PhotoSuratController extends Controller
{
    public function index($st_surat_id)
    {
        $photo = PhotoSurat::where('st_surat_id', $st_surat_id)->get();
        $st_surat = StPegawai::find($st_surat_id);
        return view('photo_surat.index', compact('st_surat_id', 'photo', 'st_surat'));
    }

    // Menampilkan form tambah gambar
    public function create($st_surat_id)
    {
        return view('photo_surat.create', compact('st_surat_id'));
    }

    // Menyimpan gambar baru
    public function store(Request $request, $st_surat_id)
    {
        $request->validate([
            'photo.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi photo
        ]);

        if ($request->hasFile('photo')) {
            foreach ($request->file('photo') as $file) {
                $namaFile = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads'), $namaFile);

                PhotoSurat::create([
                    'st_surat_id' => $st_surat_id,
                    'photo' => $namaFile,
                ]);
            }
        }

        return redirect()->route('photo_surat.index', $st_surat_id)->with('success', 'Gambar berhasil ditambahkan.');
    }



    public function destroy($st_surat_id, $photo_id)
    {
        // Find the image by its ID
        $photo = PhotoSurat::where('id', $photo_id)
            ->where('st_surat_id', $st_surat_id)
            ->first();

        // Check if the image exists
        if (!$photo) {
            return redirect()->back()->with('error', 'Photo tidak ditemukan.');
        }

        // Delete the image file from storage (if applicable)
        if (Storage::exists('uploads/' . $photo->photo)) {
            Storage::delete('uploads/' . $photo->photo);
        }

        // Delete the record from the database
        $photo->delete();

        // Redirect back with success message
        return redirect()->back()->with('success', 'Gambar berhasil dihapus.');
    }

    // Generate PDF of all images for the surat
    public function printPdf($st_surat_id)
    {
        $photo = PhotoSurat::where('st_surat_id', $st_surat_id)->get();
        $st_surat = StPegawai::findOrFail($st_surat_id);

        $pdf = Pdf::loadView('photo_surat.print_pdf', compact('photo', 'st_surat_id', 'st_surat'));
        $formattedDate = \Carbon\Carbon::parse($st_surat->tgl_kegiatan)->format('d-m-Y');
        $safeNamaKegiatan = str_replace(['/', '\\'], '-', $st_surat->nama_kegiatan);
        return $pdf->stream("Foto Kegiatan {$safeNamaKegiatan} {$formattedDate}.pdf");
    }
}
