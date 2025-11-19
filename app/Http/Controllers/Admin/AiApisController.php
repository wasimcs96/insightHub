<?php
namespace App\Http\Controllers\Admin;

use App\Services\AiApiService;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Services\AiGeneratorValidationService;
use Illuminate\Support\Facades\Cache;
use App\Models\Sector;
class AiApisController extends Controller
{
    protected $aiApiService;

    public function __construct(AiApiService $aiApiService)
    {
        $this->middleware('auth');
        $this->aiApiService = $aiApiService;
    }

   public function getSectors(): JsonResponse
    {
        $response = $this->aiApiService->getSectors();

        if ($response === false || !isset($response['sectors'])) {
            Log::error('Error fetching sectors from API.');
            return response()->json(['error' => 'Failed to fetch sectors.'], 500);
        }

        // Retrieve the sector names from the local database
        $localSectors = Sector::pluck('name')->toArray(); 

        // Filter the sectors from the API response that exist in the local database
        $filteredSectors = array_filter($response['sectors'], function ($sector) use ($localSectors) {
            return in_array($sector, $localSectors);
        });

        // Return the filtered sectors
        return response()->json(['data' => array_values($filteredSectors)], 200);
    }

    public function getTracksBySector(string $sector): JsonResponse
    {
        $response = $this->aiApiService->getTracksBySector($sector);

        if ($response === false || !isset($response['tracks'])) {
            Log::error("Error fetching tracks for sector: $sector.");
            return response()->json(['error' => 'Failed to fetch tracks.'], 500);
        }

        return response()->json(['data' => $response['tracks']], 200);
    }

    public function getRolesByTrack(string $sector, string $track): JsonResponse
    {
        // Decode the track parameter, since slashes might be encoded as %2F
        $decodedTrack = urldecode($track);

        $response = $this->aiApiService->getRolesByTrack($sector, $decodedTrack);

        if ($response === false || !isset($response['roles'])) {
            Log::error("Error fetching roles for sector: $sector and track: $decodedTrack.");
            return response()->json(['error' => 'Failed to fetch roles.'], 500);
        }

        return response()->json(['data' => $response['roles']], 200);
    }


    // public function getRoleDetails(string $sector, string $track, string $role): JsonResponse
    // {
    //     // Decode both track and role parameters to ensure proper handling of special characters
    //     dd($sector,$track,$role);
    //     $decodedTrack = urldecode($track);
    //     $decodedRole = urldecode($role);

    //     // Now make the API call with the decoded parameters
    //     $response = $this->aiApiService->getRoleDetails($sector, $decodedTrack, $decodedRole);

    //     // Handle errors if response is invalid
    //     if ($response === false || !isset($response['jobRole'])) {
    //         Log::error("Error fetching role details for sector: $sector, track: $decodedTrack, and role: $decodedRole.");
    //         return response()->json(['error' => 'Failed to fetch role details.'], 500);
    //     }

    //     // Return the role details as a response
    //     return response()->json(['data' => $response['jobRole']], 200);
    // }

    public function getRoleDetails(Request $request): JsonResponse
    {
        $sector = $request->input('sector');
        $track  = urldecode($request->input('track'));
        $role   = urldecode($request->input('role'));

        // Debugging check
        // dd($sector, $track, $role);

        $response = $this->aiApiService->getRoleDetails($sector, $track, $role);

        if ($response === false || !isset($response['jobRole'])) {
            Log::error("Error fetching role details for sector: $sector, track: $track, and role: $role.");
            return response()->json(['error' => 'Failed to fetch role details.'], 500);
        }

        return response()->json(['data' => $response['jobRole']], 200);
    }

    public function getSkillsBySectorAndTrack(string $sector, string $skillType = 'all'): JsonResponse
    {
        $response = $this->aiApiService->getSkillsBySectorAndTrack($sector, $skillType);

        if ($response === false || !isset($response['skills'])) {
            Log::error("Error fetching skills for sector: $sector and skillType: $skillType.");
            return response()->json(['error' => 'Failed to fetch skills.'], 500);
        }

        return response()->json(['data' => $response['skills']], 200);
    }

    public function getSkillDetails(Request $request): JsonResponse
    {
        $sector = $request->query('sector');
        $skill = $request->query('skill');
        $track = $request->query('track');
        $skillType = $request->query('skillType');

        $response = $this->aiApiService->getSkillDetails($sector, $skill, $track, $skillType);

        if ($response === false || !isset($response['jobRole'])) {
            Log::error("Error fetching skill details for sector: $sector, skill: $skill, track: $track, and skillType: $skillType.");
            return response()->json(['error' => 'Failed to fetch skill details.'], 500);
        }

        return response()->json(['data' => $response['jobRole']], 200);
    }

    public function getAiGeneratorJD(Request $request): JsonResponse
    {
        $validationService = new AiGeneratorValidationService();
        $validationResult = $validationService->validateJobDescriptionRequest($request->all());

        if (!$validationResult['status']) {
            return response()->json([
                'error' => 'Validation failed',
                'details' => $validationResult['errors']
            ], 422);
        }

        $data = [
            'job_role_query' => $request->job_role,
            'local_jd_query' => $request->job_description
        ];
        $response = $this->aiApiService->getAiGenratedJdData($data);
        $llmoutput = $response['llmOutput'];
        $finalResponse = $response['jobRole'];
        $finalResponse['llmOutput'] = $llmoutput;
        $finalResponse['jobGenerationId'] = $response['job_generation_id'] ?? '';

         // Generate cache key using title, sector_name, and sub_sector_name
         $title = isset($response['title']) ? $response['title'] : '';
         $sectorName = isset($response['sector_name']) ? $response['sector_name'] : '';
         $subSectorName = isset($response['sub_sector_name']) ? $response['sub_sector_name'] : '';
 
         // Replace spaces with underscores and concatenate the values
         $cacheKey = 'job_description_' . md5(str_replace(' ', '_', $title . $sectorName . $subSectorName));
         $finalResponse['redis_key'] = $cacheKey;

          // Store the response in Redis for 1 hour (you can adjust the expiration time)
        try {
            Cache::put($cacheKey, $finalResponse, now()->addHours(120));
        } catch (\Exception $e) {
            Log::error("Error caching JD details: " . $e->getMessage());
        }
        // dd($finalResponse);
        if ($finalResponse === false || !isset($finalResponse)) {
            Log::error("Error fetching JD details for job_role: $request->job_role");
            return response()->json(['error' => 'Failed to genrate JD.'], 500);
        }
        return response()->json(['data' => $finalResponse], 200);
    }
    /**
     * Endpoint to send feedback rating.
     *
     * @param string $jobGenerationId
     * @param bool $thumbsUp
     * @param bool $thumbsDown
     * @return JsonResponse
     */
    public function sendFeedbackRating(Request $request): JsonResponse
    { 
        $data = $request->validate([
            'job_generation_id' => 'required',
            'thumbs_up' => 'required',
            'thumbs_down' => 'required',
            'feedback_rating' => 'required|string',
            'feedback' => 'required|string',
            'additional_feedback' => 'nullable|string',
        ]);
        $response = $this->aiApiService->sendFeedbackRating($data);
        if ($response === false) {
            return response()->json(['error' => 'Failed to send feedback rating.'], 500);
        }
        return response()->json(['message' => 'Feedback rating sent successfully.'], 200);
    }

    // public function getAiGeneratorJD(Request $request): JsonResponse
    // {
    //     $validationService = new AiGeneratorValidationService();
    //     $validationResult = $validationService->validateJobDescriptionRequest($request->all());

    //     if (!$validationResult['status']) {
    //         return response()->json([
    //             'error' => 'Validation failed',
    //             'details' => $validationResult['errors']
    //         ], 422);
    //     }

    //     $jobRole = $request->job_role;
    //     $jobDescription = $request->job_description;

    //     // Generate a unique cache key based on job_role and job_description
    //     $cacheKey = 'ai_generator_jd_' . md5($jobRole . $jobDescription); // md5 to create a unique string

    //     // Check if the data is already in Redis cache
    //     $cachedResponse = Cache::get($cacheKey);

    //     if ($cachedResponse) {
    //         // Return cached response if available
    //         return response()->json(['data' => $cachedResponse], 200);
    //     }

    //     // If not cached, fetch from API
    //     $data = [
    //         'job_role_query' => $jobRole,
    //         'local_jd_query' => $jobDescription
    //     ];

    //     $response = $this->aiApiService->getAiGenratedJdData($data);
    //     $llmoutput = $response['llmOutput'];
    //     $finalResponse = $response['jobRole'];
    //     $finalResponse['llmOutput'] = $llmoutput;

    //     // Handle error if the response is invalid
    //     if ($finalResponse === false || !isset($finalResponse)) {
    //         Log::error("Error fetching JD details for job_role: $jobRole");
    //         return response()->json(['error' => 'Failed to generate JD.'], 500);
    //     }

    //     // Store the response in Redis with an expiration time (e.g., 60 minutes)
    //     Cache::put($cacheKey, $finalResponse, now()->addMinutes(60));  // You can adjust the time as needed

    //     // Return the API response
    //     return response()->json(['data' => $finalResponse], 200);
    // }
    
}
