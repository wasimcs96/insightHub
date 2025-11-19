<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\DepartmentSection;
use App\Models\Division;
use App\Models\SectionUnit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SectionUnitController extends Controller
{
    public function index(Request $request)
    {
        $query = SectionUnit::with(['department', 'departmentSection'])
            ->where('company_id', auth()->user()->id);

        // Apply filters
        if ($request->filled('division_id')) {
            $query->whereHas('department', function ($q) use ($request) {
                $q->where('division_id', $request->division_id)
                  ->where('status', 'active');
            });
        }

        if ($request->filled('department_id')) {
            $query->where('department_id', $request->department_id)
                  ->where('status', 'active');
        }

        if ($request->filled('department_section_id')) {
            $query->where('department_section_id', $request->department_section_id)
                  ->where('status', 'active');
        }

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%')
                  ->where('status', 'active');
        }

        // Get all active divisions and departments for the filter dropdowns
        $divisions = Division::where('company_id', auth()->user()->id)
                             ->where('status', 'active')
                             ->get();

        $departments = Department::whereIn('division_id', $divisions->pluck('id'))
                                 ->where('status', 'active')
                                 ->get();
        
        // Paginate results
        $units = $query->paginate(10);

        return view('admin.section_units.index', compact('units', 'divisions', 'departments'));
    }

    public function create()
    {
        $departments = Department::where('company_id', auth()->user()->id)->where('status', 'active')->get();
        $divisions  = Division::where('company_id', auth()->user()->id)->where('status', 'active')->get();
        return view('admin.section_units.create', compact('departments', 'divisions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'department_id' => 'required|exists:departments,id',
            'department_section_id' => 'required|exists:department_sections,id',
            'name' => 'required|string|max:255',
            'status' => 'required|string|in:active,inactive',
            'division_id' => 'required',
        ]);

        $department = Department::find($request->department_id);

        if ($department->company_id != auth()->user()->id) {
            return redirect()->route('section_units.index')->with('error', 'Unauthorized action.');
        }

        DB::beginTransaction();

        try {
            $request->merge(['company_id' => Auth::id()]);
            SectionUnit::create($request->all());
            DB::commit();
            return redirect()->route('section_units.index')->with('success', 'Unit created successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('section_units.index')->with('error', 'An error occurred while creating the unit.');
        }
    }

    public function edit(SectionUnit $sectionUnit)
    {
        $departments = Department::where('company_id', auth()->user()->id)
        ->where('status', 'active')
        ->get();
        $divisions  = Division::where('company_id', auth()->user()->id)
        ->where('status', 'active')
        ->get();
        if ($sectionUnit->department->company_id != auth()->user()->id) {
            return redirect()->route('section_units.index')->with('error', 'Unauthorized action.');
        }

        return view('admin.section_units.edit', compact('sectionUnit', 'departments', 'divisions'));
    }

    public function update(Request $request, SectionUnit $sectionUnit)
    {
        $request->validate([
            'department_id' => 'required|exists:departments,id',
            'department_section_id' => 'required|exists:department_sections,id',
            'name' => 'required|string|max:255',
            'status' => 'required|string|in:active,inactive',
            'division_id' => 'required',
        ]);

        if ($sectionUnit->department->company_id != auth()->user()->id) {
            return redirect()->route('section_units.index')->with('error', 'Unauthorized action.');
        }

        $department = Department::find($request->department_id);

        if ($department->company_id != auth()->user()->id) {
            return redirect()->route('section_units.index')->with('error', 'Unauthorized action.');
        }

        DB::beginTransaction();

        try {
            $sectionUnit->update($request->all());
            DB::commit();
            return redirect()->route('section_units.index')->with('success', 'Unit updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('section_units.index')->with('error', 'An error occurred while updating the unit.');
        }
    }

    public function destroy(SectionUnit $sectionUnit)
    {
        if ($sectionUnit->department->company_id != auth()->user()->id) {
            return redirect()->route('section_units.index')->with('error', 'Unauthorized action.');
        }

        DB::beginTransaction();

        try {
            $sectionUnit->delete();
            DB::commit();
            return redirect()->route('section_units.index')->with('success', 'Unit deleted successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('section_units.index')->with('error', 'An error occurred while deleting the unit.');
        }
    }

    public function getSections(Request $request, $departmentId)
    {
        if ($request->ajax()) {
            $sections = DepartmentSection::where('department_id', $departmentId)->where('status', 'active')->get();
            return response()->json($sections);
        }
    }

    public function getUnits($sectionId)
    {
        $units = SectionUnit::where('department_section_id', $sectionId)
                            ->where('status', 'active')
                            ->get();

        return response()->json($units);
    }

    
}
