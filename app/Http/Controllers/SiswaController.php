<?php

namespace App\Http\Controllers;

use App\Models\Configurasi;
use App\Models\Siswa;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
// use Barryvdh\DomPDF\PDF;
// use PDF;
use Barryvdh\DomPDF\Facade\Pdf;




class SiswaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        if ($search) {
            $siswas = Siswa::where('name', 'like', '%' . $search . '%')
                ->orWhere('nis', 'like', '%' . $search . '%')
                ->paginate(5);
        } else {
            $siswas = Siswa::paginate(5);
        }

        return view('siswa.index', compact('siswas'));
    }

    public function create()
    {
        $kelas = Kelas::all();
        return view('siswa.create', compact('kelas'));
    }

    // In the controller
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'nis' => 'required',
            'npsn' => 'nullable|string',
            'kelas_id' => 'required|exists:kelas,id'
        ]);

        try {
            $siswa = new Siswa();
            $siswa->name = $validated['name'];
            $siswa->nis = $validated['nis'];
            $siswa->npsn = $validated['npsn'] ?? null;
            $siswa->kelas_id = $validated['kelas_id'];
            $siswa->save();

            Log::info('Siswa saved successfully');
        } catch (\Exception $e) {
            Log::error('Error saving siswa: ' . $e->getMessage());
        }

        return redirect()->route('siswas.index');
    }
    // public function store(Request $request)
    // {
    //     $validated = $request->validate([
    //         'name' => 'required',
    //         'nis' => 'required',
    //         'kelas_id' => 'required|exists:kelas,id'
    //     ]);
    //     return redirect()->route('siswas.index')->with('success', 'Student created successfully.');
    // }

    public function edit(Siswa $siswa)
    {
        $kelas = Kelas::all();
        return view('siswa.edit', compact('siswa', 'kelas'));
    }

    public function update(Request $request, Siswa $siswa)
    {
        $validated = $request->validate([
            'name' => 'required',
            'nis' => 'required',
            'npsn' => 'nullable|string',
            'kelas_id' => 'required|exists:kelas,id'
        ]);
        $siswa->update($validated);
        return redirect()->route('siswas.index')->with('success', 'Student updated successfully.');
    }

    public function destroy(Siswa $siswa)
    {
        $siswa->delete();
        return redirect()->route('siswa.index')->with('success', 'Student deleted successfully.');
    }


    public function pdf($id)
    {
        $atasanNama = Configurasi::valueOf('atasan.nama');
        $atasanJabatan = Configurasi::valueOf('atasan.jabatan');
        $atasanNip = Configurasi::valueOf('atasan.nip');
        $atasanPangkat = Configurasi::valueOf('atasan.pangkat');
        $atasanUnitkerja = Configurasi::valueOf('atasan.unitkerja');
        $siswa = Siswa::find($id);
        $pdf = Pdf::loadView('siswa.pdf', compact('siswa', 'atasanNama', 'atasanJabatan', 'atasanNip', 'atasanPangkat', 'atasanUnitkerja'))
            ->setPaper('a4')
            ->setOptions(['margin-left' => 30]); // Set left margin to 3 cm (30 mm)
        return $pdf->stream('siswa.pdf');
    }

    public function show(Siswa $siswa)
    {
        return view('siswa.show', compact('siswa'));
    }
}
