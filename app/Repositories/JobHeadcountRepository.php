<?php
// app/Repositories/JobHeadcountRepository.php

namespace App\Repositories;

use App\Contracts\JobHeadcountRepositoryInterface;
use App\Models\JobHeadcount;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Throwable;

class JobHeadcountRepository extends BaseRepository implements JobHeadcountRepositoryInterface
{
    public function __construct(JobHeadcount $model)
    {
        parent::__construct($model);
    }

    public function getVacantByJobId(int $jobId): Collection
    {
        return $this->model->with([
                'parent.user:id,name',
                'job:id,title'
            ])
            ->where('job_id', $jobId)
            ->whereNull('user_id')
            ->get();
    }

    public function getOccupiedByJobId(int $jobId): Collection
    {
        return $this->model->with([
                'user:id,name,email',
                'parent.user:id,name',
                'job:id,title'
            ])
            ->where('job_id', $jobId)
            ->whereNotNull('user_id')
            ->get();
    }

    public function getHeadcountWithHierarchy(int $headcountId): ?object
    {
        return $this->model->with([
                'user:id,name,email',
                'parent.user:id,name',
                'children.user:id,name',
                'job:id,title'
            ])
            ->find($headcountId);
    }

    public function getVacantHeadcountsFormatted(int $jobId): Collection
    {

        return $this->getVacantByJobId($jobId)->map(function ($headcount) {
            return [
                'id' => $headcount->id,
                'headcount_code' => $headcount->headcount_code,
                'job_title' => $headcount->job->title ?? 'Unknown Job',
                'parent_info' => $headcount->parent ? [
                    'user_name' => $headcount->parent->user?->name ?? 'Vacant',
                    'headcount_code' => $headcount->parent->headcount_code
                ] : null,
                'display_text' => $this->formatHeadcountDisplay($headcount),
                'is_available' => true
            ];
        });
    }

    public function getHeadcountStatsByJobId(int $jobId): array
    {
        $stats = $this->model->where('job_id', $jobId)
            ->selectRaw('
                COUNT(*) as total_headcounts,
                COUNT(user_id) as occupied_count,
                COUNT(*) - COUNT(user_id) as vacant_count
            ')
            ->first();

        return [
            'total' => $stats->total_headcounts ?? 0,
            'occupied' => $stats->occupied_count ?? 0,
            'vacant' => $stats->vacant_count ?? 0,
            'occupancy_rate' => $stats->total_headcounts > 0 
                ? round(($stats->occupied_count / $stats->total_headcounts) * 100, 2) 
                : 0
        ];
    }

    private function formatHeadcountDisplay(JobHeadcount $headcount): string
    {
        $display = $headcount->headcount_code;
        
        if ($headcount->parent && $headcount->parent->user) {
            $display .= '     ' . $headcount->parent->user->name;
            $display .= ' (' . $headcount->parent->headcount_code . ')';
        } elseif ($headcount->parent) {
            $display .= '     ' . 'Vacant Position';
            $display .= ' (' . $headcount->parent->headcount_code . ')';
        }
        
        return $display;
    }

    // Add this method to your JobHeadcountRepository
    // Add this method to your JobHeadcountRepository

    public function assignUserToHeadcount(int $headcountId, int $userId, array $auditMetadata = []): array
    {
        try {
            return DB::transaction(function () use ($headcountId, $userId, $auditMetadata) {
                $headcount = $this->model->with(['job.department', 'user'])
                    ->where('id', $headcountId)
                    ->whereNull('user_id')
                    ->lockForUpdate()
                    ->first();

                if (!$headcount) {
                    return [
                        'success' => false,
                        'message' => 'Headcount position not found or already occupied'
                    ];
                }

                // Get user information for audit
                $user = User::find($userId);
                if (!$user) {
                    return [
                        'success' => false,
                        'message' => 'User not found'
                    ];
                }

                // Prepare dynamic audit metadata
                $dynamicAuditMetadata = [
                    'action' => 'assign_employee',
                    'reason' => $auditMetadata['reason'] ?? 'Employee conversion from candidate',
                    'source' => $auditMetadata['source'] ?? 'Talent Acquisition',
                    'node' => (object) [  // Make sure this is an object
                        'data' => (object) [  // Make sure data is also an object
                            'code' => $headcount->headcount_code,
                            'name' => $user->name,
                            'id' => $headcount->id,
                            'user_id' => $user->id
                        ]
                    ],
                    'extra' => (object) array_merge([  // Make extra an object too
                        'previous_user' => null,
                        'conversion_type' => 'candidate_to_employee'
                    ], $auditMetadata['extra'] ?? [])
                ];

                // Set the audit metadata on the model before update
                $headcount->orgMetadata = $dynamicAuditMetadata;

                $updated = $headcount->update([
                    'user_id' => $userId,
                    'is_filled'=>1,
                    'orgMetadata' => $dynamicAuditMetadata // Store for audit trail
                ]);

                if (!$updated) {
                    return [
                        'success' => false,
                        'message' => 'Failed to update headcount record'
                    ];
                }

                return [
                    'success' => true,
                    'message' => 'User assigned to headcount successfully',
                    'data' => [
                        'headcount_id' => $headcount->id,
                        'job_id' => $headcount->job_id,
                        'department_id' => $headcount->job->department_id ?? null,
                        'headcount_code' => $headcount->headcount_code,
                        'user' => [
                            'id' => $user->id,
                            'name' => $user->name,
                            'email' => $user->email
                        ],
                        'audit_metadata' => $dynamicAuditMetadata
                    ]
                ];
            });

        } catch (Throwable $e) {
            return [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }
    }
}