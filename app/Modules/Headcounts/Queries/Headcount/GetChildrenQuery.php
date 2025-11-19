<?php
namespace App\Modules\Headcounts\Queries\Headcount;

use App\Modules\Headcounts\Services\JobHeadcountService;

class GetChildrenQuery
{
    public function __construct(protected JobHeadcountService $service) {}

    public function __invoke(int $parentId)
    {
        return $this->service->getChildren($parentId);
    }
}
