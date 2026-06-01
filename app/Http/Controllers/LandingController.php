<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        $plans = Plan::where('is_active', true)->get()->groupBy('type');
        return view('welcome', compact('plans'));
    }

    public function privacyPolicy()
    {
        return view('pages.privacy-policy');
    }

    public function termsAndConditions()
    {
        return view('pages.terms-and-conditions');
    }

    public function refundPolicy()
    {
        return view('pages.refund-policy');
    }

    public function show($filename)
    {
        // Optional: Auth check
        // if (!auth()->check()) {
        //     abort(403);
        // }

        $basePath = realpath(storage_path('app/private_image'));
        $path = $basePath ? realpath($basePath . DIRECTORY_SEPARATOR . basename($filename)) : false;

        if (! $basePath || ! $path || ! str_starts_with($path, $basePath . DIRECTORY_SEPARATOR)) {
            abort(404);
        }

        return response()->file($path);
    }
}
