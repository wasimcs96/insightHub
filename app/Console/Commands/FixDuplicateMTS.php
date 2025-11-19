<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

// class FixDuplicateMTS extends Command
// {
//     protected $signature = 'mts:fix {--apply : Apply changes instead of dry run}';
//     protected $description = 'Remove duplicate master technical skills and reassign related jobs/families';

//     public function handle()
//     {
//         $apply = $this->option('apply');
//         $this->info($apply ? 'Running in APPLY mode' : 'Running in DRY-RUN mode');

//         // 1. Find duplicates
//         $duplicates = DB::table('master_technical_skills')
//             ->selectRaw('LOWER(TRIM(name)) as name_key, sector_id, category_id, GROUP_CONCAT(id ORDER BY id ASC) as ids, COUNT(*) as cnt')
//             ->where('is_custom', '!=', 0)
//             ->groupBy('name_key', 'sector_id', 'category_id')
//             ->having('cnt', '>', 1)
//             ->get();

//             // dd($duplicates);
//         if ($duplicates->isEmpty()) {
//             $this->info('✅ No duplicates found.');
//             return;
//         }

//         $batchSize = 100; // Set your batch size
//         DB::beginTransaction();

//         try {
//             foreach ($duplicates as $group) {
//                 $ids = explode(',', $group->ids);
//                 $keepId = array_shift($ids); // Keep the first one
//                 $dupIds = $ids;

//                 $this->line("Keep #$keepId, delete [" . implode(',', $dupIds) . "]");

//                 if (!$apply) continue; // Skip changes if dry run

//                 // 2. Update job links (Batch process)
//                 foreach (array_chunk($dupIds, $batchSize) as $chunk) {
//                     // Lock rows explicitly to prevent other transactions from updating them at the same time
//                     DB::table('job_technical_skills')
//                         ->whereIn('master_technical_skill_id', $chunk)
//                         ->lockForUpdate()
//                         ->update(['master_technical_skill_id' => $keepId]);

//                     DB::table('department_technical_skills')
//                         ->whereIn('master_technical_skill_id', $chunk)
//                         ->lockForUpdate()
//                         ->update(['master_technical_skill_id' => $keepId]);

//                     DB::commit(); // Commit after each batch to release the lock
//                 }

//                 // 3. Remove pivot duplicates (Batch process)
//                 foreach (array_chunk($dupIds, $batchSize) as $chunk) {
//                     DB::statement("DELETE jt1 FROM job_technical_skills jt1
//                                    JOIN job_technical_skills jt2
//                                    ON jt1.job_id = jt2.job_id
//                                    AND jt1.master_technical_skill_id = jt2.master_technical_skill_id
//                                    AND jt1.id > jt2.id
//                                    WHERE jt1.master_technical_skill_id IN (" . implode(',', $chunk) . ")");

//                     DB::statement("DELETE jft1 FROM department_technical_skills jft1
//                                    JOIN department_technical_skills jft2
//                                    ON jft1.department_id = jft2.department_id
//                                    AND jft1.master_technical_skill_id = jft2.master_technical_skill_id
//                                    AND jft1.id > jft2.id
//                                    WHERE jft1.master_technical_skill_id IN (" . implode(',', $chunk) . ")");
//                     DB::commit(); // Commit after each batch
//                 }

//                 // 4. Delete duplicate skills (Batch process)
//                 foreach (array_chunk($dupIds, $batchSize) as $chunk) {
//                     DB::table('master_technical_skills')->whereIn('id', $chunk)->delete();
//                     DB::commit(); // Commit after each batch
//                 }
//             }

//             $apply ? DB::commit() : DB::rollBack();
//             $this->info($apply ? '✅ Duplicates removed.' : 'ℹ Dry run complete.');

//         } catch (\Throwable $e) {
//             DB::rollBack();
//             $this->error("❌ Error: " . $e->getMessage());
//         }
//     }
// }
class FixDuplicateMTS extends Command
{
    protected $signature = 'mts:fix {--apply : Apply changes instead of dry run}';
    protected $description = 'Remove duplicate master technical skills and reassign related jobs/families';

    public function handle()
    {
        $apply = $this->option('apply');
        $this->info($apply ? 'Running in APPLY mode' : 'Running in DRY-RUN mode');

        DB::beginTransaction();

        try {
            // 1. Handle duplicates where master skill (is_custom=0) exists with custom duplicates
            $this->handleMasterVsCustomDuplicates($apply);
            
            // 2. Handle duplicates among custom skills only (original logic)
            $this->handleCustomOnlyDuplicates($apply);

            $apply ? DB::commit() : DB::rollBack();
            $this->info($apply ? '✅ All duplicates processed.' : 'ℹ Dry run complete.');

        } catch (\Throwable $e) {
            DB::rollBack();
            $this->error("❌ Error: " . $e->getMessage());
        }
    }

    private function handleMasterVsCustomDuplicates($apply)
    {
        $this->line("\n=== Processing Master vs Custom Duplicates ===");
        
        // Find groups where master skill (is_custom=0) exists with custom duplicates
        $duplicateGroups = DB::table('master_technical_skills as mts1')
            ->join('master_technical_skills as mts2', function($join) {
                $join->on(DB::raw('LOWER(TRIM(mts1.name))'), '=', DB::raw('LOWER(TRIM(mts2.name))'))
                     ->on('mts1.sector_id', '=', 'mts2.sector_id')
                     ->on('mts1.category_id', '=', 'mts2.category_id')
                     ->on(DB::raw('COALESCE(mts1.description, "")'), '=', DB::raw('COALESCE(mts2.description, "")'))
                     ->on(DB::raw('COALESCE(mts1.level_1_description, "")'), '=', DB::raw('COALESCE(mts2.level_1_description, "")'))
                     ->on(DB::raw('COALESCE(mts1.level_2_description, "")'), '=', DB::raw('COALESCE(mts2.level_2_description, "")'))
                     ->on(DB::raw('COALESCE(mts1.level_3_description, "")'), '=', DB::raw('COALESCE(mts2.level_3_description, "")'))
                     ->on(DB::raw('COALESCE(mts1.level_4_description, "")'), '=', DB::raw('COALESCE(mts2.level_4_description, "")'))
                     ->on(DB::raw('COALESCE(mts1.level_5_description, "")'), '=', DB::raw('COALESCE(mts2.level_5_description, "")'))
                     ->on(DB::raw('COALESCE(mts1.level_6_description, "")'), '=', DB::raw('COALESCE(mts2.level_6_description, "")'))
                     ->on(DB::raw('COALESCE(mts1.level_1_ability, "")'), '=', DB::raw('COALESCE(mts2.level_1_ability, "")'))
                     ->on(DB::raw('COALESCE(mts1.level_2_ability, "")'), '=', DB::raw('COALESCE(mts2.level_2_ability, "")'))
                     ->on(DB::raw('COALESCE(mts1.level_3_ability, "")'), '=', DB::raw('COALESCE(mts2.level_3_ability, "")'))
                     ->on(DB::raw('COALESCE(mts1.level_4_ability, "")'), '=', DB::raw('COALESCE(mts2.level_4_ability, "")'))
                     ->on(DB::raw('COALESCE(mts1.level_5_ability, "")'), '=', DB::raw('COALESCE(mts2.level_5_ability, "")'))
                     ->on(DB::raw('COALESCE(mts1.level_6_ability, "")'), '=', DB::raw('COALESCE(mts2.level_6_ability, "")'))
                     ->on(DB::raw('COALESCE(mts1.level_1_knowledge, "")'), '=', DB::raw('COALESCE(mts2.level_1_knowledge, "")'))
                     ->on(DB::raw('COALESCE(mts1.level_2_knowledge, "")'), '=', DB::raw('COALESCE(mts2.level_2_knowledge, "")'))
                     ->on(DB::raw('COALESCE(mts1.level_3_knowledge, "")'), '=', DB::raw('COALESCE(mts2.level_3_knowledge, "")'))
                     ->on(DB::raw('COALESCE(mts1.level_4_knowledge, "")'), '=', DB::raw('COALESCE(mts2.level_4_knowledge, "")'))
                     ->on(DB::raw('COALESCE(mts1.level_5_knowledge, "")'), '=', DB::raw('COALESCE(mts2.level_5_knowledge, "")'))
                     ->on(DB::raw('COALESCE(mts1.level_6_knowledge, "")'), '=', DB::raw('COALESCE(mts2.level_6_knowledge, "")'));
            })
            ->where('mts1.is_custom', '=', 0) // Master skill
            ->whereIn('mts2.is_custom', [1, 2]) // Custom skills
            ->where('mts1.id', '!=', 'mts2.id')
            ->select('mts1.id as master_id', 'mts1.name as skill_name', 
                    DB::raw('GROUP_CONCAT(mts2.id ORDER BY mts2.id ASC) as custom_ids'))
            ->groupBy('mts1.id', 'mts1.name')
            ->get();

        if ($duplicateGroups->isEmpty()) {
            $this->info('No master vs custom duplicates found.');
            return;
        }

        foreach ($duplicateGroups as $group) {
            $masterId = $group->master_id;
            $customIds = explode(',', $group->custom_ids);
            
            $this->line("Keep master #{$masterId} ({$group->skill_name}), remove custom [" . implode(',', $customIds) . "]");

            if (!$apply) continue;

            $this->processSkillMerge($masterId, $customIds);
        }
    }

    private function handleCustomOnlyDuplicates($apply)
    {
        $this->line("\n=== Processing Custom-Only Duplicates ===");
        
        // Original logic for custom-only duplicates
        $duplicates = DB::table('master_technical_skills')
            ->selectRaw('LOWER(TRIM(name)) as name_key, sector_id, category_id, GROUP_CONCAT(id ORDER BY id ASC) as ids, COUNT(*) as cnt')
            ->where('is_custom', '!=', 0)
            ->groupBy('name_key', 'sector_id', 'category_id')
            ->having('cnt', '>', 1)
            ->get();

        if ($duplicates->isEmpty()) {
            $this->info('No custom-only duplicates found.');
            return;
        }

        foreach ($duplicates as $group) {
            $ids = explode(',', $group->ids);
            $keepId = array_shift($ids);
            $dupIds = $ids;

            $this->line("Keep custom #{$keepId}, delete custom [" . implode(',', $dupIds) . "]");

            if (!$apply) continue;

            $this->processSkillMerge($keepId, $dupIds);
        }
    }

    private function processSkillMerge($keepId, $removeIds)
    {
        $batchSize = 100;

        // Update job_technical_skills - merge preferred levels intelligently
        foreach (array_chunk($removeIds, $batchSize) as $chunk) {
            // For each job that has both the keepId and removeIds, keep the higher preferred level
            DB::statement("
                UPDATE job_technical_skills jts1
                JOIN job_technical_skills jts2 ON jts1.job_id = jts2.job_id
                SET jts1.level = GREATEST(jts1.level, jts2.level)
                WHERE jts1.master_technical_skill_id = ? 
                AND jts2.master_technical_skill_id IN (" . implode(',', array_fill(0, count($chunk), '?')) . ")",
                array_merge([$keepId], $chunk)
            );

            // Update remaining records to point to keepId
            DB::table('job_technical_skills')
                ->whereIn('master_technical_skill_id', $chunk)
                ->update(['master_technical_skill_id' => $keepId]);

            DB::table('department_technical_skills')
                ->whereIn('master_technical_skill_id', $chunk)
                ->update(['master_technical_skill_id' => $keepId]);
        }

        // Remove duplicate pivot entries
        foreach (array_chunk($removeIds, $batchSize) as $chunk) {
            DB::statement("
                DELETE jt1 FROM job_technical_skills jt1
                JOIN job_technical_skills jt2
                ON jt1.job_id = jt2.job_id
                AND jt1.master_technical_skill_id = jt2.master_technical_skill_id
                AND jt1.id > jt2.id
                WHERE jt1.master_technical_skill_id = ?",
                [$keepId]
            );

            DB::statement("
                DELETE dt1 FROM department_technical_skills dt1
                JOIN department_technical_skills dt2
                ON dt1.department_id = dt2.department_id
                AND dt1.master_technical_skill_id = dt2.master_technical_skill_id
                AND dt1.id > dt2.id
                WHERE dt1.master_technical_skill_id = ?",
                [$keepId]
            );
        }

        // Delete the duplicate skills
        foreach (array_chunk($removeIds, $batchSize) as $chunk) {
            DB::table('master_technical_skills')->whereIn('id', $chunk)->delete();
        }
    }
}