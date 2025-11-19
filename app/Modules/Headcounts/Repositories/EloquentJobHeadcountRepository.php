<?php
namespace App\Modules\Headcounts\Repositories;

use App\Models\JobHeadcount;
use Illuminate\Support\Collection;

class EloquentJobHeadcountRepository implements JobHeadcountRepositoryInterface
{
    public function create(array $data): JobHeadcount
    {
        return JobHeadcount::create($data);
    }

    public function update(int $id, array $data): JobHeadcount
    {
        $hc = JobHeadcount::findOrFail($id);
        $hc->update($data);
        return $hc;
    }

    public function delete(int $id): bool
    {
        $hc = JobHeadcount::findOrFail($id);
        return $hc->delete();
    }

    public function find(int $id): ?JobHeadcount
    {
        return JobHeadcount::find($id);
    }

    public function findByCode(string $code): ?JobHeadcount
    {
        return JobHeadcount::where('headcount_code', $code)->first();
    }

    public function countByJob(int $jobId): int
    {
        return JobHeadcount::where('job_id', $jobId)->count();
    }

    public function allByJob(int $jobId): Collection
    {
        return JobHeadcount::where('job_id', $jobId)
            ->orderBy('headcount_number')
            ->get();
    }

    public function childrenOf(int $parentId): Collection
    {
        return JobHeadcount::where('parent_id', $parentId)
            ->orderBy('headcount_number')
            ->get();
    }
}
