<?php

namespace App\Services\InsightHub;

use App\Models\CompanyValue;
use Illuminate\Support\Facades\DB;
use Exception;

class CompanyValueService
{
    public function getAll(int $perPage = 10)
    {
        return CompanyValue::latest()->paginate($perPage);
    }

    public function store(array $data)
    {
        DB::beginTransaction();

        try {
            $companyValue = CompanyValue::create($data);
            DB::commit();
            return $companyValue;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception('Error creating company value: ' . $e->getMessage());
        }
    }

    public function update(CompanyValue $companyValue, array $data)
    {
        DB::beginTransaction();

        try {
            $companyValue->update($data);
            DB::commit();
            return $companyValue;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception('Error updating company value: ' . $e->getMessage());
        }
    }

    public function delete(CompanyValue $companyValue)
    {
        DB::beginTransaction();

        try {
            $companyValue->delete();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception('Error deleting company value: ' . $e->getMessage());
        }
    }
}
