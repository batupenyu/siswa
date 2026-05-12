<?php

namespace App\Http\Controllers;

use App\Models\SuratPanggilan;
use App\Models\Penilai;
use App\Models\Siswa;
use App\Models\Pegawai;
use App\Models\HeaderIconImage;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class SuratPanggilanController extends Controller
{
    private function formData(): array
    {
        return [
            'siswas'  => Siswa::orderBy('name')->get(),
            'pegawais' => Pegawai::orderBy('nama')->get(),
            'kops'    => HeaderIconImage::all(),
        ];
    }

    public function index()
    {
        $suratPanggilan = SuratPanggilan::latest()->paginate(10);
        return view('surat_panggilan.index', compact('suratPanggilan'));
    }

    public function create()
    {
        return view('surat_panggilan.create', $this->formData());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'tanggal_surat'    => 'required|date',
            'nomor_surat'      => 'required|string|max:255',
            'sifat'            => 'nullable|string|max:255',
            'lampiran'         => 'nullable|string|max:255',
            'perihal'          => 'required|string|max:255',
            'nama_siswa'       => 'required|string|max:255',
            'hari_tanggal'     => 'required|date',
            'tempat'           => 'required|string|max:255',
            'agenda'           => 'required|string',
            'paragraf_penutup' => 'nullable|string',
            'nama_guru_bk'     => 'required|string|max:255',
            'pangkat_golongan' => 'nullable|string|max:255',
            'nip'              => 'nullable|string|max:255',
            'an_guru_bk'       => 'nullable|boolean',
            'kop_id'           => 'nullable|exists:header_icon_images,id',
        ]);
        $data['an_guru_bk'] = $request->boolean('an_guru_bk');

        SuratPanggilan::create($data);
        return redirect()->route('surat-panggilan.index')->with('success', 'Surat panggilan berhasil dibuat.');
    }

    public function show($id)
    {
        $surat = SuratPanggilan::findOrFail($id);
        $penilai = Penilai::first();
        $kop = $surat->kop_id ? HeaderIconImage::find($surat->kop_id) : null;
        $pdf = Pdf::loadView('surat_panggilan.show', compact('surat', 'penilai', 'kop'))
            ->setPaper('a4', 'portrait');
        return $pdf->stream('surat_panggilan_' . $id . '.pdf');
    }

    public function edit($id)
    {
        $surat = SuratPanggilan::findOrFail($id);
        return view('surat_panggilan.edit', array_merge(['surat' => $surat], $this->formData()));
    }

    public function update(Request $request, $id)
    {
        $surat = SuratPanggilan::findOrFail($id);
        $data = $request->validate([
            'tanggal_surat'    => 'required|date',
            'nomor_surat'      => 'required|string|max:255',
            'sifat'            => 'nullable|string|max:255',
            'lampiran'         => 'nullable|string|max:255',
            'perihal'          => 'required|string|max:255',
            'nama_siswa'       => 'required|string|max:255',
            'hari_tanggal'     => 'required|date',
            'tempat'           => 'required|string|max:255',
            'agenda'           => 'required|string',
            'paragraf_penutup' => 'nullable|string',
            'nama_guru_bk'     => 'required|string|max:255',
            'pangkat_golongan' => 'nullable|string|max:255',
            'nip'              => 'nullable|string|max:255',
            'an_guru_bk'       => 'nullable|boolean',
            'kop_id'           => 'nullable|exists:header_icon_images,id',
        ]);
        $data['an_guru_bk'] = $request->boolean('an_guru_bk');

        $surat->update($data);
        return redirect()->route('surat-panggilan.index')->with('success', 'Surat panggilan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        SuratPanggilan::findOrFail($id)->delete();
        return redirect()->route('surat-panggilan.index')->with('success', 'Surat panggilan berhasil dihapus.');
    }
}
