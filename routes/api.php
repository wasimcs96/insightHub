<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\AiJdGeneratorController;
use App\Http\Controllers\InsightHub\CompanyProfileController;

use App\Http\Controllers\QuizController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/




Route::get('/user/data', function (Request $request) {

    $user = App\Models\User::where('email',$request->email)->first();

    return response()->json($user);
});

Route::get('/job-description', function (Request $request) {

    $user =  App\Models\Job::where('is_primary',0)->select('id','title')->get();

    return response()->json($user);
});


// Route::get('/job-positions', function (Request $request) {

//     $user = App\Models\Job::select('id','title')->get();

//     return response()->json($user);
// });

Route::put('/jobs/update-technical-assessment',  function (Request $request) {

    $id  = $request->input('id');
    $application_id = $request->input('application_id');
    $job = App\Models\Job::findOrFail($id);
    $job->technical_assessment_id = $request->input('technical_assessment_id');
    $job->save();


    return response()->json(['message' => 'Job updated successfully', 'data' => $job]);

});

Route::get('/randomizer', [QuizController::class, 'generateNewQuestionSet']);

Route::post('/profile', [CompanyProfileController::class, 'store']);


Route::post('/jobs/non-primary', [AiJdGeneratorController::class, 'getNonPrimaryJobs']);

Route::post('/generate-jd', [AiJdGeneratorController::class, 'generateJd']);
Route::get('/sync-job-family-skills', [AiJdGeneratorController::class, 'syncJobFamilyTechnicalSkills']);

/*
|--------------------------------------------------------------------------
| API Routes - Talent Core (TC)
|--------------------------------------------------------------------------
*/
Route::prefix('v1')->middleware(['api.rate.limit', 'api.external.auth'])->group(function () { //'tenant.context'
    // Health check - no authentication required
    Route::get('/health', function () {
        return response()->json([
            'success' => true,
            'service' => 'talent-core',
            'version' => '1.0.0',
            'timestamp' => now()->toISOString(),
            'status' => 'healthy'
        ]);
    });
    
    // Protected API endpoints - require service authentication
    Route::middleware([])->group(function () { //api.auth'
        // Employee endpoints
        Route::prefix('employees')->group(function () {
            Route::get('/{id}', function () {
                return response()->json([
                    'success' => true,
                    'data' => [], // Employee data would be fetched here
                    'message' => 'Send Employee Details to BSC',
                ]);
                //->middleware('api.external.auth:employees.read');
            });
        });
    });    
}); 