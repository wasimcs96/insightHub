<?php

namespace App\Services\InsightHub\OrganizationStructure;

use App\Models\Division;
use App\Models\Department;
use Illuminate\Support\Facades\DB;
use Exception;

class DivisionService
{
    /**
     * Get all divisions with pagination (for current tenant only)
     *
     * @param int $perPage
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getAll(int $perPage = 10)
    {
        $query = Division::with('business_unit')
            ->where('status', 'active');
        
        // Filter by tenant_id
        if (auth()->check() && auth()->user()->tenant_id) {
            $query->where('tenant_id', auth()->user()->tenant_id);
        }
        
        return $query->orderBy('head_of_division')
            ->orderBy('id')
            ->paginate($perPage);
    }

    /**
     * Get a single division by ID
     *
     * @param int $id
     * @return Division|null
     */
    public function getById(int $id)
    {
        return Division::with('business_unit')->find($id);
    }

    /**
     * Store a new division
     *
     * @param array $data
     * @return Division
     * @throws Exception
     */
    public function store(array $data)
    {
        DB::beginTransaction();

        try {
            // Prepare data for creation
            $divisionData = [
                'head_of_division' => $data['head_of_division'],
                'business_unit_id' => $data['business_unit_id'],
                'status' => 'active',
                'tenant_id' => auth()->user()->tenant_id,
                'company_id' => auth()->user()->company_id ?? null,
            ];

            $division = Division::create($divisionData);
            
            DB::commit();
            
            return $division;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception('Error creating division: ' . $e->getMessage());
        }
    }

    /**
     * Update an existing division
     *
     * @param int $id
     * @param array $data
     * @return Division
     * @throws Exception
     */
    public function update(int $id, array $data)
    {
        DB::beginTransaction();

        try {
            $division = Division::findOrFail($id);
            
            // Verify division belongs to current tenant
            if ($division->tenant_id !== auth()->user()->tenant_id) {
                throw new Exception('Unauthorized access to this division.');
            }

            $division->update([
                'head_of_division' => $data['head_of_division'],
                'business_unit_id' => $data['business_unit_id'],
            ]);
            
            DB::commit();
            
            return $division;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception('Error updating division: ' . $e->getMessage());
        }
    }

    /**
     * Delete a division
     *
     * @param int $id
     * @return bool
     * @throws Exception
     */
    public function delete(int $id)
    {
        DB::beginTransaction();

        try {
            $division = Division::findOrFail($id);
            
            // Verify division belongs to current tenant
            if ($division->tenant_id !== auth()->user()->tenant_id) {
                throw new Exception('Unauthorized access to this division.');
            }

            // Check if division has related departments
            $departmentsCount = Department::where('division_id', $id)->count();
            
            if ($departmentsCount > 0) {
                throw new Exception('Cannot delete division because it has associated departments. Please remove or reassign departments first.');
            }

            // Check if division has employees
            $employeesCount = $this->getEmployeeCount($id);
            
            if ($employeesCount > 0) {
                throw new Exception('Cannot delete division because it has ' . $employeesCount . ' employee(s) associated with it. Please reassign employees first.');
            }

            $division->delete();
            
            DB::commit();
            
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Get employee count for a division
     *
     * @param int $divisionId
     * @return int
     */
    public function getEmployeeCount(int $divisionId): int
    {
        return DB::table('users')
            ->join('departments', 'users.department_id', '=', 'departments.id')
            ->where('departments.division_id', $divisionId)
            ->where('users.tenant_id', auth()->user()->tenant_id)
            ->count();
    }

    /**
     * Check if division can be deleted
     *
     * @param int $divisionId
     * @return bool
     */
    public function canDelete(int $divisionId): bool
    {
        $departmentsCount = Department::where('division_id', $divisionId)->count();
        $employeesCount = $this->getEmployeeCount($divisionId);
        
        return ($departmentsCount === 0 && $employeesCount === 0);
    }

    /**
     * Get divisions with employee counts
     *
     * @param array $divisionIds
     * @return array
     */
    public function getEmployeeCounts(array $divisionIds): array
    {
        if (empty($divisionIds)) {
            return [];
        }

        return DB::table('users')
            ->join('departments', 'users.department_id', '=', 'departments.id')
            ->whereIn('departments.division_id', $divisionIds)
            ->selectRaw('departments.division_id as division_id, count(users.id) as cnt')
            ->groupBy('departments.division_id')
            ->pluck('cnt', 'division_id')
            ->toArray();
    }
}
