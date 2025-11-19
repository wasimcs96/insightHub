<?php
namespace App\Modules\Headcounts\Queries\Headcount;

use App\Modules\Headcounts\Services\JobHeadcountService;

class GetByJobQuery
{
    public function __construct(protected JobHeadcountService $service) {}

    public function __invoke(int $jobId)
    {
        return $this->service->allByJob($jobId);
    }
}
