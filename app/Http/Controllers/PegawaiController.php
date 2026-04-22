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

        $firstRow = fgetcsv($handle);
        if ($firstRow === false) {
            fclose($handle);
            return;
        }

        rewind($handle);
        
        $delimiter = ';';
        $testDelimiters = [';', ',', '\t'];
        $maxCount = 0;
        $bestDelimiter = ',';
        
        foreach ($testDelimiters as $d) {
            $count = count(str_getcsv($firstRow[0] ?? '', $d));
            if ($count > $maxCount) {
                $maxCount = $count;
                $bestDelimiter = $d;
            }
        }
        
        if ($bestDelimiter !== ',') {
            $delimiter = $bestDelimiter;
        }

        fgetcsv($handle, 0, $delimiter);

        while (($row = fgetcsv($handle, 0, $delimiter)) !== FALSE) {
            if (isset($row[0], $row[1], $row[2])) {
                $name = $this->cleanString($row[0] ?? '');
                $nip = $this->cleanString($row[1] ?? '');

                if (!empty($name) && !empty($nip)) {
                    $pegawaiData = [
                        'nama' => $name,
                        'nip' => $nip,
                        'jabatan' => $this->cleanString($row[2] ?? ''),
                        'pangkat' => $this->cleanString($row[3] ?? ''),
                        'status_kepegawaian' => $this->validateEnumValue($row[4] ?? null, ['PNS', 'PPPK', 'Honor', '-']),
                        'agama' => $this->validateEnumValue($row[5] ?? null, ['islam', 'kristen', 'protestan', 'hindu', 'budha', 'konghucu']),
                        'alamat' => $this->cleanString($row[6] ?? ''),
                        'tgl_tmt_cpns' => $this->validateDate($row[7] ?? null),
                        'integrasi' => $this->cleanString($row[8] ?? ''),
                        'no_karpeg' => $this->cleanString($row[9] ?? ''),
                        'jenis_kelamin' => $this->validateEnumValue($row[10] ?? null, ['Laki-laki', 'Perempuan']),
                        'tgl_lahir' => $this->validateDate($row[11] ?? null),
                        'tempat_lahir' => $this->cleanString($row[12] ?? ''),
                        'tgl_tmt_jabatan' => $this->validateDate($row[13] ?? null),
                        'tgl_tmt_pangkat' => $this->validateDate($row[14] ?? null),
                    ];

                    $existingPegawai = Pegawai::where('nip', $pegawaiData['nip'])->first();
                    if (!$existingPegawai) {
                        Pegawai::create($pegawaiData);
                    }
                }
            }
        }

        fclose($handle);
    }

    private function cleanString($value)
    {
        if ($value === null || $value === '') {
            return null;
        }
        
        $value = trim($value);
        $value = str_replace("\xA0", ' ', $value);
        $value = preg_replace('/\s+/', ' ', $value);
        
        return $value;
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
