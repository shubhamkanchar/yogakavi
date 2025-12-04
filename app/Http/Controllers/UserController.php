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
        return view('form.diet');
    }

    public function dietLead(Request $request)
    {
        try {
            $request->validate([
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required',
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);

            $user = User::whereEmail($request->email)->first();
            if ($user) {
                return response()->json([
                    'success' => true,
                    'msg' => 'User diet form already submitted'
                ]);
            } else {
                $user = new User();
                $user->email = $request->email;
                $user->first_name = $request->first_name;
                $user->last_name = $request->last_name;
                $user->age = $request->age;
                $user->height = $request->height;
                $user->weight = $request->weight;
                $user->subscription = 'diet';
                $user->phone = $request->phone;
                $user->password = Hash::make($request->password);
                $user->save();

                $diet = new DietLead();
                $diet->user_id = $user->id;
                $diet->past_surgery = $request->past_surgery;
                $diet->surgery_details = $request->surgery_details;
                $diet->thyroid = $request->thyroid;
                $diet->diet_pref = $request->diet_pref;
                $diet->routine = $request->routine;
                $diet->allergy = $request->allergy;
                $diet->allergy_details = $request->allergy_details;
                $diet->occupation = $request->occupation;
                $diet->phone = $request->phone;
                $diet->notes = $request->notes;
                $diet->save();

                Auth::login($user);
                return response()->json([
                    'success' => true,
                    'msg' => 'User diet form submitted successfully'
                ]);
            }
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'msg' => $e->getMessage()
            ]);
        }
    }


    public function getYoga()
    {
        return view('form.yoga');
    }

    public function yogaLead(Request $request)
    {
        try {
            $request->validate([
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required',
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);

            $user = User::whereEmail($request->email)->first();
            if ($user) {
                return response()->json([
                    'success' => true,
                    'msg' => 'User yoga form already submitted'
                ]);
            } else {
                $user = new User();
                $user->email = $request->email;
                $user->first_name = $request->first_name;
                $user->last_name = $request->last_name;
                $user->age = $request->age;
                $user->height = $request->height;
                $user->weight = $request->weight;
                $user->subscription = 'yoga';
                $user->phone = $request->phone;
                $user->password = Hash::make($request->password);
                $user->save();

                $yoga = new YogaLead();
                $yoga->user_id = $user->id;
                $yoga->disease = $request->disease;
                $yoga->surgery = $request->surgery;
                $yoga->workout_type = $request->workout_type;
                $yoga->reason = $request->reason;
                $yoga->save();

                Auth::login($user);
                return response()->json([
                    'success' => true,
                    'msg' => 'User diet form created successfully'
                ]);
            }
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'msg' => $e->getMessage()
            ]);
        }
    }
}
