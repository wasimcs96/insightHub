<?php

namespace App\Http\Controllers\InsightHub\OrganizationStructure;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Division;
use App\Models\BusinessUnit;
use App\Models\Department;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\Http\Requests\StoreDivisionRequest;
use App\Http\Requests\UpdateDivisionRequest;
use App\Services\InsightHub\OrganizationStructure\DivisionService;
use Exception;

class DivisionController extends Controller
{
    protected $divisionService;

    /**
     * Constructor
     */
    public function __construct(DivisionService $divisionService)
    {
        $this->divisionService = $divisionService;
    }

    /**
     * Display a listing of divisions.
     */
    public function getData(Request $request)
    {
        try {
            $perPage = (int) min(max((int) $request->query('per_page', 50), 1), 200);
            $page = max((int) $request->query('page', 1), 1);
            $search = trim((string) $request->query('q', ''));
    
            $builder = Division::query()
                ->with('business_unit:id,name')
                ->select(['id', 'head_of_division', 'business_unit_id', 'status', 'tenant_id', 'created_at', 'updated_at']);
    
            // Filter by tenant_id - only show divisions for logged-in user's tenant
            if (auth()->check() && auth()->user()->tenant_id) {
                $builder->where('tenant_id', auth()->user()->tenant_id);
            }
    
            // Active filter
            $builder->where('status', 'active');
    
            // Search by head_of_division
            if ($search !== '') {
                $builder->where('head_of_division', 'like', "%{$search}%");
            }
    
            // Sorting
            $builder->orderBy('head_of_division')->orderBy('id');
    
            // Paginated response
            $paginator = $builder->paginate($perPage, ['*'], 'page', $page)
                                ->appends($request->query());

            // Batch fetch employee counts and department counts to avoid N+1 queries
            $items = $paginator->items();
            $divisionIds = collect($items)->pluck('id')->all();

            // Get employee counts in single query
            $employeeCounts = $this->divisionService->getEmployeeCounts($divisionIds);

            // Get department counts in single query for can_delete check
            $departmentCounts = DB::table('departments')
                ->whereIn('division_id', $divisionIds)
                ->selectRaw('division_id, count(*) as cnt')
                ->groupBy('division_id')
                ->pluck('cnt', 'division_id')
                ->toArray();

            // Attach computed properties
            foreach ($items as $item) {
                $item->employee_count = $employeeCounts[$item->id] ?? 0;
                $item->department_count = $departmentCounts[$item->id] ?? 0;
                $item->can_delete = $item->employee_count === 0;
                
                // Format business unit name for response
                $item->business_unit_name = $item->business_unit ? $item->business_unit->name : 'N/A';
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
            \Log::error('Division getData error', ['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return response()->json([
                'status'  => 'error',
                'message' => 'Something went wrong.',
                'error'   => app()->environment('local') ? $e->getMessage() : null,
            ], 500);
        }
    }

    /**
     * Check if a division name already exists for the current tenant within the same business unit.
     */
    public function checkDuplicate(Request $request)
    {
        try {
            $name = trim($request->input('head_of_division', ''));
            $businessUnitId = $request->input('business_unit_id', null);
            $excludeId = $request->input('exclude_id', null);
            
            if (empty($name) || empty($businessUnitId)) {
                return response()->json(['exists' => false]);
            }

            $query = Division::where('head_of_division', $name)
                             ->where('business_unit_id', $businessUnitId);
            
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
            \Log::error('Division duplicate check error', ['error' => $e->getMessage()]);
            return response()->json([
                'exists' => false,
                'error' => 'Failed to check for duplicates'
            ], 500);
        }
    }

    public function index()
    {
        // Fetch active business units for dropdown
        $businessUnits = BusinessUnit::where('status', 1)
            ->where('tenant_id', auth()->user()->tenant_id)
            ->orderBy('name')
            ->get(['id', 'name']);

        return view('InsightHub.settings.general-settings.organization-structure.division', [
            'businessUnits' => $businessUnits
        ]);
    }

    /**
     * Store a newly created division.
     */
    public function store(StoreDivisionRequest $request)
    {
        try {
            $division = $this->divisionService->store($request->validated());

            return redirect()->back()->with('successs', 'Division created successfully.');
        } catch (Exception $e) {
            \Log::error('Division store error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to create division: ' . $e->getMessage());
        }
    }

    /**
     * Update the specified division.
     */
    public function update(UpdateDivisionRequest $request, $id)
    {
        try {
            $division = $this->divisionService->update($id, $request->validated());

            return redirect()->back()->with('successs', 'Division updated successfully.');
        } catch (Exception $e) {
            \Log::error('Division update error', [
                'id' => $id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to update division: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified division.
     */
    public function destroy($id)
    {
        try {
            $this->divisionService->delete($id);

            return redirect()->back()->with('successs', 'Division deleted successfully.');
        } catch (Exception $e) {
            \Log::error('Division delete error', [
                'id' => $id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
