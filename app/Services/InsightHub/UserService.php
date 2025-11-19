<?php

namespace App\Services\InsightHub;

use App\Models\User;
use App\Models\UserEmployment;
use App\Models\UserPerformanceRating;
use App\Models\Role;
use App\Models\JobHeadcount;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Exception;

class UserService
{
    /**
     * Get paginated users with filters
     */
    public function getPaginatedUsers(array $filters = [], int $perPage = 10)
    {
        $query = User::query();

        // Eager load relationships, including position
        $query->with(['role', 'department', 'division', 'position']);

        // Apply filters
        if (!empty($filters['search'])) {
            $search = $filters['search'];
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('employee_code', 'like', "%{$search}%")
                    ->orWhere('job_position', 'like', "%{$search}%")
                    ->orWhere('department', 'like', "%{$search}%");
            });
        }

        if (!empty($filters['department'])) {
            $query->whereIn('department_id', (array)$filters['department']);
        }

        if (!empty($filters['job_position'])) {
            $query->where('job_position', $filters['job_position']);
        }

        if (!empty($filters['onboarding_status'])) {
            $query->whereIn('onboarding_email_status', $filters['onboarding_status']);
        }

        if (isset($filters['is_active'])) {
            $query->where('is_active', $filters['is_active']);
        }

        // Exclude super admin users if needed
        if (!empty($filters['exclude_admin'])) {
            $query->where('is_admin', '!=', 1);
        }

        // Order by
        $sortBy = $filters['sort_by'] ?? 'created_at';
        $sortOrder = $filters['sort_order'] ?? 'desc';
        $query->orderBy($sortBy, $sortOrder);

        return $query->paginate($perPage);
    }

    /**
     * Get paginated employees with filters
     */
    public function getPaginatedEmployees(array $filters = [], int $perPage = 10)
    {
        $query = User::query()
            ->with([
                'position',
                'department',
                'division.business_unit'
            ])
            ->where('role_name', 'employee');

        // Apply filters
        if (!empty($filters['search'])) {
            $search = $filters['search'];
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('employee_code', 'like', "%{$search}%");
                // Only fields that exist in users table
            });
        }

        if (!empty($filters['department'])) {
            $query->whereIn('department_id', (array)$filters['department']);
        }

        if (!empty($filters['position'])) {
            $query->whereIn('position_id', (array)$filters['position']);
        }

        if (!empty($filters['onboarding_status'])) {
            $query->whereIn('onboarding_email_status', (array)$filters['onboarding_status']);
        }

        // Business unit filter (via division)
        if (!empty($filters['business_unit'])) {
            $query->whereHas('division', function ($q) use ($filters) {
                $q->whereIn('business_unit_id', (array)$filters['business_unit']);
            });
        }

        // Exclude super admin users if needed
        if (!empty($filters['exclude_admin'])) {
            $query->where('is_admin', '!=', 1);
        }

        // Order by
        $sortBy = $filters['sort_by'] ?? 'created_at';
        $sortOrder = $filters['sort_order'] ?? 'desc';
        $query->orderBy($sortBy, $sortOrder);

        return $query->paginate($perPage);
    }

    /**
     * Get paginated candidates with filters
     */
    public function getPaginatedCandidates(array $filters = [], int $perPage = 10)
    {
        $query = User::query()->with([
            'jobOpeningApplication.jobOpening.department',
            'jobOpeningApplication.jobOpening.job.division',
            'jobOpeningApplication.jobOpening.job.businessUnit'
        ])
        ->where('role_name', 'candidate');

        // Apply search filter
        if (!empty($filters['search'])) {
            $search = $filters['search'];
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('employee_code', 'like', "%{$search}%");
                // Search job position via related job opening
                $q->orWhereHas('jobOpeningApplication.jobOpening', function ($qq) use ($search) {
                    $qq->where('job_title', 'like', "%{$search}%");
                });
                // Search department via related job opening
                $q->orWhereHas('jobOpeningApplication.jobOpening.department', function ($qq) use ($search) {
                    $qq->where('name', 'like', "%{$search}%");
                });
            });
        }

        // Filter by department (via job application)
        if (!empty($filters['department'])) {
            $query->whereHas('jobOpeningApplication.jobOpening', function ($q) use ($filters) {
                $q->whereIn('department_id', (array)$filters['department']);
            });
        }

        // Filter by job position (via job application)
        if (!empty($filters['job_position'])) {
            $query->whereHas('jobOpeningApplication.jobOpening', function ($q) use ($filters) {
                $q->where('id', $filters['job_position']);
            });
        }

        // Filter by division (via job opening's job)
        if (!empty($filters['division'])) {
            $query->whereHas('jobOpeningApplication.jobOpening.job', function ($q) use ($filters) {
                $q->whereIn('division_id', (array)$filters['division']);
            });
        }

        // Filter by business unit (via job opening's job)
        if (!empty($filters['business_unit'])) {
            $query->whereHas('jobOpeningApplication.jobOpening.job', function ($q) use ($filters) {
                $q->whereIn('business_unit_id', (array)$filters['business_unit']);
            });
        }

        // Filter by hiring status (application status)
        if (!empty($filters['hiring_status'])) {
            $query->whereHas('jobOpeningApplication', function ($q) use ($filters) {
                $q->where('status', $filters['hiring_status']);
            });
        }

        // Filter by is_active
        if (isset($filters['is_active'])) {
            $query->where('is_active', $filters['is_active']);
        }

        // Exclude super admin users if needed
        if (!empty($filters['exclude_admin'])) {
            $query->where('is_admin', '!=', 1);
        }

        // Order by
        $sortBy = $filters['sort_by'] ?? 'created_at';
        $sortOrder = $filters['sort_order'] ?? 'desc';
        $query->orderBy($sortBy, $sortOrder);

        return $query->paginate($perPage);
    }

    /**
     * Get all unique departments
     */
    public function getDepartments()
    {
        return User::whereNotNull('department')
            ->distinct()
            ->pluck('department')
            ->sort()
            ->values();
    }

    /**
     * Get all unique job positions
     */
    public function getJobPositions()
    {
        return User::whereNotNull('job_position')
            ->distinct()
            ->pluck('job_position')
            ->sort()
            ->values();
    }

    /**
     * Create a new user
     */
    public function createUser(array $data): User
    {
        DB::beginTransaction();
        
        try {
            // Handle profile picture upload
            if (isset($data['profile_picture']) && $data['profile_picture'] instanceof UploadedFile) {
                $data['profile_picture'] = $this->uploadProfilePicture($data['profile_picture']);
            }

            // Hash password
            if (isset($data['password'])) {
                $data['password'] = Hash::make($data['password']);
            }

            // Set default values
            $data['onboarding_email_status'] = $data['onboarding_email_status'] ?? 'Pending';
            $data['is_active'] = $data['is_active'] ?? true;

            $user = User::create($data);

            DB::commit();
            return $user;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function adminCreateUser(array $data, $request): User
    {
        DB::beginTransaction();

        try {
            //  1. Build Full Name
            $data['name'] = trim($data['first_name'] . ' ' . $data['last_name']);

            //  2. Tagify fields (store as raw JSON)
            foreach (['skills', 'professional_certificate', 'training_program'] as $field) {
                if (!empty($data[$field])) {
                    $data[$field] = json_encode(json_decode($data[$field], true));
                }
            }

            //  3. Auto-generate password
            $data['password'] = Hash::make(Str::random(12));


            //  4. Profile picture upload (if any)
            if ($request->hasFile('profile_picture')) {
                $data['profile_picture'] = $request->file('profile_picture')->store('profile_pictures', 'public');
            }

             //  5. Default values, add role_name, model_has_role

            $data['onboarding_email_status'] = 0; // tinyint
            $data['is_active'] = 1;
            $data['tenant_id'] = auth()->user()->tenant_id ?? null;

            if (!empty($data['role_id'])) {
                $role = Role::find($data['role_id']);
                $data['role_name'] = $role ? $role->name : null;
            }
             //  6. Create User
            $user = User::create($data);

            if (!empty($data['role_id'])) {
                DB::table('model_has_roles')->insert([
                    'role_id'    => (int) $data['role_id'],
                    'model_type' => User::class,
                    'model_id'   => $user->id,
                ]);
            }
            $headcount = JobHeadcount::where('id', $data['job_position_headcount_id'])
                ->whereNull('user_id')
                ->first();

            if ($headcount) {
                $headcount->update([
                    'user_id' => $user->id,
                    'is_filled' => 1
                ]);
            }
            // 7. Save Performance Ratings

            $currentYear = now()->year;
            $years = [$currentYear, $currentYear - 1, $currentYear - 2];

            $performanceRatings = [];

            foreach ($years as $year) {
                $field = 'performance_rating_' . $year;
                $performanceRatings[$year] = $request->input($field);
            }

            $this->savePerformanceRatings($user->id, $performanceRatings);

             // 8. Save Employment History
            if ($request->has('employments')) {
                foreach ($request->employments as $employment) {

                    $employment['user_id'] = $user->id;

                    // Fix DB typo mapping
                    $employment['key_responsiblity'] = $employment['key_responsibility'] ?? null;
                    unset($employment['key_responsibility']);
                    // Auto-calc year_of_work
                    if (!empty($employment['start_date']) && !empty($employment['end_date'])) {
                        $start = Carbon::parse($employment['start_date']);
                        $end   = Carbon::parse($employment['end_date']);
                        $employment['year_of_work'] = round($start->floatDiffInYears($end), 2);
                    }

                    UserEmployment::create($employment);
                }
            }


            DB::commit();
            return $user;

        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Save performance ratings
     */
    private function savePerformanceRatings(int $userId, array $ratings)
    {
        foreach ($ratings as $year => $rating) {

            if ($rating === null || $rating === '') {
                continue;
            }

            // Normalize rating
            if ($rating == 0) {
                $normalized = 0;
            } elseif ($rating > 0 && $rating < 2) {
                $normalized = 1;
            } elseif ($rating > 3) {
                $normalized = 3;
            } else {
                $normalized = 2;
            }

            UserPerformanceRating::updateOrCreate(
                ['user_id' => $userId, 'year' => $year],
                [
                    'rating'             => $rating,
                    'normalized_rating'  => $normalized,
                    'rating_descriptor'  => null,
                    'rating_description' => null,
                ]
            );
        }
    }

    /**
     * Update an existing user
     */
    public function updateUser(User $user, array $data): User
    {
        DB::beginTransaction();
        
        try {
            // Handle profile picture upload
            if (isset($data['profile_picture']) && $data['profile_picture'] instanceof UploadedFile) {
                // Delete old profile picture
                if ($user->profile_picture) {
                    $this->deleteProfilePicture($user->profile_picture);
                }
                $data['profile_picture'] = $this->uploadProfilePicture($data['profile_picture']);
            }

            // Hash password if provided
            if (isset($data['password']) && !empty($data['password'])) {
                $data['password'] = Hash::make($data['password']);
            } else {
                unset($data['password']);
            }

            $user->update($data);

            DB::commit();

            return $user->fresh();
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Delete a user
     */
    public function deleteUser(User $user): bool
    {
        // Prevent deletion if linked
        $hasDepartment   = !empty($user->department_id);
        $hasDivision     = !empty($user->division_id);
        $hasCompany      = !empty($user->company_id);
        $hasBusinessUnit = $user->division && !empty($user->division->business_unit_id);

        if ($hasDepartment || $hasDivision || $hasCompany || $hasBusinessUnit) {
            throw new \Exception('Cannot delete: user is linked to department, division, company, or business unit');
        }

        DB::beginTransaction();
        try {
            if ($user->profile_picture) {
                $this->deleteProfilePicture($user->profile_picture);
            }

            $user->delete(); // soft delete

            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Delete multiple users
     */
    public function deleteMultipleUsers(array $userIds): array
    {
        DB::beginTransaction();

        $deleted = [];
        $skipped = [];
        $errors = [];

        try {
            $users = User::whereIn('id', $userIds)->get();

            foreach ($users as $user) {
                $hasDepartment   = !empty($user->department_id);
                $hasDivision     = !empty($user->division_id);
                $hasCompany      = !empty($user->company_id);
                $hasBusinessUnit = $user->division && !empty($user->division->business_unit_id);

                if ($hasDepartment || $hasDivision || $hasCompany || $hasBusinessUnit) {
                    $skipped[] = $user->id;
                    continue;
                }

                try {
                    if ($user->profile_picture) {
                        $this->deleteProfilePicture($user->profile_picture);
                    }
                    $user->delete(); // soft delete
                    $deleted[] = $user->id;
                } catch (Exception $e) {
                    $errors[$user->id] = $e->getMessage();
                }
            }

            DB::commit();

            return [
                'deleted' => $deleted,
                'skipped' => $skipped,
                'errors'  => $errors,
            ];
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Send onboarding email to user
     */
    public function sendOnboardingEmail(User $user): bool
    {
        try {
            // TODO: Implement email sending logic
            // Mail::to($user->email)->send(new OnboardingEmail($user));

            $user->update(['onboarding_email_status' => 'Sent']);

            return true;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Send onboarding emails to multiple users
     */
    public function sendBulkOnboardingEmails(array $userIds): int
    {
        $successCount = 0;
        
        $users = User::whereIn('id', $userIds)->get();
        
        foreach ($users as $user) {
            try {
                $this->sendOnboardingEmail($user);
                $successCount++;
            } catch (Exception $e) {
                // Log error but continue with other users
                \Log::error("Failed to send onboarding email to user {$user->id}: " . $e->getMessage());
            }
        }

        return $successCount;
    }

    /**
     * Process bulk user upload from CSV/Excel
     */
    public function processBulkUpload(UploadedFile $file): array
    {
        // TODO: Implement CSV/Excel parsing and user creation
        // This is a placeholder for the bulk upload functionality
        
        $results = [
            'success' => 0,
            'failed' => 0,
            'errors' => []
        ];

        return $results;
    }

    /**
     * Upload profile picture
     */
    private function uploadProfilePicture(UploadedFile $file): string
    {
        $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs('images/profile_pictures', $filename, 'public');
        
        return 'storage/' . $path;
    }

    /**
     * Delete profile picture
     */
    private function deleteProfilePicture(string $path): void
    {
        $fullPath = str_replace('storage/', '', $path);
        
        if (Storage::disk('public')->exists($fullPath)) {
            Storage::disk('public')->delete($fullPath);
        }
    }

    /**
     * Get user statistics
     */
    public function getUserStatistics(): array
    {
        return [
            'total_users' => User::count(),
            'active_users' => User::where('is_active', true)->count(),
            'inactive_users' => User::where('is_active', false)->count(),
            'pending_onboarding' => User::where('onboarding_email_status', 'Pending')->count(),
            'sent_onboarding' => User::where('onboarding_email_status', 'Sent')->count(),
        ];
    }
}
