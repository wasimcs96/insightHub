<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use App\Models\CompanyDetail;
use App\Resources\Api\V1\CompanyDetailResource;
use OpenApi\Annotations as OA;
use App\Services\OrganizationChartService;
use App\Modules\Headcounts\Services\JobHeadcountService;

class CompanyController extends Controller
{
    protected OrganizationChartService $organizationChartService;

    // Inject OrganizationChartService and JobHeadcountService into the controller
    public function __construct(OrganizationChartService $organizationChartService)
    {
        $this->organizationChartService = $organizationChartService;
    }
    /**
     * GET /rest/v1/company-details
     * Returns a single company record 
     * and owner user info when available.
     */

    /**
     * @OA\Get(
     *   path="/rest/v1/company-details",
     *   summary="Company Details",
     *   tags={"Companies"},
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
     *     description="Search by company name/email/website/address",
     *     @OA\Schema(type="string")
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
     *           @OA\Property(property="id", type="integer", example=42),
     *           @OA\Property(property="name", type="string", example="CXS Analytics Sdn Bhd"),
     *           @OA\Property(property="mobile_number", type="string", nullable=true, example="60123456789"),
     *           @OA\Property(property="email", type="string", nullable=true, example="info@cxsanalytics.com"),
     *           @OA\Property(property="website", type="string", nullable=true, example="https://cxsanalytics.com"),
     *           @OA\Property(property="address", type="string", nullable=true, example="A-01-01, Menara XYZ, Kuala Lumpur"),
     *           @OA\Property(property="sector_id", type="integer", nullable=true, example=3),
     *           @OA\Property(property="sector_name", type="string", nullable=true, example="Information Technology"),
     *           @OA\Property(property="subsector_id", type="integer", nullable=true, example=9),
     *           @OA\Property(property="subsector_name", type="string", nullable=true, example="Software & Analytics"),
     *           @OA\Property(property="user_id", type="integer", nullable=true, example=7),
     *           @OA\Property(property="owner_user_name", type="string", nullable=true, example="Tech Admin"),
     *           @OA\Property(property="owner_user_email", type="string", nullable=true, example="techadmin@cxsanalytics.com"),
     *           @OA\Property(property="created_at", type="string", example="2025-09-02T10:15:00Z"),
     *           @OA\Property(property="updated_at", type="string", example="2025-09-02T10:30:00Z")
     *         )
     *       ),
     *       @OA\Property(
     *         property="meta",
     *         type="object",
     *         nullable=true,
     *         @OA\Property(
     *           property="pagination",
     *           type="object",
     *           @OA\Property(property="total", type="integer", example=10),
     *           @OA\Property(property="per_page", type="integer", example=50),
     *           @OA\Property(property="current_page", type="integer", example=1),
     *           @OA\Property(property="last_page", type="integer", example=1)
     *         )
     *       )
     *     )
     *   )
     * )
    */

    /**
     * Get company details.
     *
     * Requires an API key in the header.
     *
     * @group Company Structure
     * @authenticated
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     * @response 200 scenario="Success" {
     *   "status": "success",
     *   "data": [
     *     {
     *       "id": 42,
     *       "name": "CXS Analytics Sdn Bhd",
     *       "mobile_number": "60123456789",
     *       "email": "info@cxsanalytics.com",
     *       "website": "https://cxsanalytics.com",
     *       "address": "A-01-01, Menara XYZ, Kuala Lumpur",
     *       "sector_id": 3,
     *       "sector_name": "Information Technology",
     *       "subsector_id": 9,
     *       "subsector_name": "Software & Analytics",
     *       "user_id": 7,
     *       "owner_user_name": "Tech Admin",
     *       "owner_user_email": "techadmin@cxsanalytics.com",
     *       "created_at": "2025-09-02T10:15:00Z",
     *       "updated_at": "2025-09-02T10:30:00Z"
     *     }
     *   ],
     *   "meta": {
     *     "pagination": {
     *       "total": 10,
     *       "per_page": 50,
     *       "current_page": 1,
     *       "last_page": 1
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
     *   "message": "Company not found"
     * }
    */

    public function show(Request $request)
    {
        try {
            $builder = CompanyDetail::query()
                ->select([
                    'company_details.*',
                ])->first();
    
            $company = $builder->firstOrFail();
    
            return response()->json([
                'status' => 'success',
                'data'   => new CompanyDetailResource($company),
                'meta'   => null,
            ]);
        } catch (\Throwable $e) {
            \Log::error('Company detail unexpected error', ['error' => $e->getMessage()]);
            return response()->json([
                'status'  => 'error',
                'message' => 'Something went wrong.',
                'error'   => app()->environment('local') ? $e->getMessage() : null,
            ], 500);
        }
    }
    

    /**
     * GET /rest/v1/organization-chart
     */
    /**
     * @OA\Get(
     *   path="/rest/v1/organization-chart",
     *   summary="Retrieve organization chart hierarchy",
     *   tags={"Organization Chart"},
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
     *     name="page",
     *     in="query",
     *     description="Page number (starts at 1)",
     *     @OA\Schema(type="integer", minimum=1),
     *     required=true
     *   ),
     *   @OA\Parameter(
     *     name="department_id",
     *     in="query",
     *     description="Filter by department ID",
     *     @OA\Schema(type="integer")
     *   ),
     *   @OA\Parameter(
     *     name="job_position",
     *     in="query",
     *     description="Filter by job position",
     *     @OA\Schema(type="string")
     *   ),
     *   @OA\Parameter(
     *     name="user_id",
     *     in="query",
     *     description="Filter by user ID",
     *     @OA\Schema(type="integer")
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="OK",
     *     @OA\JsonContent(
     *       type="object",
     *       @OA\Property(property="status", type="string", example="success"),
     *       @OA\Property(property="data", type="array",
     *         @OA\Items(
     *           type="object",
     *           @OA\Property(property="id", type="string", example="JD0139-5051-01"),
     *           @OA\Property(property="parent_code", type="string", nullable=true),
     *           @OA\Property(property="data", type="object",
     *             @OA\Property(property="title", type="string", example="Chief Executive Officer"),
     *             @OA\Property(property="department", type="string", example="PH DEP"),
     *             @OA\Property(property="code", type="string", example="JD0139-5051-01"),
     *             @OA\Property(property="name", type="string", example="Yatco Shaira Mae V."),
     *             @OA\Property(property="imageURL", type="string", example="http://127.0.0.1:8002/admin/media/svg/org-chart-svg/user-new.svg"),
     *             @OA\Property(property="isYou", type="boolean", example=false),
     *             @OA\Property(property="level", type="string", example="13"),
     *             @OA\Property(property="user_id", type="integer", example=4820),
     *             @OA\Property(property="parent_id", type="integer", nullable=true),
     *             @OA\Property(property="job_id", type="integer", example=5051),
     *             @OA\Property(property="department_id", type="integer", example=1),
     *             @OA\Property(property="headcount_id", type="string", example="1220"),
     *             @OA\Property(property="is_new", type="boolean", example=false),
     *             @OA\Property(property="new_employee", type="boolean", example=false),
     *             @OA\Property(property="employee_removed", type="boolean", example=false),
     *             @OA\Property(property="is_transfer", type="boolean", example=false),
     *             @OA\Property(property="is_reassigned", type="boolean", example=false),
     *             @OA\Property(property="is_deleted", type="boolean", example=false),
     *             @OA\Property(property="is_critical", type="integer", example=0),
     *             @OA\Property(property="is_blured", type="boolean", example=false),
     *             @OA\Property(property="is_subordinates", type="boolean", example=true)
     *           ),
     *           @OA\Property(property="options", type="object",
     *             @OA\Property(property="nodeBGColor", type="string", example="#eef0f6"),
     *             @OA\Property(property="nodeBGColorHover", type="string", example="#d0d3e2"),
     *             @OA\Property(property="nodeWidth", type="string", example="150"),
     *             @OA\Property(property="nodeHeight", type="string", example="100")
     *           ),
     *           @OA\Property(property="modified_fields", type="object",
     *             @OA\Property(property="department", type="boolean", example=false),
     *             @OA\Property(property="user_id", type="boolean", example=false),
     *             @OA\Property(property="parent_id", type="boolean", example=false),
     *             @OA\Property(property="is_deleted", type="boolean", example=false)
     *           ),
     *           @OA\Property(property="reasons", type="object",
     *             @OA\Property(property="add_position", type="string", example=""),
     *             @OA\Property(property="remove_position", type="string", example=""),
     *             @OA\Property(property="assign_employee", type="string", example=""),
     *             @OA\Property(property="remove_employee", type="string", example=""),
     *             @OA\Property(property="move_employee", type="string", example=""),
     *             @OA\Property(property="move_position", type="string", example="")
     *           ),
     *           @OA\Property(property="children", type="array",
     *             @OA\Items(
     *               type="object",
     *               @OA\Property(property="id", type="string", example="JD0133-5053-01"),
     *               @OA\Property(property="parent_code", type="string", nullable=true),
     *               @OA\Property(property="data", type="object",
     *                 @OA\Property(property="title", type="string", example="Chief Finance Officer"),
     *                 @OA\Property(property="department", type="string", example="PH DEP"),
     *                 @OA\Property(property="code", type="string", example="JD0133-5053-01"),
     *                 @OA\Property(property="name", type="string", example="Tolentino Mark Andrei J."),
     *                 @OA\Property(property="imageURL", type="string", example="http://127.0.0.1:8002/admin/media/svg/org-chart-svg/user-new.svg"),
     *                 @OA\Property(property="isYou", type="boolean", example=false),
     *                 @OA\Property(property="level", type="string", example="13"),
     *                 @OA\Property(property="user_id", type="integer", example=4822),
     *                 @OA\Property(property="parent_id", type="integer", nullable=true),
     *                 @OA\Property(property="job_id", type="integer", example=5053),
     *                 @OA\Property(property="department_id", type="integer", example=1),
     *                 @OA\Property(property="headcount_id", type="string", example="1221"),
     *                 @OA\Property(property="is_new", type="boolean", example=false),
     *                 @OA\Property(property="new_employee", type="boolean", example=false),
     *                 @OA\Property(property="employee_removed", type="boolean", example=false),
     *                 @OA\Property(property="is_transfer", type="boolean", example=false),
     *                 @OA\Property(property="is_reassigned", type="boolean", example=false),
     *                 @OA\Property(property="is_deleted", type="boolean", example=false),
     *                 @OA\Property(property="is_critical", type="integer", example=0),
     *                 @OA\Property(property="is_blured", type="boolean", example=false),
     *                 @OA\Property(property="is_subordinates", type="boolean", example=true)
     *               ),
     *               @OA\Property(property="options", type="object",
     *                 @OA\Property(property="nodeBGColor", type="string", example="#eef0f6"),
     *                 @OA\Property(property="nodeBGColorHover", type="string", example="#d0d3e2"),
     *                 @OA\Property(property="nodeWidth", type="string", example="150"),
     *                 @OA\Property(property="nodeHeight", type="string", example="100")
     *               ),
     *               @OA\Property(property="modified_fields", type="object",
     *                 @OA\Property(property="department", type="boolean", example=false),
     *                 @OA\Property(property="user_id", type="boolean", example=false),
     *                 @OA\Property(property="parent_id", type="boolean", example=false),
     *                 @OA\Property(property="is_deleted", type="boolean", example=false)
     *               ),
     *               @OA\Property(property="reasons", type="object",
     *                 @OA\Property(property="add_position", type="string", example=""),
     *                 @OA\Property(property="remove_position", type="string", example=""),
     *                 @OA\Property(property="assign_employee", type="string", example=""),
     *                 @OA\Property(property="remove_employee", type="string", example=""),
     *                 @OA\Property(property="move_employee", type="string", example=""),
     *                 @OA\Property(property="move_position", type="string", example="")
     *               ),
     *               @OA\Property(property="children", type="array",
     *                 @OA\Items(
     *                   type="object",
     *                   @OA\Property(property="id", type="string", example="JD0133-5053-01"),
     *                   @OA\Property(property="parent_code", type="string", nullable=true),
     *                   @OA\Property(property="data", type="object",
     *                     @OA\Property(property="title", type="string", example="Chief Finance Officer"),
     *                     @OA\Property(property="department", type="string", example="PH DEP"),
     *                     @OA\Property(property="code", type="string", example="JD0133-5053-01"),
     *                     @OA\Property(property="name", type="string", example="Tolentino Mark Andrei J."),
     *                     @OA\Property(property="imageURL", type="string", example="http://127.0.0.1:8002/admin/media/svg/org-chart-svg/user-new.svg"),
     *                     @OA\Property(property="isYou", type="boolean", example=false),
     *                     @OA\Property(property="level", type="string", example="13"),
     *                     @OA\Property(property="user_id", type="integer", example=4822),
     *                     @OA\Property(property="parent_id", type="integer", nullable=true),
     *                     @OA\Property(property="job_id", type="integer", example=5053),
     *                     @OA\Property(property="department_id", type="integer", example=1),
     *                     @OA\Property(property="headcount_id", type="string", example="1221"),
     *                     @OA\Property(property="is_new", type="boolean", example=false),
     *                     @OA\Property(property="new_employee", type="boolean", example=false),
     *                     @OA\Property(property="employee_removed", type="boolean", example=false),
     *                     @OA\Property(property="is_transfer", type="boolean", example=false),
     *                     @OA\Property(property="is_reassigned", type="boolean", example=false),
     *                     @OA\Property(property="is_deleted", type="boolean", example=false),
     *                     @OA\Property(property="is_critical", type="integer", example=0),
     *                     @OA\Property(property="is_blured", type="boolean", example=false),
     *                     @OA\Property(property="is_subordinates", type="boolean", example=true)
     *                   ),
     *                   @OA\Property(property="options", type="object",
     *                     @OA\Property(property="nodeBGColor", type="string", example="#eef0f6"),
     *                     @OA\Property(property="nodeBGColorHover", type="string", example="#d0d3e2"),
     *                     @OA\Property(property="nodeWidth", type="string", example="150"),
     *                     @OA\Property(property="nodeHeight", type="string", example="100")
     *                   ),
     *                   @OA\Property(property="modified_fields", type="object",
     *                     @OA\Property(property="department", type="boolean", example=false),
     *                     @OA\Property(property="user_id", type="boolean", example=false),
     *                     @OA\Property(property="parent_id", type="boolean", example=false),
     *                     @OA\Property(property="is_deleted", type="boolean", example=false)
     *                   ),
     *                   @OA\Property(property="reasons", type="object",
     *                     @OA\Property(property="add_position", type="string", example=""),
     *                     @OA\Property(property="remove_position", type="string", example=""),
     *                     @OA\Property(property="assign_employee", type="string", example=""),
     *                     @OA\Property(property="remove_employee", type="string", example=""),
     *                     @OA\Property(property="move_employee", type="string", example=""),
     *                     @OA\Property(property="move_position", type="string", example="")
     *                   )
     *                 )
     *               )
     *             )
     *           )
     *         )
     *       ),
     *       @OA\Property(property="meta", nullable=true)
     *     )
     *   ),
     *   @OA\Response(response=404, description="Data not found")
     * )
    */

    /**
     * Get organization chart hierarchy.
     *
     * Requires an API key in the header.
     *
     * @group Company Structure
     * @authenticated
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     * @queryParam department_id integer optional Filter by department ID. Example: "3"
     * @queryParam job_position string optional Filter by job position. Example: "Software Engineer"
     * @queryParam user_id integer optional Filter by user ID. Example: "4820"
     *
     * @response 200 scenario="Success" {
     *   "status": "success",
     *   "data": [
     *     {
     *       "id": "JD0139-5051-01",
     *       "parent_code": null,
     *       "data": {
     *         "title": "Chief Executive Officer",
     *         "department": "PH DEP",
     *         "code": "JD0139-5051-01",
     *         "name": "Yatco Shaira Mae V.",
     *         "imageURL": "http://127.0.0.1:8002/admin/media/svg/org-chart-svg/user-new.svg",
     *         "isYou": false,
     *         "level": "13",
     *         "user_id": 4820,
     *         "parent_id": null,
     *         "job_id": 5051,
     *         "department_id": 1,
     *         "headcount_id": "1220",
     *         "is_new": false,
     *         "new_employee": false,
     *         "employee_removed": false,
     *         "is_transfer": false,
     *         "is_reassigned": false,
     *         "is_deleted": false,
     *         "is_critical": 0,
     *         "is_blured": false,
     *         "is_subordinates": true
     *       },
     *       "options": {
     *         "nodeBGColor": "#eef0f6",
     *         "nodeBGColorHover": "#d0d3e2",
     *         "nodeWidth": "150",
     *         "nodeHeight": "100"
     *       },
     *       "modified_fields": {
     *         "department": false,
     *         "user_id": false,
     *         "parent_id": false,
     *         "is_deleted": false
     *       },
     *       "reasons": {
     *         "add_position": "",
     *         "remove_position": "",
     *         "assign_employee": "",
     *         "remove_employee": "",
     *         "move_employee": "",
     *         "move_position": ""
     *       },
     *       "children": [
     *         {
     *           "id": "JD0133-5053-01",
     *           "parent_code": "JD0139-5051-01",
     *           "data": {
     *             "title": "Chief Finance Officer",
     *             "department": "PH DEP",
     *             "code": "JD0133-5053-01",
     *             "name": "Tolentino Mark Andrei J.",
     *             "imageURL": "http://127.0.0.1:8002/admin/media/svg/org-chart-svg/user-new.svg",
     *             "isYou": false,
     *             "level": "13",
     *             "user_id": 4822,
     *             "parent_id": 1220,
     *             "job_id": 5053,
     *             "department_id": 1,
     *             "headcount_id": "1221",
     *             "is_new": false,
     *             "new_employee": false,
     *             "employee_removed": false,
     *             "is_transfer": false,
     *             "is_reassigned": false,
     *             "is_deleted": false,
     *             "is_critical": 0,
     *             "is_blured": false,
     *             "is_subordinates": true
     *           },
     *           "options": {
     *             "nodeBGColor": "#eef0f6",
     *             "nodeBGColorHover": "#d0d3e2",
     *             "nodeWidth": "150",
     *             "nodeHeight": "100"
     *           },
     *           "modified_fields": {
     *             "department": false,
     *             "user_id": false,
     *             "parent_id": false,
     *             "is_deleted": false
     *           },
     *           "reasons": {
     *             "add_position": "",
     *             "remove_position": "",
     *             "assign_employee": "",
     *             "remove_employee": "",
     *             "move_employee": "",
     *             "move_position": ""
     *           },
     *           "children": []
     *         }
     *       ]
     *     }
     *   ],
     *   "meta": {
     *     "pagination": {
     *       "total": 10,
     *       "per_page": 50,
     *       "current_page": 1,
     *       "last_page": 1
     *     }
     *   }
     * }
     *
     * @response 404 scenario="Not Found" {
     *   "status": "error",
     *   "message": "Data not found"
     * }
    */

    public function organizationChart(Request $request)
    {
        try {
            // Retrieve the page number from the request (defaults to 1)
            $page = $request->input('page', 1);

            // Optional: Get additional filters from the request (department, position, etc.)
            $filters = $request->only(['department_id', 'job_position', 'user_id']);

            // Fetch paginated data from the service
            $data = $this->organizationChartService->getHierarchyData($filters, $page);

            // Optionally, you can return the data as a response
            return response()->json([
                'status' => 'success',
                'data'   => $data,
                'meta'   => null,
            ]);
        } catch (\Throwable $e) {
            \Log::error('Company detail unexpected error', ['error' => $e->getMessage()]);
            return response()->json([
                'status'  => 'error',
                'message' => 'Something went wrong.',
                'error'   => app()->environment('local') ? $e->getMessage() : null,
            ], 500);
        }
        
    }
}
