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
}
