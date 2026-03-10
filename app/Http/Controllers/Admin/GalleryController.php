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
            'type' => 'required|in:image,video,youtube',
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        if ($request->type === 'youtube') {
            $request->validate([
                'youtube_link' => 'required|url'
            ]);
            $path = null;
        } else {
            $mimeTypes = $request->type === 'video' ? 'mimes:mp4,mov,ogg,qt|max:20480' : 'mimes:jpeg,png,jpg,gif,svg|max:2048';
            $request->validate([
                'image' => 'required|file|' . $mimeTypes
            ]);
            $path = $request->file('image')->move('gallery', $request->file('image')->getClientOriginalName());
        }

        Gallery::create([
            'type' => $request->type,
            'youtube_link' => $request->type === 'youtube' ? $request->youtube_link : null,
            'image' => $path,
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.gallery.index')->with('success', 'Media added successfully!');
    }

    public function destroy(Gallery $gallery)
    {
        if ($gallery->type !== 'youtube' && file_exists($gallery->image)) {
            unlink($gallery->image);
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
