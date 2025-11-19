<?php

use App\Http\Controllers\Admin\DepartmentDetailsController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\QuizController;

use App\Http\Controllers\StatsController;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\ExportDetailController;

use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\ExportPopulationController;


use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Results\ResultsController;
use App\Models\User;
use App\Jobs\UpdateOceanAssessmentReport;
use App\Jobs\UpdateRiasecAssessmentReport;
use App\Jobs\UpdateCognitiveAssessmentReport;
use App\Jobs\UpdateTechnicalAssessmentReport;
use Illuminate\Contracts\Console\Kernel;
use App\Http\Controllers\Auth\SsoController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/api-docs-generate', function () {
  $result = \Symfony\Component\Process\Process::fromShellCommandline('php artisan scribe:generate');
  $result->run();

  if (!$result->isSuccessful()) {
      return response()->json([
          'status' => 'error',
          'message' => $result->getErrorOutput(),
      ], 500);
  }

  return response()->json([
      'status'  => 'success',
      'message' => $result->getOutput(),
  ]);
});


Route::get('/test-job', function () {
  $data = 1684;

  // Create an instance of the job
  $job = new UpdateOceanAssessmentReport(1684);
  // Call the handle method directly
  $job->handle();

  // Create an instance of the job
  $job = new UpdateRiasecAssessmentReport(1684);
  // Call the handle method directly
  $job->handle();

  // Create an instance of the job
  $job = new UpdateCognitiveAssessmentReport(1684);
  // Call the handle method directly
  $job->handle();

  // Create an instance of the job
  $job = new UpdateTechnicalAssessmentReport(1684);
  // Call the handle method directly
  $job->handle();

  return 'Job handled directly!';
});

Route::middleware(['checkUserId'])->group(function () {
  Route::get('quiz/cognitive-ability-assessment/intro', [QuizController::class, 'cognitiveAbilityAssessmentIntro'])->name('cognitive-ability-assessment-intro');
  Route::get('quiz/cognitive-ability-assessment/', [QuizController::class, 'cognitiveAbilityAssessment'])->name('cognitive-ability-assessment');
  Route::post('quiz/cognitive-ability-assessment/', [QuizController::class, 'cognitiveAbilityAssessmentStore'])->name('cognitive-ability-assessment-store');
});
Route::get('test', function () {

  dd(User::all());
});
// Route::get('/', function(){
//   return redirect()->route('employee.dashboard');
// });
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::get('login', [LoginController::class, 'loginForm'])->name('login');
// Route::post('login/submit', [LoginController::class, 'login']);


// Route::get('auth/{tokenReference}/{quiz:name}/{lang}', [AuthController::class, 'setUserTokenReferece']);

Route::middleware('checkRemoteToken')->prefix('quiz/{quiz:name}')->group(function () {

  Route::middleware(['checkTimer', 'checkIsQuizCompleted'])->group(function () {

    Route::get('/intro', [QuizController::class, 'intro'])->name('intro');

    Route::get('/', [QuizController::class, 'index'])->name('index');

    Route::post('/', [QuizController::class, 'store'])->name('store');

    Route::get('results', [QuizController::class, 'results'])->name('results');

    Route::get('careers', [QuizController::class, 'careers'])->name('careers');

    Route::get('career/{careerCode}', [QuizController::class, 'career'])->name('career');
  });
});

Route::middleware('checkRemoteToken')->prefix('analytics')->group(function () {

  Route::get('/', [AnalyticsController::class, 'index']);

  Route::get('{quiz:name}', [AnalyticsController::class, 'show']);

  Route::get('{quiz:name}/{quizDomain}/values', [AnalyticsController::class, 'values']);
});

// Admin Routes

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/logout/talent', [LoginController::class, 'Talentlogout'])->name('Talentlogout');
Route::get('/LMS_Login', [LoginController::class, 'LMS_Login'])->name('LMS_Login');
Route::get('/jc-direct-insight-access-login', [LoginController::class, 'jcDirectInsightAccessLogin'])->name('jc_direct_insight_access_login');




Route::get('/language', function () {
  return view('quiz.cognitive-ability.language_select');
});

Route::get('/terms-of-use', function () {
  return view('avenger.frontend.static_pages.terms_of_use');
});

Route::get('/cookie-notice', function () {
  return view('avenger.frontend.static_pages.cookie_notice');
});

Route::get('/accessibility-statement', function () {
  return view('avenger.frontend.static_pages.accessibility_statement');
});

Route::get('/privacy-policy', function () {
  return view('avenger.frontend.static_pages.privacy_policy');
});

Route::get('/legal-information', function () {
  return view('avenger.frontend.static_pages.legal_information');
});

Auth::routes();

// Employee Onboarding Route
Route::get('/employee/onboarding', [App\Http\Controllers\Employee\OnboardingController::class, 'index'])->name('employee.onboarding')->middleware('auth');

Route::get('/verify-otp', [App\Http\Controllers\Auth\RegisterController::class, 'verifyOtpView'])->name('auth.otp');
Route::post('/verify-otp', [App\Http\Controllers\Auth\RegisterController::class, 'verifyOtp'])->name('auth.otp.verify');
Route::get('/resent-otp', [App\Http\Controllers\Auth\RegisterController::class, 'resendOtp'])->name('auth.otp.resend');
Route::post('/password/send-otp', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'sendOtp'])->name('password.otp');
Route::get('/password/change-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'changePasswordView'])->name('password.change.view');
Route::post('/password/change-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'changePassword'])->name('password.change');

Route::get('/user/about-me/{step}', [App\Http\Controllers\Candidate\AboutMeController::class, 'index'])->name('user.about.me');
Route::post('/user/about-me/store', [App\Http\Controllers\Candidate\AboutMeController::class, 'store'])->name('user.about.me.store');
Route::get('/get-states', [App\Http\Controllers\Candidate\AboutMeController::class, 'getStates'])->name('auth.about.me.get.states');
Route::get('/get-cities', [App\Http\Controllers\Candidate\AboutMeController::class, 'getCities'])->name('auth.about.me.get.cities');
Route::get('/get-countries', [App\Http\Controllers\Candidate\AboutMeController::class, 'getcountries'])->name('auth.about.me.get.countries');

Route::get('/get-department', [App\Http\Controllers\HomeController::class, 'getDepartment'])->name('get.department');

Route::get('/get/cities', [App\Http\Controllers\HomeController::class, 'getCities'])->name('get.cities');

Route::get('/career', [App\Http\Controllers\Candidate\JobsController::class, 'index'])->name('all-jobs');
Route::get('/get/job/{id}', [App\Http\Controllers\Candidate\JobsController::class, 'getJob'])->name('get-job');
Route::get('/job-details/{slug}', [App\Http\Controllers\Candidate\JobsController::class, 'detail'])->name('job-details');
Route::post('/apply/job/submit/{slug}', [App\Http\Controllers\Candidate\JobsController::class, 'applySubmit'])->name('job-apply-submit')->middleware('auth');
Route::get('/apply/job/{slug}', [App\Http\Controllers\Candidate\JobsController::class, 'applyJob'])->name('apply-job')->middleware('auth');
Route::get('/job/apply/guest-user/{slug}', [App\Http\Controllers\Candidate\JobsController::class, 'guestApply'])->name('job-apply-guest');

Route::get('/applications', [App\Http\Controllers\Candidate\JobsController::class, 'applications'])->name('applications')->middleware('auth');
Route::get('/saved/jobs', [App\Http\Controllers\Candidate\JobsController::class, 'bookmarkedJob'])->name('bookmark-jobs')->middleware('auth');

Route::get('/about-me', [App\Http\Controllers\Employee\AboutMeController::class, 'index'])->name('employee.about.me')->middleware('auth');
Route::post('/about-me/store', [App\Http\Controllers\Employee\AboutMeController::class, 'store'])->name('employee.about.me.store')->middleware('auth');
Route::get('/barangay/search', [App\Http\Controllers\Employee\AboutMeController::class, 'barangaySearch'])->name('barangay.search')->middleware('auth');
Route::get('/city/search', [App\Http\Controllers\Employee\AboutMeController::class, 'citySearch'])->name('city.search')->middleware('auth');
Route::get('/technical-skill/search', [App\Http\Controllers\Candidate\AboutMeController::class, 'getTechnicalSkills'])->name('technical.skill.search')->middleware('auth');
Route::post('/job-application/update-status/{id}', [App\Http\Controllers\Candidate\JobsController::class, 'applicationStatus'])->name('admin.application.update-status');
Route::post('/toggle-bookmark', [App\Http\Controllers\Candidate\JobsController::class, 'toggleBookmark'])->name('toggle-bookmark');
// Route::get('/user/document')


Route::middleware(['auth'])->group(function () {
  // ,'firstTimeLogin' Middleware to handle the first time login
  Route::get('/dashboard/jd', [App\Http\Controllers\Employee\DashboardController::class, 'index'])->name('employee.dashboard.jd')->middleware('auth');
  Route::get('/candidate/dashboard', [App\Http\Controllers\Employee\DashboardController::class, 'psychometric'])->name('candidate.dashboard');
  Route::get('/dashboard/career-pathing', [App\Http\Controllers\Employee\DashboardController::class, 'careerPathing'])->name('employee.dashboard.career-pathing');
  Route::get('/dashboard/performance-management', [App\Http\Controllers\Employee\DashboardController::class, 'performanceManagement'])->name('employee.dashboard.performance-management');
  Route::get('/dashboard/job-application', [App\Http\Controllers\Employee\DashboardController::class, 'jobApplication'])->name('employee.dashboard.job-application');
  Route::get('/dashboard/jd-details', [App\Http\Controllers\Employee\DashboardController::class, 'jdDetails'])->name('employee.dashboard.jd-details');
Route::get('/learning-management-system', [App\Http\Controllers\Employee\DashboardController::class, 'lms'])->name('employee.lms')->middleware('auth');

Route::get('/technical-assessment/{application_id}/{technical_assessment_id}', [App\Http\Controllers\Employee\DashboardController::class, 'technical_assessment'])->name('technical_assessment')->middleware('auth');
Route::get('/contract/sign/{id}', [App\Http\Controllers\Employee\DashboardController::class, 'contractSign'])->name('contracts.sign')->middleware('auth');
Route::post('/contract/sign/submit', [App\Http\Controllers\Employee\DashboardController::class, 'contractSignSubmit'])->name('contracts.sign.submit')->middleware('auth');



Route::get('/settings', [App\Http\Controllers\Employee\SettingsController::class, 'index'])->name('employee.settings')->middleware('auth');
Route::post('/settings/store', [App\Http\Controllers\Employee\SettingsController::class, 'store'])->name('employee.settings.store')->middleware('auth');
Route::get('/help', [App\Http\Controllers\Employee\SettingsController::class, 'help'])->name('employee.help')->middleware('auth');

Route::get('/document/upload', [App\Http\Controllers\Employee\DocumentUploadController::class, 'document'])->name('employee.document')->middleware('auth');
Route::post('/document/store', [App\Http\Controllers\Employee\DocumentUploadController::class, 'document_store'])->name('employee.document.store')->middleware('auth');

Route::get('survey', [App\Http\Controllers\Employee\SurveyController::class, 'survey'])->name('employee.survey')->middleware('auth');

Route::get('/employee/survey/start/{survey}', [App\Http\Controllers\Employee\SurveyController::class, 'start'])->name('employee.survey.start')->middleware('auth');
Route::post('/survey/{surveyId}/store', [App\Http\Controllers\Employee\SurveyController::class, 'store'])->name('employee.survey.store')->middleware('auth');

Route::get('technical-assessment/dashboard', [App\Http\Controllers\Employee\TechnicalAssessmentController::class, 'index'])->name('technical.assessment.dashboard')->middleware('auth');

Route::get('technicalAssessment/start/{id}', [App\Http\Controllers\Employee\TechnicalAssessmentController::class, 'start'])->name('employee.technicalAss.start')->middleware('auth');

Route::post('technicalAssessment/store/{id}', [App\Http\Controllers\Employee\TechnicalAssessmentController::class, 'store'])->name('employee.technicalAss.store')->middleware('auth');

Route::get('job-application/technicalAssessment/start/{application_id}/{id}', [App\Http\Controllers\Employee\TechnicalAssessmentController::class, 'JobApplicationTAStart'])->name('employee.job-application.technicalAss.start')->middleware('auth');

Route::post('job-application/technicalAssessment/store/{id}', [App\Http\Controllers\Employee\TechnicalAssessmentController::class, 'JobApplicationTAStore'])->name('employee.job-application.technicalAss.store')->middleware('auth');




// Route::middleware(['auth', 'checkSkillReview'])->group(function () {
//   Route::get('performance/management', [App\Http\Controllers\Employee\PerofrmanceManagementController::class, 'performanceStepOne'])->name('performance.management.performanceStepOne');
//   Route::get('add/kpi', [App\Http\Controllers\Employee\PerofrmanceManagementController::class, 'addKpi'])->name('performance.management.addKpi');
//   Route::get('performance/plan', [App\Http\Controllers\Employee\PerofrmanceManagementController::class, 'performancePlan'])->name('performance.management.performancePlan');
//   Route::post('performance/management/post', [App\Http\Controllers\Employee\PerofrmanceManagementController::class, 'performanceStepTwo'])->name('performance.management.performanceStepOnePost');
//   Route::get('performance/management/details/{id}', [App\Http\Controllers\Employee\PerofrmanceManagementController::class, 'performanceStepTwoGet'])->name('performance.management.performanceStepTwoGet');
//   Route::post('performance/management/step3', [App\Http\Controllers\Employee\PerofrmanceManagementController::class, 'performanceStepThree'])->name('performance.management.performanceStepThree');
//   Route::get('performance/management/step3', [App\Http\Controllers\Employee\PerofrmanceManagementController::class, 'performanceStepThreeGet'])->name('performance.management.performanceStepThreeGet');
//   Route::get('/employee/review/{userId}/{reviewId}', [App\Http\Controllers\Employee\PerofrmanceManagementController::class, 'review'])->name('employee.review');
//   Route::get('/employee/review/update0/{userId}/{reviewId}', [App\Http\Controllers\Employee\PerofrmanceManagementController::class, 'review'])->name('employee.review');
//   // Route::put('/performance-management/update-skill/{reviewId}',  [App\Http\Controllers\Employee\PerofrmanceManagementController::class, 'updateSkills'])->name('performance.management.updateSkills');
//   Route::post('/performance-management/add/kpis',  [App\Http\Controllers\Employee\PerofrmanceManagementController::class, 'saveMidKpi'])->name('performance.management.saveMidKpi');
//   Route::post('/performance-management/add/end/kpis',  [App\Http\Controllers\Employee\PerofrmanceManagementController::class, 'saveEndKpi'])->name('performance.management.saveEndKpi');
// });

// Route::middleware(['auth', 'checkSkillReview'])->group(function () {
  Route::get('performance/management', [App\Http\Controllers\Employee\PerofrmanceManagementController::class, 'performanceStepOne'])->name('performance.management.performanceStepOne');
  Route::get('performance/management/kpi', [App\Http\Controllers\Employee\PerofrmanceManagementController::class, 'performanceManagmentKPI'])->name('employee.dashboard.kpi');
  Route::get('individual/development/plan', [App\Http\Controllers\Employee\DashboardController::class, 'IndividualDevelopmentPlan'])->name('individual.development.plan');
  Route::get('/get-skill-data', [App\Http\Controllers\Employee\PerofrmanceManagementController::class, 'getSkillData']);
  Route::get('/get-skill-review-types', [App\Http\Controllers\Employee\PerofrmanceManagementController::class, 'getSkillReviewTypes']);
  Route::get('/get-skill-filter-data', [App\Http\Controllers\Employee\PerofrmanceManagementController::class, 'getSkillFilterData']);

  Route::get('add/kpi', [App\Http\Controllers\Employee\PerofrmanceManagementController::class, 'addKpi'])->name('performance.management.addKpi');
  Route::get('performance/plan', [App\Http\Controllers\Employee\PerofrmanceManagementController::class, 'performancePlan'])->name('performance.management.performancePlan');
  Route::post('performance/management/post', [App\Http\Controllers\Employee\PerofrmanceManagementController::class, 'performanceStepTwo'])->name('performance.management.performanceStepOnePost');
  Route::get('performance/management/details/{id}', [App\Http\Controllers\Employee\PerofrmanceManagementController::class, 'performanceStepTwoGet'])->name('performance.management.performanceStepTwoGet');
  Route::post('performance/management/step3', [App\Http\Controllers\Employee\PerofrmanceManagementController::class, 'performanceStepThree'])->name('performance.management.performanceStepThree');
  Route::get('performance/management/step3', [App\Http\Controllers\Employee\PerofrmanceManagementController::class, 'performanceStepThreeGet'])->name('performance.management.performanceStepThreeGet');
  Route::get('/employee/review/{userId}/{reviewId}', [App\Http\Controllers\Employee\PerofrmanceManagementController::class, 'review'])->name('employee.review');
  Route::get('/employee/review/update0/{userId}/{reviewId}', [App\Http\Controllers\Employee\PerofrmanceManagementController::class, 'review'])->name('employee.review');
  // Route::put('/performance-management/update-skill/{reviewId}',  [App\Http\Controllers\Employee\PerofrmanceManagementController::class, 'updateSkills'])->name('performance.management.updateSkills');
  Route::post('/performance-management/add/kpis',  [App\Http\Controllers\Employee\PerofrmanceManagementController::class, 'saveMidKpi'])->name('performance.management.saveMidKpi');
  Route::post('/performance-management/add/end/kpis',  [App\Http\Controllers\Employee\PerofrmanceManagementController::class, 'saveEndKpi'])->name('performance.management.saveEndKpi');
// });

});
