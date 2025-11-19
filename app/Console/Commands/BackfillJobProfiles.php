<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Models\Job;
use App\Models\JobProfile;

class BackfillJobProfiles extends Command
{
    protected $signature = 'jobs:backfill-profiles';
    protected $description = 'Create/link job_profiles for jobs (is_primary=0, job_profile_id IS NULL)';

    public function handle(): int
    {
        Job::query()
            ->whereNull('job_profile_id')
            ->whereNotNull('job_type')
            ->where('is_primary', 0)
            ->orderBy('id')
            ->chunkById(200, function ($jobs) {
                foreach ($jobs as $job) {
                    DB::transaction(function () use ($job) {
                        // lock current row to avoid races
                        /** @var Job $j */
                        $j = Job::whereKey($job->id)->lockForUpdate()->first();

                        // guards (don’t touch is_primary=1 or already linked jobs)
                        if ($j->is_primary != 0 || !is_null($j->job_profile_id)) {
                            return;
                        }

                        // 1) pick or generate code
                        $code = trim((string) $j->code);
                        if ($code === '') {
                            $code     = $this->generateUniqueAaCode();
                            $j->code  = $code;
                        }

                        if (empty($j->position_code) || Job::where('position_code', $code)->exists()) {
                            // Generate a unique version (e.g., append a counter)
                            $uniqueCode = $code;
                            $counter = 1;
                            while (Job::where('position_code', $uniqueCode)->exists()) {
                                $uniqueCode = $code . '-' . $counter++;
                            }
                            $j->position_code = $uniqueCode;
                        } else {
                            $j->position_code = $code;
                        }


                        // 2) find or create profile by aa_job_profile_id
                        $profile = JobProfile::where('aa_job_profile_id', $code)->first();
                        if (!$profile) {
                            $profile = new JobProfile();
                            $profile->aa_job_profile_id = $code;
                            $profile->department_id     = $j->department_id;
                            $profile->name              = $j->title ?: ('Job #'.$j->id);
                            $profile->description       = $j->description;
                            $profile->save();
                        }

                        // 3) link job -> profile
                        $j->job_profile_id = $profile->id;
                        $j->save();
                    });
                }
            });

        $this->info('Backfill completed.');
        return self::SUCCESS;
    }

    /**
     * Generate a 10-char code: First A–Z, then 9 chars [a-z0-9].
     * Ensures uniqueness against job_profiles.aa_job_profile_id.
     */
    protected function generateUniqueAaCode(): string
    {
        $chars = 'abcdefghijklmnopqrstuvwxyz0123456789';

        do {
            $first = chr(random_int(65, 90)); // A-Z
            $rest  = '';
            for ($i = 0; $i < 9; $i++) {
                $rest .= $chars[random_int(0, strlen($chars) - 1)];
            }
            $code = $first . $rest;
        } while (JobProfile::where('aa_job_profile_id', $code)->exists());

        return $code;
    }
}
