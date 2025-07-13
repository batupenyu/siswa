<?php

namespace App\Http\Controllers;

use App\Models\AkKredit;
use App\Models\Configurasi;
use App\Models\Pegawai;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Exports\PegawaiExport;
use Maatwebsite\Excel\Facades\Excel;

class PegawaiController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $pangkat = $request->input('pangkat');

        $query = Pegawai::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', '%' . $search . '%')
                    ->orWhere('nip', 'like', '%' . $search . '%');
            });
        }

        if ($pangkat && $pangkat !== '') {
            $query->where('pangkat', $pangkat);
        }

        $pegawais = $query->orderBy('pangkat', 'ASC')->paginate(20);

        return view('pegawai.index', compact('pegawais'));
    }

    public function create()
    {
        return view('pegawai.create');
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'required|string|max:255|unique:pegawais,nip', // Ensure NIP is unique
            'jabatan' => 'nullable|string|max:255',
            'pangkat' => 'nullable|string|max:255',
            'integrasi' => 'nullable|string|max:255',
            'no_karpeg' => 'nullable|string|max:255',
            'jenis_kelamin' => 'nullable|in:Laki-laki,Perempuan',
            'tgl_lahir' => 'nullable|date',
            'tempat_lahir' => 'nullable|string|max:255',
            'tgl_tmt_jabatan' => 'nullable|date',
            'tgl_tmt_pangkat' => 'nullable|date',
        ]);

        // Create a new Pegawai instance
        $pegawai = new Pegawai();

        // Assign values from the validated request data
        $pegawai->nama = $validatedData['nama'];
        $pegawai->nip = $validatedData['nip'];
        $pegawai->jabatan = $validatedData['jabatan'] ?? null;
        $pegawai->pangkat = $validatedData['pangkat'] ?? null;
        $pegawai->integrasi = $validatedData['integrasi'] ?? null;
        $pegawai->no_karpeg = $validatedData['no_karpeg'] ?? null;
        $pegawai->jenis_kelamin = $validatedData['jenis_kelamin'] ?? null;
        $pegawai->tgl_lahir = $validatedData['tgl_lahir'] ?? null;
        $pegawai->tempat_lahir = $validatedData['tempat_lahir'] ?? null;
        $pegawai->tgl_tmt_jabatan = $validatedData['tgl_tmt_jabatan'] ?? null;
        $pegawai->tgl_tmt_pangkat = $validatedData['tgl_tmt_pangkat'] ?? null;

        // Save the Pegawai record to the database
        $pegawai->save();

        // Redirect to the index page with a success message
        return redirect()->route('pegawais.index')->with('success', 'Pegawai berhasil ditambahkan.');
    }

    public function show($id)
    {
        $pegawai = Pegawai::find($id);
        return view('pegawai.show', compact('pegawai'));
    }

    public function edit($id)
    {
        $pegawai = Pegawai::findOrFail($id);
        return view('pegawai.edit', compact('pegawai'));
    }

    public function update(Request $request, $id)
    {
        $pegawai = Pegawai::findOrFail($id);
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'pangkat' => 'required|string|max:255',
            'integrasi' => 'nullable|string|max:255',
            'no_karpeg' => 'nullable|string|max:255',
            'jenis_kelamin' => 'nullable|in:Laki-laki,Perempuan',
            'tgl_lahir' => 'nullable|date',
            'tempat_lahir' => 'nullable|string|max:255',
            'tgl_tmt_jabatan' => 'nullable|date',
            'tgl_tmt_pangkat' => 'nullable|date',
        ]);

        $pegawai->update($validatedData);

        return redirect()->route('pegawais.index')->with('success', 'Data pegawai berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pegawai = Pegawai::find($id);
        $pegawai->delete();
        return redirect()->route('pegawais.index');
    }

    public function pdf($id)
    {
        $atasanNama = Configurasi::valueOf('atasan.nama');
        $atasanJabatan = Configurasi::valueOf('atasan.jabatan');
        $atasanNip = Configurasi::valueOf('atasan.nip');
        $atasanPangkat = Configurasi::valueOf('atasan.pangkat');
        $atasanUnitkerja = Configurasi::valueOf('atasan.unitkerja');

        $pegawais = Pegawai::find($id);
        $pdf = Pdf::loadView('pegawai.pdf', compact('pegawais', 'atasanNama', 'atasanNip', 'atasanPangkat', 'atasanUnitkerja', 'atasanJabatan'));
        // ->setPaper('a4', 'landscape'); // Set the paper size and orientation

        return $pdf->stream('pegawai.pdf');
    }

    public function kredit($id)
    {
        $pegawai = Pegawai::find($id);

        if (!$pegawai) {
            return redirect()->back()->with('error', 'Pegawai not found.');
        }

        $akKredits = AkKredit::first();
        if (!$akKredits) {
            return redirect()->back()->with('error', 'No AkKredit records found.');
        }

        return view('pegawai.kredit', compact('pegawai', 'akKredits'));
    }

    public function exportExcel(Request $request)
    {
        // Get the same filters as the index method
        $search = $request->input('search');
        $pangkat = $request->input('pangkat');

        // Create filename with current date
        $filename = 'data-pegawai-' . now()->format('Y-m-d') . '.xlsx';

        // Export using PegawaiExport with filters
        return Excel::download(
            new PegawaiExport($search, $pangkat),
            $filename
        );
    }
}
