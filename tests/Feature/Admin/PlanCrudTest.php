<?php

namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Plan;
use App\Models\User;

class PlanCrudTest extends TestCase
{
    use \Illuminate\Foundation\Testing\RefreshDatabase;

    public function test_admin_can_view_plans_index()
    {
        $admin = \App\Models\User::factory()->create(['role' => 'admin']);
        $plan = Plan::create([
            'name' => 'Test Plan',
            'type' => 'yoga',
            'interval_days' => 30,
            'price' => 1000,
            'color' => '#667eea',
            'is_active' => true,
        ]);

        $response = $this->actingAs($admin)->get(route('admin.plans.index'));

        $response->assertStatus(200);
        $response->assertSee('Test Plan');
    }

    public function test_admin_can_create_plan_with_discount()
    {
        $admin = \App\Models\User::factory()->create(['role' => 'admin']);
        
        $planData = [
            'name' => 'New Yoga Plan',
            'type' => 'yoga',
            'interval_days' => 30,
            'price' => 1000,
            'color' => '#667eea',
            'discount_type' => 'percentage',
            'discount_value' => 10,
            'is_active' => '1',
        ];

        $response = $this->actingAs($admin)->post(route('admin.plans.store'), $planData);

        $response->assertRedirect(route('admin.plans.index'));
        $this->assertDatabaseHas('plans', [
            'name' => 'New Yoga Plan',
            'discount_type' => 'percentage',
            'discount_value' => 10,
        ]);

        $plan = Plan::where('name', 'New Yoga Plan')->first();
        $this->assertEquals(900, $plan->discounted_price);
    }

    public function test_admin_can_update_plan()
    {
        $admin = \App\Models\User::factory()->create(['role' => 'admin']);
        $plan = Plan::create([
            'name' => 'Old Name',
            'type' => 'diet',
            'interval_days' => 60,
            'price' => 2000,
            'color' => '#48bb78',
        ]);

        $response = $this->actingAs($admin)->put(route('admin.plans.update', $plan), [
            'name' => 'Updated Name',
            'type' => 'diet',
            'interval_days' => 60,
            'price' => 2000,
            'color' => '#48bb78',
            'discount_type' => 'fixed',
            'discount_value' => 500,
            'is_active' => '1',
        ]);

        $response->assertRedirect(route('admin.plans.index'));
        $this->assertDatabaseHas('plans', [
            'id' => $plan->id,
            'name' => 'Updated Name',
            'discount_type' => 'fixed',
            'discount_value' => 500,
        ]);
    }

    public function test_admin_can_delete_plan()
    {
        $admin = \App\Models\User::factory()->create(['role' => 'admin']);
        $plan = Plan::create([
            'name' => 'To Be Deleted',
            'type' => 'combo',
            'interval_days' => 30,
            'price' => 1500,
            'color' => '#ed8936',
        ]);

        $response = $this->actingAs($admin)->delete(route('admin.plans.destroy', $plan));

        $response->assertRedirect(route('admin.plans.index'));
        $this->assertDatabaseMissing('plans', ['id' => $plan->id]);
    }

    public function test_non_admin_cannot_access_plans()
    {
        $user = \App\Models\User::factory()->create(['role' => 'user']);
        
        $response = $this->actingAs($user)->get(route('admin.plans.index'));
        $response->assertStatus(302); // Redirect back or to dashboard
    }
}
