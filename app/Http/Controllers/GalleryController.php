<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        $images = Gallery::where('is_active', true)->latest()->get();
        return view('gallery.index', compact('images'));
    }
}
