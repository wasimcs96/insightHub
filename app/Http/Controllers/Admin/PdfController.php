<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use App\Models\Job;
use App\Models\Department;
use App\Models\MasterGeneralSetting;
use Illuminate\Support\Facades\Storage;
use App\Models\MasterSkill;
use App\Models\MasterScopeOfStudy;

class PdfController extends Controller
{
    public function exportInternalPdf($id)
    {
        ini_set('memory_limit', '500M');

        $job = Job::with([
            'businessUnit',
            'division',
            'educationLevel',
            'scopeStudy',
            'technicalSkills',
            'Skills',
            'criticalFunctions',
            'headcounts' 
        ])->find($id);

        $logo = MasterGeneralSetting::where('name', 'logo')->first();
        $logoPath = $logo?->value;
        $imagePath = public_path('storage/' . $logoPath);
        if (file_exists($imagePath)) {
            // Detect image type
            $imageInfo = getimagesize($imagePath);
$imageType = $imageInfo[2] ?? null;

            $image = null;
            if ($imageType === IMAGETYPE_PNG) {
                $image = imagecreatefrompng($imagePath);
            } elseif ($imageType === IMAGETYPE_JPEG) {
                $image = imagecreatefromjpeg($imagePath);
            } elseif ($imageType === IMAGETYPE_GIF) {
                $image = imagecreatefromgif($imagePath);
            }
            if ($image) {
                // Use original image data for best quality
                $imageData = file_get_contents($imagePath);
                $base64Image = base64_encode($imageData);
                imagedestroy($image);
            } else {
                $base64Image = '';
            }
        } else {
            $base64Image = '';
        }

        $technicalSkills = $job->technicalSkills->map(function($skill) {
            $level = $skill->pivot->level ?? 1;
            $skillData = $skill->toArray();
            $desc = $skillData['level_' . $level . '_description'] ?? '';
            $skill->current_description = $desc ?: ($skillData['description'] ?? '');
            return $skill;
        });

        $masterSkills = MasterSkill::all();

        $genericSkills = $job->Skills->map(function($skill) use ($masterSkills) {
            $level = $skill->level ?? 1;
            $master = $masterSkills->first(function($ms) use ($skill) {
                return $ms->name === $skill->title;
            });
            $desc = '';
            if ($master) {
                $descKey = 'level_' . $level . '_description';
                $desc = !empty($master->$descKey) ? $master->$descKey : ($master->description ?? '');
            }
            $skill->current_description = $desc;
            return $skill;
        });

        $masterScopes = MasterScopeOfStudy::all();

        $cleanTitle = preg_replace('/[^A-Za-z0-9 ]/', '', $job->title);
        $cleanTitle = str_replace(' ', '_', $cleanTitle);
        $dateString = date('dmY'); // DDMMYYYY
        $exportTitle = $cleanTitle . '_' . $dateString;

        $data = [
            'job' => $job,
            'critical_functions' => $job->criticalFunctions,
            'technical_skills' => $technicalSkills,
            'generic_skills' => $genericSkills,
            'base64Image' => $base64Image,
            'masterSkills' => $masterSkills,
            'masterScopes' => $masterScopes,
        ];

        $pdf = PDF::loadView('admin.setting.download_jd_internal', $data)
            ->setPaper('a4', 'portrait')
            ->set_option("enable_php", true);

        return $pdf->download($exportTitle . '.pdf');
    }
    public function exportExternalPdf($id)
    {
        ini_set('memory_limit', '500M');

        $job = Job::with([
            'educationLevel', 
            'scopeStudy', 
            'technicalSkills', 
            'Skills', 
            'criticalFunctions', 
            'division',
            'OrgDepartment'
            ])->find($id);

        $logo = MasterGeneralSetting::where('name', 'logo')->first();
        $logoPath = $logo?->value;
        $imagePath = public_path('storage/' . $logoPath);

        if (file_exists($imagePath)) {
            $imageInfo = getimagesize($imagePath);
            $imageType = $imageInfo[2] ?? null;

            $image = null;
            if ($imageType === IMAGETYPE_PNG) {
                $image = imagecreatefrompng($imagePath);
            } elseif ($imageType === IMAGETYPE_JPEG) {
                $image = imagecreatefromjpeg($imagePath);
            } elseif ($imageType === IMAGETYPE_GIF) {
                $image = imagecreatefromgif($imagePath);
            }
            if ($image) {
                // Use original image data for best quality
                $imageData = file_get_contents($imagePath);
                $base64Image = base64_encode($imageData);
                imagedestroy($image);
            } else {
                $base64Image = '';
            }
        } else {
            $base64Image = '';
        }

        $technicalSkills = $job->technicalSkills->map(function($skill) {
            $level = $skill->pivot->level ?? 1;
            $skillData = $skill->toArray();
            $desc = $skillData['level_' . $level . '_description'] ?? '';
            $skill->current_description = $desc ?: ($skillData['description'] ?? '');
            return $skill;
        });

        $masterSkills = MasterSkill::all();

        $genericSkills = $job->Skills->map(function($skill) use ($masterSkills) {
            $level = $skill->level ?? 1;
            $master = $masterSkills->first(function($ms) use ($skill) {
                return $ms->name === $skill->title;
            });
            $desc = '';
            if ($master) {
                $descKey = 'level_' . $level . '_description';
                $desc = !empty($master->$descKey) ? $master->$descKey : ($master->description ?? '');
            }
            $skill->current_description = $desc;
            return $skill;
        });

        $masterScopes = MasterScopeOfStudy::all();

        $cleanTitle = preg_replace('/[^A-Za-z0-9 ]/', '', $job->title);
        $cleanTitle = str_replace(' ', '_', $cleanTitle);
        $dateString = date('dmY'); // DDMMYYYY
        $exportTitle = $cleanTitle . '_' . $dateString;

        $data = [
            'job' => $job,
            'critical_functions' => $job->criticalFunctions,
            'technical_skills' => $technicalSkills,
            'generic_skills' => $genericSkills,
            'base64Image' => $base64Image,
            'masterSkills' => $masterSkills,
            'masterScopes' => $masterScopes,
        ];

        $pdf = PDF::loadView('admin.setting.download_jd_external', $data)
            ->setPaper('a4', 'portrait')
            ->set_option("enable_php", true);

        return $pdf->download($exportTitle . '.pdf');
    }
    public function exportMasterPdf($id)
    {
        ini_set('memory_limit', '500M');

        $job = Job::with([
            'businessUnit',
            'division',
            'educationLevel',
            'scopeStudy',
            'technicalSkills',
            'Skills',
            'criticalFunctions'
        ])->find($id);

        $technicalSkills = $job->technicalSkills->map(function($skill) {
            $level = $skill->pivot->level ?? 1;
            $skillData = $skill->toArray();
            $desc = $skillData['level_' . $level . '_description'] ?? '';
            $skill->current_description = $desc ?: ($skillData['description'] ?? '');
            return $skill;
        });

        $masterSkills = MasterSkill::all();

        $genericSkills = $job->Skills->map(function($skill) use ($masterSkills) {
            $level = $skill->level ?? 1;
            $master = $masterSkills->first(function($ms) use ($skill) {
                return $ms->name === $skill->title;
            });
            $desc = '';
            if ($master) {
                $descKey = 'level_' . $level . '_description';
                $desc = !empty($master->$descKey) ? $master->$descKey : ($master->description ?? '');
            }
            $skill->current_description = $desc;
            return $skill;
        });

        $masterScopes = MasterScopeOfStudy::all();

        $cleanTitle = preg_replace('/[^A-Za-z0-9 ]/', '', $job->title);
        $cleanTitle = str_replace(' ', '_', $cleanTitle);
        $dateString = date('dmY'); // DDMMYYYY
        $exportTitle = $cleanTitle . '-MasterJD_' . $dateString;

        $data = [
            'job' => $job,
            'critical_functions' => $job->criticalFunctions,
            'technical_skills' => $technicalSkills,
            'generic_skills' => $genericSkills,
            'masterSkills' => $masterSkills,
            'masterScopes' => $masterScopes,
        ];

        $pdf = PDF::loadView('admin.setting.download_jd_master', $data)
            ->setPaper('a4', 'portrait')
            ->set_option("enable_php", true);

        return $pdf->download($exportTitle . '.pdf');
    }
    public function exportCompanyJDPdf($id)
    {
        $jobs = Job::where('org_department', $id)->get();
        $department = Department::where('id',$id)->first();
       
        // Define the path using DIRECTORY_SEPARATOR for consistency
        $publicPath = public_path('job_description' . DIRECTORY_SEPARATOR . $department->name);
        
        // Ensure the directory exists, create it if not
        if (!is_dir($publicPath)) {
            // Attempt to create the directory and capture any error
            if (!mkdir($publicPath, 0755, true)) {
                die('Failed to create directory: ' . $publicPath);
            }
        }
        
        // Generate the PDFs
        foreach ($jobs as $job) {
            $data = [
                'job' => $job,
                'critical_functions' => $job->criticalFunctions,
                'technical_skills' => $job->technicalSkills,
                'generic_skills' => $job->Skills
            ];
            
            $pdf = PDF::loadView('admin.setting.download_jd', $data);
            
            $cleanTitle = preg_replace('/[^A-Za-z0-9 ]/', '', $job->title); // Remove all special characters
            $cleanTitle = str_replace(' ', '_', $cleanTitle); 
            
            // Save the generated PDF for each job in the public directory
            $pdfFilePath = $publicPath . DIRECTORY_SEPARATOR . $cleanTitle . '.pdf';
            
            try {
                $pdf->save($pdfFilePath);
            } catch (\Exception $e) {
                die('Failed to save PDF: ' . $e->getMessage());
            }
        }
        $cleanDepartTitle = preg_replace('/[^A-Za-z0-9 ]/', '',  $department->name); // Remove all special characters
            $cleanDepartTitle = str_replace(' ', '_', $cleanDepartTitle);
        // Create a ZIP file
        $zipFilePath = public_path('job_description' . DIRECTORY_SEPARATOR . $cleanDepartTitle .'.zip');
        $zip = new \ZipArchive();
    
        if ($zip->open($zipFilePath, \ZipArchive::CREATE | \ZipArchive::OVERWRITE) !== true) {
            die('Failed to create ZIP file: ' . $zipFilePath);
        }
        
        // Add all PDF files to the ZIP
        $files = glob($publicPath . DIRECTORY_SEPARATOR . '*.pdf');
        foreach ($files as $file) {
            $zip->addFile($file, basename($file));
        }
        
        $zip->close();
        
        // Return the ZIP file for download
        return response()->download($zipFilePath)->deleteFileAfterSend(true);
    }
}
