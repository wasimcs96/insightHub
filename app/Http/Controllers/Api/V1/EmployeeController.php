<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;
use App\Resources\Api\V1\{EmployeeResource, EmployeeDetailResource, JobDetailResource, PsychometricResultResource, TechnicalSkillDetailResource, SoftSkillDetailResource}; 
use App\Models\{User, Job, UserResult, MasterTechnicalSkill, MasterSkill};
use OpenApi\Annotations as OA;

class EmployeeController extends Controller
{
    /**
     * GET /rest/v1/employees
     *
     * Returns active users (employees) with department name and job title.
     *
     * Query params (optional):
     * - paginate: bool (default true). If false, returns full list (cached 5m when filters are empty)
     * - per_page: int (default 50, max 200)
     * - q: string (search by name/email)
     * - department_id: int (filter)
     * - position_id: int (filter) — foreign key to jobs.id
     * - job_id: int (alias for position_id)
     */

    /**
      * @OA\Get(
      *   path="/rest/v1/employees",
      *   summary="List active employees (users) with department and job",
      *   tags={"Employees"},
      *   security={{"bearerAuth":{},"ApiKeyAuth":{}}},
      *
      *   @OA\Parameter(
      *     name="x-api-key",
      *     in="header",
      *     required=true,
      *     description="Project API Key",
      *     @OA\Schema(type="string")
      *   ),
      *   @OA\Parameter(
      *     name="per_page",
      *     in="query",
      *     description="Items per page (default 50, max 200)",
      *     @OA\Schema(type="integer", minimum=1, maximum=200)
      *   ),
      *   @OA\Parameter(
      *     name="page",
      *     in="query",
      *     description="Page number (starts at 1)",
      *     @OA\Schema(type="integer", minimum=1)
      *   ),
      *   @OA\Parameter(
      *     name="q",
      *     in="query",
      *     description="Search by name/email",
      *     @OA\Schema(type="string")
      *   ),
      *   @OA\Parameter(
      *     name="department_id",
      *     in="query",
      *     @OA\Schema(type="integer")
      *   ),
      *   @OA\Parameter(
      *     name="position_id",
      *     in="query",
      *     @OA\Schema(type="integer")
      *   ),
      *   @OA\Parameter(
      *     name="job_id",
      *     in="query",
      *     @OA\Schema(type="integer")
      *   ),
      *
      *   @OA\Response(
      *     response=200,
      *     description="OK",
      *     @OA\JsonContent(
      *       type="object",
      *       @OA\Property(property="status", type="string", example="success"),
      *       @OA\Property(
      *         property="data",
      *         type="array",
      *         @OA\Items(
      *           type="object",
      *           @OA\Property(property="id", type="integer", example=123),
      *           @OA\Property(property="name", type="string", example="Jane Doe"),
      *           @OA\Property(property="email", type="string", example="jane@cxsanalytics.com"),
      *           @OA\Property(property="department_id", type="integer", example=5),
      *           @OA\Property(property="department_name", type="string", example="Finance"),
      *           @OA\Property(property="position_id", type="integer", example=7),
      *           @OA\Property(property="job_title", type="string", example="Senior Analyst")
      *           @OA\Property(property="job_level", type="string", example="Senior Analyst")
      *         )
      *       ),
      *       @OA\Property(
      *         property="meta",
      *         type="object",
      *         nullable=true,
      *         @OA\Property(
      *           property="pagination",
      *           type="object",
      *           @OA\Property(property="total", type="integer", example=250),
      *           @OA\Property(property="per_page", type="integer", example=50),
      *           @OA\Property(property="current_page", type="integer", example=1),
      *           @OA\Property(property="last_page", type="integer", example=5)
      *         )
      *       )
      *     )
      *   )
      * )
    */
     
    /**
     * Get a list of employees.
     *
     * Requires an API key in the header.
     *
     * @group Employee Management
     * @authenticated
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     * @queryParam per_page integer optional The number of items per page (default 50, max 200). Example: 50
     * @queryParam page integer optional The page number (starts at 1). Example: 1
     * @queryParam q string optional The search term for filtering by name or email. Example: "Jane Doe"
     * @queryParam department_id integer optional Filter by department ID. Example: "5"
     * @queryParam position_id integer optional Filter by position ID. Example: "7"
     * @queryParam job_id integer optional Filter by job ID. Example: "3"
     *
     * @response 200 scenario="Success" {
     *   "status": "success",
     *   "data": [
     *     {
     *       "id": 123,
     *       "name": "Jane Doe",
     *       "email": "jane@cxsanalytics.com",
     *       "department_id": 5,
     *       "department_name": "Finance",
     *       "position_id": 7,
     *       "job_title": "Senior Analyst"
     *       "job_level": "11"
     *     }
     *   ],
     *   "meta": {
     *     "pagination": {
     *       "total": 250,
     *       "per_page": 50,
     *       "current_page": 1,
     *       "last_page": 5
     *     }
     *   }
     * }
     * 
     * @response 400 scenario="Bad Request" {
     *   "status": "error",
     *   "message": "Invalid request parameters"
     * }
     * 
     * @response 404 scenario="Not Found" {
     *   "status": "error",
     *   "message": "No employees found"
     * }
    */

    public function index(Request $request)
    {
       try {
            $paginate = filter_var($request->query('paginate', true), FILTER_VALIDATE_BOOLEAN);
            $perPage  = (int) min(max((int) $request->query('per_page', 50), 1), 200);
            $page     = max((int) $request->query('page', 1), 1);
            $search   = trim((string) $request->query('q', ''));
            $deptId   = $request->query('department_id');
            $posId    = $request->query('position_id') ?: $request->query('job_id');
    
            $builder = User::query()
                ->where('users.company_id', 3)
                ->where('users.role_name', 'employee')
                ->select([
                    'users.*',
                    'departments.id as department_id',
                    'departments.name as department_name',
                    'jobs.id as job_id',
                    'jobs.title as job_title',
                    'jobs.level as job_level',
                ])
                ->leftJoin('departments', 'departments.id', '=', 'users.department_id')
                ->leftJoin('jobs', 'jobs.id', '=', 'users.position_id');
    
            // Optional filters
            if ($deptId) {
                $builder->where('users.department_id', $deptId);
            }
            if ($posId) {
                $builder->where('users.position_id', $posId);
            }
    
            // Search on name/email
            if ($search !== '') {
                $builder->where(function ($q) use ($search) {
                    if (Schema::hasColumn('users', 'name')) {
                        $q->orWhere('users.name', 'like', "%{$search}%");
                    }
                    if (Schema::hasColumn('users', 'full_name')) {
                        $q->orWhere('users.full_name', 'like', "%{$search}%");
                    }
                    if (Schema::hasColumn('users', 'email')) {
                        $q->orWhere('users.email', 'like', "%{$search}%");
                    }
                });
            }
    
            // Sorting
            if (Schema::hasColumn('users', 'name')) {
                $builder->orderBy('users.name');
            } elseif (Schema::hasColumn('users', 'full_name')) {
                $builder->orderBy('users.full_name');
            }
            $builder->orderBy('users.id');
    
            // Paginated response (explicit page support)
            $paginator = $builder->paginate($perPage, ['*'], 'page', $page)
                                ->appends($request->query());
    
            return response()->json([
                'status' => 'success',
                'data'   => EmployeeResource::collection($paginator->items()),
                'meta'   => [
                    'pagination' => [
                        'total'        => $paginator->total(),
                        'per_page'     => $paginator->perPage(),
                        'current_page' => (int) $paginator->currentPage(),
                        'last_page'    => (int) $paginator->lastPage(),
                    ],
                ],
            ]);
        } catch (\Throwable $e) {
            \Log::error('Employees index unexpected error', ['error' => $e->getMessage()]);
            return response()->json([
                'status'  => 'error',
                'message' => 'Something went wrong.',
                'error'   => app()->environment('local') ? $e->getMessage() : null,
            ], 500);
        }
    }
    


    /**
    * GET /rest/v1/employees/{id}
    * Returns a single employee (User) with department, division, business unit, and job title.
    */

    /**
     * Get employee details
     *
     * Requires an API key in the header.
     *
     * @group Employee Management
     * @authenticated
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     * @pathParam id integer required The employee's unique ID. Example: 123
     *
     * @response 200 scenario="Success" {
     *   "status": "success",
     *   "data": {
     *     "id": 123,
     *     "name": "Jane Doe",
     *     "email": "jane@cxsanalytics.com",
     *     "phone": "+60-12-3456789",
     *     "department_id": 5,
     *     "department_name": "Finance",
     *     "division_id": 2,
     *     "division_name": "Corporate Services",
     *     "business_unit_id": 1,
     *     "business_unit_name": "Head Office",
     *     "position_id": 7,
     *     "job_title": "Senior Analyst",
     *     "created_at": "2025-09-02T10:15:00Z",
     *     "updated_at": "2025-09-02T11:00:00Z"
     *   },
     *   "meta": null
     * }
     * 
     * @response 404 scenario="Not Found" {
     *   "status": "error",
     *   "message": "User not found"
     * }
    */

    
    public function show(Request $request, int $id)
    {
        try {
            $builder = User::query()
                ->select([
                    'users.*',

                    // Department
                    'departments.id as department_id',
                    'departments.name as department_name',
                    'departments.division_id as joined_division_id',

                    // Division
                    'divisions.id as division_id',
                    'divisions.head_of_division as division_name',
                    'divisions.business_unit_id as joined_business_unit_id',

                    // Business Unit
                    'business_units.id as business_unit_id',
                    'business_units.name as business_unit_name',

                    // Job
                    'jobs.id as job_id',
                    'jobs.title as job_title',
                    'jobs.level as job_level',
                ])
                ->leftJoin('departments', 'departments.id', '=', 'users.department_id')
                ->leftJoin('divisions', 'divisions.id', '=', 'departments.division_id')
                ->leftJoin('business_units', 'business_units.id', '=', 'divisions.business_unit_id')
                ->leftJoin('jobs', 'jobs.id', '=', 'users.position_id')
                ->where('users.id', $id);

            // Active user only (if your schema enforces active logic)
            // if (Schema::hasColumn('users', 'is_active')) {
            //     $builder->where('users.is_active', 1);
            // } elseif (Schema::hasColumn('users', 'status')) {
            //     $builder->where('users.status', 'active');
            // }

            $user = $builder->firstOrFail();

            return response()->json([
                'status' => 'success',
                'data'   => new EmployeeDetailResource($user),
                'meta'   => null,
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'status'  => 'error',
                'message' => 'User not found.',
            ], 404);
        } catch (\Throwable $e) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Something went wrong.',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }

    /**
    * GET /rest/v1/jd/{id}
    */

    /**
     * @OA\Get(
     *   path="/rest/v1/jd/{id}",
     *   summary="Job description (JD) detail",
     *   tags={"Jobs"},
     *   security={{"bearerAuth":{},"ApiKeyAuth":{}}},
     *
     *   @OA\Parameter(
     *     name="x-api-key",
     *     in="header",
     *     required=true,
     *     description="Project API Key",
     *     @OA\Schema(type="string")
     *   ),
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     required=true,
     *     @OA\Schema(type="integer")
     *   ),
     *
     *   @OA\Response(
     *     response=200,
     *     description="OK",
     *     @OA\JsonContent(
     *       type="object",
     *       @OA\Property(property="status", type="string", example="success"),
     *       @OA\Property(
     *         property="data",
     *         type="object",
     *         @OA\Property(property="id", type="integer", example=15),
     *         @OA\Property(property="title", type="string", example="Senior Data Analyst"),
     *         @OA\Property(property="position_code", type="string", nullable=true, example="DA-SR-001"),
     *         @OA\Property(property="description", type="string", nullable=true, example="Owns analytics deliverables and dashboards."),
     *         @OA\Property(property="department_name", type="string", nullable=true, example="Finance"),
     *         @OA\Property(property="technical_skills", type="array",
      *         @OA\Items(
      *           type="object",
      *           @OA\Property(property="id", type="integer", example=123),
      *           @OA\Property(property="title", type="string", example="Technical Skill 1"),
      *           @OA\Property(property="description", type="string", example="Description"),
      *           @OA\Property(property="level", type="integer", example=5),
      *           @OA\Property(property="level_description", type="string", example="Level's Description")
      *         )),
     *         @OA\Property(property="soft_skills", type="array",
      *         @OA\Items(
      *           type="object",
      *           @OA\Property(property="id", type="integer", example=123),
      *           @OA\Property(property="title", type="string", example="Soft Skill 1"),
      *           @OA\Property(property="level", type="integer", example=5)
      *         )),
     *       ),
     *       @OA\Property(property="meta", nullable=true)
     *     )
     *   ),
     *
     *   @OA\Response(response=404, description="Job not found")
     * )
    */

    /**
     * Get job description (JD) details by ID.
     *
     * Requires an API key in the header.
     *
     * @group Employee Management
     * @authenticated
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     *
     * @pathParam id integer required The job description's unique ID. Example: 15
     *
     * @response 200 scenario="Success" {
     *   "status": "success",
     *   "data": {
     *     "id": 15,
     *     "title": "Senior Data Analyst",
     *     "position_code": "DA-SR-001",
     *     "description": "Owns analytics deliverables and dashboards.",
     *     "department_name": "Finance",
     *     "technical_skills": [
     *       {
     *         "id": 123,
     *         "title": "Technical Skill 1",
     *         "description": "Description",
     *         "level": 5,
     *         "level_description": "Level's Description"
     *       }
     *     ],
     *     "soft_skills": [
     *       {
     *         "id": 123,
     *         "title": "Soft Skill 1",
     *         "level": 5
     *       }
     *     ]
     *   },
     *   "meta": null
     * }
     * 
     * @response 404 scenario="Not Found" {
     *   "status": "error",
     *   "message": "Job not found"
     * }
    */


    public function jd(Request $request, int $id)
    {
        try {
            $job = Job::find($id);
            
            return response()->json([
                'status' => 'success',
                'data'   => new JobDetailResource($job),
                'meta'   => null,
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Job not found.',
            ], 404);
        } catch (\Throwable $e) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Something went wrong.',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Get technical skill details by ID.
     *
     * Returns sector info, code/name, description, job link, type,
     * per-level descriptors (1–6) with description/knowledge/ability,
     * and timestamps knowledge and abilities are seperated by ';'.
     *
     * Requires an API key in the header.
     *
     * @group Technical Skills
     * @authenticated
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     *
     * @pathParam id integer required The technical skill's unique ID. Example: 42
     *
     * @response 200 scenario="Success" {
     *   "status": "success",
     *   "data": {
     *     "id": 42,
     *     "sector": {
     *       "id": 2,
     *       "name": "Information & Communication",
     *       "sub_sector": {
     *         "id": 5,
     *         "name": "Data & Analytics"
     *       }
     *     },
     *     "code": "ICT-DA-001",
     *     "name": "Data Analysis",
     *     "description": "Ability to analyze datasets and derive insights for decision-making.",
     *     "levels": [
     *       { "level": 1, "description": "Basic understanding.", "knowledge": "Foundational terms; Foundational terms", "ability": "Follow instructions; Follow instructions" },
     *       { "level": 2, "description": "Working knowledge.", "knowledge": "Common tools.", "ability": "Handle routine tasks." },
     *       { "level": 3, "description": "Proficient.", "knowledge": "Methods and models.", "ability": "Work independently." },
     *       { "level": 4, "description": "Advanced.", "knowledge": "Complex techniques.", "ability": "Optimize solutions." },
     *       { "level": 5, "description": "Expert.", "knowledge": "State-of-the-art practices.", "ability": "Lead initiatives." },
     *       { "level": 6, "description": "Thought leader.", "knowledge": "Emerging trends.", "ability": "Set strategy." }
     *     ],
     *     "created_at": "2025-02-28T10:22:31Z",
     *     "updated_at": "2025-03-01T09:10:00Z"
     *   },
     *   "meta": null
     * }
     *
     * @response 404 scenario="Not Found" {
     *   "status": "error",
     *   "message": "Technical skill not found."
     * }
    */



    public function technicalSkillDetails(Request $request, int $id)
    {
        try {
            $techicalSkill = MasterTechnicalSkill::find($id);
            
            return response()->json([
                'status' => 'success',
                'data'   => new TechnicalSkillDetailResource($techicalSkill),
                'meta'   => null,
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Technical skill not found.',
            ], 404);
        } catch (\Throwable $e) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Something went wrong.',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Get soft skill details by ID.
     *
     * Returns name, description,
     * per-level descriptors (1–3) with description/knowledge/ability,
     * and timestamps knowledge and abilities are seperated by ';'.
     *
     * Requires an API key in the header.
     *
     * @group Soft Skills
     * @authenticated
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     *
     * @pathParam id integer required The soft skill's unique ID. Example: 42
     *
     * @response 200 scenario="Success" {
     *   "status": "success",
     *   "data": {
     *     "id": 1,
     *     "name": "Creative Thinking",
     *     "description": "Ability to analyze datasets and derive insights for decision-making.",
     *     "levels": [
     *       { "level": 1, "description": "Basic understanding.", "knowledge": "Foundational terms; Foundational terms", "ability": "Follow instructions; Follow instructions" },
     *       { "level": 2, "description": "Working knowledge.", "knowledge": "Common tools.", "ability": "Handle routine tasks." },
     *       { "level": 3, "description": "Proficient.", "knowledge": "Methods and models.", "ability": "Work independently." }
     *     ],
     *     "created_at": "2025-02-28T10:22:31Z",
     *     "updated_at": "2025-03-01T09:10:00Z"
     *   },
     *   "meta": null
     * }
     *
     * @response 404 scenario="Not Found" {
     *   "status": "error",
     *   "message": "Technical skill not found."
     * }
    */



    public function softSkillDetails(Request $request, string $name)
    {
        try {
            $techicalSkill = MasterSkill::where('name', $name)->first();
            
            return response()->json([
                'status' => 'success',
                'data'   => new SoftSkillDetailResource($techicalSkill),
                'meta'   => null,
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Soft skill not found.',
            ], 404);
        } catch (\Throwable $e) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Something went wrong.',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * GET /rest/v1/employees/{id}/psychometric-results
     * Returns a user's psychometric results using the user_results schema provided.
     *
     * Query params (optional):
     * - result_type: string | csv 
     * - assessment_type: string | csv (Example - ocean, riasec, cognitive)
     * - job_id: int (filter)
     * - q: string (search by name/slug/description)
     */

    /**
     * Get psychometric results for a employee.
     *
     * Requires an API key in the header.
     *
     * @group Employee Management
     * @authenticated
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     * @pathParam id integer required The user ID. Example: 123
     * @queryParam result_type string optional Filter by result type (e.g., ocean, riasec, cognitive). Example: "ocean"
     * @queryParam assessment_type string optional Filter by assessment type (e.g., personality, cognitive). Example: "psychometric"
     * @queryParam job_id integer optional Filter by job ID. Example: "7"
     * @queryParam descriptor_id integer optional Filter by descriptor ID. Example: "101"
     * @queryParam q string optional Search by name, slug, code, or description. Example: "Openness"
     *
     * @response 200 scenario="Success" {
     *   "status": "success",
     *   "data": {
     *     "user": {
     *       "id": 123,
     *       "name": "Jane Doe",
     *       "email": "jane@cxsanalytics.com",
     *       "is_personality_motivation_completed": 1,
     *       "is_work_interest_completed": 1,
     *       "is_cognitive_ability_completed": 1,
     *       "is_technical_assessment_completed": 1
     *     },
     *     "results": [
     *       {
     *         "id": 999,
     *         "user_id": 123,
     *         "job_id": 7,
     *         "assessment_type": "psychometric",
     *         "result_type": "ocean",
     *         "name": "Openness",
     *         "slug": "openness",
     *         "code": "O",
     *         "descriptor_id": 101,
     *         "description": "High openness indicates...",
     *         "score": 145,
     *         "z_score": 1.23,
     *         "level": 3,
     *         "percentage": 72.5,
     *         "level_description": "Above average",
     *         "created_at": "2025-09-02T10:11:00Z",
     *         "updated_at": "2025-09-02T10:11:00Z"
     *       }
     *     ],
     *     "meta": null
     *   }
     * }
     * 
     * @response 404 scenario="Not Found" {
     *   "status": "error",
     *   "message": "User not found"
     * }
    */

    public function psychometricResults(Request $request, int $id)
    {
        try {
            // Ensure user exists & fetch flags
            $user = User::query()
                ->select([
                    'id',
                    'name',
                    'email',
                    'is_personality_motivation_completed',
                    'is_work_interest_completed',
                    'is_cognitive_ability_completed',
                    'is_technical_assessment_completed',
                ])
                ->findOrFail($id);

            // CSV helpers
            $csv = fn($key) => $request->filled($key)
                ? array_values(array_filter(array_map('trim', explode(',', $request->query($key)))))
                : null;

            $resultTypes     = $csv('result_type');
            $assessmentTypes = $csv('assessment_type');
            $jobId           = $request->query('job_id');
            $descriptorId    = $request->query('descriptor_id');
            $search          = trim((string) $request->query('q', ''));

            $builder = UserResult::query()
                ->select([
                    'user_results.id',
                    'user_results.user_id',
                    'user_results.job_id',
                    'user_results.assessment_type',
                    'user_results.result_type',
                    'user_results.name',
                    'user_results.slug',
                    'user_results.code',
                    'user_results.descriptor_id',
                    'user_results.description',
                    'user_results.score',
                    'user_results.z_score',
                    'user_results.level',
                    'user_results.percentage',
                    'user_results.level_description'
                ])
                ->where('user_results.user_id', $id);

            if ($resultTypes) {
                $builder->whereIn('user_results.result_type', $resultTypes);
            }

            if ($assessmentTypes) {
                $builder->whereIn('user_results.assessment_type', $assessmentTypes);
            }

            if ($jobId) {
                $builder->where('user_results.job_id', $jobId);
            }

            if ($descriptorId) {
                $builder->where('user_results.descriptor_id', $descriptorId);
            }

            if ($search !== '') {
                $builder->where(function ($q) use ($search) {
                    $q->orWhere('user_results.name', 'like', "%{$search}%")
                        ->orWhere('user_results.slug', 'like', "%{$search}%")
                        ->orWhere('user_results.code', 'like', "%{$search}%")
                        ->orWhere('user_results.description', 'like', "%{$search}%");
                });
            }

            $builder->where(function ($q) {
                $q->whereNotIn('user_results.result_type', [
                    'ccs_match_rate',
                    'jmr',
                    'soft_skill_score',
                    'overall_match_rate',
                ])->orWhere(function ($sub) {
                    $sub->whereIn('user_results.result_type', [
                            'ccs_match_rate',
                            'jmr',
                            'soft_skill_score',
                            'overall_match_rate',
                        ])
                        ->whereNotNull('user_results.job_id')
                        ->where('user_results.job_id', '<>', 0);
                });
            });

            $builder->where(function ($q) {
                $q->where(function ($sub) {
                    $sub->where('user_results.assessment_type', 'technical')
                        ->where('user_results.result_type', 'overall')
                        ->whereNotNull('user_results.job_id')
                        ->where('user_results.job_id', '<>', 0);
                })->orWhere(function ($sub) {
                    $sub->where('user_results.assessment_type', '<>', 'technical')
                        ->orWhere('user_results.result_type', '<>', 'overall');
                });
            });

            $results = $builder->orderBy('user_results.created_at', 'desc')->get();

            return response()->json([
                'status' => 'success',
                'data' => [
                    'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email'=> $user->email,
                    'is_personality_motivation_completed' => $user->is_personality_motivation_completed,
                    'is_work_interest_completed' => $user->is_work_interest_completed,
                    'is_cognitive_ability_completed' => $user->is_cognitive_ability_completed,
                    'is_technical_assessment_completed' => $user->is_technical_assessment_completed,
                    'job_id' => $user->position_id
                    ],
                    'results' => PsychometricResultResource::collection($results),
                ],
                'meta' => null,
            ]);

        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status'  => 'error',
                'message' => 'User not found.',
            ], 404);
        }
    }


}
