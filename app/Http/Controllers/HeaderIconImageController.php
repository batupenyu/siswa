<?php

namespace App\Http\Controllers;

use App\Models\HeaderIconImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HeaderIconImageController extends Controller
{
    public function index()
    {
        $images = HeaderIconImage::all();
        return view('header_icon_images.index', compact('images'));
    }

    public function create()
    {
        return view('header_icon_images.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('public/header_icons', $filename);

            HeaderIconImage::create([
                'filename' => $filename,
                'path' => $path,
            ]);
        }

        return redirect()->route('header_icon_images.index')->with('success', 'Image uploaded successfully.');
    }

    public function edit($id)
    {
        $image = HeaderIconImage::findOrFail($id);
        return view('header_icon_images.edit', compact('image'));
    }

    public function update(Request $request, $id)
    {
        $image = HeaderIconImage::findOrFail($id);

        $request->validate([
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image
            if (Storage::exists($image->path)) {
                Storage::delete($image->path);
            }

            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('public/header_icons', $filename);

            $image->update([
                'filename' => $filename,
                'path' => $path,
            ]);
        }

        return redirect()->route('header_icon_images.index')->with('success', 'Image updated successfully.');
    }

    public function destroy($id)
    {
        $image = HeaderIconImage::findOrFail($id);

        if (Storage::exists($image->path)) {
            Storage::delete($image->path);
        }

        $image->delete();

        return redirect()->route('header_icon_images.index')->with('success', 'Image deleted successfully.');
    }
}
