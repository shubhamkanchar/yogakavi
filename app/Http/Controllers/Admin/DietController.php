<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DietPlan;
use App\Models\DietPlanDetail;
use App\Models\DietPlanExchange;
use App\Models\Menu;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class DietController extends Controller
{
    // Standard exchange groups with their 1-exchange nutritional values
    private static function defaultExchangeGroups(): array
    {
        return [
            ['name' => 'Milk (whole)',        'std_amount' => 250, 'std_energy' => 180, 'std_protein' => 8,  'std_carbs' => 12,  'std_fat' => 11],
            ['name' => 'Milk (skimmed)',      'std_amount' => 320, 'std_energy' => 94,  'std_protein' => 8,  'std_carbs' => 15,  'std_fat' => 0],
            ['name' => 'Meat 1 (Whole Egg)', 'std_amount' => 55,  'std_energy' => 75,  'std_protein' => 7,  'std_carbs' => 0,   'std_fat' => 5],
            ['name' => 'Meat 2 (Egg white)', 'std_amount' => 30,  'std_energy' => 25,  'std_protein' => 5,  'std_carbs' => 0,   'std_fat' => 0],
            ['name' => 'Pulses and legumes', 'std_amount' => 30,  'std_energy' => 100, 'std_protein' => 7,  'std_carbs' => 17,  'std_fat' => 0],
            ['name' => 'Green leafy Vegetable','std_amount'=> 100,'std_energy' => 30,  'std_protein' => 3,  'std_carbs' => 2.5, 'std_fat' => 0],
            ['name' => 'Other Vegetable',    'std_amount' => 150, 'std_energy' => 30,  'std_protein' => 2,  'std_carbs' => 3.5, 'std_fat' => 0],
            ['name' => 'Roots and Tubers',   'std_amount' => 150, 'std_energy' => 50,  'std_protein' => 1.5,'std_carbs' => 10,  'std_fat' => 0],
            ['name' => 'Fruits',             'std_amount' => 100, 'std_energy' => 45,  'std_protein' => 1,  'std_carbs' => 10,  'std_fat' => 0],
            ['name' => 'Cereals/Starch',     'std_amount' => 20,  'std_energy' => 75,  'std_protein' => 2,  'std_carbs' => 15,  'std_fat' => 0.5],
            ['name' => 'Fats - Oil seed',    'std_amount' => 12,  'std_energy' => 45,  'std_protein' => 2,  'std_carbs' => 0,   'std_fat' => 5],
            ['name' => 'Fats',               'std_amount' => 5,   'std_energy' => 45,  'std_protein' => 0,  'std_carbs' => 0,   'std_fat' => 5],
            ['name' => 'Sugar',              'std_amount' => 6,   'std_energy' => 20,  'std_protein' => 0,  'std_carbs' => 5,   'std_fat' => 0],
        ];
    }

    public function create(Request $request, $uuid = null)
    {
        $uuid = $uuid ?? $request->uuid;
        $menus = Menu::all()->groupBy('type');
        $exchangeGroups = self::defaultExchangeGroups();
        foreach ($exchangeGroups as &$group) {
            $group['exchange_no'] = 0;
        }
        unset($group);
        return view('admin.diet.create', compact('menus', 'exchangeGroups', 'uuid'));
    }

    public function store(Request $request)
    {
        $userId = User::where('uuid', $request->uuid)->value('id');
        $daysCount = count($request->days);
        $dietPlan = DietPlan::create([
            'user_id'   => $userId,
            'end_date'  => now()->addDays($daysCount),
        ]);
        foreach ($request->days as $index => $day) {
            $breakfast = $this->saveMenuItem($day['breakfast'] ?? '', 'breakfast');
            $lunch     = $this->saveMenuItem($day['lunch'] ?? '', 'lunch');
            $snacks    = $this->saveMenuItem($day['snacks'] ?? '', 'snacks');
            $dinner    = $this->saveMenuItem($day['dinner'] ?? '', 'dinner');

            DietPlanDetail::create([
                'user_id'      => $userId,
                'diet_plan_id' => $dietPlan->id,
                'day_number'   => $index + 1,
                'breakfast'    => $breakfast,
                'breakfast_weight' => $day['breakfast_weight'] ?? null,
                'lunch'        => $lunch,
                'lunch_weight' => $day['lunch_weight'] ?? null,
                'snacks'       => $snacks,
                'snacks_weight'=> $day['snacks_weight'] ?? null,
                'dinner'       => $dinner,
                'dinner_weight'=> $day['dinner_weight'] ?? null,
            ]);
        }

        // --- 3. SAVE EXCHANGE GROUPS ---
        if ($request->has('exchanges')) {
            foreach ($request->exchanges as $ex) {
                if (!isset($ex['name']) || trim($ex['name']) === '') continue;
                DietPlanExchange::create([
                    'diet_plan_id' => $dietPlan->id,
                    'name'         => $ex['name'],
                    'exchange_no'  => $ex['exchange_no'] ?? 0,
                    'std_amount'   => $ex['std_amount'] ?? 0,
                    'std_energy'   => $ex['std_energy'] ?? 0,
                    'std_protein'  => $ex['std_protein'] ?? 0,
                    'std_carbs'    => $ex['std_carbs'] ?? 0,
                    'std_fat'      => $ex['std_fat'] ?? 0,
                ]);
            }
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
        $data = $this->getDietPlanData($request->uuid);

        $pdf = Pdf::loadView('pdf.diet-plan', $data)->setPaper('A4', 'landscape');

        return $pdf->download('Diet_Plan_'.$request->uuid.'.pdf');
    }

    public function viewDietPlan(Request $request)
    {
        $data = $this->getDietPlanData($request->uuid);

        return view('admin.users.diet-plan', $data);
    }

    private function getDietPlanData($uuid)
    {
        $dietPlan = DietPlan::with(['user.dietLead', 'exchanges'])->where('uuid', $uuid)->firstOrFail();
        $dietDetails = DietPlanDetail::where('diet_plan_id', $dietPlan->id)->get();
        $user = $dietPlan->user;

        // Parse height and weight
        $heightCm = $this->parseHeightToCm($user->height);
        $weightKg = $this->parseWeightToKg($user->weight);
        $age = $user->age ? (int) $user->age : null;

        // Calculations
        $bmi = null;
        $bmr = null;
        $ibw = null;
        $tdee = null;

        if ($heightCm && $weightKg) {
            // BMI
            $bmi = round($weightKg / (($heightCm / 100) ** 2), 1);

            // BMR
            $gender = strtolower($user->gender ?? '');
            if ($gender === 'male' || $gender === 'm' || str_contains(strtolower($user->fullName), 'mr.')) {
                $bmr = round((10 * $weightKg) + (6.25 * $heightCm) - (5 * $age) + 5);
            } elseif ($gender === 'female' || $gender === 'f' || str_contains(strtolower($user->fullName), 'mrs.') || str_contains(strtolower($user->fullName), 'ms.')) {
                $bmr = round((10 * $weightKg) + (6.25 * $heightCm) - (5 * $age) - 161);
            } else {
                // Gender average
                $bmr = round((10 * $weightKg) + (6.25 * $heightCm) - (5 * $age) - 78);
            }

            // IBW
            $heightInches = $heightCm / 2.54;
            $inchesOver5Feet = max(0, $heightInches - 60);
            if ($gender === 'male' || $gender === 'm' || str_contains(strtolower($user->fullName), 'mr.')) {
                $ibw = round(50.0 + (2.3 * $inchesOver5Feet), 1);
            } elseif ($gender === 'female' || $gender === 'f' || str_contains(strtolower($user->fullName), 'mrs.') || str_contains(strtolower($user->fullName), 'ms.')) {
                $ibw = round(45.5 + (2.3 * $inchesOver5Feet), 1);
            } else {
                $ibw = round(22 * (($heightCm / 100) ** 2), 1);
            }

            // TDEE
            $activityFactor = 1.2; // Default to Sedentary
            $activityLevel = strtolower($user->activity_level ?? '');
            if ($activityLevel === 'lightly_active') {
                $activityFactor = 1.375;
            } elseif ($activityLevel === 'moderately_active') {
                $activityFactor = 1.55;
            } elseif ($activityLevel === 'very_active') {
                $activityFactor = 1.725;
            } elseif ($activityLevel === 'extra_active') {
                $activityFactor = 1.9;
            }
            $tdee = round($bmr * $activityFactor);
        }

        // Format Profile Details
        $profile = [];
        if ($user->fullName) {
            $profile['Name'] = $user->fullName;
        }
        if ($age) {
            $profile['Age'] = $age . ' years';
        }
        if ($user->gender) {
            $profile['Gender'] = ucfirst($user->gender);
        }
        if ($user->dietLead && $user->dietLead->occupation) {
            $profile['Occupation'] = ucfirst($user->dietLead->occupation);
        }
        if ($user->residence) {
            $profile['Residence'] = $user->residence;
        }
        if ($user->family_type) {
            $profile['Family Type'] = $user->family_type;
        }
        if ($heightCm) {
            $feet = floor(($heightCm / 2.54) / 12);
            $inches = round(($heightCm / 2.54) - ($feet * 12));
            $profile['Height'] = "{$feet}'{$inches}\" ({$heightCm} cm)";
        }
        if ($weightKg) {
            $profile['Weight'] = "{$weightKg} kg";
        }
        if ($user->activity_level) {
            $profile['Activity Level'] = str_replace('_', ' ', ucfirst($user->activity_level));
        }
        if ($user->dietLead && $user->dietLead->diet_pref) {
            $profile['Food Habits'] = ucfirst($user->dietLead->diet_pref);
        }

        // Present Complaints
        $complaints = [];
        if ($user->dietLead) {
            if ($user->dietLead->thyroid === 'yes') {
                $complaints[] = "Thyroid";
            }
            if ($user->dietLead->past_surgery === 'yes' && $user->dietLead->surgery_details) {
                $complaints[] = "Past Surgery (" . $user->dietLead->surgery_details . ")";
            }
            if ($user->dietLead->allergy === 'yes' && $user->dietLead->allergy_details) {
                $complaints[] = "Allergy (" . $user->dietLead->allergy_details . ")";
            }
            if ($user->dietLead->notes) {
                $complaints[] = $user->dietLead->notes;
            }
        }
        if (!empty($complaints)) {
            $profile['Present Complaints'] = implode(', ', $complaints);
        }

        // Build exchange group rows with computed totals
        $exchanges = [];
        $totals = ['amount' => 0, 'energy' => 0, 'protein' => 0, 'carbs' => 0, 'fat' => 0];
        foreach ($dietPlan->exchanges as $ex) {
            $amount  = round($ex->exchange_no * $ex->std_amount, 1);
            $energy  = round($ex->exchange_no * $ex->std_energy, 1);
            $protein = round($ex->exchange_no * $ex->std_protein, 1);
            $carbs   = round($ex->exchange_no * $ex->std_carbs, 1);
            $fat     = round($ex->exchange_no * $ex->std_fat, 1);
            $exchanges[] = [
                'name'        => $ex->name,
                'exchange_no' => $ex->exchange_no,
                'std_amount'  => $ex->std_amount,
                'std_energy'  => $ex->std_energy,
                'std_protein' => $ex->std_protein,
                'std_carbs'   => $ex->std_carbs,
                'std_fat'     => $ex->std_fat,
                'amount'      => $amount,
                'energy'      => $energy,
                'protein'     => $protein,
                'carbs'       => $carbs,
                'fat'         => $fat,
            ];
            $totals['amount']  += $amount;
            $totals['energy']  += $energy;
            $totals['protein'] += $protein;
            $totals['carbs']   += $carbs;
            $totals['fat']     += $fat;
        }
        $totals = array_map(fn($v) => round($v, 1), $totals);

        return [
            'dietPlan'    => $dietPlan,
            'dietDetails' => $dietDetails,
            'profile'     => $profile,
            'exchanges'   => $exchanges,
            'totals'      => $totals,
            'metrics'     => [
                'BMI'  => $bmi  ? $bmi  . ' kg/m2'     : null,
                'BMR'  => $bmr  ? $bmr  . ' kcal/day'  : null,
                'IBW'  => $ibw  ? $ibw  . ' kg'         : null,
                'TDEE' => $tdee ? $tdee . ' kcal/day'  : null,
            ]
        ];
    }

    private function parseHeightToCm($heightStr)
    {
        $heightStr = trim($heightStr ?? '');
        if (empty($heightStr)) {
            return null;
        }
        if (is_numeric($heightStr)) {
            return (float) $heightStr;
        }
        if (preg_match('/^(\d+)\s*\'\s*(\d+)?\s*\"?$/', $heightStr, $matches)) {
            $feet = (int) $matches[1];
            $inches = isset($matches[2]) ? (int) $matches[2] : 0;
            return ($feet * 12 + $inches) * 2.54;
        }
        if (preg_match('/^(\d+(\.\d+)?)\s*cm$/i', $heightStr, $matches)) {
            return (float) $matches[1];
        }
        if (preg_match('/^(\d+(\.\d+)?)/', $heightStr, $matches)) {
            return (float) $matches[1];
        }
        return null;
    }

    private function parseWeightToKg($weightStr)
    {
        $weightStr = trim($weightStr ?? '');
        if (empty($weightStr)) {
            return null;
        }
        if (is_numeric($weightStr)) {
            return (float) $weightStr;
        }
        if (preg_match('/^(\d+(\.\d+)?)\s*kg$/i', $weightStr, $matches)) {
            return (float) $matches[1];
        }
        if (preg_match('/^(\d+(\.\d+)?)/', $weightStr, $matches)) {
            return (float) $matches[1];
        }
        return null;
    }
}
