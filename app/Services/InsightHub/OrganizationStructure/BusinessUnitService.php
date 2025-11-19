<?php

namespace App\Services\InsightHub\OrganizationStructure;

use App\Models\BusinessUnit;
use App\Models\Division;
use App\Models\Department;
use Illuminate\Support\Facades\DB;
use Exception;

class BusinessUnitService
{
    /**
     * Get all business units with pagination (for current tenant only)
     *
     * @param int $perPage
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getAll(int $perPage = 10)
    {
        $query = BusinessUnit::where('status', 1);
        
        // Filter by tenant_id
        if (auth()->check() && auth()->user()->tenant_id) {
            $query->where('tenant_id', auth()->user()->tenant_id);
        }
        
        return $query->orderBy('name')
            ->orderBy('id')
            ->paginate($perPage);
    }

    /**
     * Get a single business unit by ID
     *
     * @param int $id
     * @return BusinessUnit|null
     */
    public function getById(int $id)
    {
        return BusinessUnit::find($id);
    }

    /**
     * Store a new business unit
     *
     * @param array $data
     * @return BusinessUnit
     * @throws Exception
     */
    public function store(array $data)
    {
        DB::beginTransaction();

        try {
            // Prepare data for creation
            $businessUnitData = [
                'name' => $data['name'],
                'status' => 1,
                'tenant_id' => auth()->user()->tenant_id,
                'company_id' => auth()->user()->company_id ?? 0,
            ];

            $businessUnit = BusinessUnit::create($businessUnitData);
            
            DB::commit();
            
            return $businessUnit;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception('Error creating business unit: ' . $e->getMessage());
        }
    }

    /**
     * Update an existing business unit
     *
     * @param int $id
     * @param array $data
     * @return BusinessUnit
     * @throws Exception
     */
    public function update(int $id, array $data)
    {
        DB::beginTransaction();

        try {
            $businessUnit = BusinessUnit::findOrFail($id);
            
            // Verify business unit belongs to current tenant
            if ($businessUnit->tenant_id !== auth()->user()->tenant_id) {
                throw new Exception('Unauthorized access to this business unit.');
            }

            $businessUnit->update([
                'name' => $data['name'],
            ]);
            
            DB::commit();
            
            return $businessUnit;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception('Error updating business unit: ' . $e->getMessage());
        }
    }

    /**
     * Delete a business unit
     *
     * @param int $id
     * @return bool
     * @throws Exception
     */
    public function delete(int $id)
    {
        DB::beginTransaction();

        try {
            $businessUnit = BusinessUnit::findOrFail($id);
            
            // Verify business unit belongs to current tenant
            if ($businessUnit->tenant_id !== auth()->user()->tenant_id) {
                throw new Exception('Unauthorized access to this business unit.');
            }

            // Check if business unit has related divisions
            $divisionsCount = Division::where('business_unit_id', $id)->count();
            
            if ($divisionsCount > 0) {
                throw new Exception('Cannot delete business unit because it has associated divisions. Please remove or reassign divisions first.');
            }

            // Check if business unit has employees (through divisions and departments)
            $employeesCount = $this->getEmployeeCount($id);
            
            if ($employeesCount > 0) {
                throw new Exception('Cannot delete business unit because it has ' . $employeesCount . ' employee(s) associated with it. Please reassign employees first.');
            }

            $businessUnit->delete();
            
            DB::commit();
            
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Get employee count for a business unit
     *
     * @param int $businessUnitId
     * @return int
     */
    public function getEmployeeCount(int $businessUnitId): int
    {
        return DB::table('users')
            ->join('departments', 'users.department_id', '=', 'departments.id')
            ->join('divisions', 'departments.division_id', '=', 'divisions.id')
            ->where('divisions.business_unit_id', $businessUnitId)
            ->where('users.tenant_id', auth()->user()->tenant_id)
            ->count();
    }

    /**
     * Check if business unit can be deleted
     *
     * @param int $businessUnitId
     * @return bool
     */
    public function canDelete(int $businessUnitId): bool
    {
        $divisionsCount = Division::where('business_unit_id', $businessUnitId)->count();
        $employeesCount = $this->getEmployeeCount($businessUnitId);
        
        return ($divisionsCount === 0 && $employeesCount === 0);
    }

    /**
     * Get business units with employee counts
     *
     * @param array $businessUnitIds
     * @return array
     */
    public function getEmployeeCounts(array $businessUnitIds): array
    {
        if (empty($businessUnitIds)) {
            return [];
        }

        $tenantId = auth()->check() && auth()->user()->tenant_id 
            ? auth()->user()->tenant_id 
            : null;

        $query = DB::table('users')
            ->join('departments', 'users.department_id', '=', 'departments.id')
            ->join('divisions', 'departments.division_id', '=', 'divisions.id')
            ->whereIn('divisions.business_unit_id', $businessUnitIds)
            ->selectRaw('divisions.business_unit_id as business_unit_id, count(users.id) as cnt')
            ->groupBy('divisions.business_unit_id');

        if ($tenantId) {
            $query->where('users.tenant_id', $tenantId);
        }

        return $query->pluck('cnt', 'business_unit_id')
            ->toArray();
    }
}
