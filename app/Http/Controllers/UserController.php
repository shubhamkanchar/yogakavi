<?php

namespace App\Http\Controllers;

use App\Models\DietLead;
use App\Models\User;
use App\Models\YogaLead;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function getDiet()
    {
        if (!Auth::user()->hasActivePlan('diet')) {
            return redirect()->route('dashboard')->with('error', 'You need an active Diet Plan to access this form.');
        }
        return view('form.diet', ['user' => Auth::user()]);
    }

    public function dietLead(Request $request)
    {
        try {
            $user = Auth::user();
            if (!$user) {
                return response()->json(['success' => false, 'msg' => 'Unauthorized']);
            }

            $request->validate([
                'first_name' => 'required',
                'last_name' => 'required',
                'age' => 'required',
                'height' => 'required',
                'weight' => 'required',
                // 'phone' => 'nullable', // Phone is optional in form
            ]);

            // Update User Profile
            $user->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'age' => $request->age,
                'height' => $request->height,
                'weight' => $request->weight,
                'phone' => $request->phone,
            ]);

            // Create or Update Diet Lead
            // Using updateOrCreate to prevent duplicates if they resubmit
            DietLead::updateOrCreate(
                ['user_id' => $user->id],
                [
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

            return response()->json([
                'success' => true,
                'msg' => 'Diet details updated successfully!'
            ]);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'msg' => $e->getMessage()
            ]);
        }
    }


    public function getYoga()
    {
        if (!Auth::user()->hasActivePlan('yoga')) {
            return redirect()->route('dashboard')->with('error', 'You need an active Yoga Plan to access this form.');
        }
        return view('form.yoga', ['user' => Auth::user()]);
    }

    public function yogaLead(Request $request)
    {
        try {
            $user = Auth::user();
            if (!$user) {
                return response()->json(['success' => false, 'msg' => 'Unauthorized']);
            }

            $request->validate([
                'first_name' => 'required',
                'last_name' => 'required',
                'age' => 'required',
                'height' => 'required',
                'weight' => 'required',
            ]);

            // Update User Profile
            $user->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'age' => $request->age,
                'height' => $request->height,
                'weight' => $request->weight,
                'phone' => $request->phone,
            ]);

            // Create or Update Yoga Lead
            YogaLead::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'disease' => $request->disease,
                    'surgery' => $request->surgery,
                    'workout_type' => $request->workout_type,
                    'reason' => $request->reason,
                ]
            );

            return response()->json([
                'success' => true,
                'msg' => 'Yoga details updated successfully!'
            ]);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'msg' => $e->getMessage()
            ]);
        }
    }
}
