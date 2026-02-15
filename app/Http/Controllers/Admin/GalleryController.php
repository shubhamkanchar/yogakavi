<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index()
    {
        $images = Gallery::latest()->get();
        return view('admin.gallery.index', compact('images'));
    }

    public function create()
    {
        return view('admin.gallery.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        $path = $request->file('image')->store('gallery', 'public');

        Gallery::create([
            'image' => $path,
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.gallery.index')->with('success', 'Image uploaded successfully!');
    }

    public function destroy(Gallery $gallery)
    {
        if (Storage::disk('public')->exists($gallery->image)) {
            Storage::disk('public')->delete($gallery->image);
        }
        $gallery->delete();

        return back()->with('success', 'Image deleted successfully!');
    }

    public function toggleStatus(Gallery $gallery)
    {
        $gallery->update(['is_active' => !$gallery->is_active]);
        return back()->with('success', 'Status updated!');
    }
}
