<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MetaSetting;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class MetaSettingsController extends Controller
{
    public function index()
    {
        $currentYear = now()->year;
        $dbSettings = MetaSetting::where('year', $currentYear)->get()->keyBy('setting_name')->toArray();
    
        $predefinedSettings = [
            'Mid Year Approval', 
            'End Year Approval', 
            'Planning Approval', 
            'Mid Year KPI', 
            'End Year KPI', 
            'Planning KPI'
        ];
    
        $settings = [];
        foreach ($predefinedSettings as $settingName) {
            $settings[] = $dbSettings[$settingName] ?? [
                'setting_name' => $settingName,
                'start_date' => null,
                'end_date' => null,
                'status' => 'inactive',
            ];
        }
    
        return view('admin.meta-settings.index', [
            'settings' => $settings,
        ]);
    }    

    public function create()
    {
        return view('admin.meta-settings.create');
    }

    public function store(Request $request)
{
    // Validate the request data
    $validated = $request->validate([
        'type' => 'required|string',
        'status' => 'required|string|in:active,inactive',
        'expiry_date' => 'required|date|after_or_equal:today',
    ]);

    $currentYear = now()->year;
    $userId = Auth::id();

    // Update or create the MetaSetting
    MetaSetting::updateOrCreate(
        [
            'setting_name' => $validated['type'],
            'year' => $currentYear,
        ],
        [
            'start_date' => now(),
            'end_date' => $validated['expiry_date'],
            'status' => $validated['status'],
            'user_id' => $userId,
        ]
    );

    // Fetch all settings from the database
    $dbSettings = MetaSetting::where('year', $currentYear)->get()->keyBy('setting_name')->toArray();

    // Define your predefined settings
    $predefinedSettings = [
        'Mid Year Approval', 
        'End Year Approval', 
        'Planning Approval', 
        'Mid Year KPI', 
        'End Year KPI', 
        'Planning KPI'
    ];

    // Merge predefined settings with database settings
    $settings = [];
    foreach ($predefinedSettings as $setting) {
        $settings[] = $dbSettings[$setting] ?? [
            'setting_name' => $setting,
            'start_date' => null,
            'end_date' => null,
            'status' => 'inactive',
        ];
    }

    // Redirect back with success message and latest data
    return redirect()->back()->with('success', 'Setting has been saved successfully.')->with('settings', $settings);
}

    
    public function edit($id)
    {
        $metaSetting = MetaSetting::findOrFail($id);
        return view('admin.meta-settings.edit', compact('metaSetting'));
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'setting_name' => 'required|string|max:255',
            'end_date' => 'required|date',
            'status' => 'required|in:active,inactive',
        ]);

        $metaSetting = MetaSetting::findOrFail($id);
        $metaSetting->update($request->all());

        return redirect()->route('admin.meta-settings.index')->with('success', 'Meta setting updated successfully.');
    }

    public function destroy($id)
    {
        $metaSetting = MetaSetting::findOrFail($id);
        $metaSetting->delete();

        return redirect()->route('admin.meta-settings.index')->with('success', 'Meta setting deleted successfully.');
    }
}
