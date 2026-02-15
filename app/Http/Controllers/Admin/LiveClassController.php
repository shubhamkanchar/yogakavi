<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LiveClass;
use Illuminate\Http\Request;

class LiveClassController extends Controller
{
    protected $slots = [
        "9 AM to 10 AM",
        "7 PM to 8 PM",
        "5.15 AM to 6.15 AM",
        "6.15 AM to 7.15 AM",
        "7.30 AM to 8.30 AM"
    ];

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $liveClasses = LiveClass::latest()->paginate(10);
        return view('admin.live_classes.index', compact('liveClasses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $slots = $this->slots;
        return view('admin.live_classes.create', compact('slots'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'time_slot' => 'required|string|in:' . implode(',', $this->slots),
            'meeting_link' => 'required|url',
            'is_active' => 'nullable|boolean',
        ]);

        $data = $request->except('expertise_level');
        $data['is_active'] = $request->has('is_active');

        LiveClass::create($data);

        return redirect()->route('admin.live_classes.index')->with('success', 'Live class created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LiveClass $liveClass)
    {
        $slots = $this->slots;
        return view('admin.live_classes.edit', compact('liveClass', 'slots'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LiveClass $liveClass)
    {
        $request->validate([
            'time_slot' => 'required|string|in:' . implode(',', $this->slots),
            'meeting_link' => 'required|url',
            'is_active' => 'nullable|boolean',
        ]);

        $data = $request->except('expertise_level');
        $data['is_active'] = $request->has('is_active');

        $liveClass->update($data);

        return redirect()->route('admin.live_classes.index')->with('success', 'Live class updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LiveClass $liveClass)
    {
        $liveClass->delete();
        return redirect()->route('admin.live_classes.index')->with('success', 'Live class deleted successfully.');
    }
}
