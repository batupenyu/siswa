<?php

namespace App\Http\Controllers;

use App\Models\SuratIzinPegawai;
use App\Models\Pegawai;
use App\Models\HeaderIconImage;
use App\Models\Penilai;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class SuratIzinPegawaiController extends Controller
{
    public function index(Request $request)
    {
        $query = SuratIzinPegawai::with('pegawai');

        if ($request->filled('nama')) {
            $query->whereHas('pegawai', function ($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->nama . '%');
            });
        }

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('tanggal', [$request->start_date, $request->end_date]);
        } elseif ($request->filled('start_date')) {
            $query->where('tanggal', '>=', $request->start_date);
        } elseif ($request->filled('end_date')) {
            $query->where('tanggal', '<=', $request->end_date);
        }

        $query->orderBy('tanggal', 'asc');

        $suratIzinPegawais = $query->paginate(10)->appends($request->all());

        return view('surat_izin_pegawai.index', compact('suratIzinPegawais'));
    }

    public function create()
    {
        $pegawais = Pegawai::orderBy('nama', 'asc')->get();
        return view('surat_izin_pegawai.create', compact('pegawais'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pegawais_id' => 'required|exists:pegawais,id',
            'tanggal' => 'required|date',
            'jam' => 'required',
            'status' => 'required|in:keterlambatan,meninggalkan',
            'keperluan' => 'required|in:Dinas,Pribadi',
            'keterangan' => 'nullable|string|max:255',
        ]);

        SuratIzinPegawai::create($request->all());

        return redirect()->route('surat_izin_pegawai.index')->with('success', 'Data berhasil disimpan.');
    }

    public function show($id)
    {
        $suratIzinPegawai = SuratIzinPegawai::with('pegawai')->findOrFail($id);
        return view('surat_izin_pegawai.show', compact('suratIzinPegawai'));
    }

    public function edit($id)
    {
        $suratIzinPegawai = SuratIzinPegawai::findOrFail($id);
        $pegawais = Pegawai::orderBy('nama', 'asc')->get();
        return view('surat_izin_pegawai.edit', compact('suratIzinPegawai', 'pegawais'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'pegawais_id' => 'required|exists:pegawais,id',
            'tanggal' => 'required|date',
            'jam' => 'required',
            'status' => 'required|in:keterlambatan,meninggalkan',
            'keperluan' => 'required|in:Dinas,Pribadi',
            'keterangan' => 'nullable|string|max:255',
        ]);

        $suratIzinPegawai = SuratIzinPegawai::findOrFail($id);
        $suratIzinPegawai->update($request->all());

        return redirect()->route('surat_izin_pegawai.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $suratIzinPegawai = SuratIzinPegawai::findOrFail($id);
        $suratIzinPegawai->delete();

        return redirect()->route('surat_izin_pegawai.index')->with('success', 'Data berhasil dihapus.');
    }

    public function pdf($id)
    {
        $penilai = Penilai::first();
        $suratIzinPegawai = SuratIzinPegawai::with('pegawai')->findOrFail($id);
        $headerIconImage = HeaderIconImage::latest()->first();
        $pdf = PDF::loadView('surat_izin_pegawai.pdf', compact('penilai', 'suratIzinPegawai', 'headerIconImage'));
        return $pdf->stream('surat_izin_pegawai_' . $id . '.pdf');
    }
}
