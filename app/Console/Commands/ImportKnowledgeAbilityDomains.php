<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\MtsKACDMappingImport;

class ImportKnowledgeAbilityDomains extends Command
{
    protected $signature = 'import:knowledge-ability-domains {filepath=public/knowledge_ability_domains.xlsx}';
    protected $description = 'Import knowledge and ability domains data from Excel file';

    public function handle()
    {
        ini_set('memory_limit', '1024M');
        $filepath = base_path($this->argument('filepath'));

        if (!file_exists($filepath)) {
            $this->error("File does not exist at path: {$filepath}");
            return 1;
        }

        Excel::import(new MtsKACDMappingImport, $filepath);

        $this->info("Import completed!");
        return 0;
    }
}
