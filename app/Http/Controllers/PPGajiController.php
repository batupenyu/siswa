<?php

namespace App\Http\Controllers;

use App\Models\PP_Gaji;
use Illuminate\Http\Request;

class PPGajiController extends Controller
{
    public function index()
    {
        $ppGajis = PP_Gaji::all();
        return view('pp_gaji.index', compact('ppGajis'));
    }

    public function create()
    {
        return view('pp_gaji.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required|string|max:255',
        ]);

        PP_Gaji::create($request->only('description'));

        return redirect()->route('pp_gaji.index')->with('success', 'PP Gaji created successfully.');
    }

    public function show(PP_Gaji $pp_gaji)
    {
        return view('pp_gaji.show', compact('pp_gaji'));
    }

    public function edit(PP_Gaji $pp_gaji)
    {
        return view('pp_gaji.edit', compact('pp_gaji'));
    }

    public function update(Request $request, PP_Gaji $pp_gaji)
    {
        $request->validate([
            'description' => 'required|string|max:255',
        ]);

        $pp_gaji->update($request->only('description'));

        return redirect()->route('pp_gaji.index')->with('success', 'PP Gaji updated successfully.');
    }

    public function destroy(PP_Gaji $pp_gaji)
    {
        $pp_gaji->delete();

        return redirect()->route('pp_gaji.index')->with('success', 'PP Gaji deleted successfully.');
    }
}
