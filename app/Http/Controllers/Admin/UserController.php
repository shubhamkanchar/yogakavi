<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\DietPlanDataTable;
use App\DataTables\UsersDataTable;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(UsersDataTable $dataTable)
    {
        return $dataTable->render('admin.users.index');
    }

    public function userProfile(DietPlanDataTable $dataTable,Request $request){
        $authUser = auth()->user();
        if ($authUser->role !== 'admin' && $authUser->uuid !== $request->uuid) {
            return redirect()->route('dashboard')->with('error', 'Unauthorized access.');
        }

        $user = User::where('uuid',$request->uuid)->first();
        if (!$user) {
            abort(404);
        }
        return $dataTable->render('admin.users.profile',compact('user'));
        // return view('admin.users.profile',compact('user'));
    }
}
