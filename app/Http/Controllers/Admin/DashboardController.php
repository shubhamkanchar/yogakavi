<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $user = auth()->user();

        // Enforce Form Completion checks for non-admin users
        if ($user->role !== 'admin') {
            if ($user->hasActivePlan('yoga') && !$user->hasFilledForm('yoga')) {
                return redirect()->route('form.yoga')->with('warning', 'Please complete your Yoga Profile to proceed.');
            }

            if ($user->hasActivePlan('diet') && !$user->hasFilledForm('diet')) {
                return redirect()->route('form.diet')->with('warning', 'Please complete your Diet Profile to proceed.');
            }
            
            if ($user->hasActivePlan('combo')) {
                 if (!$user->hasFilledForm('yoga')) {
                     return redirect()->route('form.yoga')->with('warning', 'Please complete your Yoga Profile first.');
                 }
                 if (!$user->hasFilledForm('diet')) {
                    return redirect()->route('form.diet')->with('warning', 'Please complete your Diet Profile as well.');
                 }
            }
            return view('admin.dashboard.index');
        }

        // Statistics
        $totalUsers = User::whereRole('user')->count();
        $totalRevenue = \App\Models\Subscription::sum('amount');
        $activeSubscriptions = \App\Models\Subscription::where('status', 'active')->count();
        
        // Plan Distribution
        $planCounts = \App\Models\Subscription::where('status', 'active')
            ->join('plans', 'subscriptions.plan_id', '=', 'plans.id')
            ->selectRaw('plans.type, count(*) as count')
            ->groupBy('plans.type')
            ->pluck('count', 'type');

        // Top 5 Users by Purchase Value
        $topSpenders = \App\Models\Subscription::selectRaw('user_id, sum(amount) as total_spent')
            ->groupBy('user_id')
            ->orderByDesc('total_spent')
            ->limit(5)
            ->with('user')
            ->get();

        // Top 5 Repeated Users
        $frequentBuyers = \App\Models\Subscription::selectRaw('user_id, count(*) as purchase_count')
            ->groupBy('user_id')
            ->orderByDesc('purchase_count')
            ->limit(5)
            ->with('user')
            ->get();

        return view('admin.dashboard.index', compact(
            'totalUsers', 
            'totalRevenue', 
            'activeSubscriptions', 
            'planCounts', 
            'topSpenders', 
            'frequentBuyers'
        ));
    }
}
