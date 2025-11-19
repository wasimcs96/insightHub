<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Division;
use App\Models\Job;
use App\Models\OrganisationPosition;
use App\Models\User;
use App\Models\UserResult;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Services\Job\UpdateVacancyInJobService;

class OrganisationController extends Controller
{

    public function __construct(UpdateVacancyInJobService $service)
    {
        $this->updateVacancyInJobService = $service;
    }

    public function buildOrgChart($topPosition)
    {
        if ($topPosition) {
            $result = [];

            if ($topPosition->user) {
                $result['user'] = $topPosition->user->name;
            }

            if ($topPosition->job) {
                $result['job_title'] = $topPosition->job->title ?? '';
                $result['className'] = 'level-' . $topPosition->job->level ?? '';
            }

            if ($topPosition->department) {
                $result['department'] = $topPosition->department->name;
            }


            $result = array_merge($result, [
                'id' => $topPosition->id ?? '',
                'user_id' => $topPosition->user_id ?? '',
                'job_id' => $topPosition->job_id ?? '',
                'department_id' => $topPosition->department_id ?? '',
                'position_name' => $topPosition->title ?? '',
                'parent_id' => $topPosition->parent_id ?? '',
                'additional_department_id' => $topPosition->additional_department_id ?? '',
            ]);

            $result['name'] = $topPosition->title;

            if (array_key_exists("user", $result)) {
                $result['name'] = $topPosition->user->name . '(' . $topPosition->title . ')';
            }

            if (array_key_exists("job_title", $result)) {
                $result['title'] = $result['job_title'];
            }


            if ($topPosition->subPositions->isNotEmpty()) {
                $result['children'] = [];
                foreach ($topPosition->subPositions as $subordinate) {
                    $result['children'][] = $this->buildOrgChart($subordinate);
                }
            }

            return $result;
            # code...
        }
        return [];
    }

    public function buildOrgChartData(Request $request)
    {
        $department_id = $request->department_id ?? 129;
        $departmentDetail = Department::find($department_id);
        ini_set('max_execution_time', 300);
        $topPosition = OrganisationPosition::where('parent_id', null)->where('department_id',$department_id)->first();

        if (!$topPosition) {
            $topPosition = OrganisationPosition::create(['title' => '','department_id'=>$department_id]);
        }

        $dataSource = $this->buildOrgChart($topPosition);

        $allPositions = OrganisationPosition::where('department_id',$department_id)->pluck('user_id')->toArray();

        // Define the array of IDs to be excluded, and filter out null values
        $excludedIds = array_filter($allPositions);
        // $departments = Department::all()->toArray();
        $divisions = Division::where('company_id', auth()->user()->isCompany() ? auth()->user()->id : auth()->user()->company_id)
            ->where('status', 'active')
            ->get();

        $departments = Department::whereIn('division_id', $divisions->pluck('id'))
            ->where('status', 1)
            ->get();
        $employees = User::where('role_name', 'employee')->where('company_id', auth()->user()->isCompany() ? auth()->user()->id : auth()->user()->company_id)->get()->toArray();

        $create_at = OrganisationPosition::orderBy('created_at', 'asc')->value('created_at');
        $updated_at = OrganisationPosition::where('department_id', $department_id)
        ->orderBy('updated_at', 'desc')
        ->value('updated_at');

        return view('admin.org_structure', compact('dataSource', 'departments', 'employees', 'divisions','departmentDetail','create_at','updated_at'));
    }

    public function storePositionDetails(Request $request)
    {
        if ($request->has('employee') && $request->employee != null) {
            OrganisationPosition::where('id', $request->id)->update(['user_id' => $request->employee]);
            if ($request->has('department_search') && $request->department_search != null) {
                User::where('id', $request->employee)->update(['department_id' => $request->department_search]);
            }
            if ($request->has('job_search') && $request->job_search != null) {
                $positionId = User::where('id', $request->employee)->pluck('position_id')->first();
                if ($positionId != $request->job_search) {
                    $this->updateVacancyInJobService->updateVacancyOnJobEdit($request->job_search);
                }
                User::where('id', $request->employee)->update(['position_id' => $request->job_search]);
            }
        }

        if ($request->has('job_search') && $request->job_search != null) {
            $job=Job::find($request->job_search);
            OrganisationPosition::where('id', $request->id)->update(['title' => $job->title]);
        }

        if ($request->has('department_search') && $request->department_search != null) {
            OrganisationPosition::where('id', $request->id)->update(['department_id' => $request->department_search]);
        }

        if ($request->has('job_search') && $request->job_search != null) {
            OrganisationPosition::where('id', $request->id)->update(['job_id' => $request->job_search]);
        }

        if ($request->has('job_search') && $request->job_search != null) {
            OrganisationPosition::where('id', $request->id)->update(['title' => $request->title]);
        }

        if ($request->has('additional_department_id') && $request->additional_department_id != null) {
            OrganisationPosition::where('id', $position->id)->update(['additional_department_id' => $request->additional_department_id]);
        }

        return redirect()->back()->with('success', 'Data Updated Successfully');
    }

    public function addpositionDetails(Request $request)
    {
        $position = OrganisationPosition::create(['title' => $request->position_title, 'parent_id' => $request->parent_id]);
        if ($request->has('employee_subordinates') && $request->employee_subordinates != null) {
            OrganisationPosition::where('id', $position->id)->update(['user_id' => $request->employee_subordinates]);
            if ($request->has('department_search_subordinates') && $request->department_search_subordinates != null) {
                User::where('id', $request->employee_subordinates)->update(['department_id' => $request->department_search_subordinates]);
            }
            if ($request->has('job_search_subordinates') && $request->job_search_subordinates != null) {
                $positionId = User::where('id', $request->employee_subordinates)->pluck('position_id')->first();
                if ($positionId != $request->job_search_subordinates) {
                    $this->updateVacancyInJobService->updateVacancyOnJobEdit($request->job_search_subordinates);
                }
                User::where('id', $request->employee_subordinates)->update(['position_id' => $request->job_search_subordinates]);
            }
        }

        if ($request->has('department_search_subordinates') && $request->department_search_subordinates != null) {
            OrganisationPosition::where('id', $position->id)->update(['department_id' => $request->department_search_subordinates]);
        }

        if ($request->has('job_search_subordinates') && $request->job_search_subordinates != null) {
            OrganisationPosition::where('id', $position->id)->update(['job_id' => $request->job_search_subordinates]);
        }

        return redirect()->back()->with('success', 'Data Updated Successfully');
    }

    public function removepositionDetails(Request $request)
    {
        OrganisationPosition::find($request->id)->delete();
        return redirect()->back()->with('success', 'Data Updated Successfully');
    }

    public function employeesGet(Request $request)
    {
        $allPositions = OrganisationPosition::pluck('user_id')->toArray();
        // Define the array of IDs to be excluded, and filter out null values
        $excludedIds = array_filter($allPositions);

        $employees = User::whereNotIn('id', $excludedIds)->where('role_name', 'employee')->where('company_id', auth()->user()->isCompany() ? auth()->user()->id : auth()->user()->company_id)->get()->toArray();
        if ($request->has('user_id') && $request->user_id) {
            $user_id = $request->user_id;
            $array = array_filter($excludedIds, function ($value) use ($user_id) {
                return $value != $user_id;
            });

            // Reindex the array to avoid any gaps in the array keys
            $array = array_values($array);

            $employees = User::whereNotIn('id', $array)->where('role_name', 'employee')->where('company_id', auth()->user()->isCompany() ? auth()->user()->id : auth()->user()->company_id)->get()->toArray();
        }
        return response()->json($employees);
    }

    public function employeesData(Request $request)
    {
        $employee = User::where('id',$request->user_id)->first();

        $employeeResults = UserResult::where('user_id', $request->user_id)->get();
        // Return the view with data
        return view('admin.employee_card', compact('employee','employeeResults'))->render();
    }

    public function buildOrgChartlist(Request $request)
{
    // Retrieve divisions for the currently logged-in user's company
    $divisions = Division::where('company_id', auth()->user()->isCompany() ? auth()->user()->id : auth()->user()->company_id)->where('status', 'active')->get();

    // Initialize the query for departments
    $query = Department::with('division')->where('company_id', auth()->user()->isCompany() ? auth()->user()->id : auth()->user()->company_id);

    // Filter by division_id if provided
    if ($request->filled('division_id')) {
        $query->where('division_id', $request->division_id);
    }

    // Filter by name if provided
    if ($request->filled('name')) {
        $query->where('name', 'like', '%' . $request->name . '%');
    }

    // Paginate the results
    $departments = $query->paginate(10);

    return view('admin.org_structure_list', compact('departments', 'divisions'));
}
}
