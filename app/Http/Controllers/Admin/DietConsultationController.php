<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DietConsultation;

class DietConsultationController extends Controller
{
    public function index()
    {
        $consultations = DietConsultation::latest()->paginate(15);
        return view('admin.diet_consultations.index', compact('consultations'));
    }

    public function toggleContacted(DietConsultation $consultation)
    {
        $consultation->update(['is_contacted' => !$consultation->is_contacted]);
        return back()->with('success', 'Contacted status updated successfully.');
    }
}
