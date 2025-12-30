<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('pages.contact');
    }

    public function store(\Illuminate\Http\Request $request)
    {
        // Rate Limiting: 1 request per minute by IP to prevent spam
        $executed = \Illuminate\Support\Facades\RateLimiter::attempt(
            'send-message:'.$request->ip(),
            $perMinute = 1,
            function() {
                // This is just a placeholder for the action effectively being allowed
            }
        );

        if (! $executed) {
            return back()->with('error', 'Too many messages. Please try again in a minute.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        try {
            // "pick mail from env" - Sending TO the admin email (using MAIL_FROM_ADDRESS as admin email)
            $adminEmail = env('MAIL_FROM_ADDRESS');
            
            if ($adminEmail) {
                \Illuminate\Support\Facades\Mail::to($adminEmail)->send(new \App\Mail\ContactInquiry($validated));
            }
            
            return back()->with('success', 'Thank you for contacting us! We will get back to you shortly.');
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Contact Form Error: ' . $e->getMessage());
            return back()->with('error', 'Unable to send message. Please try again later.');
        }
    }
}
