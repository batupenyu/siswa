<?php

namespace App\Http\Controllers;

use App\Models\SiswaProfil;
use Illuminate\Http\Request;
use App\Models\Siswa;
use Barryvdh\DomPDF\Facade\Pdf;

class SiswaProfilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $siswaProfils = SiswaProfil::all();
        return view('siswa_profil.index', compact('siswaProfils'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $siswas = Siswa::all();
        return view('siswa_profil.create', compact('siswas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'siswa_id' => 'required|exists:siswas,id',
            'nama_panggilan' => 'nullable|string|max:255',
            'jenis_kelamin' => 'nullable|in:L,P',
            'tempat_tanggal_lahir' => 'nullable|string|max:255',
            'agama' => 'nullable|in:islam,budha,hindu,kristen',
            'kewarganegaraan' => 'nullable|string|max:255',
            'anak_ke_berapa' => 'nullable|integer',
            'jumlah_saudara_kandung' => 'nullable|integer',
            'jumlah_saudara_tiri' => 'nullable|integer',
            'jumlah_saudara_angkat' => 'nullable|integer',
            'status_anak' => 'nullable|in:yatim,piatu,yatim-piatu',
            'bahasa_sehari_hari_di_rumah' => 'nullable|string|max:255',
            'alamat' => 'nullable|string',
            'nomor_telepon' => 'nullable|string|max:20',
            'tinggal_dengan' => 'nullable|in:orang_tua,saudara,di_asrama,kos',
            'jarak_tempat_tinggal_ke_sekolah' => 'nullable|numeric',
            'golongan_darah' => 'nullable|string|max:3',
            'penyakit_yang_pernah_diderita' => 'nullable|in:tbc,cacar,malaria,dll',
            'kelainan_jasmani' => 'nullable|string|max:255',
            'tinggi_dan_berat_badan' => 'nullable|string|max:255',
            'pendidikan_sebelumnya' => 'nullable|string|max:255',
            'lulusan_dari' => 'nullable|string|max:255',
            'tanggal_dan_nomor_sttb' => 'nullable|string|max:255',
            'lama_belajar' => 'nullable|string|max:255',
            'dari_sekolah' => 'nullable|string|max:255',
            'alasan_pindah' => 'nullable|string',
            'diterima_di_sekolah_ini' => 'nullable|string|max:255',
            'di_kelas' => 'nullable|string|max:255',
            'kelompok' => 'nullable|string|max:255',
            'kompetensi_keahlian' => 'nullable|string|max:255',
            'tanggal_diterima' => 'nullable|date',
            'kesenian_kegemaran_siswa' => 'nullable|string|max:255',
            'olahraga_kegemaran_siswa' => 'nullable|string|max:255',
            'kegiatan_kemasyarakatan_kegemaran_siswa' => 'nullable|string|max:255',
            'kegemaran_lain_lain' => 'nullable|string|max:255',
            'jurusan' => 'nullable|in:TBSM,TKR,TITL,TP,TKJ',
        ]);

        $siswaProfil = SiswaProfil::create($validatedData);

        return redirect()->route('siswa-profil.index')->with('success', 'Siswa Profil created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $siswaProfil = SiswaProfil::findOrFail($id);
        $pdf = Pdf::loadView('siswa_profil.show', compact('siswaProfil'));
        return $pdf->stream('siswa_profil_' . $id . '.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $siswaProfil = SiswaProfil::findOrFail($id);
        $siswas = Siswa::all();
        return view('siswa_profil.edit', compact('siswaProfil', 'siswas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $siswaProfil = SiswaProfil::findOrFail($id);

        $validatedData = $request->validate([
            'siswa_id' => 'sometimes|required|exists:siswas,id',
            'nama_panggilan' => 'nullable|string|max:255',
            'jenis_kelamin' => 'nullable|in:L,P',
            'tempat_tanggal_lahir' => 'nullable|string|max:255',
            'agama' => 'nullable|in:islam,budha,hindu,kristen',
            'kewarganegaraan' => 'nullable|string|max:255',
            'anak_ke_berapa' => 'nullable|integer',
            'jumlah_saudara_kandung' => 'nullable|integer',
            'jumlah_saudara_tiri' => 'nullable|integer',
            'jumlah_saudara_angkat' => 'nullable|integer',
            'status_anak' => 'nullable|in:yatim,piatu,yatim-piatu',
            'bahasa_sehari_hari_di_rumah' => 'nullable|string|max:255',
            'alamat' => 'nullable|string',
            'nomor_telepon' => 'nullable|string|max:20',
            'tinggal_dengan' => 'nullable|in:orang_tua,saudara,di_asrama,kos',
            'jarak_tempat_tinggal_ke_sekolah' => 'nullable|numeric',
            'golongan_darah' => 'nullable|string|max:3',
            'penyakit_yang_pernah_diderita' => 'nullable|in:tbc,cacar,malaria,dll',
            'kelainan_jasmani' => 'nullable|string|max:255',
            'tinggi_dan_berat_badan' => 'nullable|string|max:255',
            'pendidikan_sebelumnya' => 'nullable|string|max:255',
            'lulusan_dari' => 'nullable|string|max:255',
            'tanggal_dan_nomor_sttb' => 'nullable|string|max:255',
            'lama_belajar' => 'nullable|string|max:255',
            'dari_sekolah' => 'nullable|string|max:255',
            'alasan_pindah' => 'nullable|string',
            'diterima_di_sekolah_ini' => 'nullable|string|max:255',
            'di_kelas' => 'nullable|string|max:255',
            'kelompok' => 'nullable|string|max:255',
            'kompetensi_keahlian' => 'nullable|string|max:255',
            'tanggal_diterima' => 'nullable|date',
            'kesenian_kegemaran_siswa' => 'nullable|string|max:255',
            'olahraga_kegemaran_siswa' => 'nullable|string|max:255',
            'kegiatan_kemasyarakatan_kegemaran_siswa' => 'nullable|string|max:255',
            'kegemaran_lain_lain' => 'nullable|string|max:255',
            'jurusan' => 'nullable|in:TBSM,TKR,TITL,TP,TKJ',
        ]);

        $siswaProfil->update($validatedData);

        return redirect()->route('siswa-profil.show', $siswaProfil->id)->with('success', 'Siswa Profil updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $siswaProfil = SiswaProfil::findOrFail($id);
        $siswaProfil->delete();

        return redirect()->route('siswa-profil.index')->with('success', 'Siswa Profil deleted successfully.');
    }
}
