<?php

namespace App\Http\Controllers;

use App\Models\Ipp;
use App\Models\Siswa;
use Illuminate\Http\Request;

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
        ]);

        $bulanString = implode(',', $request->bulan);

        Ipp::create([
            'siswa_id' => $request->siswa_id,
            'bulan' => $bulanString,
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
        ]);

        $bulanString = implode(',', $request->bulan);

        $ipp->update([
            'siswa_id' => $request->siswa_id,
            'bulan' => $bulanString,
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
}
