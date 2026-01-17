<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\DataTables\SubscriptionDataTable;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SubscriptionDataTable $dataTable)
    {
        return $dataTable->render('admin.subscriptions.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $subscription = \App\Models\Subscription::with(['user', 'plan'])->findOrFail($id);
        return view('admin.subscriptions.edit', compact('subscription'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $subscription = \App\Models\Subscription::findOrFail($id);
        
        $request->validate([
            'status' => 'required|in:active,trial,pending_payment,expired,cancelled',
            'expiry_date' => 'nullable|date',
        ]);

        $subscription->update([
            'status' => $request->status,
            'expiry_date' => $request->expiry_date,
        ]);

        return redirect()->route('admin.subscriptions.index')->with('success', 'Subscription updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
