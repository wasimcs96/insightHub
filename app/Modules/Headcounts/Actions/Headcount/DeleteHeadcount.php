<?php
namespace App\Modules\Headcounts\Actions\Headcount;

use App\Modules\Headcounts\Services\JobHeadcountService;

class DeleteHeadcount
{
    public function __construct(protected JobHeadcountService $service) {}

    public function __invoke(int $id)
    {
        return $this->service->delete($id);
    }
}
