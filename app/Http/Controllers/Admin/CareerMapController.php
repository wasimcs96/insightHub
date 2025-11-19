<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Job; 
use App\Models\JobSkill; 
use App\Models\MasterEducationLevel;

class CareerMapController extends Controller
{
    public function careerMapDetails(Request $request)
    {
        $jobTitle = $request->input('job_title'); // Get job title from the request
        
        // Fetch job details from the database based on job title
        $job = Job::where('title', $jobTitle)->first();

        // Check if job exists
        if (!$job) {
            return response()->json(['error' => 'Job not found'], 404);
        }

        // Fetch job skills if job exists
        $jobSkills = JobSkill::where('job_id', $job->id)
            ->select('title', 'level')
            ->get();

        // Get the education level name from the MasterEducationLevel model
        $educationLevel = MasterEducationLevel::find($job->education_level); // Get education level based on the ID in Job

        // Check if education level exists, otherwise default to 'N/A'
        $educationLevelName = $educationLevel ? $educationLevel->name : 'N/A';

        // Extract relevant training values from the JSON array
        $relevantTraining = collect(json_decode($job->relevant_training))
            ->pluck('value')
            ->implode(', ');  // Join them into a comma-separated string
           
 

        // // Prepare the skills with levels
        $skillsWithLevels = $jobSkills->map(function ($skill) {
            return $skill->title.' ' . '<svg xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em" viewBox="0 0 24 24" style="margin-left: 2px;">
	                                    <path fill="#f7941c" d="m5.825 21l1.625-7.025L2 9.25l7.2-.625L12 2l2.8 6.625l7.2.625l-5.45 4.725L18.175 21L12 17.275z" />
                                        </svg>' . $skill->level ;  // Format as "Skill Name (Level)"
        })->toArray();  // Return as an array instead of a string
    

        // Return the job data as JSON
        return response()->json([
            'job-title'  => $job->jobTitle ?? '',
            'description' => $job->description ?? '',
            'work_experience' => $job->work_experience ?? '',
            'education_level' => $educationLevelName ?? '',
            'relevant_training' => $relevantTraining ?? '',
            'skills' => $skillsWithLevels ?? '', // Return skills as an array
        ]);
    }
}
