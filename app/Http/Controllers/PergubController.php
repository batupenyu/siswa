<?php

namespace App\Http\Controllers;

use App\Models\Pergub;
use Illuminate\Http\Request;

class PergubController extends Controller
{
    public function viewIndex(Request $request)
    {
        $query = $request->input('search');
        $pergubList = Pergub::when($query, function ($q) use ($query) {
            return $q->where('description', 'like', '%' . $query . '%');
        })->paginate(5)->appends(['search' => $query]);
        return view('pergub.index', compact('pergubList'));
    }

    public function viewCreate()
    {
        return view('pergub.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'description' => 'required|string',
        ]);

        Pergub::create($validated);
        return redirect()->route('pergub.index')->with('success', 'Data Pergub berhasil ditambahkan.');
    }

    public function viewShowWeb($id)
    {
        $pergub = Pergub::findOrFail($id);
        return view('pergub.show', compact('pergub'));
    }

    public function viewEdit($id)
    {
        $pergub = Pergub::findOrFail($id);
        return view('pergub.edit', compact('pergub'));
    }

    public function updateWeb(Request $request, $id)
    {
        $pergub = Pergub::findOrFail($id);

        $validated = $request->validate([
            'description' => 'required|string',
        ]);

        $pergub->update($validated);

        return redirect()->route('pergub.index')->with('success', 'Data Pergub berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pergub = Pergub::findOrFail($id);
        $pergub->delete();

        return redirect()->route('pergub.index')->with('success', 'Data Pergub berhasil dihapus.');
    }
}
