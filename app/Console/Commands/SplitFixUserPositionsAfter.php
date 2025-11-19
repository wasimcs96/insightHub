<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Job;
use App\Models\JobHeadcount;

class SplitFixUserPositionsAfter extends Command
{
    protected $signature = 'jobs:fix-user-positions {--dry-run : Only show what would be updated}';
    protected $description = 'Fix users position_id after job splits based on their headcount';

    public function handle()
    {
        $isDryRun = $this->option('dry-run');
        
        if ($isDryRun) {
            $this->warn('DRY RUN MODE - No changes will be made');
            $this->line('');
        }

        $this->info('Finding users with mismatched position_id...');
        $this->line('');

        // Find users where their position_id doesn't match their headcount's job_id
        $usersToUpdate = DB::table('users as u')
            ->join('job_headcounts as jh', 'u.id', '=', 'jh.user_id')
            ->where('u.position_id', '!=', DB::raw('jh.job_id'))
            ->select(
                'u.id as user_id',
                'u.name as user_name',
                'u.position_id as current_position_id',
                'jh.job_id as correct_position_id',
                'jh.headcount_code',
                'u.id'
            )
            ->get();

        if ($usersToUpdate->isEmpty()) {
            $this->info('✓ No users need updating. All position_ids are correct!');
            return 0;
        }

        $this->warn('Found ' . count($usersToUpdate) . ' user(s) with incorrect position_id');
        $this->line('');
        $this->info('═══════════════════════════════════════════════════════════');
        $this->line('');

        $updateCount = 0;
        foreach ($usersToUpdate as $user) {
            $currentJob = Job::find($user->current_position_id);
            $correctJob = Job::find($user->correct_position_id);

            $this->line("User: {$user->user_name} (ID: {$user->user_id})");
            $this->error("├─ WRONG Position: {$currentJob->title} (ID: {$user->current_position_id})");
            $this->info("└─ CORRECT Position: {$correctJob->title} (ID: {$user->correct_position_id})");
            $this->line('');

            if (!$isDryRun) {
                User::where('id', $user->user_id)
                    ->update([
                        'position_id' => $user->correct_position_id,
                        'updated_at' => now()
                    ]);
                $updateCount++;
            }
        }

        $this->line('═══════════════════════════════════════════════════════════');
        $this->line('');

        if ($isDryRun) {
            $this->warn('DRY RUN: Would have updated ' . count($usersToUpdate) . ' user(s)');
            $this->info('Run without --dry-run to apply changes');
        } else {
            $this->info("✓ Successfully updated {$updateCount} user(s)");
        }

        return 0;
    }
}