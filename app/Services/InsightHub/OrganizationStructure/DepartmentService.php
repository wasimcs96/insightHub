<?php

namespace App\Services\InsightHub\OrganizationStructure;

use App\Models\Department;
use App\Models\Division;
use Illuminate\Support\Facades\DB;
use Exception;

class DepartmentService
{
    /**
     * Get all departments with pagination (for current tenant only)
     *
     * @param int $perPage
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getAll(int $perPage = 10)
    {
        $query = Department::where('status', 1);
        
        // Filter by tenant_id
        if (auth()->check() && auth()->user()->tenant_id) {
            $query->where('tenant_id', auth()->user()->tenant_id);
        }
        
        return $query->orderBy('name')
            ->orderBy('id')
            ->paginate($perPage);
    }

    /**
     * Get a single department by ID
     *
     * @param int $id
     * @return Department|null
     */
    public function getById(int $id)
    {
        return Department::find($id);
    }

    /**
     * Store a new department
     *
     * @param array $data
     * @return Department
     * @throws Exception
     */
    public function store(array $data)
    {
        DB::beginTransaction();

        try {
            // Prepare data for creation
            $departmentData = [
                'name' => $data['name'],
                'head_of_department' => $data['name'],
                'division_id' => $data['division_id'],
                'status' => 1,
                'tenant_id' => auth()->user()->tenant_id,
                'company_id' => auth()->user()->company_id ?? 0,
            ];

            $department = Department::create($departmentData);
            
            DB::commit();
            
            return $department;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception('Error creating department: ' . $e->getMessage());
        }
    }

    /**
     * Update an existing department
     *
     * @param int $id
     * @param array $data
     * @return Department
     * @throws Exception
     */
    public function update(int $id, array $data)
    {
        DB::beginTransaction();

        try {
            $department = Department::findOrFail($id);
            
            // Verify department belongs to current tenant
            if ($department->tenant_id !== auth()->user()->tenant_id) {
                throw new Exception('Unauthorized access to this department.');
            }

            $department->update([
                'name' => $data['name'],
                'division_id' => $data['division_id'],
            ]);
            
            DB::commit();
            
            return $department;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception('Error updating department: ' . $e->getMessage());
        }
    }

    /**
     * Delete a department
     *
     * @param int $id
     * @return bool
     * @throws Exception
     */
    public function delete(int $id)
    {
        DB::beginTransaction();

        try {
            $department = Department::findOrFail($id);
            
            // Verify department belongs to current tenant
            if ($department->tenant_id !== auth()->user()->tenant_id) {
                throw new Exception('Unauthorized access to this department.');
            }

            // Check if department has employees
            $employeesCount = $this->getEmployeeCount($id);
            
            if ($employeesCount > 0) {
                throw new Exception('Cannot delete department because it has ' . $employeesCount . ' employee(s) associated with it. Please reassign employees first.');
            }

            $department->delete();
            
            DB::commit();
            
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Get employee count for a department
     *
     * @param int $departmentId
     * @return int
     */
    public function getEmployeeCount(int $departmentId): int
    {
        $query = DB::table('users')
            ->where('department_id', $departmentId);
        
        // Filter by tenant_id if authenticated
        if (auth()->check() && auth()->user()->tenant_id) {
            $query->where('tenant_id', auth()->user()->tenant_id);
        }
        
        return $query->count();
    }

    /**
     * Check if department can be deleted
     *
     * @param int $departmentId
     * @return bool
     */
    public function canDelete(int $departmentId): bool
    {
        $employeesCount = $this->getEmployeeCount($departmentId);
        
        return ($employeesCount === 0);
    }

    /**
     * Get departments with employee counts
     *
     * @param array $departmentIds
     * @return array
     */
    public function getEmployeeCounts(array $departmentIds): array
    {
        if (empty($departmentIds)) {
            return [];
        }

        $query = DB::table('users')
            ->whereIn('department_id', $departmentIds)
            ->whereNotNull('department_id');
        
        // Filter by tenant_id if authenticated
        if (auth()->check() && auth()->user()->tenant_id) {
            $query->where('tenant_id', auth()->user()->tenant_id);
        }
        
        return $query->selectRaw('department_id, count(id) as cnt')
            ->groupBy('department_id')
            ->pluck('cnt', 'department_id')
            ->toArray();
    }
}
