<?php

namespace App\Http\Controllers;

use App\Models\Suket;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SuketController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        if ($search) {
            $sukets = Suket::where('description', 'like', '%' . $search . '%')
                ->orWhereHas('siswa', function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%');
                })
                ->paginate(5);
        } else {
            $sukets = Suket::with('siswa')->paginate(5);
        }

        $siswas = Siswa::all();

        return view('suket.index', compact('sukets', 'siswas'));
    }

    public function create()
    {
        $siswas = Siswa::all();
        return view('suket.create', compact('siswas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'siswas_id' => 'required|exists:siswas,id',
            'description' => 'required|string',
            'tgl_ditetapkan' => 'required|date',
            'tempat_ditetapkan' => 'required|string',
        ]);

        try {
            Suket::create($validated);
            Log::info('Suket saved successfully');
        } catch (\Exception $e) {
            Log::error('Error saving suket: ' . $e->getMessage());
        }

        return redirect()->route('sukets.index');
    }

    public function edit(Suket $suket)
    {
        $siswas = Siswa::all();
        return view('suket.edit', compact('suket', 'siswas'));
    }

    public function update(Request $request, Suket $suket)
    {
        $validated = $request->validate([
            'siswas_id' => 'required|exists:siswas,id',
            'description' => 'required|string',
            'tgl_ditetapkan' => 'required|date',
            'tempat_ditetapkan' => 'required|string',
        ]);

        $suket->update($validated);

        return redirect()->route('sukets.index')->with('success', 'Suket updated successfully.');
    }

    public function destroy(Suket $suket)
    {
        $suket->delete();
        return redirect()->route('sukets.index')->with('success', 'Suket deleted successfully.');
    }

    public function pdf($id)
    {
        $atasanNama = \App\Models\Configurasi::valueOf('atasan.nama');
        $atasanJabatan = \App\Models\Configurasi::valueOf('atasan.jabatan');
        $atasanNip = \App\Models\Configurasi::valueOf('atasan.nip');
        $atasanPangkat = \App\Models\Configurasi::valueOf('atasan.pangkat');
        $atasanUnitkerja = \App\Models\Configurasi::valueOf('atasan.unitkerja');

        $suket = Suket::with('siswa.kelas')->findOrFail($id);
        $siswa = $suket->siswa;

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('suket.pdf', compact('suket', 'siswa', 'atasanNama', 'atasanJabatan', 'atasanNip', 'atasanPangkat', 'atasanUnitkerja'))
            ->setPaper('a4')
            ->setOptions(['margin-left' => 30]);

        return $pdf->stream('suket.pdf');
    }
}
