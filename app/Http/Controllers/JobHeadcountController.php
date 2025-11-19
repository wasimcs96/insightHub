<?php
// app/Http/Controllers/JobHeadcountController.php

namespace App\Http\Controllers;

use App\Contracts\JobHeadcountRepositoryInterface;
use App\Helpers\HelperFunctions;
use App\Helpers\MainHelper;
use App\Models\Job;
use App\Models\JobHeadcount;
use App\Models\JobOpening;
use App\Models\JobOpeningApplication;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Throwable;

class JobHeadcountController extends Controller
{
    protected JobHeadcountRepositoryInterface $jobHeadcountRepository;

    public function __construct(JobHeadcountRepositoryInterface $jobHeadcountRepository)
    {
        $this->jobHeadcountRepository = $jobHeadcountRepository;
    }

    public function getVacantHeadcounts(Request $request): JsonResponse
    {
        
        $request->validate([
            'job_id' => 'required|integer|exists:jobs,id'
        ]);

        try {
            $vacantHeadcounts = $this->jobHeadcountRepository
                ->getVacantHeadcountsFormatted($request->job_id);

            return response()->json([
                'success' => true,
                'data' => $vacantHeadcounts,
                'count' => $vacantHeadcounts->count()
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch vacant headcounts: ' . $e->getMessage()
            ], 500);
        }
    }

    // public function convertToEmployee(Request $request): JsonResponse
    // {
    //     // If you soft-delete users, ensure uniqueness excludes deleted rows
    //     $data = $request->validate([
    //         'user_id'       => ['required','integer','exists:users,id'],
    //         'headcount_id'  => ['required','integer','exists:job_headcounts,id'],
    //         'employee_id'   => [
    //             'required','string',
    //             Rule::unique('users', 'employee_id') // drop whereNull if no soft-deletes
    //         ],
    //     ]);

    //     try {
    //         $headcountData = DB::transaction(function () use ($data) {
    //             // Lock the user row to avoid concurrent conversions
    //             $user = User::lockForUpdate()->findOrFail($data['user_id']);

    //             if (!empty($user->employee_id)) {
    //                 throw new \RuntimeException('User already has an employee ID.');
    //             }

    //             // This should also lock/verify the headcount is still vacant internally
    //             $assign = $this->jobHeadcountRepository->assignUserToHeadcount(
    //                 $data['headcount_id'],
    //                 $data['user_id']
    //             );

    //             if (!$assign) {
    //                 throw new \RuntimeException($assign['message'] ?? 'Failed to assign user to headcount.');
    //             }
        
                
    //             if ($user && $assign) {
    //                 $user->department_id = $assign['data']['department_id'];
    //                 $user->position_id = $assign['data']['job_id'];
    //                 $user->company_id = 3;
    //                 $user->employee_code = $data['employee_id'];
    //                 $user->save();

    //             }

    //             // Return the headcount payload for the response
    //             return $assign['headcount'] ?? null;
    //         });

    //         return response()->json([
    //             'success' => true,
    //             'message' => 'Candidate converted to employee successfully',
    //             'data'    => $headcountData,
    //         ]);
    //     } catch (\Illuminate\Database\QueryException $e) {
    //         // Handles rare race on unique employee_id (DB-level)
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Employee ID already exists or database constraint failed.',
    //         ], 409);
    //     } catch (Throwable $e) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => $e->getMessage(),
    //         ], 500);
    //     }
    // }

    public function convertToEmployee(Request $request): JsonResponse
    {
        $data = $request->validate([
    'user_id' => ['required', 'integer', 'exists:users,id'],
    'headcount_id' => ['required', 'integer', 'exists:job_headcounts,id'],
    'employee_id' => [
        'required',
        'string',
        Rule::unique('users', 'employee_code')
    ],
    'reason' => ['nullable', 'string', 'max:500'],
    'application_id' => ['required', 'exists:job_opening_applications,id'],
], [
    'employee_id.unique'     => 'This Employee ID has already been taken.',
]);

        try {
            $result = DB::transaction(function () use ($data) {
                $conversionSingle = 1;
                $jobOpeningApplication = null;
                $jobOpening = null;
                
                // Lock the user row to avoid concurrent conversions
                $user = User::lockForUpdate()->findOrFail($data['user_id']);

                if (!empty($user->employee_code)) {
                    throw new \RuntimeException('User already has an employee ID.');
                }

                // If application_id is provided, handle job opening application logic
                if (!empty($data['application_id'])) {
                    $jobOpeningApplication = JobOpeningApplication::with([
                        'jobOpening.job.department',
                        'contract',
                        'user'
                    ])->findOrFail($data['application_id']);

                    // Validate application status
                    if ($jobOpeningApplication->status != 9) {
                        throw new \RuntimeException('Only applications in the Offer Accepted stage can be converted to employees.');
                    }

                    $jobOpening = $jobOpeningApplication->jobOpening;
                    $job = $jobOpening->job;

                    // Validate job opening status
                    if ($jobOpening->status != 2) {
                        if ($jobOpening->status == 4) {
                            throw new \RuntimeException('Job Advertisement is already filled.');
                        }
                        throw new \RuntimeException('Job Advertisement is not active.');
                    }

                    // Get vacant headcounts for this job using repository
                    $vacantHeadcounts = $this->jobHeadcountRepository->getVacantByJobId($job->id);
                    $vacantCount = $vacantHeadcounts->count();

                    // Check if there are any vacant positions
                    if ($vacantCount <= 0) {
                        $this->markJobAsFilledByHeadcounts($job, $jobOpening);
                        throw new \RuntimeException('No vacant positions available for this job.');
                    }

                    // Verify the provided headcount belongs to this job
                    $headcountForJob = $vacantHeadcounts->where('id', $data['headcount_id'])->first();
                    if (!$headcountForJob) {
                        throw new \RuntimeException('The selected headcount position does not belong to this job or is not vacant.');
                    }
                }

                // Get headcount details for validation and audit
                $headcount = JobHeadcount::with(['job.department', 'parent.user'])
                    ->where('id', $data['headcount_id'])
                    ->whereNull('user_id')
                    ->first();

                if (!$headcount) {
                    throw new \RuntimeException('Headcount position not found or already occupied.');
                }

                // Prepare audit metadata with correct structure
                $auditMetadata = [
                    'reason' => $data['reason'] ?? 'Employee conversion from candidate via Talent Acquisition',
                    'source' => $jobOpeningApplication ? 'Talent Acquisition - Job Application Conversion' : 'Talent Acquisition - Direct Conversion',
                    'extra' => [
                        'employee_code' => $data['employee_id'],
                        'converted_by' => Auth::user()->name ?? 'System',
                        'conversion_date' => now()->toDateTimeString(),
                        'original_status' => $jobOpeningApplication ? 'job_applicant' : 'candidate',
                        'job_opening_id' => $jobOpening->id ?? null,
                        'application_id' => $data['application_id'] ?? null
                    ]
                ];

                // Assign user to headcount using repository with proper audit trail
                $assignmentResult = $this->jobHeadcountRepository->assignUserToHeadcount(
                    $data['headcount_id'],
                    $data['user_id'],
                    $auditMetadata
                );

                if (!$assignmentResult['success']) {
                    throw new \RuntimeException($assignmentResult['message'] ?? 'Failed to assign user to headcount.');
                }

                // Update user with new employee information
                if ($user && $assignmentResult['success']) {
                    $user->department_id = $assignmentResult['data']['department_id'] ?? null;
                    $user->position_id = $assignmentResult['data']['job_id'] ?? null;
                    $user->company_id = $jobOpeningApplication->contract->company_id ?? 3;
                    $user->employee_code = $data['employee_id'];
                    $user->role_id = 1;
                    $user->role_name = 'employee';
                    
                    // Handle email updates if from job application
                    if ($jobOpeningApplication) {
                        $user->secondary_email = $user->email;
                        if ($jobOpeningApplication->contract && $jobOpeningApplication->contract->emp_official_email) {
                            $user->email = $jobOpeningApplication->contract->emp_official_email;
                        }
                    }
                    
                    $user->save();
                }

                // Handle job opening application specific logic
                if ($jobOpeningApplication) {
                    // Send conversion email
                    $this->sendConversionEmail($jobOpeningApplication);

                    // Update application status to converted
                    $jobOpeningApplication->update(['status' => 12]);

                    // Check if job opening is now filled based on remaining vacant headcounts
                    $remainingVacantHeadcounts = $this->jobHeadcountRepository->getVacantByJobId($job->id);
                    $filledApplicationsCount = JobOpeningApplication::where('status', 12)
                        ->where('job_opening_id', $jobOpening->id)
                        ->count();

                    // Mark as filled if no more vacant positions or all applications processed
                    if ($remainingVacantHeadcounts->count() == 0) {
                        $this->markJobAsFilledByHeadcounts($job, $jobOpening);
                        $conversionSingle = 2;
                    }
                }

                // Return comprehensive data including headcount assignment info
                return [
                    'user' => $user->fresh(['company', 'department']),
                    'headcount' => $assignmentResult['data'],
                    'audit_trail' => $assignmentResult['data']['audit_metadata'] ?? null,
                    'conversionSingle' => $conversionSingle,
                    'remaining_vacant_positions' => isset($job) ? $this->jobHeadcountRepository->getVacantByJobId($job->id)->count() : null,
                    'job_application_converted' => !empty($data['application_id'])
                ];
            });

            return response()->json([
                'success' => true,
                'message' => $result['job_application_converted'] 
                    ? 'Application converted to employee successfully' 
                    : 'Candidate converted to employee successfully',
                'data' => $result,
                'conversionSingle' => $result['conversionSingle']
            ]);

        } catch (\Illuminate\Database\QueryException $e) {
            $errorCode = $e->getCode();
            if ($errorCode == 23000) {
                return response()->json([
                    'success' => false,
                    'message' => 'Employee ID already exists or database constraint failed.',
                ], 409);
            }

            return response()->json([
                'success' => false,
                'message' => 'Database error occurred.',
            ], 500);

        } catch (Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    // Helper methods from convertToEmployeeAjax
    private function markJobAsFilledByHeadcounts(Job $job, JobOpening $jobOpening): void
    {
        // Update job's vacancy field to match actual vacant headcounts
        $vacantCount = $this->jobHeadcountRepository->getVacantByJobId($job->id)->count();
        
        $job->update(['vacancy' => $vacantCount]);
        
        // Mark job opening as filled
        $jobOpening->update([
            'status' => 4,
            'application_filled_date' => now()
        ]);
    }

    private function sendConversionEmail(JobOpeningApplication $jobOpeningApplication): void
    {
        try {
            $user = $jobOpeningApplication->user;
            $contract = $jobOpeningApplication->contract;
            
            $to = $jobOpeningApplication->external_user_email ?? $user->email ?? '';
            $mailableClass = 'convert_to_employee';

            $data = [
                'Official Email' => $contract->emp_official_email ?? $user->email ?? '',
                'previous_email' => $user->secondary_email ?? $user->email ?? '',
                'Employee Full Name' => $user->name ?? '',
                'Employee First Name' => $user->first_name ?? '',
                'Employee Middle Name' => $user->middle_name ?? '',
                'Employee Last Name' => $user->last_name ?? '',
                'Job Title' => $jobOpeningApplication->jobOpening->job_title ?? '',
                'Company Name' => $user->company->userCompany->name ?? '',
                'Start Date' => now()->format('Y-m-d')
            ];

            HelperFunctions::sendEmail($to, $mailableClass, $data);
            
        } catch (Throwable $e) {
            // Log error but don't fail the conversion
            \Log::error('Failed to send conversion email: ' . $e->getMessage(), [
                'application_id' => $jobOpeningApplication->id,
                'user_id' => $jobOpeningApplication->user_id
            ]);
        }
    }
}