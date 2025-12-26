<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DietPlan;
use App\Models\DietPlanDetail;
use App\Models\Menu;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class DietController extends Controller
{
    public function create()
    {
        $menus = Menu::all()->groupBy('type');
        return view('admin.diet.create', compact('menus'));
    }

    public function store(Request $request)
    {
        $userId = User::where('uuid', $request->uuid)->value('id');
        $dietPlan = DietPlan::create([
            'user_id'   => $userId,
        ]);
        foreach ($request->days as $index => $day) {
            // --- 1. STORE NEW MENU ITEMS ---
            $breakfast = $this->saveMenuItem($day['breakfast'], 'breakfast');
            $lunch     = $this->saveMenuItem($day['lunch'], 'lunch');
            $snacks    = $this->saveMenuItem($day['snacks'], 'snacks');
            $dinner    = $this->saveMenuItem($day['dinner'], 'dinner');

            // --- 2. SAVE DIET PLAN ---
            DietPlanDetail::create([
                'user_id'   => $userId,
                'diet_plan_id' => $dietPlan->id,
                'day_number' => $index + 1,
                'breakfast' => $breakfast,
                'lunch'     => $lunch,
                'snacks'    => $snacks,
                'dinner'    => $dinner,
            ]);
        }

        return back()->with('success', 'Diet plan saved successfully!');
    }

    /*----------------------------------------------
    | Save Menu Item If Custom Added
    -----------------------------------------------*/
    private function saveMenuItem($value, $type)
    {
        // If it is custom input
        if (!Menu::where('name', $value)->exists()) {
            if (trim($value) !== "") {
                Menu::create([
                    'name' => $value,
                    'type' => $type
                ]);
            }
        }

        return $value;
    }

    public function downloadPdf(Request $request)
    {
        $dietPlan = DietPlan::where('uuid',$request->uuid)
            ->value('id');
        $dietDetails = DietPlanDetail::where('diet_plan_id',$dietPlan)->get();

        $pdf = Pdf::loadView('pdf.diet-plan', [
            'dietPlan' => $dietPlan,
            'dietDetails' => $dietDetails,
        ])->setPaper('A4', 'landscape');

        return $pdf->download('Diet_Plan_'.$request->uuid.'.pdf');
    }

    public function viewDietPlan(Request $request)
    {
        $dietPlan = DietPlan::where('uuid',$request->uuid)
            ->value('id');
        $dietDetails = DietPlanDetail::where('diet_plan_id',$dietPlan)->get();

        return view('admin.users.diet-plan', compact('dietPlan' ,'dietDetails'));

    }
}
