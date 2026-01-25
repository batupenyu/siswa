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

        // Fetch unique periods for the dropdown
        $availablePeriods = AkKredit::select('startDate')
            ->distinct()
            ->orderBy('startDate', 'DESC')
            ->get()
            ->map(function ($item) {
                $year = \Carbon\Carbon::parse($item->startDate)->year;
                return [
                    'value' => $item->startDate,
                    'label' => $year
                ];
            });

        // Pass data to the view
        return view('akKredits.index', compact('akKredits', 'pegawais', 'pegawaiId', 'akKredit', 'availablePeriods'));
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




    public function generatePdf(Request $request)
    {
        // Retrieve input parameters
        $tgl_awal = $request->tgl_awal;
        $tgl_akhir = $request->tgl_akhir;
        $pegawaiId = $request->query('pegawai_id');

        // Retrieve additional options
        $options = [
            'angka_integrasi' => $request->has('angka_integrasi'),
            'periode' => $request->get('periode', []), // Now an array of selected periods
        ];

        // Fetch configuration data for the atasan
        $penilai = Penilai::first();
        $kpa = Kpa::first();
        $atasanNama = Configurasi::valueOf('atasan.nama');
        $atasanJabatan = Configurasi::valueOf('atasan.jabatan');
        $atasanNip = Configurasi::valueOf('atasan.nip');
        $atasanPangkat = Configurasi::valueOf('atasan.pangkat');
        $atasanUnitkerja = Configurasi::valueOf('atasan.unitkerja');
        $atasanInstansi = Configurasi::valueOf('atasan.instansi');

        // Handle multiple periods selection - prioritize selected periods over date range
        $selectedPeriods = $options['periode'];

        // Fetch the data for the selected pegawai or all records based on selected periods
        $akKredits = AkKredit::with('pegawai')
            ->when($pegawaiId, function ($query, $pegawaiId) {
                return $query->where('pegawais_id', $pegawaiId); // Update column name to 'pegawais_id'
            })
            ->when(!empty($selectedPeriods), function ($query) use ($selectedPeriods, $tgl_awal, $tgl_akhir) {
                // If 'all' is selected, don't apply date filter
                if (in_array('all', $selectedPeriods)) {
                    return $query; // No date filter
                } else {
                    $query = $query->where(function ($q) use ($selectedPeriods, $tgl_awal, $tgl_akhir) {
                        $hasCondition = false;

                        // Process specific date periods (like '2025-01-01')
                        $specificDates = array_filter($selectedPeriods, function($period) {
                            return preg_match('/^\d{4}-\d{2}-\d{2}$/', $period) && !in_array($period, ['all', 'current_year', 'last_year', 'last_2_years', 'last_5_years']);
                        });

                        if (!empty($specificDates)) {
                            $q->whereIn('startDate', $specificDates);
                            $hasCondition = true;
                        }

                        // Process relative periods (like 'current_year', 'last_year')
                        $relativePeriods = array_intersect($selectedPeriods, ['current_year', 'last_year', 'last_2_years', 'last_5_years']);

                        foreach ($relativePeriods as $period) {
                            $range = $this->getSinglePeriodRange($period, $tgl_awal, $tgl_akhir);
                            if ($range) {
                                if ($hasCondition) {
                                    $q->orWhereBetween('startDate', [$range['start'], $range['end']]);
                                } else {
                                    $q->whereBetween('startDate', [$range['start'], $range['end']]);
                                    $hasCondition = true;
                                }
                            }
                        }
                    });
                }
            })
            ->orderBy('startDate', 'ASC')
            ->get();

        // Fetch the first record (filtered by pegawai_id if provided) with the same filters as main query
        $akKredits_first = AkKredit::with('pegawai')
            ->when($pegawaiId, function ($query, $pegawaiId) {
                return $query->where('pegawais_id', $pegawaiId); // Update column name to 'pegawais_id'
            })
            ->when(!empty($selectedPeriods), function ($query) use ($selectedPeriods, $tgl_awal, $tgl_akhir) {
                // If 'all' is selected, don't apply date filter
                if (in_array('all', $selectedPeriods)) {
                    return $query; // No date filter
                } else {
                    $query = $query->where(function ($q) use ($selectedPeriods, $tgl_awal, $tgl_akhir) {
                        $hasCondition = false;

                        // Process specific date periods (like '2025-01-01')
                        $specificDates = array_filter($selectedPeriods, function($period) {
                            return preg_match('/^\d{4}-\d{2}-\d{2}$/', $period) && !in_array($period, ['all', 'current_year', 'last_year', 'last_2_years', 'last_5_years']);
                        });

                        if (!empty($specificDates)) {
                            $q->whereIn('startDate', $specificDates);
                            $hasCondition = true;
                        }

                        // Process relative periods (like 'current_year', 'last_year')
                        $relativePeriods = array_intersect($selectedPeriods, ['current_year', 'last_year', 'last_2_years', 'last_5_years']);

                        foreach ($relativePeriods as $period) {
                            $range = $this->getSinglePeriodRange($period, $tgl_awal, $tgl_akhir);
                            if ($range) {
                                if ($hasCondition) {
                                    $q->orWhereBetween('startDate', [$range['start'], $range['end']]);
                                } else {
                                    $q->whereBetween('startDate', [$range['start'], $range['end']]);
                                    $hasCondition = true;
                                }
                            }
                        }
                    });
                }
            })
            ->orderBy('endDate', 'DESC')  // Sort by endDate to get the most recent period
            ->first(); // Use first() to get the first matching record (latest end date)

        // Check if akKredit is null
        if (!$akKredits_first) {
            return redirect()->route('akKredits.index')->with('error', 'No matching records found for the specified date range.');
        }

        // Calculate the total AK credit for all records - using same logic as before but with the filtered records
        $totalAkKreditValue = 0;
        \Log::info('Generate PDF calculation start', ['akKredits_count' => count($akKredits->toArray())]);
        foreach ($akKredits as $akKredit) {
            $startDate = \Carbon\Carbon::parse($akKredit->startDate);
            $endDate = \Carbon\Carbon::parse($akKredit->endDate);
            $diffInMonths = $startDate->diffInMonths($endDate) + 1;

            if ($akKredit->predikat == 'Sangat Baik') {
                $prosentase = 150;
            } else {
                $prosentase = 100;
            }

            $gol = $akKredit->pegawai->pangkat;

            if ($gol == 'IV/a') {
                $koefisien = 37.5;
                $jenjang = 450;
            } elseif ($gol == 'III/d') {
                $koefisien = 25;
                $jenjang = 200;
                $namaPangkat = 'Penata tk';
            } elseif ($gol == 'III/c') {
                $koefisien = 12.5;
                $jenjang = 100;
            } else {
                $koefisien = 0; // Default for other cases
            }

            $value = ($koefisien * $diffInMonths / 12) * $prosentase / 100;
            \Log::info('Generate PDF calculation detail', [
                'akKredit_id' => $akKredit->id,
                'gol' => $gol,
                'diffInMonths' => $diffInMonths,
                'koefisien' => $koefisien,
                'prosentase' => $prosentase,
                'value' => $value,
                'running_total' => $totalAkKreditValue + $value
            ]);
            $totalAkKreditValue += $value; // Add the numeric value, not formatted string
        }

        // Calculate integrasi value based on options
        $integrasiValue = 0;
        if (isset($options['angka_integrasi']) && $options['angka_integrasi']) {
            $integrasiValue = (float)($akKredits_first->pegawai->integrasi ?? 0);
        }

        // Calculate total with integrasi if option is selected
        $totalAkKreditValueWithIntegrasi = $totalAkKreditValue + $integrasiValue;

        \Log::info('Generate PDF final calculation', [
            'totalAkKreditValue' => $totalAkKreditValue,
            'integrasiValue' => $integrasiValue,
            'totalAkKreditValueWithIntegrasi' => $totalAkKreditValueWithIntegrasi,
            'pegawai_pangkat' => $akKredits_first->pegawai->pangkat ?? 'unknown',
            'options' => $options
        ]);

        // Calculate the final 'baru' value based on the employee's pangkat
        $employeePangkat = $akKredits_first->pegawai->pangkat;
        if ($employeePangkat == 'III/d') {
            // Use the appropriate total based on whether integrasi is included
            if (isset($options['angka_integrasi']) && $options['angka_integrasi']) {
                $finalBaruValue = $totalAkKreditValueWithIntegrasi - 100; // For III/d, baru = total_with_integrasi - 100
            } else {
                $finalBaruValue = $totalAkKreditValue - 100; // For III/d, baru = total_without_integrasi - 100
            }
        } else {
            // Use the appropriate total based on whether integrasi is included
            if (isset($options['angka_integrasi']) && $options['angka_integrasi']) {
                $finalBaruValue = $totalAkKreditValueWithIntegrasi; // For others, baru = total_with_integrasi
            } else {
                $finalBaruValue = $totalAkKreditValue; // For others, baru = total_without_integrasi
            }
        }

        // Pass the data to the view - use the appropriate total based on integrasi option
        $displayTotalAkKreditValue = isset($options['angka_integrasi']) && $options['angka_integrasi']
            ? $totalAkKreditValueWithIntegrasi
            : $totalAkKreditValue;

        // Also pass the integrasi value separately for use in views if needed
        $integrasiValueForView = isset($options['angka_integrasi']) && $options['angka_integrasi']
            ? $integrasiValue
            : 0;

        try {
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
                'tgl_akhir',
                'displayTotalAkKreditValue', // This is the total to display (with or without integrasi based on option)
                'finalBaruValue',
                'options',
                'integrasiValueForView' // Pass integrasi value separately
            ));

            // Return the PDF as a stream (preview in browser)
            return $pdf->stream('akumulasi-an.-' . $akKredits_first->pegawai->nama . '-' . \Carbon\Carbon::parse($akKredits_first->endDate)->format('Y')  . '.pdf');
        } catch (\Exception $e) {
            \Log::error('PDF Generation Error: ' . $e->getMessage() . ' Line: ' . $e->getLine() . ' File: ' . $e->getFile());
            return redirect()->route('akKredits.index')->with('error', 'Error generating PDF: ' . $e->getMessage());
        }
    }

    public function penetapan(Request $request)
    {
        // Retrieve input parameters
        $penilai = Penilai::first();
        $kpa = Kpa::first();
        $tgl_awal = $request->tgl_awal;
        $tgl_akhir = $request->tgl_akhir;
        $pegawaiId = $request->query('pegawai_id');

        // Retrieve additional options
        $options = [
            'angka_integrasi' => $request->has('angka_integrasi'),
            'periode' => $request->get('periode', []), // Now an array of selected periods
        ];

        // Fetch configuration data for the atasan
        $atasanNama = Configurasi::valueOf('atasan.nama');
        $atasanJabatan = Configurasi::valueOf('atasan.jabatan');
        $atasanNip = Configurasi::valueOf('atasan.nip');
        $atasanPangkat = Configurasi::valueOf('atasan.pangkat');
        $atasanUnitkerja = Configurasi::valueOf('atasan.unitkerja');
        $atasanInstansi = Configurasi::valueOf('atasan.instansi');

        // Handle multiple periods selection - prioritize selected periods over date range
        $selectedPeriods = $options['periode'];

        // Fetch the data for the selected pegawai or all records based on selected periods
        $akKredits = AkKredit::with('pegawai')
            ->when($pegawaiId, function ($query, $pegawaiId) {
                return $query->where('pegawais_id', $pegawaiId); // Update column name to 'pegawais_id'
            })
            ->when(!empty($selectedPeriods), function ($query) use ($selectedPeriods, $tgl_awal, $tgl_akhir) {
                // If 'all' is selected, don't apply date filter
                if (in_array('all', $selectedPeriods)) {
                    return $query; // No date filter
                } else {
                    $query = $query->where(function ($q) use ($selectedPeriods, $tgl_awal, $tgl_akhir) {
                        $hasCondition = false;

                        // Process specific date periods (like '2025-01-01')
                        $specificDates = array_filter($selectedPeriods, function($period) {
                            return preg_match('/^\d{4}-\d{2}-\d{2}$/', $period) && !in_array($period, ['all', 'current_year', 'last_year', 'last_2_years', 'last_5_years']);
                        });

                        if (!empty($specificDates)) {
                            $q->whereIn('startDate', $specificDates);
                            $hasCondition = true;
                        }

                        // Process relative periods (like 'current_year', 'last_year')
                        $relativePeriods = array_intersect($selectedPeriods, ['current_year', 'last_year', 'last_2_years', 'last_5_years']);

                        foreach ($relativePeriods as $period) {
                            $range = $this->getSinglePeriodRange($period, $tgl_awal, $tgl_akhir);
                            if ($range) {
                                if ($hasCondition) {
                                    $q->orWhereBetween('startDate', [$range['start'], $range['end']]);
                                } else {
                                    $q->whereBetween('startDate', [$range['start'], $range['end']]);
                                    $hasCondition = true;
                                }
                            }
                        }
                    });
                }
            })
            ->orderBy('startDate', 'ASC')
            ->get();

        // Fetch the first record (filtered by pegawai_id if provided) with the same filters as main query
        $akKredits_first = AkKredit::with('pegawai')
            ->when($pegawaiId, function ($query, $pegawaiId) {
                return $query->where('pegawais_id', $pegawaiId); // Update column name to 'pegawais_id'
            })
            ->when(!empty($selectedPeriods), function ($query) use ($selectedPeriods, $tgl_awal, $tgl_akhir) {
                // If 'all' is selected, don't apply date filter
                if (in_array('all', $selectedPeriods)) {
                    return $query; // No date filter
                } else {
                    $query = $query->where(function ($q) use ($selectedPeriods, $tgl_awal, $tgl_akhir) {
                        $hasCondition = false;

                        // Process specific date periods (like '2025-01-01')
                        $specificDates = array_filter($selectedPeriods, function($period) {
                            return preg_match('/^\d{4}-\d{2}-\d{2}$/', $period) && !in_array($period, ['all', 'current_year', 'last_year', 'last_2_years', 'last_5_years']);
                        });

                        if (!empty($specificDates)) {
                            $q->whereIn('startDate', $specificDates);
                            $hasCondition = true;
                        }

                        // Process relative periods (like 'current_year', 'last_year')
                        $relativePeriods = array_intersect($selectedPeriods, ['current_year', 'last_year', 'last_2_years', 'last_5_years']);

                        foreach ($relativePeriods as $period) {
                            $range = $this->getSinglePeriodRange($period, $tgl_awal, $tgl_akhir);
                            if ($range) {
                                if ($hasCondition) {
                                    $q->orWhereBetween('startDate', [$range['start'], $range['end']]);
                                } else {
                                    $q->whereBetween('startDate', [$range['start'], $range['end']]);
                                    $hasCondition = true;
                                }
                            }
                        }
                    });
                }
            })
            ->orderBy('endDate', 'DESC')  // Sort by endDate to get the most recent period
            ->first(); // Use first() to get the first matching record (latest end date)

        // Check if akKredit is null
        if (!$akKredits_first) {
            return redirect()->route('akKredits.index')->with('error', 'No matching records found for the specified date range.');
        }

        // Skip the mismatch check for date range queries - this validation doesn't make sense for date ranges
        // The original logic was checking if all records have the same startDate as tgl_awal, which is not appropriate for date range queries

        // Calculate the total AK credit for all records - using same logic as akumulasi
        $totalAkKreditValue = 0;
        \Log::info('Penetapan calculation start', ['akKredits_count' => count($akKredits->toArray())]);
        foreach ($akKredits as $akKredit) {
            $startDate = \Carbon\Carbon::parse($akKredit->startDate);
            $endDate = \Carbon\Carbon::parse($akKredit->endDate);
            $diffInMonths = $startDate->diffInMonths($endDate) + 1;

            if ($akKredit->predikat == 'Sangat Baik') {
                $prosentase = 150;
            } else {
                $prosentase = 100;
            }

            $gol = $akKredit->pegawai->pangkat;

            if ($gol == 'IV/a') {
                $koefisien = 37.5;
                $jenjang = 450;
            } elseif ($gol == 'III/d') {
                $koefisien = 25;
                $jenjang = 200;
                $namaPangkat = 'Penata tk';
            } elseif ($gol == 'III/c') {
                $koefisien = 12.5;
                $jenjang = 100;
            } else {
                $koefisien = 0; // Default for other cases
            }

            $value = ($koefisien * $diffInMonths / 12) * $prosentase / 100;
            \Log::info('Penetapan calculation detail', [
                'akKredit_id' => $akKredit->id,
                'gol' => $gol,
                'diffInMonths' => $diffInMonths,
                'koefisien' => $koefisien,
                'prosentase' => $prosentase,
                'value' => $value,
                'running_total' => $totalAkKreditValue + $value
            ]);
            $totalAkKreditValue += $value; // Add the numeric value, not formatted string
        }
        // Add integrasi value based on options
        $integrasiValue = 0;
        if ($options['angka_integrasi']) {
            $integrasiValue = (float)($akKredits_first->pegawai->integrasi ?? 0);
        }

        $totalAkKreditValueWithIntegrasi = $totalAkKreditValue + $integrasiValue;

        \Log::info('Penetapan final calculation', [
            'totalAkKreditValue' => $totalAkKreditValue,
            'integrasiValue' => $integrasiValue,
            'totalAkKreditValueWithIntegrasi' => $totalAkKreditValueWithIntegrasi,
            'pegawai_pangkat' => $akKredits_first->pegawai->pangkat ?? 'unknown',
            'options' => $options
        ]);

        // Calculate the final 'baru' value based on the employee's pangkat
        $employeePangkat = $akKredits_first->pegawai->pangkat;
        if ($employeePangkat == 'III/d') {
            $finalBaruValue = $totalAkKreditValueWithIntegrasi - 100; // For III/d, baru = total - 100
        } else {
            $finalBaruValue = $totalAkKreditValueWithIntegrasi; // For others, baru = total
        }

        // Pass the data to the view - use the appropriate total based on integrasi option
        $displayTotalAkKreditValue = isset($options['angka_integrasi']) && $options['angka_integrasi']
            ? $totalAkKreditValueWithIntegrasi
            : $totalAkKreditValue;

        // Also pass the integrasi value separately for use in views if needed
        $integrasiValueForView = isset($options['angka_integrasi']) && $options['angka_integrasi']
            ? $integrasiValue
            : 0;

        try {
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
                'tgl_akhir',
                'displayTotalAkKreditValue', // This is the total to display (with or without integrasi based on option)
                'finalBaruValue',
                'options',
                'integrasiValueForView' // Pass integrasi value separately
            ));

            // Return the PDF as a stream (preview in browser)
            return $pdf->stream('penetapan-an.-' . $akKredits_first->pegawai->nama . '-' . \Carbon\Carbon::parse($akKredits_first->endDate)->format('Y')  . '.pdf');
        } catch (\Exception $e) {
            \Log::error('PDF Generation Error (penetapan): ' . $e->getMessage());
            return redirect()->route('akKredits.index')->with('error', 'Error generating PDF: ' . $e->getMessage());
        }
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

    public function forPegawai($pegawaiId)
    {
        $akKredits = AkKredit::where('pegawais_id', $pegawaiId)->get();

        return response()->json([
            'pegawai_id' => $pegawaiId,
            'count' => $akKredits->count(),
            'records' => $akKredits
        ]);
    }

    /**
     * Get date range based on selected period option
     */
    private function getDateRangeForPeriod($period, $tgl_awal, $tgl_akhir)
    {
        switch ($period) {
            case 'all':
                // Return null to indicate no date restriction
                return null;
            case '2025-01-01':
                return [
                    'start' => '2025-01-01',
                    'end' => '2025-12-31'
                ];
            case '2024-01-01':
                return [
                    'start' => '2024-01-01',
                    'end' => '2024-12-31'
                ];
            case '2023-01-01':
                return [
                    'start' => '2023-01-01',
                    'end' => '2023-12-31'
                ];
            case 'current_year':
                $year = date('Y');
                return [
                    'start' => $year . '-01-01',
                    'end' => $year . '-12-31'
                ];
            case 'last_year':
                $year = date('Y') - 1;
                return [
                    'start' => $year . '-01-01',
                    'end' => $year . '-12-31'
                ];
            case 'last_2_years':
                $year = date('Y') - 1;
                $startYear = $year - 1;
                return [
                    'start' => $startYear . '-01-01',
                    'end' => $year . '-12-31'
                ];
            case 'last_5_years':
                $year = date('Y');
                $startYear = $year - 4;
                return [
                    'start' => $startYear . '-01-01',
                    'end' => $year . '-12-31'
                ];
            case 'specific':
            default:
                // Use the provided date range
                return [
                    'start' => $tgl_awal,
                    'end' => $tgl_akhir
                ];
        }
    }

    /**
     * Get date range for a single period
     */
    private function getSinglePeriodRange($period, $tgl_awal, $tgl_akhir)
    {
        switch ($period) {
            case 'all':
                // Return null to indicate no date restriction
                return null;
            case '2025-01-01':
                return [
                    'start' => '2025-01-01',
                    'end' => '2025-12-31'
                ];
            case '2024-01-01':
                return [
                    'start' => '2024-01-01',
                    'end' => '2024-12-31'
                ];
            case '2023-01-01':
                return [
                    'start' => '2023-01-01',
                    'end' => '2023-12-31'
                ];
            case 'current_year':
                $year = date('Y');
                return [
                    'start' => $year . '-01-01',
                    'end' => $year . '-12-31'
                ];
            case 'last_year':
                $year = date('Y') - 1;
                return [
                    'start' => $year . '-01-01',
                    'end' => $year . '-12-31'
                ];
            case 'last_2_years':
                $year = date('Y') - 1;
                $startYear = $year - 1;
                return [
                    'start' => $startYear . '-01-01',
                    'end' => $year . '-12-31'
                ];
            case 'last_5_years':
                $year = date('Y');
                $startYear = $year - 4;
                return [
                    'start' => $startYear . '-01-01',
                    'end' => $year . '-12-31'
                ];
            case 'specific':
            default:
                // Use the provided date range
                return [
                    'start' => $tgl_awal,
                    'end' => $tgl_akhir
                ];
        }
    }
}
