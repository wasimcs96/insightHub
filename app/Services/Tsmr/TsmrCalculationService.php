<?php

namespace App\Services\Tsmr;

use Illuminate\Support\Facades\DB;
use App\Models\MasterTechnicalSkill;
use App\Models\MasterTechnicalSkillsCognitiveDomainKa;

class TsmrCalculationService
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

    private $cognitiveDomainCache = [];

    /**
     * Calculate Technical Skill Match Rate
     */
    public function calculateTechnicalSkillMatchRate($user_id, $position_id, $cognitiveResult)
    {
        // Get job technical skills with their required levels
        $jobTechnicalSkills = DB::table('job_technical_skills as jts')
            ->join('master_technical_skills as mts', 'jts.master_technical_skill_id', '=', 'mts.id')
            ->where('jts.job_id', $position_id)
            ->select([
                'jts.master_technical_skill_id',
                'jts.level as required_level',
                'mts.name as technical_skill_name',
                'mts.level_1_knowledge',
                'mts.level_2_knowledge',
                'mts.level_3_knowledge',
                'mts.level_4_knowledge',
                'mts.level_5_knowledge',
                'mts.level_6_knowledge',
                'mts.level_1_ability',
                'mts.level_2_ability',
                'mts.level_3_ability',
                'mts.level_4_ability',
                'mts.level_5_ability',
                'mts.level_6_ability'
            ])
            ->get();

        if ($jobTechnicalSkills->isEmpty()) {
            return -1; // No technical skills found for the job
        }

        // Get all unique master_technical_skill_ids for batch processing
        $skillIds = $jobTechnicalSkills->pluck('master_technical_skill_id')->unique()->toArray();

        // Pre-load all cognitive domain mappings for these skills in ONE query
        $this->preloadCognitiveDomainMappingsForSkills($skillIds);

        $technicalSkillTSMRs = [];

        foreach ($jobTechnicalSkills as $jobSkill) {
            // Calculate cognitive domain distribution for this skill at the required level
            $cognitiveDistribution = $this->calculateCognitiveDistribution(
                $jobSkill,
                $jobSkill->required_level
            );

            if (empty($cognitiveDistribution)) {
                continue;
            }

            // Calculate TSMR for this skill
            $tsmr = $this->calculateSkillTSMR($cognitiveDistribution, $cognitiveResult);
            
            if ($tsmr !== null) {
                $technicalSkillTSMRs[] = $tsmr;
            }
        }

        // Clear cache
        $this->cognitiveDomainCache = [];

        return round(
            count($technicalSkillTSMRs) > 0 
                ? array_sum($technicalSkillTSMRs) / count($technicalSkillTSMRs) 
                : 0, 
            2
        );
    }

    /**
     * Pre-load cognitive domain mappings for multiple skills
     */
    private function preloadCognitiveDomainMappingsForSkills(array $skillIds)
    {
        // Get all KA records for these skills
        $records = MasterTechnicalSkillsCognitiveDomainKa::whereIn('master_technical_skill_id', $skillIds)
            ->select('master_technical_skill_id', 'level', 'type', 'description', 'cognitive_domain_short_name')
            ->get();

        // Build cache
        foreach ($records as $record) {
            $cacheKey = $record->master_technical_skill_id . '|' . $record->level . '|' . $record->type . '|' . $record->description;
            $this->cognitiveDomainCache[$cacheKey] = $record->cognitive_domain_short_name;
        }
    }

    /**
     * Calculate cognitive domain distribution for a technical skill at a specific level
     */
    private function calculateCognitiveDistribution($jobSkill, $level)
    {
        // Parse knowledge and ability for this level
        $parsedSkills = [];
        
        // Parse knowledge
        $knowledgeField = "level_{$level}_knowledge";
        if (!empty($jobSkill->$knowledgeField)) {
            $descriptions = array_filter(
                array_map('trim', explode(';', $jobSkill->$knowledgeField))
            );
            
            foreach ($descriptions as $description) {
                $parsedSkills[] = [
                    'master_technical_skill_id' => $jobSkill->master_technical_skill_id,
                    'level' => $level,
                    'type' => 'knowledge',
                    'description' => $description,
                ];
            }
        }
        
        // Parse ability
        $abilityField = "level_{$level}_ability";
        if (!empty($jobSkill->$abilityField)) {
            $descriptions = array_filter(
                array_map('trim', explode(';', $jobSkill->$abilityField))
            );
            
            foreach ($descriptions as $description) {
                $parsedSkills[] = [
                    'master_technical_skill_id' => $jobSkill->master_technical_skill_id,
                    'level' => $level,
                    'type' => 'ability',
                    'description' => $description,
                ];
            }
        }

        if (empty($parsedSkills)) {
            return null;
        }

        // Assign cognitive domains (matched or predicted)
        $cognitiveAssignments = [];
        
        foreach ($parsedSkills as $skill) {
            $cacheKey = $skill['master_technical_skill_id'] . '|' . $skill['level'] . '|' . $skill['type'] . '|' . $skill['description'];
            
            if (isset($this->cognitiveDomainCache[$cacheKey])) {
                // Matched from database
                $cognitiveAssignments[] = $this->cognitiveDomainCache[$cacheKey];
            } else {
                // Predict
                $cognitiveAssignments[] = $this->predictCognitiveDomain($skill['description'], $skill['type']);
            }
        }

        // Count by cognitive domain
        $counts = [
            'qk' => 0,
            'ck' => 0,
            'vr' => 0,
            'fr' => 0
        ];

        foreach ($cognitiveAssignments as $domain) {
            if (isset($counts[$domain])) {
                $counts[$domain]++;
            }
        }

        $total = array_sum($counts);

        if ($total == 0) {
            return null;
        }

        // Calculate percentages and levels
        return [
            'qk_percentage' => round(($counts['qk'] / $total) * 100, 2),
            'ck_percentage' => round(($counts['ck'] / $total) * 100, 2),
            'vr_percentage' => round(($counts['vr'] / $total) * 100, 2),
            'fr_percentage' => round(($counts['fr'] / $total) * 100, 2),
            'qk_level' => $this->determineLevel(($counts['qk'] / $total) * 100),
            'ck_level' => $this->determineLevel(($counts['ck'] / $total) * 100),
            'vr_level' => $this->determineLevel(($counts['vr'] / $total) * 100),
            'fr_level' => $this->determineLevel(($counts['fr'] / $total) * 100),
        ];
    }

    /**
     * Calculate TSMR for a single skill
     */
    private function calculateSkillTSMR($cognitiveDistribution, $cognitiveResult)
    {
        $domains = [
            'Quantitative Knowledge' => [
                'percentage' => 'qk_percentage',
                'level' => 'qk_level'
            ],
            'Comprehension Knowledge' => [
                'percentage' => 'ck_percentage',
                'level' => 'ck_level'
            ],
            'Visual Reasoning' => [
                'percentage' => 'vr_percentage',
                'level' => 'vr_level'
            ],
            'Fluid Reasoning' => [
                'percentage' => 'fr_percentage',
                'level' => 'fr_level'
            ]
        ];

        $totalMatch = 0;
        $domainCount = 0;

        foreach ($domains as $domainName => $domainInfo) {
            $percentage = $cognitiveDistribution[$domainInfo['percentage']] ?? 0;
            $requiredLevel = $cognitiveDistribution[$domainInfo['level']] ?? 0;

            if ($percentage == 0) {
                continue;
            }

            $userLevel = $cognitiveResult[$domainName] ?? 0;
            $gap = $requiredLevel - $userLevel;
            $gapPercentage = $this->getGapPercentage($gap);

            $totalMatch += ($percentage * $gapPercentage);
            $domainCount++;
        }

        return $domainCount > 0 ? $totalMatch : null;
    }

    /**
     * Predict cognitive domain based on description
     */
    private function predictCognitiveDomain(string $description, string $type): string
    {
        $descriptionLower = strtolower($description);
        $scores = [];

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

        arsort($scores);
        $predictedDomain = array_key_first($scores);

        if ($scores[$predictedDomain] == 0) {
            return $type === 'knowledge' ? 'ck' : 'fr';
        }

        return $predictedDomain;
    }

    /**
     * Determine level based on percentage
     */
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

    /**
     * Get gap percentage based on level gap
     */
    private function getGapPercentage($gap)
    {
        if ($gap <= 0) {
            return 1.0; // 100% match when user meets or exceeds requirement
        } elseif ($gap == 1) {
            return 0.5; // 50% match when gap is 1
        } else { // gap >= 2
            return 0.25; // 25% match when gap is 2 or more
        }
    }
}