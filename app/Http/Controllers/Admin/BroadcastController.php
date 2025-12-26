<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class BroadcastController extends Controller
{
    public function create()
    {
        return view('admin.broadcast.create');
    }

    public function preview(Request $request)
    {
        $request->validate([
            'meet_link' => 'required|url',
            'message' => 'required|string',
        ]);

        // Logic: active 'yoga' OR 'combo'
        // Using get() to fetch all matching users
        $users = User::whereHas('subscriptions', function ($query) {
            $query->where('status', 'active')
                  ->whereHas('plan', function ($q) {
                      $q->whereIn('type', ['yoga', 'combo']);
                  });
        })
        ->whereNotNull('phone') // Ensure phone exists
        ->get(['id', 'first_name', 'last_name', 'phone', 'email']); 
        
        // Filter out users without valid phone if necessary, though validation on input is better.
        // Assuming phone is stored as 10 digit, might need +91 prefix for wa.me if not present.
        
        $meetLink = $request->meet_link;
        $message = $request->message;
        
        // Prepare data for JS
        $broadcastData = $users->map(function($user) use ($meetLink, $message) {
            $fullMessage = "Hi " . $user->first_name . ",\n\n" . $message . "\n\nJoin Class: " . $meetLink;
            
            // Basic phone formatting for India if missing
            $phone = $user->phone;
            if (strlen($phone) == 10) {
                $phone = '91' . $phone;
            }
            
            return [
                'name' => $user->full_name,
                'phone' => $phone,
                'message' => $fullMessage
            ];
        });

        return view('admin.broadcast.preview', compact('broadcastData', 'users', 'meetLink', 'message'));
    }

    public function sendEmails(Request $request)
    {
        $request->validate([
            'meet_link' => 'required|url',
            'message' => 'required|string',
        ]);

        $users = User::whereHas('subscriptions', function ($query) {
            $query->where('status', 'active')
                  ->whereHas('plan', function ($q) {
                      $q->whereIn('type', ['yoga', 'combo']);
                  });
        })->whereNotNull('email')->get();

        $count = 0;
        foreach ($users as $user) {
            try {
                \Illuminate\Support\Facades\Mail::to($user->email)
                    ->send(new \App\Mail\ClassLinkBroadcast($request->message, $request->meet_link));
                $count++;
            } catch (\Exception $e) {
                // log error, continue
            }
        }

        return redirect()->route('admin.broadcast.create')
            ->with('success', "Emails sent successfully to $count users.");
    }
}
