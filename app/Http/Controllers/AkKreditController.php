<?php

namespace App\Http\Controllers;

use App\Models\AkKredit;
use App\Models\Configurasi;
use App\Models\Kpa;
use App\Models\Pegawai;
use App\Models\Penilai;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;



class AkKreditController extends Controller
{
    // Display a listing of akKredits
    public function index(Request $request)
    {

        // Retrieve all pegawais (employees)
        $pegawais = Pegawai::orderBy('nama', 'ASC')->get();

        // Get the selected pegawai_id from the query string (if provided)
        $pegawaiId = $request->query('pegawai_id');

        // Fetch akKredits filtered by pegawais_id if pegawaiId is provided
        if ($pegawaiId) {
            $akKredits = AkKredit::where('pegawais_id', $pegawaiId)->orderBy('startDate', 'ASC')->paginate(10);
        } else {
            // If no pegawai_id is provided, fetch all akKredits ordered by startDate ascending
            $akKredits = AkKredit::orderBy('startDate', 'ASC')->paginate(10);
        }

        $akKredit = AkKredit::when($pegawaiId, function ($query, $pegawaiId) {
            return $query->where('pegawais_id', $pegawaiId); // Update column name to 'pegawais_id'
        })->orderBy('startDate', 'DESC')->first(); // Use first() to get the first matching record in ascending order

        // Pass data to the view
        return view('akKredits.index', compact('akKredits', 'pegawais', 'pegawaiId', 'akKredit'));
        // return view('pdf.akKredits', compact('akKredits', 'pegawais', 'pegawaiId'));
    }

    // public function index(Request $request)
    // {
    //     $pegawaiId = $request->input('pegawai_id');

    //     // Paginate akKredits based on selected pegawai
    //     $akKredits = $pegawaiId
    //         ? AkKredit::where('pegawai_id', $pegawaiId)->paginate(10)
    //         : AkKredit::paginate(10);

    //     // Fetch all pegawais for the dropdown
    //     $pegawais = Pegawai::all();

    //     return view('akKredits.index', compact('akKredits', 'pegawais', 'pegawaiId'));
    // }

    public function akumulasi(Request $request)
    {
        $search = $request->input('search');

        $akKredits = AkKredit::with('pegawai')
            ->when($search, function ($query, $search) {
                $query->where('pegawai.nama', 'like', '%' . $search . '%')
                    ->orWhere('pegawai.nip', 'like', '%' . $search . '%')
                    ->orWhere('pegawai.jabatan', 'like', '%' . $search . '%')
                    ->orWhere('pegawai.unitkerja', 'like', '%' . $search . '%');
            })
            ->get();

        $atasanNama = Configurasi::valueOf('atasan.nama');
        $atasanJabatan = Configurasi::valueOf('atasan.jabatan');
        $atasanNip = Configurasi::valueOf('atasan.nip');
        $atasanPangkat = Configurasi::valueOf('atasan.pangkat');
        $atasanUnitkerja = Configurasi::valueOf('atasan.unitkerja');

        $pdf = Pdf::loadView('akKredits.akumulasi', compact('akKredits', 'atasanNama', 'atasanNip', 'atasanPangkat', 'atasanUnitkerja', 'atasanJabatan'));
        // ->setPaper('a4', 'landscape'); // Set the paper size and orientation

        return $pdf->stream('akKredits.akumulasi');
    }

    // Show the form for creating a new akKredit

    public function create()
    {
        $pegawais = \App\Models\Pegawai::all(); // Fetch all pegawai records
        return view('akKredits.create', compact('pegawais'));
    }
    // Store a newly created akKredit in storage
    public function store(Request $request)
    {
        $validated = $request->validate([
            'pegawais_id' => 'required|exists:pegawais,id',
            'startDate' => 'required|date',
            'endDate' => 'required|date|after_or_equal:startDate',
            'predikat' => 'nullable|in:Sangat Baik,Baik,Perlu Perbaikan,Kurang,Sangat Kurang', // Add predikat validation
        ]);

        AkKredit::create($validated);

        return redirect()->route('akKredits.index')->with('success', 'AkKredit created successfully.');
    }

    // Display the specified akKredit
    public function show(AkKredit $akKredit)
    {
        return view('akKredits.show', compact('akKredit'));
    }

    // Show the form for editing the specified akKredit
    public function edit(AkKredit $akKredit)
    {
        $pegawais = \App\Models\Pegawai::all(); // Fetch all pegawai records
        return view('akKredits.edit', compact('akKredit', 'pegawais'));
    }

    // Update the specified akKredit in storage
    public function update(Request $request, AkKredit $akKredit)
    {
        $validated = $request->validate([
            'pegawais_id' => 'required|exists:pegawais,id',
            'startDate' => 'required|date',
            'endDate' => 'required|date|after_or_equal:startDate',
            'predikat' => 'nullable|in:Sangat Baik,Baik,Perlu Perbaikan,Kurang,Sangat Kurang', // Add predikat validation
        ]);

        $akKredit->update($validated);

        return redirect()->route('akKredits.index')->with('success', 'AkKredit updated successfully.');
    }



    // Remove the specified akKredit from storage
    public function destroy(AkKredit $akKredit)
    {
        $akKredit->delete();

        return redirect()->route('akKredits.index')->with('success', 'AkKredit deleted successfully.');
    }

    public function pdf($id)
    {
        $atasanNama = Configurasi::valueOf('atasan.nama');
        $atasanJabatan = Configurasi::valueOf('atasan.jabatan');
        $atasanNip = Configurasi::valueOf('atasan.nip');
        $atasanPangkat = Configurasi::valueOf('atasan.pangkat');
        $atasanUnitkerja = Configurasi::valueOf('atasan.unitkerja');

        $akKredits = AkKredit::with('pegawai')->find($id);

        $pdf = Pdf::loadView('akKredits.pdf', compact('akKredits', 'atasanNama', 'atasanNip', 'atasanPangkat', 'atasanUnitkerja', 'atasanJabatan'));
        return $pdf->stream('akKredits.pdf');
    }



    // public function generatePdf(Request $request)
    // {
    //     $pegawais = Pegawai::all();
    //     $pegawaiId = $request->query('pegawai_id');

    //     $akKredits = $pegawaiId
    //         ? AkKredit::where('pegawais_id', $pegawaiId)->get()
    //         : AkKredit::all();

    //     $pdf = Pdf::loadView('akKredits.pdf', compact('akKredits', 'pegawais', 'pegawaiId'));
    //     return $pdf->stream('akKredits.pdf');
    // }

    public function generatePdf(Request $request)
    {
        // Retrieve input parameters
        $tgl_awal = $request->tgl_awal;
        $tgl_akhir = $request->tgl_akhir;

        // Fetch configuration data for the atasan
        $penilai = Penilai::first();
        $kpa = Kpa::first();
        $atasanNama = Configurasi::valueOf('atasan.nama');
        $atasanJabatan = Configurasi::valueOf('atasan.jabatan');
        $atasanNip = Configurasi::valueOf('atasan.nip');
        $atasanPangkat = Configurasi::valueOf('atasan.pangkat');
        $atasanUnitkerja = Configurasi::valueOf('atasan.unitkerja');
        $atasanInstansi = Configurasi::valueOf('atasan.instansi');

        // Fetch the data for the selected pegawai or all records
        $pegawaiId = $request->query('pegawai_id');

        // Fetch all records (filtered by pegawai_id if provided)
        $akKredits = AkKredit::when($pegawaiId, function ($query, $pegawaiId) {
            return $query->where('pegawais_id', $pegawaiId); // Update column name to 'pegawais_id'
        })
            ->whereBetween('startDate', [$tgl_awal, $tgl_akhir])
            ->orderBy('startDate', 'ASC')
            ->get();

        // Fetch the first record (filtered by pegawai_id if provided)
        $akKredits_first = AkKredit::when($pegawaiId, function ($query, $pegawaiId) {
            return $query->where('pegawais_id', $pegawaiId); // Update column name to 'pegawais_id'
        })
            ->whereBetween('startDate', [$tgl_awal, $tgl_akhir])
            ->orderBy('startDate', 'DESC')
            ->first(); // Use first() to get the first matching record

        // Check if akKredit is null
        if (!$akKredits_first) {
            return redirect()->route('akKredits.index')->with('error', 'No matching records found for the specified date range.');
        }



        // Check if tgl_awal is not equal to startDate in any AkKredit record
        $mismatchFound = false;
        foreach ($akKredits as $record) {
            if ($record->startDate != $tgl_awal) {
                $mismatchFound = false;
                break; // Exit the loop early if a mismatch is found
            }
        }

        // If a mismatch is found, redirect back to the index page with an error message
        if ($mismatchFound) {
            return redirect()->route('akKredits.index')->with('error', 'Mismatch detected: Some records have startDate values that do not match tgl_awal.');
        }

        // Pass the data to the view
        $pdf = Pdf::loadView('pdf.akKredits', compact(
            'penilai',
            'kpa',
            'akKredits',
            'akKredits_first',
            'atasanNama',
            'atasanNip',
            'atasanPangkat',
            'atasanUnitkerja',
            'atasanJabatan',
            'atasanInstansi',
            'tgl_awal',
            'tgl_akhir'
        ));

        // Return the PDF as a stream (preview in browser)
        return $pdf->stream('akumulasi-an.-' . $akKredits_first->pegawai->nama . '-' . \Carbon\Carbon::parse($akKredits_first->endDate)->format('Y')  . '.pdf');
    }

    public function penetapan(Request $request)
    {
        // Retrieve input parameters
        $penilai = Penilai::first();
        $kpa = Kpa::first();
        $tgl_awal = $request->tgl_awal;
        $tgl_akhir = $request->tgl_akhir;

        // Fetch configuration data for the atasan
        $atasanNama = Configurasi::valueOf('atasan.nama');
        $atasanJabatan = Configurasi::valueOf('atasan.jabatan');
        $atasanNip = Configurasi::valueOf('atasan.nip');
        $atasanPangkat = Configurasi::valueOf('atasan.pangkat');
        $atasanUnitkerja = Configurasi::valueOf('atasan.unitkerja');
        $atasanInstansi = Configurasi::valueOf('atasan.instansi');

        // Fetch the data for the selected pegawai or all records
        $pegawaiId = $request->query('pegawai_id');

        // Fetch all records (filtered by pegawai_id if provided)
        $akKredits = AkKredit::when($pegawaiId, function ($query, $pegawaiId) {
            return $query->where('pegawais_id', $pegawaiId); // Update column name to 'pegawais_id'
        })
            ->whereBetween('startDate', [$tgl_awal, $tgl_akhir])
            ->orderBy('startDate', 'ASC')
            ->get();

        // Fetch the first record (filtered by pegawai_id if provided)
        $akKredits_first = AkKredit::when($pegawaiId, function ($query, $pegawaiId) {
            return $query->where('pegawais_id', $pegawaiId); // Update column name to 'pegawais_id'
        })
            ->whereBetween('startDate', [$tgl_awal, $tgl_akhir])
            ->orderBy('startDate', 'DESC')
            ->first(); // Use first() to get the first matching record

        // Check if akKredit is null
        if (!$akKredits_first) {
            return redirect()->route('akKredits.index')->with('error', 'No matching records found for the specified date range.');
        }

        // Check if tgl_awal is not equal to startDate in any AkKredit record
        $mismatchFound = false;
        foreach ($akKredits as $record) {
            if ($record->startDate != $tgl_awal) {
                $mismatchFound = false;
                break; // Exit the loop early if a mismatch is found
            }
        }

        // If a mismatch is found, redirect back to the index page with an error message
        if ($mismatchFound) {
            return redirect()->route('index')->with('error', 'Mismatch detected: Some records have startDate values that do not match tgl_awal.');
        }

        // Pass the data to the view
        $pdf = Pdf::loadView('pdf.penetapan', compact(
            'penilai',
            'kpa',
            'akKredits',
            'akKredits_first',
            'atasanNama',
            'atasanNip',
            'atasanPangkat',
            'atasanUnitkerja',
            'atasanJabatan',
            'atasanInstansi',
            'tgl_awal',
            'tgl_akhir'
        ));

        // Return the PDF as a stream (preview in browser)
        return $pdf->stream('penetapan-an.-' . $akKredits_first->pegawai->nama . '-' . \Carbon\Carbon::parse($akKredits_first->endDate)->format('Y')  . '.pdf');
    }

    public function viewPdf($id)
    {

        // Fetch configuration data for the atasan
        $penilai = Penilai::first();
        $kpa = Kpa::first();
        $atasanNama = Configurasi::valueOf('atasan.nama');
        $atasanJabatan = Configurasi::valueOf('atasan.jabatan');
        $atasanNip = Configurasi::valueOf('atasan.nip');
        $atasanPangkat = Configurasi::valueOf('atasan.pangkat');
        $atasanUnitkerja = Configurasi::valueOf('atasan.unitkerja');
        $atasanInstansi = Configurasi::valueOf('atasan.instansi');

        // Fetch the record by ID
        $akKredit = AkKredit::with('pegawai')->findOrFail($id);

        // Pass data to the PDF view
        $data = [
            'akKredit' => $akKredit,
        ];

        // Generate the PDF
        // $pdf = Pdf::loadView('pdf.viewPdf', $data);
        $pdf = Pdf::loadView('pdf.viewPdf', compact(
            'penilai',
            'kpa',
            'akKredit',
            'atasanNama',
            'atasanNip',
            'atasanPangkat',
            'atasanUnitkerja',
            'atasanJabatan',
            'atasanInstansi',
        ));

        // Stream the PDF to the browser
        return $pdf->stream('konversi-an.-' . $akKredit->pegawai->nama . '-' . \Carbon\Carbon::parse($akKredit->endDate)->format('Y')  . '.pdf');
    }
}
