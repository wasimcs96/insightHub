<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\DepartmentSection;
use App\Models\Division;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DepartmentSectionController extends Controller
{
    public function index(Request $request)
    {
        $divisions = Division::where('company_id', auth()->user()->id)
            ->where('status', 'active')
            ->get();

        $query = DepartmentSection::with('department.division')
            ->where('company_id', auth()->user()->id)
            ->whereHas('department', function ($q) {
                $q->where('status', 1);
            });

        if ($request->filled('division_id')) {
            $query->whereHas('department', function ($q) use ($request) {
                $q->where('division_id', $request->division_id);
            });
        }

        if ($request->filled('department_id')) {
            $query->where('department_id', $request->department_id);
        }

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        $sections = $query->paginate(10);
        $departments = Department::whereIn('division_id', $divisions->pluck('id'))
            ->where('status', 1)
            ->get();

        return view('admin.department_sections.index', compact('sections', 'departments', 'divisions'));
    }


    public function create()
    {
        $departments = Department::where('company_id', auth()->user()->id)->where('status', 1)->get();
        $divisions = Division::where('company_id', auth()->user()->id)->where('status', 'active')->get();
        return view('admin.department_sections.create', compact('departments', 'divisions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'department_id' => 'required|exists:departments,id',
            'name' => 'required|string|max:255',
            'status' => 'required|string|in:active,inactive',
            'division_id' => 'required',
        ]);

        $department = Department::find($request->department_id);

        if ($department->company_id != auth()->user()->id) {
            return redirect()->route('department_sections.index')->with('error', 'Unauthorized action.');
        }

        DB::beginTransaction();

        try {
            $request->merge(['company_id' => Auth::id()]);
            DepartmentSection::create($request->all());
            DB::commit();
            return redirect()->route('department_sections.index')->with('success', 'Section created successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('department_sections.index')->with('error', 'An error occurred while creating the section.');
        }
    }

    public function edit(DepartmentSection $departmentSection)
    {
        $departments = Department::where('company_id', auth()->user()->id)->where('status', 1)->get();
        $divisions = Division::where('company_id', auth()->user()->id)->where('status', 'active')->get();
        $departments = Department::where('division_id', $departmentSection->department->division_id)->get();
        if ($departmentSection->department->company_id != auth()->user()->id) {
            return redirect()->route('department_sections.index')->with('error', 'Unauthorized action.');
        }

        return view('admin.department_sections.edit', compact('departmentSection', 'divisions', 'departments'));
    }

    public function update(Request $request, DepartmentSection $departmentSection)
    {
        $request->validate([
            'department_id' => 'required|exists:departments,id',
            'name' => 'required|string|max:255',
            'status' => 'required|string|in:active,inactive',
            'division_id' => 'required',
        ]);

        if ($departmentSection->department->company_id != auth()->user()->id) {
            return redirect()->route('department_sections.index')->with('error', 'Unauthorized action.');
        }

        $department = Department::find($request->department_id);

        if ($department->company_id != auth()->user()->id) {
            return redirect()->route('department_sections.index')->with('error', 'Unauthorized action.');
        }

        DB::beginTransaction();

        try {
            $departmentSection->update($request->all());
            DB::commit();
            return redirect()->route('department_sections.index')->with('success', 'Section updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('department_sections.index')->with('error', 'An error occurred while updating the section.');
        }
    }

    public function destroy(DepartmentSection $departmentSection)
    {
        if ($departmentSection->department->company_id != auth()->user()->id) {
            return redirect()->route('department_sections.index')->with('error', 'Unauthorized action.');
        }

        if ($departmentSection->sectionUnits()->count() > 0) {
            return redirect()->route('department_sections.index')->with('error', 'Cannot delete section with units.');
        }

        DB::beginTransaction();

        try {
            $departmentSection->delete();
            DB::commit();
            return redirect()->route('department_sections.index')->with('success', 'Section deleted successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('department_sections.index')->with('error', 'An error occurred while deleting the section.');
        }
    }

    public function getDepartments($divisionId)
    {
        $departments = Department::where('division_id', $divisionId)
        ->where('status', 1)
        ->get();
        return response()->json($departments);
    }
}
