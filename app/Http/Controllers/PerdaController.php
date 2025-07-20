<?php

namespace App\Http\Controllers;

use App\Models\Perda;
use Illuminate\Http\Request;
use App\Http\Requests\PerdaRequest;

class PerdaController extends Controller
{
    public function viewIndex()
    {
        $perdas = Perda::paginate(10);
        return view('perda.index', compact('perdas'));
    }

    public function viewCreate()
    {
        return view('perda.create');
    }

    public function store(PerdaRequest $request)
    {
        $validatedData = $request->validated();
        Perda::create($validatedData);
        return redirect()->route('perda.index')->with('success', 'Perda created successfully.');
    }

    public function viewShowWeb($id)
    {
        $perda = Perda::findOrFail($id);
        return view('perda.show', compact('perda'));
    }

    public function viewEdit($id)
    {
        $perda = Perda::findOrFail($id);
        return view('perda.edit', compact('perda'));
    }

    public function updateWeb(PerdaRequest $request, $id)
    {
        $perda = Perda::findOrFail($id);
        $validatedData = $request->validated();
        $perda->update($validatedData);
        return redirect()->route('perda.show', $perda->id)->with('success', 'Perda updated successfully.');
    }

    public function destroy($id)
    {
        $perda = Perda::findOrFail($id);
        $perda->delete();
        return redirect()->route('perda.index')->with('success', 'Perda deleted successfully.');
    }
}
