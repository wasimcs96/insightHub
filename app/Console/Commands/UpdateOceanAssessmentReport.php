<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Job;
use App\Helpers\AssessmentHelper;
use App\Helpers\HelperFunctions;
use App\Helpers\NewAssessmentHelper;
use App\Models\JobOpeningApplication;
use App\Models\JobOpening;

class UpdateOceanAssessmentReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'assessment:update-ocean-reports {user_id} {--job_opening_id=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update the OCEAN assessment report for a specific user';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Retrieve the user_id argument
        $user_id = $this->argument('user_id');
        $stats = HelperFunctions::getStats();
        // Fetch master descriptors from the database
        $descriptors = DB::table('master_descriptors')->get();

        // $this->info("Starting update for OCEAN assessment report for User ID: {$user_id}");

        // Your logic for updating the OCEAN assessment report for the given user_id

        $this->info('OCEAN assessment report updated successfully.');
        $user = User::find($user_id);
        // $users = User::where('is_personality_motivation_completed',1)->where('is_work_interest_completed',1)
        // ->where('is_cognitive_ability_completed',1)->where('id', '>', 2473)->whereIn('role_name', ['employee', 'candidate'])->get();

        // foreach ($users as $user) {
            if ($user_id) {
                $job_opening_id = $this->option('job_opening_id');
                $job = [];
                if($job_opening_id) {
                    $position_id = JobOpening::where('id', $job_opening_id)->value('job_id');
                    $job = Job::find($position_id);
                } else {
                    $position_id = $user->position_id;
                    $job = Job::find($position_id);
                }

                $user_type = $user->role_name ?? 'employee';
                $descriptors = $descriptors->where('user_type', $user_type);
                $this->info("Starting update for OCEAN assessment report for User ID: {$user_id}");
                NewAssessmentHelper::updateOceanResults($user_id, $user, $job_opening_id, $job, $position_id, $user_type, $descriptors, $stats);
            } 
            else {
                $this->info('I am in else');
            }
        // }

        return 0;
    }

    // Function to calculate z-score
    private function calculateZScore($score, $mean, $sd) {
        return ($score - $mean) / $sd;
    }

    // Function to convert z-score to percentage using the normal CDF
    private function zScoreToPercent($z) {
        // Constants
        $sqrt2 = sqrt(2);
    
        // Calculate the cumulative distribution function (CDF) for a normal distribution
        $percent = (1 + $this->erf($z / $sqrt2)) / 2;
    
        // Convert to percentage
        return round($percent*100,4);
    }
    
    private function erf($x) {
        // Constants for approximation
        $a1 =  0.254829592;
        $a2 = -0.284496736;
        $a3 =  1.421413741;
        $a4 = -1.453152027;
        $a5 =  1.061405429;
        $p  =  0.3275911;
    
        // Save the sign of x
        $sign = ($x >= 0) ? 1 : -1;
        $x = abs($x);
    
        // Approximation formula
        $t = 1.0 / (1.0 + $p * $x);
        $y = 1.0 - ((((($a5 * $t + $a4) * $t) + $a3) * $t + $a2) * $t + $a1) * $t * exp(-$x * $x);
    
        return $sign * $y;
    }

    private function transactionInDb($user_id,$assessment_type,$result_type,$dimension,$score, $z_score,$percentage,$level,$level_description) {
            
        // Prepare data for insertion or update
        $data = [
            'user_id' => $user_id,
            // 'job_id' => $position_id,
            'assessment_type' => $assessment_type,
            'result_type' => $result_type,
            'name' => $dimension,
            'slug' => Str::slug($dimension),
            'code' => substr($dimension, 0, 1),
            'score' => $score,
            'z_score' => $z_score,
            'percentage' => $percentage,
            'level' => $level,
            'level_description' => $level_description,
            'created_at' => now(),
            'updated_at' => now(),
        ];

        // Check if the result already exists for the user and dimension
        $existingResult = DB::table('user_results')
            ->where('user_id', $user_id)
            ->where('assessment_type', $assessment_type)
            ->where('result_type', $result_type)
            ->where('name', $dimension)
            ->first();

        if ($existingResult) {
            // Update existing record
            DB::table('user_results')
                ->where('id', $existingResult->id)
                ->update($data);
        } else {
            // Insert new record
            DB::table('user_results')->insert($data);
        }
    }

    private function getLevel($percentage, $level_type = 'percentile') {
        $level = 1;
        $level_description = '';
    
        // Determine the level type logic
        switch ($level_type) {
            case 'z_score':
                // Logic for z-score (you can adjust this as necessary for Z-score scale)
                if ($percentage > 2) {
                    $level_description = 'very high';
                    $level = 5;
                } elseif ($percentage > 1 && $percentage <= 2) {
                    $level_description = 'high';
                    $level = 4;
                } elseif ($percentage >= -1 && $percentage <= 1) {
                    $level_description = 'moderate';
                    $level = 3;
                } elseif ($percentage >= -2 && $percentage < -1) {
                    $level_description = 'low';
                    $level = 2;
                } else {
                    $level_description = 'very low';
                    $level = 1;
                }
                break;
    
            case 'raw_score':
                // Logic for raw score (you can adjust thresholds as necessary)
                if ($percentage > 85) {
                    $level_description = 'very high';
                    $level = 5;
                } elseif ($percentage > 60 && $percentage <= 85) {
                    $level_description = 'high';
                    $level = 4;
                } elseif ($percentage > 40 && $percentage <= 60) {
                    $level_description = 'moderate';
                    $level = 3;
                } elseif ($percentage >= 19 && $percentage <= 40) {
                    $level_description = 'low';
                    $level = 2;
                } else {
                    $level_description = 'very low';
                    $level = 1;
                }
                break;

            case 'skill':
                // Logic for z-score (you can adjust this as necessary for Z-score scale)
                if ($percentage > 2) {
                    $level_description = 'advance';
                    $level = 3;
                } elseif ($percentage > 1 && $percentage <= 2) {
                    $level_description = 'intermediate';
                    $level = 2;
                } elseif ($percentage > 0 && $percentage <= 1) {
                    $level_description = 'basic';
                    $level = 1;
                } else {
                    $level_description = 'under';
                    $level = 0;
                }
                break;
            case 'percentile':
            default:
                // Default case for percentile (percentage-based)
                if ($percentage > 98) {
                    $level_description = 'very high';
                    $level = 5;
                } elseif ($percentage > 84 && $percentage <= 98) {
                    $level_description = 'high';
                    $level = 4;
                } elseif ($percentage >= 16 && $percentage <= 84) {
                    $level_description = 'moderate';
                    $level = 3;
                } elseif ($percentage >= 2 && $percentage < 16) {
                    $level_description = 'low';
                    $level = 2;
                } else {
                    $level_description = 'very low';
                    $level = 1;
                }
                break;
        }
    
        return [$level, $level_description];
    }

    private function getDescriptor($assessmentType, $resultType, $dimension, $userScoreLevel, $descriptors) {
        $descriptor = $descriptors->where('assessment_type', $assessmentType)->where('result_type', $resultType)->where('slug',Str::slug($dimension))->where('user_score_level', $userScoreLevel)->first() ?? '';
        $description = $descriptor->analysis ?? '';
        $descriptor_id = $descriptor->id ?? '';

        return [$description, $descriptor_id];
    }

    private function getExistingResults($user_id, $assessmentType, $resultType, $keyBy='name', $numberOfData='single', $jobId='') {
        switch ($numberOfData) {
            case 'all':
                return  DB::table('user_results')
                            ->where('user_id', $user_id)
                            ->where('assessment_type', $assessmentType)
                            ->where('result_type', $resultType)
                            ->get()
                            ->keyBy($keyBy); // Index by 'name' for easy lookup

            case 'single':
            default:
            
                    return DB::table('user_results')
                    ->where('user_id', $user_id)
                    ->when($jobId, function ($query, $jobId) {
                        return $query->where('job_id', $jobId);
                    })
                    ->where('assessment_type', $assessmentType)
                    ->where('result_type', $resultType)
                    ->first();
        
        }
    }
    
    private function prepareData($user_id, $job_id='', $assessmentType, $resultType, $dimension, $descriptor_id, $description, $score, $z_score, $percentage, $level, $level_description) {
        return [
            'user_id' => $user_id,
            'job_id' => $job_id,
            'assessment_type' => $assessmentType,
            'result_type' => $resultType,
            'name' => $dimension,
            'slug' => Str::slug($dimension),
            'code' => substr($dimension, 0, 1),
            'descriptor_id' => $descriptor_id,
            'description' => $description,
            'score' => $score,
            'z_score' => $z_score,
            'percentage' => $percentage,
            'level' => $level,
            'level_description' => $level_description,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    private function bulkTransactionsInDb($inserData, $updateData) {
            // Bulk insert new records
            if (!empty($insertData)) {
                DB::table('user_results')->insert($insertData);
            }

            // Bulk update existing records
            if (!empty($updateData)) {
                foreach ($updateData as $updateItem) {
                    $id = $updateItem['id'];
                    unset($updateItem['id']); // Remove the ID from the update data array

                    // Update the record by ID
                    DB::table('user_results')->where('id', $id)->update($updateItem);
                }
            }
    }

    private function singleTransactionInDb($existingData, $data) {
        if ($existingData) {
            // Update existing record
            DB::table('user_results')
                ->where('id', $existingData->id)
                ->update($data);
        } else {
            // Insert new record
            DB::table('user_results')->insert($data);
        }
    }
}
