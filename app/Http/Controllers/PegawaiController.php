<?php

namespace App\Http\Controllers;

use App\Models\AkKredit;
use App\Models\Configurasi;
use App\Models\Pegawai;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Exports\PegawaiExport;
use App\Imports\PegawaiImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;

class PegawaiController extends Controller
{


    public function destroyAll()
    {
        // Pastikan hapus data child dulu karena foreign key
        DB::table('pegawai_st_pegawai')->delete();

        // Hapus semua pegawai
        DB::table('pegawais')->delete();

        return redirect()->back()->with('success', 'Semua data pegawai berhasil dihapus.');
    }

    public function importExcel(Request $request)
    {
        $request->validate([
            'file' => 'required|file'
        ]);

        $file = $request->file('file');
        $extension = strtolower($file->getClientOriginalExtension());

        if ($extension === 'csv') {
            // Handle CSV import manually
            $this->importCsv($file->getPathname());
        }

        return redirect()->back()->with('success', 'Data pegawai berhasil diimpor!');
    }

    private function importCsv($filePath)
    {
        $handle = fopen($filePath, 'r');

        // Skip header row
        fgetcsv($handle);

        while (($data = fgetcsv($handle)) !== FALSE) {
            // Map CSV columns to database fields
            // CSV columns: name, nip, jabatan, pangkat, status_kepegawaian, agama, alamat, tgl_tmt_cpns, integrasi, no_karpeg, jenis_kelamin, tgl_lahir, tempat_lahir, tgl_tmt_jabatan, tgl_tmt_pangkat
            if (isset($data[0], $data[1], $data[2])) { // At least name, nip, jabatan
                $name = trim($data[0] ?? '');
                $nip = trim($data[1] ?? '');

                // Only proceed if both required fields are present
                if (!empty($name) && !empty($nip)) {
                    $pegawaiData = [
                        'nama' => $name,
                        'nip' => $nip,
                        'jabatan' => $data[2] ?? null,
                        'pangkat' => $data[3] ?? null,
                        'status_kepegawaian' => $this->validateEnumValue($data[4] ?? null, ['PNS', 'PPPK', 'Honor', '-']),
                        'agama' => $this->validateEnumValue($data[5] ?? null, ['islam', 'kristen', 'protestan', 'hindu', 'budha', 'konghucu']),
                        'alamat' => $data[6] ?? null,
                        'tgl_tmt_cpns' => $this->validateDate($data[7] ?? null),
                        'integrasi' => $data[8] ?? null,
                        'no_karpeg' => $data[9] ?? null,
                        'jenis_kelamin' => $this->validateEnumValue($data[10] ?? null, ['Laki-laki', 'Perempuan']),
                        'tgl_lahir' => $this->validateDate($data[11] ?? null),
                        'tempat_lahir' => $data[12] ?? null,
                        'tgl_tmt_jabatan' => $this->validateDate($data[13] ?? null),
                        'tgl_tmt_pangkat' => $this->validateDate($data[14] ?? null),
                    ];

                    // Check if NIP already exists to avoid duplicates
                    $existingPegawai = Pegawai::where('nip', $pegawaiData['nip'])->first();
                    if (!$existingPegawai) {
                        Pegawai::create($pegawaiData);
                    }
                }
            }
        }

        fclose($handle);
    }

    public function downloadTemplate()
    {
        $file = public_path('templates/pegawai_template.csv');

        if (file_exists($file)) {
            return response()->download($file, 'pegawai_template.csv', [
                'Content-Type' => 'text/csv',
            ]);
        }

        abort(404, 'Template file not found');
    }

    private function validateEnumValue($value, $allowedValues)
    {
        if ($value === null || $value === '') {
            return null;
        }

        $value = trim(strtolower($value));

        foreach ($allowedValues as $allowed) {
            if (strtolower($allowed) === $value) {
                return $allowed;
            }
        }

        return null; // Return null if value is not in allowed list
    }

    private function validateDate($value)
    {
        if ($value === null || $value === '') {
            return null;
        }

        // Check if it's already in YYYY-MM-DD format
        if (preg_match('/^\d{4}-\d{2}-\d{2}$/', $value)) {
            $date = \DateTime::createFromFormat('Y-m-d', $value);
            if ($date !== false) {
                return $value;
            }
        }

        return null; // Return null if not a valid date
    }

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

        $pegawais = $query->orderBy('nama', 'ASC')->paginate(10);

        return view('pegawai.index', compact('pegawais'));
    }

    public function create()
    {
        return view('pegawai.create');
    }


    public function store(Request $request)
    {
        // Validasi: NIP harus string dan unik — penting untuk mencegah konversi ke angka
        $validatedData = $request->validate([
            'nama' => 'nullable|string|max:255',
            'nip' => 'nullable|string|max:255|unique:pegawais,nip',
            'jabatan' => 'nullable|string|max:255',
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

        Pegawai::create($validatedData);

        return redirect()->route('pegawais.index')->with('success', 'Pegawai berhasil ditambahkan.');
    }

    public function show($id)
    {
        $pegawai = Pegawai::with(['stPegawai', 'akKredits', 'anak', 'pasangan', 'ppGaji'])->find($id);
        if (!$pegawai) {
            return redirect()->route('pegawais.index')->with('error', 'Pegawai tidak ditemukan.');
        }
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
            'nama' => 'nullable|string|max:255',
            'nip' => 'nullable|string|max:255|unique:pegawais,nip,' . $pegawai->id,
            'jabatan' => 'nullable|string|max:255',
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

        $pegawai->update($validatedData);

        return redirect()->route('pegawais.index')->with('success', 'Data pegawai berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pegawai = Pegawai::find($id);
        if ($pegawai) {
            $pegawai->delete();
        }
        return redirect()->route('pegawais.index')->with('success', 'Pegawai berhasil dihapus.');
    }

    public function pdf($id)
    {
        $atasanNama = Configurasi::valueOf('atasan.nama');
        $atasanJabatan = Configurasi::valueOf('atasan.jabatan');
        $atasanNip = Configurasi::valueOf('atasan.nip');
        $atasanPangkat = Configurasi::valueOf('atasan.pangkat');
        $atasanUnitkerja = Configurasi::valueOf('atasan.unitkerja');

        $pegawais = Pegawai::find($id);
        if (!$pegawais) {
            return redirect()->back()->with('error', 'Pegawai tidak ditemukan.');
        }

        $pdf = Pdf::loadView('pegawai.pdf', compact(
            'pegawais',
            'atasanNama',
            'atasanNip',
            'atasanPangkat',
            'atasanUnitkerja',
            'atasanJabatan'
        ));

        return $pdf->stream('pegawai.pdf');
    }

    public function kredit($id)
    {
        $pegawai = Pegawai::find($id);
        if (!$pegawai) {
            return redirect()->back()->with('error', 'Pegawai tidak ditemukan.');
        }

        $akKredits = $pegawai->akKredits;
        if ($akKredits->isEmpty()) {
            return redirect()->back()->with('error', 'Tidak ada data kredit kegiatan.');
        }

        return view('pegawai.kredit', compact('pegawai', 'akKredits'));
    }

    public function exportExcel(Request $request)
    {
        $search = $request->input('search');
        $pangkat = $request->input('pangkat');

        $query = Pegawai::query();
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%$search%")
                  ->orWhere('nip', 'like', "%$search%")
                  ->orWhere('jabatan', 'like', "%$search%");
            });
        }
        if ($pangkat) {
            $query->where('pangkat', $pangkat);
        }

        if ($query->count() === 0) {
            return redirect()->back()->with('error', 'Tidak ada data untuk dieksport!');
        }

        $filename = 'data-pegawai-' . now()->format('Y-m-d') . '.xlsx';

        return Excel::download(
            new PegawaiExport($search, $pangkat),
            $filename
        );
    }
}
