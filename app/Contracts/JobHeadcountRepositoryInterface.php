<?php
// app/Contracts/JobHeadcountRepositoryInterface.php

namespace App\Contracts;


use Illuminate\Support\Collection;

interface JobHeadcountRepositoryInterface extends RepositoryInterface
{
    public function getVacantByJobId(int $jobId): Collection;
    public function getOccupiedByJobId(int $jobId): Collection;
    public function getHeadcountWithHierarchy(int $headcountId): ?object;
    public function getVacantHeadcountsFormatted(int $jobId): Collection;
    public function assignUserToHeadcount(int $headcountId, int $userId): array;
}