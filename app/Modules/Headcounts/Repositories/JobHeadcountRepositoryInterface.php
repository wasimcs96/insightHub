<?php
namespace App\Modules\Headcounts\Repositories;

use App\Models\JobHeadcount;
use Illuminate\Support\Collection;

interface JobHeadcountRepositoryInterface
{
    public function create(array $data): JobHeadcount;
    public function update(int $id, array $data): JobHeadcount;
    public function delete(int $id): bool;
    public function find(int $id): ?JobHeadcount;
    public function findByCode(string $code): ?JobHeadcount;
    public function countByJob(int $jobId): int;
    public function allByJob(int $jobId): Collection;
    public function childrenOf(int $parentId): Collection;
}
