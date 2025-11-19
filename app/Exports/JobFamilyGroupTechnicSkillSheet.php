<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class JobFamilyGroupTechnicSkillSheet implements FromArray, WithHeadings, WithTitle, WithEvents
{
    protected $group;
    protected $skills;
    protected $jobs;
    protected $dataCache = [];
    protected $columnsWithLevels = [];
    protected $levelCells = []; // Store cells by level for batch coloring

    public function __construct($group, $skills, $jobs)
    {
        $this->group = $group;
        // Pre-sort skills once
        $this->skills = $skills->sortBy('name')->values();
        $this->jobs = $jobs;
        $this->prepareDataOptimized();
    }

    private function prepareDataOptimized()
    {
        // Pre-create skill map for O(1) lookups
        $skillsById = $this->skills->keyBy('id');
        
        // Initialize level cell arrays
        for ($i = 1; $i <= 6; $i++) {
            $this->levelCells[$i] = [];
        }
        
        $rowIndex = 2;
        
        // Process jobs
        foreach ($this->jobs as $job) {
            $row = [
                $job->head_of_division ?? '',
                $job->department_name ?? '',
                $job->job_profile_name ?? '',
                $job->level ?? '',
                ($job->status == 1) ? 'Approved' : 'Pending',
            ];

            // Pre-convert skills to keyed collection for this job
            $jobSkills = collect($job->skills)->keyBy('master_technical_skill_id');

            // Process each skill column
            foreach ($this->skills as $skillIndex => $skill) {
                $colIndex = $skillIndex + 6;
                
                if ($jobSkill = $jobSkills->get($skill->id)) {
                    $level = (int) $jobSkill->level;
                    
                    if ($level >= 1 && $level <= 6) {
                        $descCol = 'level_' . $level . '_description';
                        $desc = $skill->{$descCol} ?? '';
                        
                        $row[] = "Level {$level}\n{$desc}";
                        
                        // Track for batch coloring
                        $this->columnsWithLevels[$colIndex] = true;
                        $this->levelCells[$level][] = [$rowIndex, $colIndex];
                    } else {
                        $row[] = '';
                    }
                } else {
                    $row[] = '';
                }
            }

            $this->dataCache[] = $row;
            $rowIndex++;
        }
    }

    public function array(): array
    {
        return $this->dataCache;
    }

    public function headings(): array
    {
        // Pre-build headers efficiently
        $headers = ['Division', 'Department', 'Job Position', 'Management Level', 'Status'];
        
        foreach ($this->skills as $skill) {
            $headers[] = "{$skill->name} ({$skill->sector_name}-{$skill->category_title})";
        }
        
        return $headers;
    }

    public function title(): string
    {
        return substr($this->group->name, 0, 31);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $this->applyUltraOptimizedStyling($event);
            }
        ];
    }

    private function applyUltraOptimizedStyling(AfterSheet $event)
{
    $sheet = $event->sheet->getDelegate();
    $highestColumn = $sheet->getHighestColumn();
    $highestRow = $sheet->getHighestRow();
    $highestColumnIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn);

    // Freeze panes
    $sheet->freezePane('F2');

    // FIXED: Set column widths properly using index
    for ($colIndex = 1; $colIndex <= $highestColumnIndex; $colIndex++) {
        $colLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($colIndex);
        $sheet->getColumnDimension($colLetter)->setWidth(35);
    }
    
    // Hide columns after setting widths
    $sheet->getColumnDimension('D')->setVisible(false);
    $sheet->getColumnDimension('E')->setVisible(false);

    // Apply all styles in minimal batches
    $this->batchApplyStyles($sheet, $highestColumn, $highestRow);

    // Apply colors in optimized batches
    $this->batchApplyColors($sheet, $highestColumn, $highestRow);

    // Set row heights
    $sheet->getRowDimension(1)->setRowHeight(80);
    for ($row = 2; $row <= $highestRow; $row++) {
        $sheet->getRowDimension($row)->setRowHeight(80);
    }
}

    private function batchSetColumnProperties($sheet, $highestColumn)
    {
        // Set all column widths in one loop
        for ($col = 'A'; $col <= $highestColumn; $col++) {
            $sheet->getColumnDimension($col)->setWidth(35);
            
            // Hide specific columns
            if ($col == 'D' || $col == 'E') {
                $sheet->getColumnDimension($col)->setVisible(false);
            }
        }
    }

    private function batchApplyStyles($sheet, $highestColumn, $highestRow)
    {
        // Apply all general styles in one go
        $allCellsStyle = [
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
                'wrapText' => true,
            ],
        ];
        
        $sheet->getStyle("A1:{$highestColumn}{$highestRow}")->applyFromArray($allCellsStyle);

        // Header styles - combine common properties
        $headerBaseStyle = [
            'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
                'wrapText' => true,
            ],
        ];

        // Base headers (black)
        $baseHeaderStyle = array_merge($headerBaseStyle, [
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '000000']]
        ]);
        $sheet->getStyle("A1:E1")->applyFromArray($baseHeaderStyle);

        // Skill headers (default red, will override green ones later)
        if ($highestColumn != 'E') {
            $skillHeaderStyle = array_merge($headerBaseStyle, [
                'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => 'C00000']]
            ]);
            $sheet->getStyle("F1:{$highestColumn}1")->applyFromArray($skillHeaderStyle);
        }
    }

    private function batchApplyColors($sheet, $highestColumn, $highestRow)
    {
        $levelColors = [
            1 => 'D9EAF7', 2 => 'B3DAF2', 3 => '8CCCEF',
            4 => '66BEEB', 5 => '40AEE7', 6 => '1A9EE3',
        ];

        // Apply level colors in batches by level
        foreach ($this->levelCells as $level => $cells) {
            if (empty($cells)) continue;
            
            $color = $levelColors[$level];
            
            // Group cells by column for efficient range creation
            $cellsByColumn = [];
            foreach ($cells as [$row, $col]) {
                $cellsByColumn[$col][] = $row;
            }
            
            // Apply color to each column's cells
            foreach ($cellsByColumn as $col => $rows) {
                $colLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($col);
                
                // Create ranges for consecutive rows
                sort($rows);
                $ranges = $this->createConsecutiveRanges($rows, $colLetter);
                
                foreach ($ranges as $range) {
                    $sheet->getStyle($range)->getFill()
                        ->setFillType(Fill::FILL_SOLID)
                        ->getStartColor()->setRGB($color);
                }
            }
        }

        // Update headers and apply remaining colors
        $this->finalizeColumnColors($sheet, $highestColumn, $highestRow);
    }

    private function createConsecutiveRanges($rows, $colLetter)
    {
        $ranges = [];
        $start = $rows[0];
        $end = $rows[0];
        
        for ($i = 1; $i < count($rows); $i++) {
            if ($rows[$i] == $end + 1) {
                $end = $rows[$i];
            } else {
                $ranges[] = $start == $end ? "{$colLetter}{$start}" : "{$colLetter}{$start}:{$colLetter}{$end}";
                $start = $end = $rows[$i];
            }
        }
        
        $ranges[] = $start == $end ? "{$colLetter}{$start}" : "{$colLetter}{$start}:{$colLetter}{$end}";
        
        return $ranges;
    }

    private function finalizeColumnColors($sheet, $highestColumn, $highestRow)
    {
        $totalCols = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn);
        
        for ($col = 6; $col <= $totalCols; $col++) {
            $colLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($col);
            
            if (isset($this->columnsWithLevels[$col])) {
                // Green header for columns with levels
                $sheet->getStyle("{$colLetter}1")->getFill()
                    ->setFillType(Fill::FILL_SOLID)
                    ->getStartColor()->setRGB('00B050');
            } else {
                // Light red for columns without levels
                $sheet->getStyle("{$colLetter}2:{$colLetter}{$highestRow}")->getFill()
                    ->setFillType(Fill::FILL_SOLID)
                    ->getStartColor()->setRGB('FFE6E6');
            }
        }
    }

    private function batchSetRowHeights($sheet, $highestRow)
    {
        // Set all row heights at once
        $sheet->getRowDimension(1)->setRowHeight(80);
        
        // Use a more efficient method for multiple rows
        for ($row = 2; $row <= $highestRow; $row++) {
            $sheet->getRowDimension($row)->setRowHeight(80);
        }
    }
}