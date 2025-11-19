<?php
namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;
use App\Models\Sector;
use App\Models\MasterTechnicalSkill;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TechnicalSkillsUpdateImport implements ToCollection, WithHeadingRow
{
    // public function collection(Collection $rows)
    // {
    //     ini_set('memory_limit', '-1');
    //     foreach ($rows as $row) {
    //         DB::beginTransaction();

    //         try {
    //             // Check if sector exists
    //             $sector = Sector::where('name', $row['sector'])->first();

    //             if ($sector) {
    //                 // Log sector update
    //                 Log::info("Sector exists, ID: {$sector->id}", [
    //                     'sector_name' => $sector->name
    //                 ]);
    //             } else {
    //                 throw new \Exception("Sector '{$row['sector']}' does not exist, skipping row.");
    //             }

    //             // Check if category exists
    //             $category = DB::table('technical_skill_categories')
    //                 ->where('sector_id', $sector->id)
    //                 ->where('title', $row['tsc_ccs_category'])
    //                 ->first();

    //             if ($category) {
    //                 $categoryId = $category->id;
    //                 // Log category update
    //                 Log::info("Category exists, ID: {$categoryId}", [
    //                     'sector_id' => $sector->id,
    //                     'category_title' => $row['tsc_ccs_category']
    //                 ]);
    //             } else {
    //                 throw new \Exception("Category '{$row['tsc_ccs_category']}' does not exist in sector '{$row['sector']}', skipping row.");
    //             }

    //             // Now check for technical skill and update it if it exists
    //             // $tsc = MasterTechnicalSkill::where('sector_id', $sector->id)->where('name', 'LIKE', "%{$row['tsc_ccs_title']}%")->first();
    //             $tscs = MasterTechnicalSkill::where('sector_id', $sector->id)->where('name',$row['tsc_ccs_title'])->get();


    //             foreach ($tscs as $tsc) {
    //                 if ($tsc) {
    //                     $tsc->category_id = $categoryId;
    //                     // $tsc->sector_id = $sector->id;
    //                     $tsc->save();
        
    //                     Log::info("Technical Skill updated with ID: {$tsc->id}", [
    //                         'sector_id' => $sector->id,
    //                         'category_id' => $categoryId,
    //                         'updated_rows' => $tsc
    //                     ]);
    //                 } else {
    //                     throw new \Exception("Technical Skill '{$row['tsc_ccs_title']}' does not exist in category '{$row['tsc_ccs_category']}', skipping row.");
    //                 }
    //             }

    //             DB::commit(); // Commit transaction

    //         } catch (\Exception $e) {
    //             // Rollback transaction if something goes wrong
    //             DB::rollBack();

    //             // Log the error
    //             Log::error("Error occurred while processing row: {$e->getMessage()}", [
    //                 'row_data' => $row
    //             ]);
    //         }
    //     }
    // }
    public function collection(Collection $rows)
    {
        // dd($rows);
        foreach ($rows as $row) {
            DB::beginTransaction();

            try {
                // Check if sector exists, if not create it
                $sector = Sector::firstOrCreate(
                    ['name' => $row['sector']],
                    ['name' => $row['sector']]
                );
                // dd($sector);

                Log::info("Sector processed with ID: {$sector->id}", [
                    'sector_name' => $sector->name
                ]);

                // Check if category exists, if not create it
                $category = DB::table('technical_skill_categories')
                    ->where('sector_id', $sector->id)
                    ->where('title', $row['tsc_ccs_category'])
                    ->first();

                    // dd($category);
                if (!$category) {
                    $categoryId = DB::table('technical_skill_categories')->insertGetId([
                        'sector_id' => $sector->id,
                        'title' => $row['tsc_ccs_category'],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);

                    Log::info("Category created with ID: $categoryId", [
                        'sector_id' => $sector->id,
                        'category_title' => $row['tsc_ccs_category']
                    ]);
                } else {
                    $categoryId = $category->id;
                    // Log the category update
                    Log::info("Category already exists, ID: {$categoryId}", [
                        'sector_id' => $sector->id,
                        'category_title' => $row['tsc_ccs_category']
                    ]);
                }
                // $categoryId = $category->id;
                // Now check for technical skill and update category_id
                
                // Extract the skill name from Excel (e.g., "Reliability Engineering Management")
                $excelSkillName = trim($row['tsc_ccs_title']);
                $excelSkillNameLower = mb_strtolower($excelSkillName);

                // Find all skills by extracting the name before the parenthesis in the database
                // Database format: "Partnership Management (Infocomm Technology-Stakeholder and Contract Management)"
                // We need to match just "Partnership Management" with "Reliability Engineering Management" from Excel
                // Note: Multiple skills can have the same name and sector
                $tscs = MasterTechnicalSkill::query()
                    ->where('sector_id', $sector->id)
                    ->where('category_id', NULL)
                    ->whereRaw('LOWER(TRIM(SUBSTRING_INDEX(name, " (", 1))) = ?', [$excelSkillNameLower])
                    ->get();

                if ($tscs->isNotEmpty()) {
                    foreach ($tscs as $tsc) {
                        $tsc->category_id = $categoryId;
                        $tsc->save();

                        Log::info("Technical Skill updated with ID: {$tsc->id}", [
                            'sector_id' => $sector->id,
                            'category_id' => $categoryId,
                            'updated_rows' => $tsc
                        ]);
                    }
                    
                    Log::info("Total {$tscs->count()} technical skill(s) updated for '{$excelSkillName}'", [
                        'sector' => $sector->name,
                        'category' => $row['tsc_ccs_category']
                    ]);
                } else {
                    Log::warning("No technical skills found matching '{$excelSkillName}' in sector '{$sector->name}' with NULL category_id");
                }
                //  else {
                //     $techskill = MasterTechnicalSkill::create([
                //         'sector_id' => $sector->id ?? '',
                //         'category_id' => $categoryId ?? '',
                //         'name' => $row['tsc_ccs_title']
                //     ]);

                //     Log::info("Technical Skill created with ID: {$techskill->id}", [
                //         'sector_id' => $sector->id ?? '',
                //         'category_id' => $categoryId ?? '',
                //         'updated_rows' => $techskill ?? '',
                //     ]);
                // }

                DB::commit(); // Commit transaction

            } catch (\Exception $e) {
                // Rollback transaction if something goes wrong
                DB::rollBack();

                // Log the error
                Log::error("Error occurred while processing row: {$e->getMessage()}", [
                    'row_data' => $row
                ]);
            }
        }
    }
}
