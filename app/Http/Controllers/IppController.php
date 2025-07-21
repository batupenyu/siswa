<?php

namespace App\Http\Controllers;

use App\Models\Bend;
use App\Models\Ipp;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class IppController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ipps = Ipp::with('siswa')->paginate(10);
        return view('ipp.index', compact('ipps'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $siswas = Siswa::all();
        $bulanOptions = [
            'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        ];
        return view('ipp.create', compact('siswas', 'bulanOptions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required|exists:siswas,id',
            'bulan' => 'required|array',
            'bulan.*' => 'string',
            'nominal' => 'required|numeric',
            'tgl_ditetapkan' => 'nullable|date',
            'tempat_ditetapkan' => 'nullable|string|max:255',
        ]);

        $bulanString = implode(',', $request->bulan);

        Ipp::create([
            'siswa_id' => $request->siswa_id,
            'bulan' => $bulanString,
            'nominal' => $request->nominal,
            'tgl_ditetapkan' => $request->tgl_ditetapkan,
            'tempat_ditetapkan' => $request->tempat_ditetapkan,
        ]);

        return redirect()->route('ipps.index')->with('success', 'IPP created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ipp $ipp)
    {
        return view('ipp.show', compact('ipp'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ipp $ipp)
    {
        $siswas = Siswa::all();
        $bulanOptions = [
            'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        ];
        return view('ipp.edit', compact('ipp', 'siswas', 'bulanOptions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ipp $ipp)
    {
        $request->validate([
            'siswa_id' => 'required|exists:siswas,id',
            'bulan' => 'required|array',
            'bulan.*' => 'string',
            'nominal' => 'required|numeric',
            'tgl_ditetapkan' => 'nullable|date',
            'tempat_ditetapkan' => 'nullable|string|max:255',
        ]);

        $bulanString = implode(',', $request->bulan);

        $ipp->update([
            'siswa_id' => $request->siswa_id,
            'bulan' => $bulanString,
            'nominal' => $request->nominal,
            'tgl_ditetapkan' => $request->tgl_ditetapkan,
            'tempat_ditetapkan' => $request->tempat_ditetapkan,
        ]);

        return redirect()->route('ipps.index')->with('success', 'IPP updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ipp $ipp)
    {
        $ipp->delete();

        return redirect()->route('ipps.index')->with('success', 'IPP deleted successfully.');
    }


    /**
     * Display the kwitansi (receipt) for the specified IPP.
     */
    public function kwitansi($id)
    {
        $ipp = Ipp::with('siswa')->findOrFail($id);

        $bends = Bend::with('pegawai')->where('bendahara', 'ipp')->get();

        // Prepare payments array based on months and nominal
        $bulanArray = explode(',', $ipp->bulan);
        $payments = [];
        $amountPerMonth = $ipp->nominal / count($bulanArray);
        foreach ($bulanArray as $bulan) {
            $payments[] = [
                'description' => "Biaya Penyelenggaraan Pendidikan - " . strtoupper(substr($bulan, 0, 3)),
                'amount' => $amountPerMonth,
            ];
        }
        // Add Daftar Ulang as last payment with remaining amount if any
        $totalPayments = $amountPerMonth * count($bulanArray);
        $daftarUlangAmount = $ipp->nominal - $totalPayments;
        if ($daftarUlangAmount > 0) {
            $payments[] = [
                'description' => 'Daftar Ulang',
                'amount' => $daftarUlangAmount,
            ];
        }

        // Use NumberHelper to convert nominal to terbilang
        $terbilang = \App\Helpers\NumberHelper::terbilang($ipp->nominal);

        $kwitansiData = [
            'no_trans' => $ipp->id, // or use a specific transaction number if available
            'tanggal' => $ipp->created_at->format('d/m/Y'),
            'jam_cetak' => now()->format('H:i:s'),
            'nis' => $ipp->siswa->nis ?? '',
            'nama_siswa' => $ipp->siswa->name ?? '',
            'kelas' => $ipp->siswa->kelas->name ?? '',
            'payments' => $payments,
            'bends' => $bends,
            'grand_total' => $ipp->nominal,
            'terbilang' => ucfirst($terbilang) . ' Rupiah',
            'tanggal_terbilang' => $ipp->created_at->format('d F Y'),
            'tgl_ditetapkan' => $ipp->tgl_ditetapkan,
            'tempat_ditetapkan' => $ipp->tempat_ditetapkan,
        ];

        $pdf = Pdf::loadView('ipp.kwitansi', ['kwitansi' => (object) $kwitansiData]);
        return $pdf->stream('kwitansi.pdf');
    }
}
