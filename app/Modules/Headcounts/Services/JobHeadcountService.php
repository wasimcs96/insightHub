<?php

namespace App\Modules\Headcounts\Services;

use App\Models\Job;
use App\Models\JobHeadcount;
use App\Modules\Headcounts\Repositories\JobHeadcountRepositoryInterface;
use App\Modules\Headcounts\Events\HeadcountCreated;
use App\Modules\Headcounts\Events\HeadcountDeleted;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Helpers\AuditLogger;
use Barryvdh\Debugbar\Facades\Debugbar;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class JobHeadcountService
{
    public function __construct(
        protected JobHeadcountRepositoryInterface $repo
    ) {}

    public function create(array $data)
    {
        $hc = $this->repo->create($data);
        event(new HeadcountCreated($hc));
        return $hc;
    }

    public function update(int $id, array $data)
    {
        return $this->repo->update($id, $data);
    }

    public function delete(int $id)
    {
        $hc = $this->repo->find($id);
        if ($hc) {
            $this->repo->delete($id);
            event(new HeadcountDeleted($hc));
            return true;
        }
        return false;
    }

    public function createBatch(array $items, int $departmentId): Collection
    {
        // Debugbar::addMessage($items);
        return collect($items)
            ->map(fn($hc) => $this->create([
                'job_id' => $hc['job_id'],
                'headcount_code' => $hc['headcount_code'],
                'parent_id' => $hc['parent_id'] ?? null,
                'department_id' => $departmentId,
                'headcount_number' => $hc['headcount_number'],
                'orgMetadata'=>$hc['orgMetadata']
            ]));
    }

    public function createBatchForOrgChart(array $items): Collection
    {
        return collect($items)
            ->map(fn($hc) => $this->create([
                'job_id' => $hc['job_id'],
                'headcount_code' => $hc['headcount_code'],
                'parent_id' => $hc['parent_id'] ?? null,
                'department_id' => $hc['department_id'] ?? null,
                'headcount_number' => $hc['headcount_number'],
                'orgMetadata' => $hc['orgMetadata']
            ]));
    }

    public function countByJob(int $jobId): int
    {
        return $this->repo->countByJob($jobId);
    }

    public function allByJob(int $jobId): Collection
    {
        return $this->repo->allByJob($jobId);
    }

    public function getChildren(int $parentId): Collection
    {
        return $this->repo->childrenOf($parentId);
    }

    public function findByCode(string $code): ?JobHeadcount
    {
        return $this->repo->findByCode($code);
    }

    public function find(int $id): ?JobHeadcount
    {
        return $this->repo->find($id);
    }


    public function replaceTopPosition(Job $oldTop, Job $newTop): void
    {

        DB::transaction(function () use ($oldTop, $newTop) {
            // 1. Update old top job's superior to be the new top job
            $oldTop->superior_id = $newTop->id;
            $oldTop->is_top = 0;
            $oldTop->save();

            Job::where('superior_id', $oldTop->id)
                ->update([
                    'superior_id' => $newTop->id
                ]);

            // 2. Make the new top job the top position
            $newTop->is_top = 1;
            $newTop->superior_id = null;
            $newTop->save();

            $oldParentId = JobHeadcount::where('job_id', $oldTop->id)->first()?->id;
            $parentId = JobHeadcount::where('job_id', $newTop->id)->first()?->id;

            JobHeadcount::where('parent_id', $oldParentId)->update([
                'parent_id' => $parentId
            ]);

            $headcounts = JobHeadcount::where('job_id', $oldTop->id)->get();

            // 3. Reassign all headcounts of oldTop to point to newTop
            JobHeadcount::where('job_id', $oldTop->id)->update([
                'parent_id' => $parentId
            ]);

            // Log audits using helper
            AuditLogger::logBulkAudit(
                JobHeadcount::class,
                $headcounts,
                ['parent_id' => $parentId],
                'updated',
                ['mass-update', 'hierarchy-change']
            );
        });
    }

    function updateHeadcountDepartment($jobId, $newDepartmentId)
    {
        // Safety: check inputs
        if (!$jobId || !$newDepartmentId) {
            throw new \InvalidArgumentException('Job ID and Department ID are required.');
        }

        $headcounts = JobHeadcount::where('job_id', $jobId)->get();

        // Update all headcounts for this job
        $affected = JobHeadcount::where('job_id', $jobId)
            ->update(['department_id' => $newDepartmentId]);



        AuditLogger::logBulkAudit(
            JobHeadcount::class,
            $headcounts,
            ['department_id' => $newDepartmentId],
            'updated',
            ['mass-update', 'department-change']
        );

        return $affected; // number of records updated
    }


    public function getAllowedLevels(bool $isTopPosition, ?int $superiorId): array
    {
        $levels = config('constants.LEVELS'); // e.g. [1=>'Level 1',…]
        $allowed = [];

        if ($isTopPosition) {
            // If marking as top, only levels ≥ existing top’s level
            $existingTop = Job::where('is_top', 1)->first();
            if ($existingTop) {
                $min = $existingTop->level;
                foreach ($levels as $lvl => $label) {
                    if ($lvl >= $min) {
                        $allowed[$lvl] = $label;
                    }
                }
            } else {
                // no existing top → all levels allowed
                $allowed = $levels;
            }
        } elseif ($superiorId) {
            // Normal flow: levels ≥ selected superior’s level
            $sup = Job::find($superiorId);
            if ($sup) {
                $min = $sup->level;

                foreach ($levels as $lvl => $label) {
                    if ($lvl <= $min) {
                        $allowed[$lvl] = $label;
                    }
                }
            }
        }

        // else: neither top nor superior → empty

        return $allowed;
    }

    public function getAllowedLevelsForEdit(Job $job, ?int $newSuperiorId): array
    {
        $levels = config('constants.LEVELS');

        if ($job->is_top) {
            // Editing a top job → only levels ≥ this job’s current level
            $min = $job->level;
            return collect($levels)
                ->filter(fn($label, $lvl) => $lvl >= $min)
                ->all();
        }

        // Editing a non-top job → levels ≤ its superior’s level
        // Use the newly selected superior if provided, otherwise the stored one
        $supId = $newSuperiorId ?: $job->superior_id;
        if ($supId && $sup = Job::find($supId)) {
            $max = $sup->level;
            return collect($levels)
                ->filter(fn($label, $lvl) => $lvl <= $max)
                ->all();
        }

        return [];
    }


    public function updateBatch(array $headcountData, int $jobId)
    {
        // try {
        foreach ($headcountData as $data) {
            // Find the headcount by its unique ID (e.g., "PST-4955-01")
            $headcount = JobHeadcount::where('headcount_code', $data['id'])->first();
            if ($headcount) {
                // Update the headcount details
                // $headcount->parent_id = $superiorId->id;

                // // Ensure it belongs to the correct Job ID (optional, can be skipped if not needed)

                // // Save the updated headcount
                // $headcount->save();

                $this->update($headcount->id, [
                    'job_id' => $jobId,
                    'headcount_code' => $data['id'],
                    'parent_id' => $data['parent_id'],
                    'department_id' => $data['department_id'],
                    'headcount_number' => $data['headcount_number'],
                    'orgMetadata' => [
                                    'action' => 'update_headcounts_from_job_management',
                                    'reason' => "",
                                    'node' => ['data'=>['code'=>$data['id']]],
                                    'source'=>"Job Management",
                    ]
                ]);
            } else {
                $this->create([
                    'job_id' => $jobId,
                    'headcount_code' => $data['id'],
                    'parent_id' => $data['parent_id'],
                    'department_id' => $data['department_id'],
                    'headcount_number' => $data['headcount_number'],
                    'orgMetadata' => [
                                    'action' => 'add_position',
                                    'reason' => "",
                                    'node' => ['data'=>['code'=>$data['id']]],
                                    'source'=>"Job Management",
                    ]
                ]);
            }
        }
        // } catch (Exception $e) {
        //     Log::error("Error updating headcount batch: " . $e->getMessage());
        //     throw new Exception("There was an error updating the headcount data.");
        // }
    }

    public function filter(Request $request)
    {
        $query = JobHeadcount::with('job'); // Include job title

        if ($request->filled('department_id')) {
            $query->where('department_id', $request->department_id);
        }

        if ($request->filled('job_id')) {
            $query->where('job_id', $request->job_id);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->has('is_filled')) {
            $query->where('is_filled', $request->is_filled);
        }

        if ($request->boolean('vacant')) {
            $query->whereNull('user_id');
        }

        if ($request->filled('parent_id')) {
            $query->where('parent_id', $request->parent_id);
        }

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('headcount_code', 'like', "%{$search}%")
                    ->orWhere('headcount_number', 'like', "%{$search}%");
            });
        }

        $perPage = $request->input('per_page', 10);
        return $query->paginate($perPage);
    }
}
