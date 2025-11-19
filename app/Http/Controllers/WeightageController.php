<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class WeightageController extends Controller
{
    function storeWeightage(Request $request)
    {
        $setting = Setting::where('user_id', auth()->user()->id)->first();

        if ($request->has('talent_profile')) {
            $setting->talent_profile = $request->talent_profile;
        }

        if ($request->has('employee_profile')) {
            $setting->employee_profile = $request->employee_profile;
        }

        if ($request->has('soft_skill')) {
            $setting->soft_skill = $request->soft_skill;
        }

        if ($request->has('pool_one')) {
            $setting->pool_one = $request->pool_one;
        }

        if ($request->has('pool_two')) {
            $setting->pool_two = $request->pool_two;
        }

        if ($request->has('pool_three')) {
            $setting->pool_three = $request->pool_three;
        }

        $setting->save();

        return redirect()->back()->with('success', 'Data updated successfully.');
    }

    function weightage()
    {
        $setting = Setting::where('user_id', auth()->user()->id)->first();
        return view('admin.setting.weightage', compact('setting'));
    }

    function matching()
    {
        $setting = Setting::where('user_id', auth()->user()->id)->first();
        return view('admin.setting.matching', compact('setting'));
    }
}
