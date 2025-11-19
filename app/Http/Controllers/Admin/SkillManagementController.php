<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sector;
use App\Models\JobSkill;
use App\Models\JobTechnicalSkills;
use App\Models\TechnicalSkillCategory;
use App\Models\MasterTechnicalSkill;


class SkillManagementController extends Controller
{
    public function dashboard(Request $request){
        $sectorName = $request->sector_name;
        // $sectors = Sector::all();
        $sectors = Sector::when($request->sector_name, function ($query, $sectorName) {
            return $query->where('name', 'like', '%' . $sectorName . '%');
        })->get();
            $data = [];
            foreach ($sectors as $key => $value) {      
                $skillCounts = JobSkill::whereHas('job', function ($query) use ($value) {
                    $query->where('department_id', $value->id);
                })->distinct('title')->count('id');
                
                $techSkillCounts = JobTechnicalSkills::whereHas('job', function ($query) use ($value) {
                    $query->where('department_id', $value->id);
                
                })->distinct('master_technical_skill_id')->count('id');
                // $techSkillCounts = MasterTechnicalSkill::where('is_custom',0)->where('sector_id', $value->id)->count();

                $data[$value->name] = ["icon"=>$value->icon,"id" => $value->id, "count" =>  $techSkillCounts];
            }
            return view('admin.skill-management.dashboard', compact('data'));
    }

    public function viewSkills(){
        return view('admin.skill-management.view-skills');
    }

    public function sectorSkills(Request $request, $sector_id, $category_id = null)
    {
        $search = $request->query('search');
        $letter = $request->query('letter');
        $level = $request->query('level');
        $sort = $request->query('sort', 'name'); // Default sort by name
        $order = $request->query('order', 'asc'); // Default order asc

        $letterPage = $request->query('letter_page', 1);
        $lettersPerPage = 7;

        $perPage = (int) $request->query('per_page', 10); // default to 10 if not set

        // Base query
        $query = MasterTechnicalSkill::where('is_custom',0)->where('sector_id', $sector_id);

        // Apply category filter
        if ($category_id) {
            $query->where('category_id', $category_id);
        }

        // Apply search filter
        if ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        }

        // Apply starting letter filter
        if ($letter && strtoupper($letter) !== 'ALL') {
            $query->whereRaw('UPPER(LEFT(name, 1)) = ?', [strtoupper($letter)]);
        }

        // Apply level description filter
        if ($level && in_array($level, ['1','2','3','4','5','6'])) {
            $query->whereNotNull("level_{$level}_description")
                ->where("level_{$level}_description", '!=', '');
        }

        $allowedSorts = ['name', 'created_at'];
        $allowedOrders = ['asc', 'desc'];

        $sort = in_array($request->query('sort'), $allowedSorts) ? $request->query('sort') : 'name';
        $order = in_array($request->query('order'), $allowedOrders) ? $request->query('order') : 'asc';


        // Apply sorting based on query parameters
        $query->orderBy($sort, $order);

        // Paginate results with query strings preserved
        $technicalSkills = $query->paginate($perPage)->withQueryString();

        // Sector info
        $sector = Sector::find($sector_id);

        // Total skills in sector (regardless of filters)
        $totalSkills = MasterTechnicalSkill::where('is_custom',0)->where('sector_id', $sector_id)->count();

        // Selected category (for UI purposes)
        $selectedCategory = $category_id ? TechnicalSkillCategory::find($category_id) : null;

        // Get category list with skill counts
        $categories = TechnicalSkillCategory::where('sector_id', $sector_id)
            ->withCount(['technicalSkills' => function ($q) use ($sector_id) {
                $q->where('sector_id', $sector_id);
                $q->where('is_custom',0);
            }])
            ->get()
            ->map(function ($category) {
                $category->skills_count = $category->technical_skills_count;
                return $category;
            });

        // Dynamically fetch letters only from current filter scope (sector + optional category)
        $letterQuery = MasterTechnicalSkill::where('is_custom',0)->where('sector_id', $sector_id);
        if ($category_id) {
            $letterQuery->where('category_id', $category_id);
        }
        $allLetters = $letterQuery
            ->selectRaw('UPPER(LEFT(name, 1)) as first_letter')
            ->groupBy('first_letter')
            ->orderBy('first_letter')
            ->pluck('first_letter')
            ->toArray();
// dd($allLetters);
        // Prepare paged letters for top bar filtering
        // $totalLetterPages = ceil(count($allLetters) / $lettersPerPage);
        // $visibleLetters = array_slice($allLetters, 0, $lettersPerPage);
        // $hiddenLetters = array_slice($allLetters, $lettersPerPage);
        $visibleLetters =$allLetters;
        $totalLetterPages = count($allLetters);
        // Send data to view
        return view('admin.skill-management.sector-skills', compact(
            'categories',
            'technicalSkills',
            'sector_id',
            'category_id',
            'search',
            'sector',
            'totalSkills',
            'selectedCategory',
            'letter',
            'visibleLetters',
            // 'hiddenLetters',
            'letterPage',
            'totalLetterPages',
            'level',
            'sort', // Add sort param for UI
            'order' // Add order param for UI
        ));
    }

    public function searchCategory($sector_id, Request $request)
    {
        $query = $request->get('query');
        
        $categories = TechnicalSkillCategory::where('sector_id', $sector_id)
                        ->where('title', 'like', "%{$query}%")
                        ->get();
    
        return response()->json([
            'categories' => $categories
        ]);
    }


    // Controller
public function search(Request $request) {
    $title = $request->query('name');
    $results = MasterTechnicalSkill::where('is_custom',0)->where('name', 'LIKE', "%{$title}%")->get();
    return response()->json($results);
}
    

    public function create()
    {
        $categories = TechnicalSkillCategory::all();

        return view('admin.skill-management.create',compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|integer|exists:technical_skill_categories,id',
            'level_description' => 'array',
            'knowledge' => 'array',
            'ability' => 'array',
        ]);
    
        // Initialize data array for DB insert
        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'is_custom' => $request->input('custom', 0),
        ];
        
        for ($i = 1; $i <= 6; $i++) {
            $data["level_{$i}_description"] = $request->input("level_{$i}_description");
            $data["level_{$i}_knowledge"] = $request->has("level_{$i}_knowledge") ? implode('; ', $request->input("level_{$i}_knowledge")) : null;
            $data["level_{$i}_ability"] = $request->has("level_{$i}_ability") ? implode('; ', $request->input("level_{$i}_ability")) : null;
        }
        
        MasterTechnicalSkill::create($data);
        
    
        return redirect()->back()->with('success', 'Technical Skill saved successfully!');
    }
    public function skill_view_detail() {
        return view('admin.skill-management.view-detail');
    }

    public function skill_view_master() {
        return view('admin.skill-management.master-skill');

    }

    public function fetchSkillsByCategory($categoryId)
    {
        // Fetch skills based on the category_id
        $skills = MasterTechnicalSkill::where('is_custom',0)->where('category_id', $categoryId)->get();

        // Return the skills as JSON
        return response()->json([
            'skills' => $skills,
        ]);
    }
}
