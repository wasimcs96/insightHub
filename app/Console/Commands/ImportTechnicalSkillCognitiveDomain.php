<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\TechnicalSkillCognitiveDomainImport;
use App\Models\MasterTechnicalSkillCognitiveDomain;
use Illuminate\Support\Facades\Log;

class ImportTechnicalSkillCognitiveDomain extends Command
{
    protected $signature = 'import:technical-skill-cognitive {file}';
    protected $description = 'Import technical skill cognitive domain data from Excel';

    public function handle()
    {
        $filePath = $this->argument('file');
        
        // Check if file exists
        if (!file_exists($filePath)) {
            $this->error("File not found: {$filePath}");
            return 1;
        }

        $this->info('Starting import...');
        $this->info("File: {$filePath}");
        
        try {
            // Optional: Clear existing records if needed (uncomment if required)
            // $this->info('Clearing existing records...');
            // MasterTechnicalSkillCognitiveDomain::truncate();

            // Start import
            Excel::import(
                new TechnicalSkillCognitiveDomainImport, 
                $filePath
            );

            // Get count of imported records
            $totalRecords = MasterTechnicalSkillCognitiveDomain::count();
            
            $this->info("Import completed successfully.");
            $this->info("Total records in database: {$totalRecords}");
            
            return 0;
            
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $this->error('Validation errors occurred:');
            $failures = $e->failures();
            
            foreach ($failures as $failure) {
                $errorMessage = "Row: {$failure->row()}, Column: {$failure->attribute()}, Error: " . implode(', ', $failure->errors());
                $this->error($errorMessage);
                Log::error("Import Validation Error - {$errorMessage}");
            }
            
            return 1;
            
        } catch (\Exception $e) {
            $this->error('Import failed: ' . $e->getMessage());
            Log::error('Import Error: ' . $e->getMessage(), [
                'file' => $filePath,
                'trace' => $e->getTraceAsString()
            ]);
            
            return 1;
        }
    }
}