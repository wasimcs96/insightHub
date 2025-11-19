<?php
namespace App\Services\Job;

use App\Models\Job;
use App\Models\JobHeadcount;
use Illuminate\Support\Facades\DB;

class JobService
{
    public static function getDescendantIdsUsingCTE($job_id)
    {
        $descendants = DB::select("
            WITH RECURSIVE descendants AS (
                SELECT id
                FROM jobs
                WHERE id = ?

                UNION ALL

                SELECT j.id
                FROM jobs j
                INNER JOIN descendants d ON j.superior_id = d.id
            )
            SELECT id FROM descendants
        ", [$job_id]);

        return collect($descendants)->pluck('id')->toArray();
    }
   
    public static function getAllDescendantIds($job)
    {
        $ids = [];

        foreach ($job->children as $child) {
            $ids[] = $child->id;
            $ids = array_merge($ids, self::getAllDescendantIds($child));
        }

        return $ids;
    }

    public static function searchSuperiorJobs(?string $query, ?int $level,$job_id = null)
    {

        $excludeIds = [];

        if ($job_id) {
            $excludeIds = self::getDescendantIdsUsingCTE($job_id);
        }

        return Job::query()
            ->where('is_primary', 0)
            ->whereHas('headcounts')
            ->whereHas('department')
            ->where('department_id', '!=', null)
            ->when($query, function ($q) use ($query) {
                $q->where('title', 'like', '%' . $query . '%');
            })
            ->when($level, function ($q) use ($level) {
                // Only include jobs with same or higher level
                $q->where('level', '>=', $level);
            })
            ->when($job_id, function ($q) use ($job_id) {
                // Exclude the specific job_id if provided
                $q->where('id', '!=', $job_id);
            })
            ->when(!empty($excludeIds), function ($q) use ($excludeIds) {
                $q->whereNotIn('id', $excludeIds);
            })
            ->orderBy('level')
            ->select('id', 'title','level','department_id')
            ->limit(10)
            ->get()
            ->map(function ($job) {
                return [
                    'id' => $job->id,
                    'text' => $job->title.' ('.$job?->department?->name.')' .' - Level ' . $job->level . '',
                    'level' => $job->level,
                    'department_id' => $job->department_id,
                ];
            });
    }

    public function generateHeadcountCodes(string $positionCode, int $jobDescriptionId, int $count = 3): array
    {
        $codes = [];

        for ($i = 0; $i < $count; $i++) {
            $codes[] = $this->generateHeadcountCode($positionCode, $jobDescriptionId);
        }

        return $codes;
    }

    public function generateHeadcountCode(string $positionCode, int $jobDescriptionId): string
    {
        // Sanitize: remove unwanted characters and capitalize
        $positionCode = strtoupper(preg_replace('/[^A-Z0-9]/', '', $positionCode));

        // Generate the headcount code in the format "POSITIONCODE-JOBDESCRIPTIONID-XX" where XX is the sequence number
        // Check if any headcount codes already exist for the same job description ID
        $existingCodes = JobHeadcount::withTrashed()->where('job_id', $jobDescriptionId)
            ->where('headcount_code', 'LIKE', "{$positionCode}-{$jobDescriptionId}-%")
            ->pluck('headcount_code')
            ->toArray();

        // Extract the sequence numbers from the existing headcount codes
        $usedSequences = collect($existingCodes)->map(function ($code) use ($positionCode, $jobDescriptionId) {
            preg_match("/{$positionCode}-{$jobDescriptionId}-(\d{2})$/", $code, $matches);
            return isset($matches[1]) ? intval($matches[1]) : null;
        })->filter()->sort()->values()->toArray();

        // Find the next available sequence number starting from 1
        $nextSequence = 1;
        while (in_array($nextSequence, $usedSequences)) {
            $nextSequence++;
        }

        // Pad the sequence number (e.g., 1 becomes "01")
        $nextSequencePadded = str_pad($nextSequence, 2, '0', STR_PAD_LEFT);

        // Final headcount code
        return "{$positionCode}-{$jobDescriptionId}-{$nextSequencePadded}";
    }

}
