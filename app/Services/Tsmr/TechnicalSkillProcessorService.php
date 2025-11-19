<?php

namespace App\Services\Tsmr;

use App\Models\MasterTechnicalSkill;
use App\Models\MasterTechnicalSkillsCognitiveDomainKa;
use App\Models\MasterTechnicalSkillCognitiveDomain;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TechnicalSkillProcessorService
{
    // Cognitive domain classification patterns
    private $cognitiveDomainPatterns = [
        'qk' => [
            'keywords' => [
                'calculate', 'compute', 'measure', 'quantify', 'analyse', 'analyze', 
                'data', 'metrics', 'statistics', 'numerical', 'measurement', 'assessment',
                'monitor', 'track', 'evaluate', 'report', 'dashboard', 'analytics',
                'financial', 'budget', 'forecast', 'projection', 'ratio', 'percentage',
                'kpi', 'indicator', 'performance', 'benchmark', 'target', 'threshold'
            ],
            'weight' => 1.0
        ],
        'ck' => [
            'keywords' => [
                'understand', 'concept', 'theory', 'principle', 'framework', 'model',
                'knowledge', 'guideline', 'standard', 'regulation', 'compliance', 'policy',
                'methodology', 'approach', 'strategy', 'best practice', 'requirement',
                'specification', 'definition', 'terminology', 'classification', 'taxonomy',
                'procedure', 'process', 'protocol', 'workflow', 'governance'
            ],
            'weight' => 1.0
        ],
        'vr' => [
            'keywords' => [
                'communicate', 'present', 'report', 'document', 'articulate', 'explain',
                'describe', 'inform', 'discuss', 'consult', 'advise', 'recommend',
                'negotiate', 'persuade', 'influence', 'stakeholder', 'relationship',
                'feedback', 'review', 'meeting', 'presentation', 'briefing', 'update',
                'correspondence', 'collaborate', 'liaise', 'coordinate', 'engagement'
            ],
            'weight' => 1.0
        ],
        'fr' => [
            'keywords' => [
                'implement', 'execute', 'develop', 'design', 'create', 'build',
                'establish', 'deploy', 'apply', 'utilize', 'operate', 'manage',
                'maintain', 'optimize', 'improve', 'enhance', 'troubleshoot', 'resolve',
                'configure', 'integrate', 'automate', 'control', 'mitigate', 'respond',
                'action', 'solution', 'tool', 'system', 'platform', 'technology'
            ],
            'weight' => 1.0
        ]
    ];

    // Cache for cognitive domain lookups
    private $cognitiveDomainCache = [];

    public function processAndBulkInsert(MasterTechnicalSkill $technicalSkill)
    {
        try {
            // Get the processed data
            $results = $this->getCountsForSkills($technicalSkill);
            
            if (empty($results)) {
                return [
                    'success' => false,
                    'message' => 'No data to process',
                    'processed_count' => 0
                ];
            }
            
            // CRITICAL: Ensure no duplicates in the results array itself
            $results = $this->deduplicateResults($results);
            
            // Get existing records for this skill
            $existingRecords = MasterTechnicalSkillCognitiveDomain::where('master_technical_skill_id', $technicalSkill->id)
                ->get()
                ->keyBy('level');
            
            // Process each result - update if exists, insert if not
            foreach ($results as $result) {
                $level = $result['level'];
                
                if (isset($existingRecords[$level])) {
                    // Update existing record
                    $existingRecords[$level]->update([
                        'name' => $result['name'],
                        'qk_ka_count' => $result['qk_ka_count'],
                        'ck_ka_count' => $result['ck_ka_count'],
                        'vr_ka_count' => $result['vr_ka_count'],
                        'fr_ka_count' => $result['fr_ka_count'],
                        'ka_total_count' => $result['ka_total_count'],
                        'qk_ka_percentage' => $result['qk_ka_percentage'],
                        'qk_ka_level' => $result['qk_ka_level'],
                        'ck_ka_percentage' => $result['ck_ka_percentage'],
                        'ck_ka_level' => $result['ck_ka_level'],
                        'vr_ka_percentage' => $result['vr_ka_percentage'],
                        'vr_ka_level' => $result['vr_ka_level'],
                        'fr_ka_percentage' => $result['fr_ka_percentage'],
                        'fr_ka_level' => $result['fr_ka_level'],
                    ]);
                } else {
                    // Insert new record
                    MasterTechnicalSkillCognitiveDomain::create($result);
                }
            }
            
            return [
                'success' => true,
                'message' => 'Data processed successfully',
                'processed_count' => count($results),
                'data' => $results
            ];
            
        } catch (\Exception $e) {
            Log::error('Error in processAndBulkInsert: ' . $e->getMessage());
            
            return [
                'success' => false,
                'message' => 'Error processing data: ' . $e->getMessage(),
                'processed_count' => 0
            ];
        }
    }

    public function processBulkSkills(array $technicalSkillIds)
    {
        try {
            $technicalSkills = MasterTechnicalSkill::whereIn('id', $technicalSkillIds)->get();
            
            $allResults = [];
            
            foreach ($technicalSkills as $skill) {
                $results = $this->getCountsForSkills($skill);
                $allResults = array_merge($allResults, $results);
            }
            
            if (empty($allResults)) {
                return [
                    'success' => false,
                    'message' => 'No data to process',
                    'processed_count' => 0
                ];
            }
            
            // CRITICAL: Deduplicate results
            $allResults = $this->deduplicateResults($allResults);
            
            // Get all existing records for these skills in ONE query
            $existingRecords = MasterTechnicalSkillCognitiveDomain::whereIn('master_technical_skill_id', $technicalSkillIds)
                ->get()
                ->groupBy('master_technical_skill_id')
                ->map(function ($records) {
                    return $records->keyBy('level');
                });
            
            // Separate into updates and inserts
            $toUpdate = [];
            $toInsert = [];
            
            foreach ($allResults as $result) {
                $skillId = $result['master_technical_skill_id'];
                $level = $result['level'];
                
                if (isset($existingRecords[$skillId]) && isset($existingRecords[$skillId][$level])) {
                    // Exists - prepare for update
                    $toUpdate[] = [
                        'id' => $existingRecords[$skillId][$level]->id,
                        'data' => $result
                    ];
                } else {
                    // Doesn't exist - prepare for insert
                    $toInsert[] = $result;
                }
            }
            
            // Batch update
            foreach ($toUpdate as $updateItem) {
                MasterTechnicalSkillCognitiveDomain::where('id', $updateItem['id'])->update([
                    'name' => $updateItem['data']['name'],
                    'qk_ka_count' => $updateItem['data']['qk_ka_count'],
                    'ck_ka_count' => $updateItem['data']['ck_ka_count'],
                    'vr_ka_count' => $updateItem['data']['vr_ka_count'],
                    'fr_ka_count' => $updateItem['data']['fr_ka_count'],
                    'ka_total_count' => $updateItem['data']['ka_total_count'],
                    'qk_ka_percentage' => $updateItem['data']['qk_ka_percentage'],
                    'qk_ka_level' => $updateItem['data']['qk_ka_level'],
                    'ck_ka_percentage' => $updateItem['data']['ck_ka_percentage'],
                    'ck_ka_level' => $updateItem['data']['ck_ka_level'],
                    'vr_ka_percentage' => $updateItem['data']['vr_ka_percentage'],
                    'vr_ka_level' => $updateItem['data']['vr_ka_level'],
                    'fr_ka_percentage' => $updateItem['data']['fr_ka_percentage'],
                    'fr_ka_level' => $updateItem['data']['fr_ka_level'],
                    'updated_at' => now(),
                ]);
            }
            
            // Batch insert
            if (!empty($toInsert)) {
                // Insert in chunks to avoid memory issues
                collect($toInsert)->chunk(500)->each(function ($chunk) {
                    MasterTechnicalSkillCognitiveDomain::insert($chunk->toArray());
                });
            }
            
            return [
                'success' => true,
                'message' => 'Bulk data processed successfully',
                'processed_count' => count($allResults),
                'skills_processed' => count($technicalSkills),
                'updated' => count($toUpdate),
                'inserted' => count($toInsert)
            ];
            
        } catch (\Exception $e) {
            Log::error('Error in processBulkSkills: ' . $e->getMessage());
            
            return [
                'success' => false,
                'message' => 'Error processing bulk data: ' . $e->getMessage(),
                'processed_count' => 0
            ];
        }
    }
    
    /**
     * CRITICAL: Remove duplicates from results array based on master_technical_skill_id + level
     */
    private function deduplicateResults(array $results): array
    {
        $unique = [];
        $seen = [];
        
        foreach ($results as $result) {
            $key = $result['master_technical_skill_id'] . '_' . $result['level'];
            
            if (!isset($seen[$key])) {
                $seen[$key] = true;
                $unique[] = $result;
            }
        }
        
        return $unique;
    }
    
    public function getCountsForSkills(MasterTechnicalSkill $technicalSkill)
    {
        // Parse the model data
        $parsedSkills = $this->parseSkillsFromModel($technicalSkill);
        
        if (empty($parsedSkills)) {
            return [];
        }
        
        // Group parsed skills by level - THIS ENSURES ONE RESULT PER LEVEL
        $skillsByLevel = collect($parsedSkills)->groupBy('level');
        
        // Pre-fetch all cognitive domain mappings for this skill (OPTIMIZATION)
        $this->preloadCognitiveDomainMappings($parsedSkills);
        
        $results = [];
        
        foreach ($skillsByLevel as $level => $skills) {
            // Get counts for this level - returns ONE result per level
            $countsData = $this->getCountsForLevel($skills->toArray(), $technicalSkill, $level);
            
            if ($countsData) {
                $results[] = $countsData;
            }
        }
        
        // Clear cache after processing
        $this->cognitiveDomainCache = [];
        
        return $results;
    }
    
    /**
     * OPTIMIZATION: Pre-load all cognitive domain mappings in one query
     */
    private function preloadCognitiveDomainMappings(array $parsedSkills)
    {
        // Build conditions for whereIn query
        $conditions = [];
        foreach ($parsedSkills as $skill) {
            $conditions[] = [
                'level' => $skill['level'],
                'type' => $skill['type'],
                'description' => $skill['description']
            ];
        }
        
        if (empty($conditions)) {
            return;
        }
        
        // Fetch all matching records in ONE query
        $query = MasterTechnicalSkillsCognitiveDomainKa::query();
        
        $query->where(function ($q) use ($conditions) {
            foreach ($conditions as $condition) {
                $q->orWhere(function ($subQuery) use ($condition) {
                    $subQuery->where('level', $condition['level'])
                             ->where('type', $condition['type'])
                             ->where('description', $condition['description']);
                });
            }
        });
        
        $records = $query->select('level', 'type', 'description', 'cognitive_domain_short_name')->get();
        
        // Build cache key: level|type|description => cognitive_domain
        foreach ($records as $record) {
            $cacheKey = $record->level . '|' . $record->type . '|' . $record->description;
            $this->cognitiveDomainCache[$cacheKey] = $record->cognitive_domain_short_name;
        }
    }
    
    private function getCountsForLevel(array $skills, MasterTechnicalSkill $technicalSkill, int $level)
    {
        $cognitiveAssignments = [];
        
        // Process each skill using cached lookups (MUCH FASTER)
        foreach ($skills as $skill) {
            $cacheKey = $skill['level'] . '|' . $skill['type'] . '|' . $skill['description'];
            
            // Check cache first (OPTIMIZATION)
            if (isset($this->cognitiveDomainCache[$cacheKey])) {
                $cognitiveAssignments[] = [
                    'cognitive_domain' => $this->cognitiveDomainCache[$cacheKey],
                    'source' => 'matched'
                ];
            } else {
                // No match found - predict cognitive domain
                $predictedDomain = $this->predictCognitiveDomain($skill['description'], $skill['type']);
                $cognitiveAssignments[] = [
                    'cognitive_domain' => $predictedDomain,
                    'source' => 'predicted'
                ];
            }
        }
        
        // Count by cognitive domain
        $cognitiveCounts = collect($cognitiveAssignments)
            ->groupBy('cognitive_domain')
            ->map(function ($items) {
                return count($items);
            });
        
        // Initialize counts for all cognitive domains
        $qk_ka_count = $cognitiveCounts->get('qk', 0);
        $ck_ka_count = $cognitiveCounts->get('ck', 0);
        $vr_ka_count = $cognitiveCounts->get('vr', 0);
        $fr_ka_count = $cognitiveCounts->get('fr', 0);
        
        // Calculate total
        $ka_total_count = $qk_ka_count + $ck_ka_count + $vr_ka_count + $fr_ka_count;
        
        // If no data for this level, skip
        if ($ka_total_count == 0) {
            return null;
        }
        
        // Calculate percentages
        $qk_ka_percentage = round(($qk_ka_count / $ka_total_count) * 100, 2);
        $ck_ka_percentage = round(($ck_ka_count / $ka_total_count) * 100, 2);
        $vr_ka_percentage = round(($vr_ka_count / $ka_total_count) * 100, 2);
        $fr_ka_percentage = round(($fr_ka_count / $ka_total_count) * 100, 2);
        
        // Determine levels based on percentage
        $qk_ka_level = $this->determineLevel($qk_ka_percentage);
        $ck_ka_level = $this->determineLevel($ck_ka_percentage);
        $vr_ka_level = $this->determineLevel($vr_ka_percentage);
        $fr_ka_level = $this->determineLevel($fr_ka_percentage);
        
        // Return ONE record per level
        return [
            'master_technical_skill_id' => $technicalSkill->id,
            'name' => $technicalSkill->name,
            'level' => $level,
            'qk_ka_count' => $qk_ka_count,
            'ck_ka_count' => $ck_ka_count,
            'vr_ka_count' => $vr_ka_count,
            'fr_ka_count' => $fr_ka_count,
            'ka_total_count' => $ka_total_count,
            'qk_ka_percentage' => $qk_ka_percentage,
            'qk_ka_level' => $qk_ka_level,
            'ck_ka_percentage' => $ck_ka_percentage,
            'ck_ka_level' => $ck_ka_level,
            'vr_ka_percentage' => $vr_ka_percentage,
            'vr_ka_level' => $vr_ka_level,
            'fr_ka_percentage' => $fr_ka_percentage,
            'fr_ka_level' => $fr_ka_level,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
    
    /**
     * OPTIMIZED: Predict cognitive domain based on description content
     */
    private function predictCognitiveDomain(string $description, string $type): string
    {
        $descriptionLower = strtolower($description);
        $scores = [];
        
        // Calculate scores for each cognitive domain based on keyword matching
        foreach ($this->cognitiveDomainPatterns as $domain => $config) {
            $score = 0;
            
            foreach ($config['keywords'] as $keyword) {
                if (stripos($descriptionLower, $keyword) !== false) {
                    $score += $config['weight'];
                }
            }
            
            $scores[$domain] = $score;
        }
        
        // Additional heuristics based on type
        if ($type === 'knowledge') {
            $scores['ck'] += 0.5;
            $scores['qk'] += 0.3;
        } else if ($type === 'ability') {
            $scores['fr'] += 0.5;
            $scores['vr'] += 0.3;
        }
        
        // Find domain with highest score
        arsort($scores);
        $predictedDomain = array_key_first($scores);
        
        // If all scores are 0, use default based on type
        if ($scores[$predictedDomain] == 0) {
            return $type === 'knowledge' ? 'ck' : 'fr';
        }
        
        return $predictedDomain;
    }
    
    /**
     * OPTIMIZED: Get detailed breakdown with cached lookups
     */
    public function getDetailedBreakdownWithPredictions(MasterTechnicalSkill $technicalSkill)
    {
        $parsedSkills = $this->parseSkillsFromModel($technicalSkill);
        
        if (empty($parsedSkills)) {
            return [
                'matched_records' => [],
                'predicted_records' => [],
                'counts' => [],
            ];
        }
        
        // Pre-load all mappings (OPTIMIZATION)
        $this->preloadCognitiveDomainMappings($parsedSkills);
        
        $matched = [];
        $predicted = [];
        
        foreach ($parsedSkills as $skill) {
            $cacheKey = $skill['level'] . '|' . $skill['type'] . '|' . $skill['description'];
            
            if (isset($this->cognitiveDomainCache[$cacheKey])) {
                // Matched - use database result
                $matched[] = [
                    'level' => $skill['level'],
                    'type' => $skill['type'],
                    'description' => $skill['description'],
                    'cognitive_domain_short_name' => $this->cognitiveDomainCache[$cacheKey],
                    'cognitive_domain_name' => $this->getCognitiveDomainName($this->cognitiveDomainCache[$cacheKey]),
                    'source' => 'database'
                ];
            } else {
                // Not matched - predict
                $predictedDomain = $this->predictCognitiveDomain($skill['description'], $skill['type']);
                
                $predicted[] = [
                    'level' => $skill['level'],
                    'type' => $skill['type'],
                    'description' => $skill['description'],
                    'cognitive_domain_short_name' => $predictedDomain,
                    'cognitive_domain_name' => $this->getCognitiveDomainName($predictedDomain),
                    'source' => 'predicted'
                ];
            }
        }
        
        // Clear cache
        $this->cognitiveDomainCache = [];
        
        // Combine matched and predicted for counts
        $allRecords = array_merge($matched, $predicted);
        
        $counts = collect($allRecords)
            ->groupBy('cognitive_domain_short_name')
            ->map(function ($items, $domain) {
                return [
                    'knowledge' => $items->where('type', 'knowledge')->count(),
                    'ability' => $items->where('type', 'ability')->count(),
                    'total' => $items->count(),
                    'matched' => $items->where('source', 'database')->count(),
                    'predicted' => $items->where('source', 'predicted')->count(),
                ];
            })
            ->toArray();
        
        return [
            'matched_records' => $matched,
            'predicted_records' => $predicted,
            'counts' => $counts,
            'summary' => [
                'total_records' => count($allRecords),
                'matched_count' => count($matched),
                'predicted_count' => count($predicted),
                'prediction_rate' => count($allRecords) > 0 
                    ? round((count($predicted) / count($allRecords)) * 100, 2) 
                    : 0
            ]
        ];
    }
    
    private function getCognitiveDomainName(string $shortName): string
    {
        $names = [
            'qk' => 'Quantitative Knowledge',
            'ck' => 'Conceptual Knowledge',
            'vr' => 'Verbal Reasoning',
            'fr' => 'Functional Reasoning'
        ];
        
        return $names[$shortName] ?? 'Unknown';
    }
    
    private function determineLevel(float $percentage): int
    {
        if ($percentage >= 75) {
            return 3;
        } elseif ($percentage >= 25) {
            return 2;
        } else {
            return 1;
        }
    }
    
    private function parseSkillsFromModel(MasterTechnicalSkill $technicalSkill): array
    {
        $parsed = [];
        
        // Loop through levels 1-6
        for ($level = 1; $level <= 6; $level++) {
            // Process knowledge
            $knowledgeField = "level_{$level}_knowledge";
            if (!empty($technicalSkill->$knowledgeField)) {
                $descriptions = array_filter(
                    array_map('trim', explode(';', $technicalSkill->$knowledgeField))
                );
                
                foreach ($descriptions as $description) {
                    $parsed[] = [
                        'level' => $level,
                        'type' => 'knowledge',
                        'description' => $description,
                    ];
                }
            }
            
            // Process ability
            $abilityField = "level_{$level}_ability";
            if (!empty($technicalSkill->$abilityField)) {
                $descriptions = array_filter(
                    array_map('trim', explode(';', $technicalSkill->$abilityField))
                );
                
                foreach ($descriptions as $description) {
                    $parsed[] = [
                        'level' => $level,
                        'type' => 'ability',
                        'description' => $description,
                    ];
                }
            }
        }
        
        return $parsed;
    }
    
    /**
     * Clean up duplicate records for a specific skill
     */
    public function cleanupDuplicates(int $masterTechnicalSkillId)
    {
        try {
            DB::beginTransaction();
            
            // Get all records for this skill grouped by level
            $records = MasterTechnicalSkillCognitiveDomain::where('master_technical_skill_id', $masterTechnicalSkillId)
                ->orderBy('level')
                ->orderBy('id')
                ->get()
                ->groupBy('level');
            
            $deletedCount = 0;
            
            foreach ($records as $level => $levelRecords) {
                if ($levelRecords->count() > 1) {
                    // Keep the first record, delete the rest
                    $keepRecord = $levelRecords->first();
                    
                    foreach ($levelRecords->skip(1) as $duplicateRecord) {
                        $duplicateRecord->delete();
                        $deletedCount++;
                    }
                }
            }
            
            DB::commit();
            
            return [
                'success' => true,
                'message' => "Cleaned up $deletedCount duplicate records",
                'deleted_count' => $deletedCount
            ];
            
        } catch (\Exception $e) {
            DB::rollBack();
            
            return [
                'success' => false,
                'message' => 'Error cleaning up duplicates: ' . $e->getMessage(),
                'deleted_count' => 0
            ];
        }
    }
    
    /**
     * Clean up all duplicates across all skills
     */
    public function cleanupAllDuplicates()
    {
        try {
            DB::beginTransaction();
            
            // Get all duplicate combinations
            $duplicates = DB::table('master_technical_skill_cognitive_domains')
                ->select('master_technical_skill_id', 'level', DB::raw('COUNT(*) as count'))
                ->groupBy('master_technical_skill_id', 'level')
                ->having('count', '>', 1)
                ->get();
            
            $totalDeleted = 0;
            
            foreach ($duplicates as $duplicate) {
                // Get all records for this combination
                $records = MasterTechnicalSkillCognitiveDomain::where('master_technical_skill_id', $duplicate->master_technical_skill_id)
                    ->where('level', $duplicate->level)
                    ->orderBy('id')
                    ->get();
                
                // Keep first, delete rest
                foreach ($records->skip(1) as $record) {
                    $record->delete();
                    $totalDeleted++;
                }
            }
            
            DB::commit();
            
            return [
                'success' => true,
                'message' => "Cleaned up $totalDeleted duplicate records across all skills",
                'deleted_count' => $totalDeleted,
                'duplicate_combinations' => $duplicates->count()
            ];
            
        } catch (\Exception $e) {
            DB::rollBack();
            
            return [
                'success' => false,
                'message' => 'Error cleaning up all duplicates: ' . $e->getMessage(),
                'deleted_count' => 0
            ];
        }
    }
}