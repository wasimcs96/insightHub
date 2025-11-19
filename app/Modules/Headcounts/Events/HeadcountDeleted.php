<?php
namespace App\Modules\Headcounts\Events;

use App\Models\JobHeadcount;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class HeadcountDeleted
{
    use Dispatchable, SerializesModels;

    public JobHeadcount $headcount;

    public function __construct(JobHeadcount $headcount)
    {
        $this->headcount = $headcount;
    }
}
