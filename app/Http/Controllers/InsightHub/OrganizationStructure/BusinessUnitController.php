<?php

namespace App\Http\Controllers\InsightHub\OrganizationStructure;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BusinessUnit;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\Http\Requests\StoreBusinessUnitRequest;
use App\Http\Requests\UpdateBusinessUnitRequest;
use App\Services\InsightHub\OrganizationStructure\BusinessUnitService;
use Exception;

class BusinessUnitController extends Controller
{
    protected $businessUnitService;

    /**
     * Constructor
     */
    public function __construct(BusinessUnitService $businessUnitService)
    {
        $this->businessUnitService = $businessUnitService;
    }

    /**
     * Display a listing of business units.
     */
    public function getData(Request $request)
    {
        try {
            $perPage = (int) min(max((int) $request->query('per_page', 50), 1), 200);
            $page = max((int) $request->query('page', 1), 1);
            $search = trim((string) $request->query('q', ''));
    
            $builder = BusinessUnit::query()
                ->select(['id', 'name', 'status', 'tenant_id', 'created_at', 'updated_at']);
    
            // Filter by tenant_id - only show business units for logged-in user's tenant
            if (auth()->check() && auth()->user()->tenant_id) {
                $builder->where('tenant_id', auth()->user()->tenant_id);
            }
    
            // Active filter - assuming 'status' column exists based on model
            $builder->where('status', 1);
    
            // Search by name
            if ($search !== '') {
                $builder->where('name', 'like', "%{$search}%");
            }
    
            // Sorting
            $builder->orderBy('name')->orderBy('id');
    
            // Paginated response
            $paginator = $builder->paginate($perPage, ['*'], 'page', $page)
                                ->appends($request->query());

            // Batch fetch employee counts and division counts to avoid N+1 queries
            $items = $paginator->items();
            $buIds = collect($items)->pluck('id')->all();

            // Get employee counts in single query
            $employeeCounts = $this->businessUnitService->getEmployeeCounts($buIds);

            // Get division counts in single query for can_delete check
            $divisionCounts = DB::table('divisions')
                ->whereIn('business_unit_id', $buIds)
                ->selectRaw('business_unit_id, count(*) as cnt')
                ->groupBy('business_unit_id')
                ->pluck('cnt', 'business_unit_id')
                ->toArray();

            // Attach computed properties
            foreach ($items as $item) {
                $item->employee_count = $employeeCounts[$item->id] ?? 0;
                $item->can_delete = $item->employee_count === 0;
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
            \Log::error('Business Unit getData error', ['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return response()->json([
                'status'  => 'error',
                'message' => 'Something went wrong.',
                'error'   => app()->environment('local') ? $e->getMessage() : null,
            ], 500);
        }
    }

    /**
     * Check if a business unit name already exists for the current tenant.
     */
    public function checkDuplicate(Request $request)
    {
        try {
            $name = trim($request->input('name', ''));
            $excludeId = $request->input('exclude_id', null);
            
            if (empty($name)) {
                return response()->json(['exists' => false]);
            }

            $query = BusinessUnit::where('name', $name);
            
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
            \Log::error('Business Unit duplicate check error', ['error' => $e->getMessage()]);
            return response()->json([
                'exists' => false,
                'error' => 'Failed to check for duplicates'
            ], 500);
        }
    }

    public function index()
    {
        // TODO: Fetch business units from database
        $businessUnits = [
            [
                'id' => 1,
                'name' => 'Global Tech Operations',
                'employees_count' => 6,
                'can_delete' => false
            ],
            [
                'id' => 2,
                'name' => 'Corporate Services',
                'employees_count' => 0,
                'can_delete' => true
            ],
            [
                'id' => 3,
                'name' => 'Digital Solutions & Innovation',
                'employees_count' => 3,
                'can_delete' => false
            ],
        ];

        return view('InsightHub.settings.general-settings.organization-structure.business-unit', [
            'businessUnits' => $businessUnits
        ]);
    }

    /**
     * Store a newly created business unit.
     */
    public function store(StoreBusinessUnitRequest $request)
    {
        try {
            $businessUnit = $this->businessUnitService->store($request->validated());

            return redirect()->back()->with('successs', 'Business unit created successfully.');
        } catch (Exception $e) {
            \Log::error('Business Unit store error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to create business unit: ' . $e->getMessage());
        }
    }

    /**
     * Update the specified business unit.
     */
    public function update(UpdateBusinessUnitRequest $request, $id)
    {
        try {
            $businessUnit = $this->businessUnitService->update($id, $request->validated());

            return redirect()->back()->with('successs', 'Business unit updated successfully.');
        } catch (Exception $e) {
            \Log::error('Business Unit update error', [
                'id' => $id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to update business unit: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified business unit.
     */
    public function destroy($id)
    {
        try {
            $this->businessUnitService->delete($id);

            return redirect()->back()->with('successs', 'Business unit deleted successfully.');
        } catch (Exception $e) {
            \Log::error('Business Unit delete error', [
                'id' => $id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
