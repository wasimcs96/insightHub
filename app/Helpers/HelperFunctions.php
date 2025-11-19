<?php

namespace App\Helpers;

use App\Models\Job;
use App\Models\JobOpeningApplication;
use Illuminate\Support\Facades\Mail;
use App\Models\Template;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
class HelperFunctions
{

    public static function sendEmail($to, $templateType, $data)
{
    try {
        // Ensure the mailable class name is correctly constructed
        $mailableClass = 'App\Mail\Send' . ucfirst($templateType) . 'Email';  // Capitalize templateType to map to the correct class

        // Call sendGlobalEmail to fetch template and send email
        return self::sendGlobalEmail($to, $templateType, $data, $mailableClass);
    } catch (\Exception $e) {
        // Handle exception
        \Log::error('Email sending failed: ' . $e->getMessage());
        return false;
    }
}

// Global email function
public static function sendGlobalEmail($to, $templateType, $data)
{
    try {
        // Retrieve the email template from the database based on type
        $template = Template::where('type', $templateType)->first();
        
        
        if (!$template) {
            throw new \Exception('Email template not found for type: ' . $templateType);
        }

        // Get subject and message from the template
        $subject = $template->subject;
        $message = $template->email_content;

        // Prepare the replacements for placeholders in the subject and message
        $replacements = self::prepareReplacements($data);

        // Replace the placeholders in subject and message dynamically
        foreach ($replacements as $placeholder => $value) {
            $subject = str_replace($placeholder, $value, $subject);
            $message = str_replace($placeholder, $value, $message);
        }

        // Send email using the sendEmail function with the mailable class
        self::sendEmailWithMailable($to, $subject, $message, 'App\Mail\SendOtpEmail', $data);

    } catch (\Exception $e) {
        \Log::error('Email sending failed: ' . $e->getMessage());
        return false;
    }

    return true;
}



// Send email using mailable class
public static function sendEmailWithMailable($to, $subject, $message, $mailableClass, $data)
{
    try {
        $mailableClassName = $mailableClass;
        // Directly pass the message and subject into the email
        Mail::to($to)->send(new $mailableClassName($subject, $message, $data));
    } catch (\Exception $e) {
        \Log::error('Email sending failed with mailable: ' . $e->getMessage());
    }
}

// In HelperFunctions.php
public static function prepareReplacements($data)
{
    $replacements = [];

    // Iterate over the data array and create placeholders for each key
    foreach ($data as $key => $value) {
         $formattedKey = ucwords(str_replace('_', ' ', $key));
        $replacements["[$formattedKey]"] = $value;
    }

    return $replacements;
}




    // public static function sendEmails($tos, $subject, $message, $mailableClass, $data)
    // {
    //     try {
    //         $mailableClassName = 'App\Mail\\' . $mailableClass;
    //         foreach($tos as $to) {
    //             $data['email'] = $to;
    //             Mail::to($to)->send(new $mailableClassName($subject, $message, $data));
    //         }

    //     } catch (\Exception $e) {
    //         // Handle exception
    //         \Log::error('Email sending failed: ' . $e->getMessage());
    //     }
    // }

    public static function sendEmails($tos, $mailableClass, $data)
{
    \Log::info('Email sending started.');
    
    try {
        if (is_array($tos) && count($tos) > 0) {
            foreach ($tos as $to) {
                // Ensure $data is always an array
                $data = is_array($data) ? $data : [];
                // Add recipient email to data array
                $data['email'] = $to;

                // Call the sendEmail function with the 6 arguments
                self::sendEmail($to, $mailableClass, $data);
            }
        } else {
            throw new \Exception('No recipients found or invalid recipients array.');
        }
    } catch (\Exception $e) {
        \Log::error('Email sending failed: ' . $e->getMessage());
    }

    \Log::info('Email sending completed.');
}





    public static function createShortForm($inputString) {
        // Split the input string into words
        $words = explode(" ", $inputString);

        // Initialize an empty string to store the initials
        $initials = '';

        // Loop through each word and append the first character (capitalized) to the initials string
        foreach ($words as $word) {
            $initials .= strtoupper(substr($word, 0, 1));
        }

        // Concatenate the initials to form the short form
        $shortForm = $initials;

        return $shortForm;
    }

    public static function formatCreatedAtDate($date)
    {
        return Carbon::parse($date)->format('d M Y');
    }

    public static function getEmploymentType($value)
    {
        $key = array_search($value, config('helpers.employment_type'));

        if ($key !== false) {
            return ucwords(str_replace('_', ' ', $key)); // Convert "part_time" → "Part Time"
        }

        return 'Unknown';
    }

    public static function getEducationLevel($id)
    {
        return config('helpers.education_level')[$id] ?? 'Unknown';
    }

    public static function sendEmailOnStatusChange($applicationIds, $status)
    {
        
        $jobOpeningApplications = JobOpeningApplication::whereIn('id', $applicationIds)->get();

        if ($jobOpeningApplications->isEmpty()) {
            return false;
        }

        $to = $jobOpeningApplications->pluck('external_user_email')->filter()->unique()->toArray();

        // Get the first available company name safely
        $firstApplication = $jobOpeningApplications->first();
        $companyName = auth()->user()->userCompany()->first()->name;

        $templateType = 'send_application_status_change_email';

        $data = [
            'Status' => config('helpers.application_status')[$status] ?? '',
            'Company Name' => $companyName
        ];

        self::sendEmails($to, $templateType, $data);

        return true;
    }

    public static function countDaysBetween($startDate, $endDate)
    {
        if (!$startDate || !$endDate) {
            return null;
        }

        $start = \Carbon\Carbon::parse($startDate);
        $end = \Carbon\Carbon::parse($endDate);

        return $start->diffInDays($end);
    }

    public static function getChildrenWithJD(int $jobId): array
    {
        $data = DB::table('jobs')
        ->join('jobs as children', 'jobs.id', '=', 'children.superior_id')
        ->join('departments', 'children.department_id', '=', 'departments.id')
        ->select('children.id', 'children.title', 'children.department_id', 'departments.name as department')
        ->where('jobs.id', $jobId)
        ->where('children.id', '!=', $jobId) 
        ->where('children.superior_id','!=',null)
        ->get()
        ->toArray();
    
        // return Job::with('children.department')
        //     ->findOrFail($jobId)
        //     ->children
        //     ->map(fn($c) => [
        //         'id'            => $c->id,
        //         'title'         => $c->title,
        //         'department_id' => $c->department_id,
        //         'department'    => $c->department->name ?? '',
        //     ])->toArray();
        return $data;
    }


    public static function sendForgetEmail($to, $subject, $message, $mailableClass, $data)
    {
       
        try {
            $mailableClassName = 'App\Mail\\' . $mailableClass;
            Mail::to($to)->send(new $mailableClassName($subject, $message, $data));
        } catch (\Exception $e) {
            // Handle exception
            \Log::error('Email sending failed: ' . $e->getMessage());
        }
    }

    // Function to calculate z-score
    public static function calculateZScore($score, $mean, $sd) {
        return ($score - $mean) / $sd;
    }

    // Function to convert z-score to percentage using the normal CDF
    public static function zScoreToPercent($z) {
        // Constants
        $sqrt2 = sqrt(2);
    
        // Calculate the cumulative distribution function (CDF) for a normal distribution
        $percent = (1 + self::erf($z / $sqrt2)) / 2;
    
        // Convert to percentage
        return round($percent*100,4);
    }
    
    public static function erf($x) {
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

    public static function getLevel($percentage, $level_type = 'percentile') {
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

    public static function getDescriptor($assessmentType, $resultType, $dimension, $userScoreLevel, $descriptors) {
        $descriptor = $descriptors->where('assessment_type', $assessmentType)->where('result_type', $resultType)->where('slug',Str::slug($dimension))->where('user_score_level', $userScoreLevel)->first() ?? '';
        $description = $descriptor->analysis ?? '';
        $descriptor_id = $descriptor->id ?? '';

        return [$description, $descriptor_id];
    }

    public static function getExistingResults($user_id, $assessmentType, $resultType, $keyBy='name', $numberOfData='single', $jobId='') {
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
    
    public static function prepareData($user_id, $assessmentType, $resultType, $dimension, $descriptor_id, $description, $score, $z_score, $percentage, $level, $level_description, $job_id='') {
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

    public static function bulkTransactionsInDb($insertData, $updateData) {
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

    public static function singleTransactionInDb($existingData, $data) {
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

    public static function getStats() {
        $phPanels = ['base_ph_dev', 'eei_dev', 'eei_uat', 'eei_prod', 'eight8_dev', 'eight8_uat', 'jc_uat', 'eight8_prod'];
        $myPanels = ['airasia_dev', 'airasia_uat', 'airasia_prod'];
        
        if (in_array(env('DB_DATABASE'), $phPanels)) { 
            $stats = config('helpers.stats')['ph'];
        } elseif (in_array(env('DB_DATABASE'), $myPanels)) { 
            $stats = config('helpers.stats')['my'];
        } else {
            $stats = config('helpers.stats')['all'];
        }

        return $stats;
    }

}
