<?php

namespace App\Http\Controllers;

use App\Models\GambarSurat;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Surat;
use Illuminate\Support\Facades\Storage;

class GambarSuratController extends Controller
{

    public function index($surat_id)
    {
        $gambar = GambarSurat::where('surat_id', $surat_id)->get();
        $surat = Surat::find($surat_id);
        return view('gambar_surat.index', compact('surat_id', 'gambar', 'surat'));
    }

    // Menampilkan form tambah gambar
    public function create($surat_id)
    {
        return view('gambar_surat.create', compact('surat_id'));
    }

    // Menyimpan gambar baru
    public function store(Request $request, $surat_id)
    {
        $request->validate([
            'gambar.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi gambar
        ]);

        if ($request->hasFile('gambar')) {
            foreach ($request->file('gambar') as $file) {
                $namaFile = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads'), $namaFile);

                GambarSurat::create([
                    'surat_id' => $surat_id,
                    'gambar' => $namaFile,
                ]);
            }
        }

        return redirect()->route('gambar_surat.index', $surat_id)->with('success', 'Gambar berhasil ditambahkan.');
    }


    // Menghapus gambar
    // public function destroy($id)
    // {
    //     $gambar = GambarSurat::findOrFail($id);
    //     $surat_id = $gambar->surat_id;

    //     // Hapus file fisik dari storage
    //     if (file_exists(public_path('uploads/' . $gambar->gambar))) {
    //         unlink(public_path('uploads/' . $gambar->gambar));
    //     }

    //     $gambar->delete();

    //     return redirect()->route('gambar_surat.index', $surat_id)->with('success', 'Gambar berhasil dihapus.');
    // }

    public function destroy($surat_id, $gambar_id)
    {
        // Find the image by its ID
        $gambar = GambarSurat::where('id', $gambar_id)
            ->where('surat_id', $surat_id)
            ->first();

        // Check if the image exists
        if (!$gambar) {
            return redirect()->back()->with('error', 'Gambar tidak ditemukan.');
        }

        // Delete the image file from storage (if applicable)
        if (Storage::exists('uploads/' . $gambar->gambar)) {
            Storage::delete('uploads/' . $gambar->gambar);
        }

        // Delete the record from the database
        $gambar->delete();

        // Redirect back with success message
        return redirect()->back()->with('success', 'Gambar berhasil dihapus.');
    }

    // Generate PDF of all images for the surat
    public function printPdf($surat_id)
    {
        $gambar = GambarSurat::where('surat_id', $surat_id)->get();
        $surat = Surat::findOrFail($surat_id);

        $pdf = Pdf::loadView('gambar_surat.print_pdf', compact('gambar', 'surat_id', 'surat'));
        $formattedDate = \Carbon\Carbon::parse($surat->tgl_kegiatan)->format('d-m-Y');
        return $pdf->stream("Foto Kegiatan {$surat->nama_kegiatan} {$formattedDate}.pdf");
    }
}
