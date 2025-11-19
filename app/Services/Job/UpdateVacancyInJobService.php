<?php

namespace App\Services\Job;

use App\Models\Job;
use App\Models\JobOpening;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UpdateVacancyInJobService
{

    public function updateVacancyOnJobEdit($job_id)
    {
        DB::beginTransaction();
        try {
            $job = Job::find($job_id);
            $totalEmployees = User::where('position_id', $job_id)->count();
            $totalVacancies = $job->heads - $totalEmployees;
            if ($totalVacancies < 0) {
                $totalVacancies = 0;
            }
            $job->vacancy = $totalVacancies;
            
            $job->save();

            try {
                if ($job->vacancy == 0) {
                    $jobOpenings = JobOpening::where('position_id', $job_id)->update([
                        'status' => 4
                    ]);
                }
            } catch (\Throwable $th) {
                //throw $th;
            }

            
            DB::commit();
            return $job;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function updateVacancyOnEmployeeAddOrEditIfPositionChanged($job_id)
    {
        DB::beginTransaction();
        try {
            $job = Job::find($job_id);
            $totalVacancies = $job->vacancy - 1;
            if ($totalVacancies < 0) {
                $totalVacancies = 0;
            }
            $job->vacancy = $totalVacancies;
            
            $job->save();

            if ($job->vacancy == 0) {
                $jobOpenings = JobOpening::where('position_id', $job_id)->update([
                    'status' => 4
                ]);
            }
            DB::commit();
            return $job;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

}
