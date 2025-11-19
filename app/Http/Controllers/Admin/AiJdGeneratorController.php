<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use App\Models\DepartmentTechnicalSkills;
use Illuminate\Support\Facades\DB;


class AiJdGeneratorController extends Controller
{
  public function create(){

    return view('admin.jd.AIgenerator.create');
  }

  public function edit(){

    return view('admin.jd.AIgenerator.edit');
  }

  public function getNonPrimaryJobs(Request $request)
{
    $response = Http::withHeaders([
        'Accept' => 'application/json',
        'x-api-token' => 'fea63371019d768206ee6e96a4ca88fb68cf0074ca0382943e21e562d67c0979',

    ])->post('http://51.79.140.78:8123/api/v1/jd-generator/search', [
        'localized_job_role_name' => implode(',', [
            $request->input('job_role_name'),
            $request->input('job_family_name'),
            $request->input('job_family_group_name'),
        ]),
        'sector' => '',
        'short_description' => $request->input('job_profile_description'),
    ]);
    // removed dd() so the function can continue and return a proper JSON response

    if ($response->failed()) {
        return response()->json(['error' => 'External API failed'], 500);
    }

    $apiData = $response->json();
    // dd($apiData);
    $jobs = $apiData['job_roles'] ?? [];

    $enriched = collect($jobs)->map(function ($job) use ($request) {
        return array_merge($job, [
            'job_role' => $request->input('job_role'),
            'job_family_group' => $request->input('job_family_group'),
            'job_family' => $request->input('job_family'),
            'business_unit_id' => $request->input('business_unit'),
            'job_family_group_name' => $request->input('job_family_group_name'),
            'job_family_name' => $request->input('job_family_name'),
            'job_role_name' => $request->input('job_role_name'),
            'job_profile_description' => $request->input('job_profile_description'),
            'company_jd' => $request->input('company_jd'),
        ]);
    });

    return response()->json(['jobs' => $enriched]);
}


// public function generateJd(Request $request)
//     {
//         $request->validate([
//             'additional_information' => 'required|string',
//             'localized_job_role_name' => 'required|string',
//             'selected_job_role_description' => 'required|string',
//         ]);

//         try {
//             $response = Http::withHeaders([
//                 'Content-Type' => 'application/json',
//             ])->post('https://api.cxs-ai.com/api/v1/jd-generator/generate', [
//                 'additional_information' => $request->input('additional_information'),
//                 'localized_job_role_name' => $request->input('localized_job_role_name'),
//                 'selected_job_role_description' => $request->input('selected_job_role_description'),
//             ]);

//             dd($response->json());

//             $responseData = $response->json() ?: [];

//             \Log::debug('JD Generation Response:', $responseData);

//             return response()->json($responseData, $response->status());
//         } catch (\Exception $e) {
//             \Log::error('API call failed: ' . $e->getMessage());
//             return response()->json([
//                 'error' => 'API call failed.',
//                 'message' => $e->getMessage(),
//             ], 500);
//         }
//     }

// public function generateJd(Request $request)
// {
//     // Validate the input
//     $request->validate([
//         'additional_information' => 'required|string',
//         'localized_job_role_name' => 'required|string',
//         'selected_job_role_description' => 'required|string',
//     ]);

//     try {
//         // Make API call to generate JD
//         // $response = Http::withHeaders([
//         //     'Content-Type' => 'application/json',
//         // ])->post('https://api.cxs-ai.com/api/v1/jd-generator/generate', [
//         //     'additional_information' => $request->input('additional_information'),
//         //     'localized_job_role_name' => $request->input('localized_job_role_name'),
//         //     'selected_job_role_description' => $request->input('selected_job_role_description'),
//         // ]);
        

//         $response = Http::withHeaders([
//             'Content-Type' => 'application/json',
//         ])->post('https://api.cxs-ai.com/api/v1/jd-generator/generate', [
//             'additional_information' => $request->input('additional_information'),
//             'localized_job_role_name' => $request->input('localized_job_role_name'),
//             'selected_job_role_description' => $request->input('selected_job_role_description'),
//         ]);

//         dd($response->json(), $response->body(), $response->status());


//         // Check if the response is successful
//         if ($response->successful()) {
//             $responseData = $response->json();
//             // Return the response with the generated JD description
//             return response()->json([
//                 'status' => 'success',
//                 'llmOutput' => [
//                     'description' => $responseData['jobRole']['llmOutput']['description'] ?? null,
//                 ],
//             ]);
//         } else {
//             return response()->json([
//                 'status' => 'error',
//                 'message' => 'API returned an error.',
//                 'details' => $response->json(),
//             ], $response->status());
//         }
//     } catch (\Exception $e) {
//         \Log::error('API call failed: ' . $e->getMessage());
//         return response()->json([
//             'status' => 'error',
//             'message' => 'API call failed.',
//             'error' => $e->getMessage(),
//         ], 500);
//     }
// }

// public function generateJd(Request $request)
// {
//     // Validate the input data
//     $request->validate([
//         'additional_information' => 'required|string',
//         'localized_job_role_name' => 'required|string',
//         'selected_job_role_description' => 'required|string',
//     ]);

//     try {
//         // Make the API call to generate the JD description
//         // $response = Http::withHeaders([
//         //     'Content-Type' => 'application/json',
//         // ])->post('https://api.cxs-ai.com/api/v1/jd-generator/generate', [
//         //     'additional_information' => $request->input('additional_information'),
//         //     'localized_job_role_name' => $request->input('localized_job_role_name'),
//         //     'selected_job_role_description' => $request->input('selected_job_role_description'),
//         // ]);

//         $response = Http::withHeaders([
//             'Content-Type' => 'application/json',
//         ])->post('https://api.cxs-ai.com/api/v1/jd-generator/generate', [
//             'additional_information' => "YOUR ROLE AS A MOC Engineer:\n● Strong understanding of aircraft systems and modifications.\n● Ability to work under pressure and manage multiple tasks.\n● Skilled in auditing and ensuring compliance with aviation standards.\n\nWHAT YOU’LL CHAMPION:\n● Manage changes to aircraft systems and modifications, ensuring compliance with regulatory standards.\n● Maintain records of modifications and ensure accurate data is captured.\n● Collaborate with engineering teams to review and approve modifications.\n● Provide technical support during modifications and troubleshooting.\n● Ensure all modifications are in line with safety and regulatory requirements.",
//             'localized_job_role_name' => 'Route Revenue Analyst',
//             'selected_job_role_description' => "The Network Planning Analyst is responsible for evaluating and recommending new route opportunities to grow airline networks and aircraft fleet. He/She is able to develop short-term network plans for the current and upcoming schedule seasons. He conducts research to comprehend and review traffic rights and airport constraints of flight routes. He provides coaching, training and feedback to improve performance of junior analysts.\n\nThe Network Planning Analyst has excellent verbal and written communication skills to prepare reports and propose new routes to internal stakeholders. He also possesses strong analytical skills to evaluate route performances and potential new routes. He has strong statistical and research skills and good computer literacy to run network planning software. In addition, he is able to obtain stakeholders buy-in with his strong presentation skills and possesses strong interpersonal skills to work effectively with other departments and team members."
//         ]);
//         // Debug the response for troubleshooting
//         // dd($response->json(), $response->body(), $response->status());

//         // Check if the response was successful
//         if ($response->successful()) {
//             // Extract the JSON data from the response
//             $responseData = $response->json();

//             // Return the generated JD description
//             return response()->json([
//                 'status' => 'success',
//                 'llmOutput' => [
//                     'description' => $responseData['jobRole'] ?? null,
//                 ],
//             ]);
//         } else {
//             // If the API returns an error, send the error message back
//             return response()->json([
//                 'status' => 'error',
//                 'message' => 'API returned an error.',
//                 'details' => $response->json(),
//             ], $response->status());
//         }
//     } catch (\Exception $e) {
//         // Log the error if the API call fails and return the error response
//         \Log::error('API call failed: ' . $e->getMessage());

//         return response()->json([
//             'status' => 'error',
//             'message' => 'API call failed.',
//             'error' => $e->getMessage(),
//         ], 500);
//     }
// }


// public function generateJd(Request $request)
// {
//     // Validate the input data
//     $request->validate([
//         'additional_information' => 'required|string',
//         'localized_job_role_name' => 'required|string',
//         'selected_job_role_description' => 'required|string',
//     ]);

//     try {
//         // Make the API call to generate the JD description

//         $rawInfo = $request->input('additional_information');

//         // Decode escaped characters like \n, \t
//         $decodedInfo = stripslashes($rawInfo);

//         // Replace newline and bullet characters with plain text formatting
//         $sanitizedAdditionalInfo = str_replace(["\n", "\r", "●"], ' ', $decodedInfo);

//         // Collapse multiple spaces into one
//         $sanitizedAdditionalInfo = preg_replace('/\s+/', ' ', $sanitizedAdditionalInfo);

//         // Final trim
//         $sanitizedAdditionalInfo = trim($sanitizedAdditionalInfo);


//         $response = Http::withHeaders([
//             'Content-Type' => 'application/json',
//         ])->post('https://api.cxs-ai.com/api/v1/jd-generator/generate', [
//             'additional_information' => $sanitizedAdditionalInfo,
//             'localized_job_role_name' => $request->input('localized_job_role_name'),
//             'selected_job_role_description' => $request->input('selected_job_role_description'),
//         ]);

//         // Check if the response was successful
//         if ($response->successful()) {
//             // Extract the JSON data from the response
//             $responseData = $response->json();
//             // You can check the structure of the response by dd($responseData) if needed

//             // Return the jobRole array as part of the response
//             return response()->json([
//                 'status' => 'success',
//                 'jobRole' => $responseData ?? null,  // Assuming 'jobRole' is the key in the response
//             ]);
//         } else {
//             // If the API returns an error, send the error message back
//             return response()->json([
//                 'status' => 'error',
//                 'message' => 'API returned an error.',
//                 'details' => $response->json(),
//             ], $response->status());
//         }
//     } catch (\Exception $e) {
//         // Log the error if the API call fails and return the error response
//         \Log::error('API call failed: ' . $e->getMessage());

//         return response()->json([
//             'status' => 'error',
//             'message' => 'API call failed.',
//             'error' => $e->getMessage(),
//         ], 500);
//     }
// }

// public function generateJd(Request $request)
// {
//     // Validate the input data
//     $request->validate([
//         'additional_information' => 'required|string',
//         'localized_job_role_name' => 'required|string',
//         'selected_job_role_description' => 'required|string',
//     ]);

//     // dd($request->input('selected_job_role_description'));

//     try {
//         // Get the raw additional information from the request
//         $rawInfo = $request->input('additional_information');

//         // Decode escaped characters like \n, \t
//         $decodedInfo = stripslashes($rawInfo);

//         // Replace newline characters and bullet points with plain text formatting (as per your requirement)
//         $sanitizedAdditionalInfo = str_replace(["\n", "\r", "●"], ' ', $decodedInfo);

//         // Collapse multiple spaces into one
//         $sanitizedAdditionalInfo = preg_replace('/\s+/', ' ', $sanitizedAdditionalInfo);

//         // Final trim to remove any leading or trailing spaces
//         $sanitizedAdditionalInfo = trim($sanitizedAdditionalInfo);


        

//         // Send the data as an array (not encoded as a JSON string)
//         $response = Http::withHeaders([
//             'Content-Type' => 'application/json',
//         ])->post('https://api.cxs-ai.com/api/v1/jd-generator/generate', [
//             'additional_information' => $sanitizedAdditionalInfo,
//             'localized_job_role_name' => $request->input('localized_job_role_name'),
//             'selected_job_role_description' => $request->input('selected_job_role_description'),
//         ]);
//         // dd($response, $request->input('selected_job_role_description'));
//         // Check if the response was successful
//         if ($response->successful()) {
//             // Extract the JSON data from the response
//             $responseData = $response->json();

//             // Return the jobRole array as part of the response
//             return response()->json([
//                 'status' => 'success',
//                 'jobRole' => $responseData ?? null,  // Assuming 'jobRole' is the key in the response
//             ]);
//         } else {
//             // Log the full response for debugging
//             \Log::error('API returned an error: ' . $response->body());

//             // If the API returns an error, send the error message back
//             return response()->json([
//                 'status' => 'error',
//                 'message' => 'API returned an error.',
//                 'details' => $response->json(),  // If available
//             ], $response->status());
//         }
//     } catch (\Exception $e) {
//         // Log the error if the API call fails and return the error response
//         \Log::error('API call failed: ' . $e->getMessage());

//         return response()->json([
//             'status' => 'error',
//             'message' => 'API call failed.',
//             'error' => $e->getMessage(),
//         ], 500);
//     }
// }

public function generateJd(Request $request)
{
    $request->validate([
        'framework_job_role_id' => 'required|numeric',
        'user_job_role_name' => 'required|string',
        'user_short_description' => 'required|string',
    ]);

    try {
        $payload = [
            'framework_job_role_id' => (int) $request->input('framework_job_role_id'),
            'llm_skills' => false,
            'user_job_role_name' => $request->input('user_job_role_name'),
            'user_short_description' => $request->input('user_short_description'),
        ];

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'x-api-token' => 'fea63371019d768206ee6e96a4ca88fb68cf0074ca0382943e21e562d67c0979',
        ])->post('http://51.79.140.78:8123/api/v1/jd-generator/generate', $payload);

        if ($response->successful()) {
            return response()->json([
                'status' => 'success',
                'jobRole' => $response->json(),
            ]);
        } else {
            \Log::error('API returned error: ' . $response->body());

            return response()->json([
                'status' => 'error',
                'message' => 'External API returned an error.',
                'details' => $response->json()
            ], $response->status());
        }
    } catch (\Exception $e) {
        \Log::error('JD API call failed: ' . $e->getMessage());

        return response()->json([
            'status' => 'error',
            'message' => 'API call failed.',
            'error' => $e->getMessage(),
        ], 500);
    }
}



    public function syncJobFamilyTechnicalSkills()
    {

        // dd('adadads');
        set_time_limit(0); // Allow unlimited time

        $timestamp = Carbon::now();
        $insertData = [];

         $jobs = \App\Models\Job::with(['jdTechSkills:id,job_id,master_technical_skill_id'])
         ->where('is_primary', 0)
        ->select('id', 'department_id')
        ->get();

        // dd($jobs);

        $existing = DB::table('department_technical_skills')
        ->select('master_technical_skill_id', 'department_id')
        ->get()
        ->map(function ($item) {
            return $item->master_technical_skill_id . '_' . $item->department_id;
        })->toArray();

        foreach ($jobs as $job) {
        $departmentId = $job->department_id;
        if (!$departmentId) {
            continue; // skip jobs not assigned to a department
        }

        foreach ($job->jdTechSkills as $techSkill) {
            $masterId = $techSkill->master_technical_skill_id;
            if (!$masterId) {
                continue;
            }

            $key = $masterId . '_' . $departmentId;
            if (in_array($key, $existing, true)) {
                continue; // already linked
            }

            $insertData[] = [
                'master_technical_skill_id' => $masterId,
                'department_id'       => $departmentId,
                'created_at'          => $timestamp,
                'updated_at'          => $timestamp,
            ];

            Log::info("Skill Mapped: $masterId", [
                'department_id' => $departmentId
            ]);
            // keep the in-memory set updated to avoid dupes within this run
            $existing[] = $key;
        }
    }


        // Batch insert in chunks (safe for large data)
         foreach (array_chunk($insertData, 500) as $chunk) {
        DB::table('department_technical_skills')->insert($chunk);
        }

        return response()->json([
            'message' => 'Sync completed. ' . count($insertData) . ' new records added.'
        ]);
        
    }



}
