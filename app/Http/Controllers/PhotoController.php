<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\Surat;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
    public function photo(Surat $surat)
    {
        return view('photos.create', compact('surat'));
    }

    public function showPhoto(Surat $surat)
    {
        $photos = Photo::where('surat_id', $surat->id)->get();
        return view('photos.show', compact('surat', 'photos'));
    }

    public function index()
    {
        $photos = Photo::with('surat')->get();
        return view('photos.index', compact('photos'));
    }

    public function create()
    {
        $surats = Surat::all();
        return view('photos.create', compact('surats'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'surat_id' => 'required|exists:surats,id',
            'title' => 'nullable|string|max:255',
            'photos.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $path = $photo->store('photos', 'public');

                Photo::create([
                    'surat_id' => $validated['surat_id'],
                    'title' => $validated['title'],
                    'path' => $path,
                    'original_name' => $photo->getClientOriginalName(),
                ]);
            }

            return redirect()->route('photos.index')
                ->with('success', 'Photos uploaded successfully!');
        }
        dd($request->all());
        return back()->with('error', 'No photos were uploaded.');
    }

    public function show(Photo $photo)
    {
        return view('photos.show', compact('photo'));
    }

    public function edit(Photo $photo)
    {
        $surats = Surat::all();
        return view('photos.edit', compact('photo', 'surats'));
    }

    public function update(Request $request, Photo $photo)
    {
        $validated = $request->validate([
            'surat_id' => 'required|exists:surats,id',
            'title' => 'nullable|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = [
            'surat_id' => $validated['surat_id'],
            'title' => $validated['title'],
        ];

        if ($request->hasFile('photo')) {
            Storage::disk('public')->delete($photo->path);
            $path = $request->file('photo')->store('photos', 'public');
            $data['path'] = $path;
            $data['original_name'] = $request->file('photo')->getClientOriginalName();
        }

        $photo->update($data);

        return redirect()->route('photos.index')
            ->with('success', 'Photo updated successfully.');
    }

    public function destroy(Photo $photo)
    {
        Storage::disk('public')->delete($photo->path);
        $photo->delete();

        return redirect()->route('photos.index')
            ->with('success', 'Photo deleted successfully.');
    }
}
