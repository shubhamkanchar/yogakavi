<?php

namespace App\Http\Controllers;

use App\Models\DietLead;
use App\Models\User;
use App\Models\YogaLead;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getYoga()
    {
        return view('form.yoga');
    }

    public function dietLead(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'mobile' => 'required',
            'goal' => 'required'
        ]);

        $user = User::updateOrCreate(
            ['email' => $request->email],
            [
                'first_name' => $request->name,
                'age' => $request->age,
                'height' => $request->height,
                'weight' => $request->weight,
            ]
        );

        // STEP 2: Create Diet Lead
        DietLead::updateOrCreate(
            ['user_id' => $user->id],
            [
                'user_id' => $user->id,
                'past_surgery' => $request->past_surgery,
                'surgery_details' => $request->surgery_details,
                'thyroid' => $request->thyroid,
                'diet_pref' => $request->diet_pref,
                'routine' => $request->routine,
                'allergy' => $request->allergy,
                'allergy_details' => $request->allergy_details,
                'occupation' => $request->occupation,
                'phone' => $request->phone,
                'notes' => $request->notes,
            ]
        );

        return back()->with('success', 'Diet Lead Submitted!');
    }

    public function getDiet()
    {
        return view('form.diet');
    }

    public function yogaLead(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required'
        ]);

        // STEP 1: Create or find User
        $user = User::updateOrCreate(
            ['email' => $request->email],
            [
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'age' => $request->age,
                'height' => $request->height,
                'weight' => $request->weight,
            ]
        );

        // STEP 2: Create Yoga Lead
        YogaLead::updateOrCreate(
            ['user_id' => $user->id],
            [
                'user_id' => $user->id,
                'disease' => $request->disease,
                'surgery' => $request->surgery,
                'workout_type' => $request->workout_type,
                'reason' => $request->reason,
            ]
        );

        return back()->with('success', 'Yoga Lead Submitted!');
    }
}
