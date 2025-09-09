<?php

namespace App\Http\Controllers;

use App\Models\ShipService;
use Illuminate\Http\Request;

class ShipServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $shipServices = ShipService::all();
        return view('ship_services.index', compact('shipServices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ship_services.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'days' => 'required|integer',
            'price' => 'required|numeric',
        ]);

        ShipService::create($request->all());

        return redirect()->route('ship_services.index')->with('success', 'Ship Service created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ShipService $shipService)
    {
        return view('ship_services.show', compact('shipService'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ShipService $shipService)
    {
        return view('ship_services.edit', compact('shipService'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ShipService $shipService)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'days' => 'required|integer',
            'price' => 'required|numeric',
        ]);

        $shipService->update($request->all());

        return redirect()->route('ship_services.index')->with('success', 'Ship Service updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ShipService $shipService)
    {
        $shipService->delete();

        return redirect()->route('ship_services.index')->with('success', 'Ship Service deleted successfully.');
    }
}
