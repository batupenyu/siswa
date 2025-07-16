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
            'jabatan' => 'required|string|max:255',
            'pangkat' => 'nullable|string|max:255',
            'status_kepegawaian' => 'nullable|string|max:255',
            'digaji_menurut' => 'nullable|integer|exists:pp_gajis,id',
            'integrasi' => 'nullable|string|max:255',
            'no_karpeg' => 'nullable|string|max:255',
            'jenis_kelamin' => 'nullable|in:Laki-laki,Perempuan',
            'tgl_lahir' => 'nullable|date',
            'tempat_lahir' => 'nullable|string|max:255',
            'tgl_tmt_jabatan' => 'nullable|date',
            'tgl_tmt_pangkat' => 'nullable|date',
            'agama' => 'nullable|string|max:255',
            'alamat' => 'nullable|string|max:255',
            'tgl_tmt_cpns' => 'nullable|date',
        ]);

        // Use mass assignment to create Pegawai
        $pegawai = Pegawai::create($validatedData);

        // Redirect to the index page with a success message
        return redirect()->route('pegawais.index')->with('success', 'Pegawai berhasil ditambahkan.');
    }

    public function show($id)
    {
        $pegawai = Pegawai::with(['stPegawai', 'akKredits', 'anak', 'pasangan', 'ppGaji'])->find($id);
        return view('pegawai.show', compact('pegawai'));
    }

    public function edit($id)
    {
        $pegawai = Pegawai::with(['stPegawai', 'akKredits', 'anak', 'pasangan', 'ppGaji'])->findOrFail($id);
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
            'status_kepegawaian' => 'nullable|string|max:255',
            'digaji_menurut' => 'nullable|integer|exists:pp_gajis,id',
            'integrasi' => 'nullable|string|max:255',
            'no_karpeg' => 'nullable|string|max:255',
            'jenis_kelamin' => 'nullable|in:Laki-laki,Perempuan',
            'tgl_lahir' => 'nullable|date',
            'tempat_lahir' => 'nullable|string|max:255',
            'tgl_tmt_jabatan' => 'nullable|date',
            'tgl_tmt_pangkat' => 'nullable|date',
            'agama' => 'nullable|string|max:255',
            'alamat' => 'nullable|string|max:255',
            'tgl_tmt_cpns' => 'nullable|date',
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

        $akKredits = $pegawai->akKredits;
        if ($akKredits->isEmpty()) {
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
