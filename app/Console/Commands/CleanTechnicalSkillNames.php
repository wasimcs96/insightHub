<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\MasterTechnicalSkill;

class CleanTechnicalSkillNames extends Command
{
    // The name and signature of the console command
    protected $signature = 'skills:clean-names {--dry-run}';

    // The console command description
    protected $description = 'Remove bracketed content from skill names based on category_id and sector_id';

    // Execute the console command
    public function handle()
    {
        // Check if dry-run is enabled
        $isDryRun = $this->option('dry-run');

        // Loop through the skills to check and clean their names
        $skills = MasterTechnicalSkill::where('is_custom', '!=', 0)->where('category_id','!=',null)->where('sector_id','!=',null)->get();
// dd($skills);
        foreach ($skills as $skill) {
            // Get the sector and category name from your related tables
            $sector = $skill->sector;  // Assuming you have a relation to the Sector model
            $category = $skill->category;  // Assuming you have a relation to the Category model
            $sectorName = trim($sector->name);
            $categoryName = trim($category->title);
            // Construct the pattern to match the sector and category inside parentheses
            $pattern = '/\s?\(' . preg_quote($sectorName, '/') . '\s*-\s*' . preg_quote($categoryName, '/') . '\)/i';
            $this->info("Checking Skill ID {$skill->id}: {$skill->name}");
            $this->info("Pattern: {$pattern}");

            if (preg_match($pattern, $skill->name)) {
                $cleanedName = trim(preg_replace($pattern, '', $skill->name));
                if ($isDryRun) {
                    $this->info("Skill ID {$skill->id}: {$skill->name} -> {$cleanedName}");
                } else {
                    $skill->name = $cleanedName;
                    $skill->save();
                    $this->info("Skill ID {$skill->id} cleaned successfully.");
                }
            } else {
                $this->info("No match found for Skill ID {$skill->id}: {$skill->name}");
            }
        }

        // Final message after processing
        if (!$isDryRun) {
            $this->info('Skill names cleaned!');
        } else {
            $this->info('Dry run complete. No changes were made.');
        }
    }
}
