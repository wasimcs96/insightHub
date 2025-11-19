<?php
namespace App\Modules\Headcounts\Actions\Headcount;

use App\Modules\Headcounts\Services\JobHeadcountService;

class CreateHeadcount
{
    public function __construct(protected JobHeadcountService $service) {}

    public function __invoke(array $data)
    {
        return $this->service->create($data);
    }
}
