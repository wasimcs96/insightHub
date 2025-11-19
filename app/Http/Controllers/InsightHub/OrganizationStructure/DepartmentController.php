<?php

namespace App\Http\Controllers\InsightHub\OrganizationStructure;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Division;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\Http\Requests\StoreDepartmentRequest;
use App\Http\Requests\UpdateDepartmentRequest;
use App\Services\InsightHub\OrganizationStructure\DepartmentService;
use Exception;

class DepartmentController extends Controller
{
    protected $departmentService;

    /**
     * Constructor
     */
    public function __construct(DepartmentService $departmentService)
    {
        $this->departmentService = $departmentService;
    }

    /**
     * Get departments data for API/AJAX requests.
     */
    /**
     * Get departments data for API/AJAX requests.
     */
    public function getData(Request $request)
    {
        try {
            $perPage = (int) min(max((int) $request->query('per_page', 50), 1), 200);
            $page = max((int) $request->query('page', 1), 1);
            $search = trim((string) $request->query('q', ''));
            $divisionId = $request->query('division_id');
            $businessUnitId = $request->query('business_unit_id');
    
            $builder = Department::query()
                ->with(['division.business_unit'])
                ->select(['id', 'name', 'division_id', 'status', 'tenant_id', 'created_at', 'updated_at']);
    
            // Filter by tenant_id - only show departments for logged-in user's tenant
            if (auth()->check() && auth()->user()->tenant_id) {
                $builder->where('tenant_id', auth()->user()->tenant_id);
            }
    
            // Active filter
            $builder->where('status', 1);
    
            // Filter by division
            if ($divisionId) {
                $builder->where('division_id', $divisionId);
            }

            // Filter by business unit (through division)
            if ($businessUnitId) {
                $builder->whereHas('division', function($query) use ($businessUnitId) {
                    $query->where('business_unit_id', $businessUnitId);
                });
            }
    
            // Search by name
            if ($search !== '') {
                $builder->where('name', 'like', "%{$search}%");
            }
    
            // Sorting
            $builder->orderBy('name')->orderBy('id');
    
            // Paginated response
            $paginator = $builder->paginate($perPage, ['*'], 'page', $page)
                                ->appends($request->query());

            // Batch fetch employee counts to avoid N+1 queries
            $items = $paginator->items();
            $departmentIds = collect($items)->pluck('id')->all();

            // Get employee counts in single query
            $employeeCounts = $this->departmentService->getEmployeeCounts($departmentIds);

            // Attach computed properties
            foreach ($items as $item) {
                $item->employee_count = $employeeCounts[$item->id] ?? 0;
                $item->can_delete = $item->employee_count === 0;
                
                // Format division and business unit names for response
                $item->division_name = $item->division ? $item->division->head_of_division : 'N/A';
                $item->business_unit_name = $item->division && $item->division->business_unit 
                    ? $item->division->business_unit->name 
                    : 'N/A';
            }

            return response()->json([
                'status' => 'success',
                'data'   => $items,
                'meta'   => [
                    'pagination' => [
                        'total'        => $paginator->total(),
                        'per_page'     => $paginator->perPage(),
                        'current_page' => $paginator->currentPage(),
                        'last_page'    => $paginator->lastPage(),
                    ],
                ],
            ]);
        } catch (\Throwable $e) {
            \Log::error('Department getData error', ['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return response()->json([
                'status'  => 'error',
                'message' => 'Something went wrong.',
                'error'   => app()->environment('local') ? $e->getMessage() : null,
            ], 500);
        }
    }

    /**
     * Check if a department name already exists for the current tenant within the same division.
     */
    public function checkDuplicate(Request $request)
    {
        try {
            $name = trim($request->input('name', ''));
            $divisionId = $request->input('division_id', null);
            $excludeId = $request->input('exclude_id', null);
            
            if (empty($name) || empty($divisionId)) {
                return response()->json(['exists' => false]);
            }

            $query = Department::where('name', $name)
                               ->where('division_id', $divisionId);
            
            // Filter by tenant
            if (auth()->check() && auth()->user()->tenant_id) {
                $query->where('tenant_id', auth()->user()->tenant_id);
            }
            
            // Exclude specific ID (for edit scenarios)
            if ($excludeId) {
                $query->where('id', '!=', $excludeId);
            }
            
            $exists = $query->exists();
            
            return response()->json(['exists' => $exists]);
        } catch (\Throwable $e) {
            \Log::error('Department duplicate check error', ['error' => $e->getMessage()]);
            return response()->json([
                'exists' => false,
                'error' => 'Failed to check for duplicates'
            ], 500);
        }
    }

    public function index()
    {
        // Fetch active divisions for dropdown
        $divisions = Division::where('status', 'active')
            ->where('tenant_id', auth()->user()->tenant_id)
            ->with('business_unit:id,name')
            ->orderBy('head_of_division')
            ->get(['id', 'head_of_division', 'business_unit_id']);

        return view('InsightHub.settings.general-settings.organization-structure.department', [
            'divisions' => $divisions
        ]);
    }

    /**
     * Store a newly created department.
     */
    public function store(StoreDepartmentRequest $request)
    {
        try {
            $department = $this->departmentService->store($request->validated());

            return redirect()->back()->with('success', 'Department created successfully.');
        } catch (Exception $e) {
            \Log::error('Department store error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to create department: ' . $e->getMessage());
        }
    }

    /**
     * Update the specified department.
     */
    public function update(UpdateDepartmentRequest $request, $id)
    {
        try {
            $department = $this->departmentService->update($id, $request->validated());

            return redirect()->back()->with('success', 'Department updated successfully.');
        } catch (Exception $e) {
            \Log::error('Department update error', [
                'id' => $id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to update department: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified department.
     */
    public function destroy($id)
    {
        try {
            $this->departmentService->delete($id);

            return redirect()->back()->with('success', 'Department deleted successfully.');
        } catch (Exception $e) {
            \Log::error('Department delete error', [
                'id' => $id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
