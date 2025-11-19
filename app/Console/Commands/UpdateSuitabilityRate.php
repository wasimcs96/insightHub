<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\JobOpeningApplication;
use App\Models\JobOpening;
use App\Models\JobOpeningSuitabilityRateSetting;

class UpdateSuitabilityRate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'job-opening:update-suitability-rate {job_opening_application_id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update the suitability rate for a specific user';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Retrieve the job_opening_application_id argument
        $job_opening_application_id = $this->argument('job_opening_application_id');

        $jobApplication = JobOpeningApplication::with(['jobOpening', 'user'])->find($job_opening_application_id);
        if (!$jobApplication) {
            $this->error('Job application not found.');
            return 1;
        }

        $jobOpening = $jobApplication->jobOpening;
        $user = $jobApplication->user;
        $suitabilityRateCriterias = JobOpeningSuitabilityRateSetting::where('job_opening_id', $jobOpening->id)->get();

        $totalCriteriaCount = $suitabilityRateCriterias->count();
        $suitabilityRate = 0;

        foreach ($suitabilityRateCriterias as $criteria) {
            $weightage = $criteria->weightage / 100; // Calculate weightage once
            switch ($criteria->criteria_id) {
                case 1: // Education Program
                    $suitabilityRate += ($user->education_program_id == $jobOpening->education_program_id)
                        ? 100 * $weightage
                        : 20 * $weightage;
                    break;

                case 2: // Education Level
                    if ($user->education_level >= $jobOpening->education_level_id) {
                        $suitabilityRate += 100 * $weightage;
                    } else {
                        $difference = abs($user->education_level - $jobOpening->education_level_id);
                        $suitabilityRate += ($difference > 3) 
                            ? 25 * $weightage 
                            : 50 * $weightage;
                    }
                    break;

                case 3: // Salary
                    if ($jobApplication->expected_salary <= $jobOpening->salary) {
                        $suitabilityRate += 100 * $weightage;
                    } else {
                        $difference = abs($jobApplication->expected_salary - $jobOpening->salary);
                        $percentage = ($difference / $jobOpening->salary) * 100;

                        if ($percentage <= 10) {
                            $suitabilityRate += 85 * $weightage;
                        } elseif ($percentage <= 20) {
                            $suitabilityRate += 75 * $weightage;
                        } elseif ($percentage <= 30) {
                            $suitabilityRate += 50 * $weightage;
                        } elseif ($percentage <= 40) {
                            $suitabilityRate += 30 * $weightage;
                        } else {
                            $suitabilityRate += 20 * $weightage;
                        }
                    }
                    break;

                case 4: // Work Experience
                    $experienceDifference = abs($user->year_of_experience_in_it_sector - $jobOpening->work_experience);
                    if ($user->year_of_experience_in_it_sector >= $jobOpening->work_experience) {
                        $suitabilityRate += 100 * $weightage;
                    } elseif ($experienceDifference < 1) {
                        $suitabilityRate += 100 * $weightage;
                    } elseif ($experienceDifference <= 3) {
                        $suitabilityRate += 85 * $weightage;
                    } elseif ($experienceDifference <= 5) {
                        $suitabilityRate += 70 * $weightage;
                    } elseif ($experienceDifference <= 8) {
                        $suitabilityRate += 50 * $weightage;
                    } else {
                        $suitabilityRate += 30 * $weightage;
                    }
                    break;
            }
        }

        // Calculate and save the suitability rate
        $jobApplication->suitability_rate = $suitabilityRate / $totalCriteriaCount;
        $jobApplication->save();
        $this->info('Suitability rate for the user updated.');

        return 0;

    }

}
