<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Plan;
use Illuminate\Support\Str;

class PlanSeeder extends Seeder
{
    public function run(): void
    {
        $plans = [
            // Yoga Plans
            [
                'name' => 'Yoga - 1 Month',
                'interval_days' => 30,
                'price' => 1000,
                'type' => 'yoga',
                'color' => '#667eea',
                'description' => '1 Month Access to Yoga Sessions',
            ],
            [
                'name' => 'Yoga - 3 Months',
                'interval_days' => 90,
                'price' => 2200,
                'type' => 'yoga',
                'color' => '#667eea',
                'description' => '3 Months Access to Yoga Sessions',
            ],
            [
                'name' => 'Yoga - 6 Months',
                'interval_days' => 180,
                'price' => 4000,
                'type' => 'yoga',
                'color' => '#667eea',
                'description' => '6 Months Access to Yoga Sessions',
            ],
            [
                'name' => 'Yoga - 1 Year',
                'interval_days' => 365,
                'price' => 8000,
                'type' => 'yoga',
                'color' => '#667eea',
                'description' => '1 Year Access to Yoga Sessions',
            ],
            
            // Diet Plans
            [
                'name' => 'Diet - 3 Months',
                'interval_days' => 90,
                'price' => 3000,
                'type' => 'diet',
                'color' => '#48bb78',
                'description' => '3 Months Personalized Diet Plan',
            ],

            // Combo Plans
            [
                'name' => 'Yoga + Diet Combo - 1 Month',
                'interval_days' => 30,
                'price' => 1500,
                'type' => 'combo',
                'color' => '#ed8936',
                'description' => '1 Month Access to both Yoga & Diet',
            ],
            [
                'name' => 'Personal Training (Weight Loss) - 1 Month',
                'interval_days' => 30,
                'price' => 3000,
                'type' => 'personal', // Categorized as Combo/Special
                'color' => '#e53e3e',
                'description' => 'Personalized Weight Loss Training',
            ],
        ];

        foreach ($plans as $plan) {
            Plan::updateOrCreate(
                ['name' => $plan['name']],
                [
                    'uuid' => Str::uuid(), // Explicitly set UUID
                    'interval_days' => $plan['interval_days'],
                    'price' => $plan['price'],
                    'type' => $plan['type'],
                    'color' => $plan['color'],
                    'description' => $plan['description'],
                    'is_active' => true,
                ]
            );
        }
    }
}
