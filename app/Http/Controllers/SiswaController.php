<?php

namespace App\Http\Controllers;

use App\Models\Configurasi;
use App\Models\Siswa;
use App\Models\Kelas;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Imports\SiswaImport;
use App\Exports\SiswaExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class SiswaController extends Controller
{
    public function export()
    {
        try {
            return Excel::download(new SiswaExport, 'siswas.xlsx');
        } catch (\Exception $e) {
            \Log::error('Export Siswa failed: ' . $e->getMessage());
            return redirect()->route('siswas.index')->with('error', 'Export failed. Please check logs or try again.');
        }
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv',
        ]);

        try {
            Excel::import(new SiswaImport, $request->file('file'));
            return redirect()->route('siswas.index')->with('success', 'Import berhasil.');
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
            $messages = [];
            foreach ($failures as $failure) {
                $messages[] = 'Baris ' . $failure->row() . ': ' . implode(', ', $failure->errors());
            }
            return redirect()->route('siswas.index')->with('error', implode(' | ', $messages));
        } catch (\Exception $e) {
            Log::error('Import error: ' . $e->getMessage());
            return redirect()->route('siswas.index')->with('error', 'Import gagal, terjadi kesalahan.');
        }
    }

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
        return redirect()->route('siswas.index')->with('success', 'Student deleted successfully.');
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
            ->setOptions(['margin-left' => 30]);
        return $pdf->stream('siswa.pdf');
    }

    public function show(Siswa $siswa)
    {
        return view('siswa.show', compact('siswa'));
    }
}
