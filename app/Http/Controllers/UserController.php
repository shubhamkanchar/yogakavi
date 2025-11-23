<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function dietLead(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'mobile'=>'required',
            'goal'=>'required'
        ]);

        // Save to DB
        \DB::table('diet_leads')->insert([
            'name'=>$request->name,
            'mobile'=>$request->mobile,
            'goal'=>$request->goal,
            'created_at'=>now()
        ]);

        return back()->with('success','Thank you! We will contact you soon.');
    }

    public function yogaLead(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'mobile'=>'required',
            'batch_time'=>'required'
        ]);

        \DB::table('yoga_leads')->insert([
            'name'=>$request->name,
            'mobile'=>$request->mobile,
            'batch_time'=>$request->batch_time,
            'created_at'=>now()
        ]);

        return back()->with('success','Thank you! We will contact you soon.');
    }

}
