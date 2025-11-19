<?php

namespace App\Services;

use App\Models\JobHeadcount;
use App\Models\Job;
use Illuminate\Support\Facades\DB;

class JobHeadcountValidationService
{
    /**
     * Validate Job Headcount data.
     *
     * @param array $updates
     * @return array
     */
    public function validateJobHeadcounts(array $updates)
    {
        $errors = [];

        // Validate each update item
        foreach ($updates as $item) {
            if ($item->action == 'modify_node' && $item->node->data->is_new == true && $item->node->modified_fields->is_deleted == false) {
                // Validate headcount_code
                $headcountCode = $item->node->id;
                $headcountExists = JobHeadcount::where('headcount_code', $headcountCode)->exists();

                if ($headcountExists) {
                    $errors[] = "Headcount code '{$headcountCode}' already exists in the system.";
                }

                // Validate parent_id in the job_headcounts table
                $parentId = $item->parentId;
                if ($parentId) {
                    $parentExists = JobHeadcount::find($parentId);
                    if (!$parentExists) {
                        $errors[] = "Parent ID '{$parentId}' does not exist.";
                    }
                }

                // Validate job_id in the jobs table
                $jobId = $item->node->data->job_id;
                $jobExists = Job::find($jobId);
                if (!$jobExists) {
                    $errors[] = "Job ID '{$jobId}' does not exist.";
                }
            }
        }

        return $errors;
    }

    /**
     * Batch validation method for large datasets.
     *
     * @param array $updates
     * @return void
     */
    public function validateUpdates(array $updates)
    {
        // Group validation by job_id for efficiency
        $parentIds = array_map(function($item) {
            // Assuming each $item is an object with a nested 'node' structure
            return isset($item->node->data->parent_id) ? $item->node->data->parent_id : null;
        }, $updates);

        $headcountCodes = array_map(function($item) {
            // Assuming each $item is an object with a nested 'node' structure
            return isset($item->node->id) ? $item->node->id : null;
        }, $updates);
        

        $jobs = array_map(function($item) {
            // Assuming each $item is an object with a nested 'node' structure
            return isset($item->node->data->job_id) ? $item->node->data->job_id : null;
        }, $updates);

        // Query job_headcounts by the job_ids that are being updated
        $jobHeadcounts = JobHeadcount::whereIn('id', $parentIds)->get()->keyBy('id');
    
        $jobHeadcountsCode = JobHeadcount::whereIn('headcount_code', $headcountCodes)->get()->keyBy('headcount_code');

        $jobExists = Job::whereIn('id', $jobs)->get()->keyBy('id');        
        
        // Iterate over the updates and validate each one
        $errors = [];
        foreach ($updates as $item) {
            // Validate headcount_code
            if ($item->node->data->is_new == true && $item->node->modified_fields->is_deleted == false) {
                $headcountCode = $item->node->id;
                if ($jobHeadcountsCode->has($headcountCode)) {
                    $errors[] = "Headcount code '{$headcountCode}' already exists.";
                }

                // Validate parent node existence
                $parentId = $item->node->data->parent_id;
                if ($parentId && !$jobHeadcounts->has($parentId)) {
                    $errors[] = "Parent ID '{$parentId}' does not exist.";
                }

                // Validate job_id and check if it exists in the jobs table
                $jobId = $item->node->data->job_id;
                if ($jobId && !$jobExists->has($jobId)) {
                    $errors[] = "Job ID '{$jobId}' does not exist.";
                }
            }
        }

        return $errors;
    }
}
