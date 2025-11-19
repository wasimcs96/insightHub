<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MasterGeneralSetting;
use Illuminate\Support\Facades\Storage;



class GeneralSettingController extends Controller
{
    public function index()
    {
        $logo = MasterGeneralSetting::where('name', 'logo')->first();
        $favicon = MasterGeneralSetting::where('name', 'favicon')->first();
        $year = MasterGeneralSetting::where('name', 'year')->first();
        $version = MasterGeneralSetting::where('name', 'version')->first();
    
        return view('admin.GeneralSetting.index', compact('logo', 'favicon','year','version'));
    }

    

    public function create()
    {
        return view('admin.GeneralSetting.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        // Store the image
        $imagePath = $request->file('image')->store('uploads/images', 'public');
    
        // Store the image path in the `value` column
        \App\Models\MasterGeneralSetting::create([
            'name' => $request->name,
            'value' => $imagePath,
        ]);
    
        return redirect()->route('general_setting.index')->with('success', 'Image uploaded successfully!');
    }
    



    public function updateMultiple(Request $request)
    {
        // Update Logo
        if ($request->hasFile('logo_image')) {
            $logo = MasterGeneralSetting::where('name', 'logo')->first();
            $logoPath = $request->file('logo_image')->store('uploads/images', 'public');
            $logo->value = $logoPath;
            $logo->save();
        }
    
        // Update Favicon
        if ($request->hasFile('favicon_image')) {
            $favicon = MasterGeneralSetting::where('name', 'favicon')->first();
            $faviconPath = $request->file('favicon_image')->store('uploads/images', 'public');
            $favicon->value = $faviconPath;
            $favicon->save();
        }
    
        // Update Year
        if ($request->filled('year')) {
            $year = MasterGeneralSetting::where('name', 'year')->first();
            if (!$year) {
                $year = new MasterGeneralSetting();
                $year->name = 'year';
            }
            $year->value = $request->input('year');
            $year->save();
        }
    
        // Update Version
        if ($request->filled('version')) {
            $version = MasterGeneralSetting::where('name', 'version')->first();
            if (!$version) {
                $version = new MasterGeneralSetting();
                $version->name = 'version';
            }
            $version->value = $request->input('version');
            $version->save();
        }
    
        return redirect()->back()->with('success', 'General settings updated successfully!');
    }
    
    

public function destroy($id)
{
    $mastergenral = MasterGeneralSetting::findOrFail($id);
    $mastergenral->delete();
    return redirect()->route('general_setting.index')->with('success', 'setting deleted successfully.');

}

}
