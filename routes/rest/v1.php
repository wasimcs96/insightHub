<?php

use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\Demographics\DemographicsController;
use App\Http\Controllers\Demographics\EducationController;
use App\Http\Controllers\Demographics\FinancialSupportController;
use App\Http\Controllers\Demographics\GeographyController;
use App\Http\Controllers\Demographics\NationalityController;
use App\Http\Controllers\Demographics\SignupInfoController;
use App\Http\Controllers\Results\ResultsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\JobOpeningsController;
use App\Http\Controllers\Api\V1\{DivisionController, BusinessUnitController, DepartmentController, EmployeeController, CompanyController, SectorController, JobsController, UserController};
use App\Http\Controllers\Api\V1\RoleController;

Route::prefix('v1')->group(function () {

  Route::get('/quizzes/{quizDomainValueAnswer:user_id}', [AnalyticsController::class, 'quizzesCompletion']);

  Route::prefix('analytics')->group(function () {

    Route::get('quizzes', [AnalyticsController::class, 'quizzes']);

    Route::get('{quiz:name}/{quizDomain?}', [AnalyticsController::class, 'analytics']);

    Route::post('{quiz:name}/totals', [AnalyticsController::class, 'totals']);
  });

  Route::prefix('demographics')->group(function () {

    Route::get('userStatus', [DemographicsController::class, 'userStatus']);

    Route::get('userEducation', [DemographicsController::class, 'userEducation']);

    Route::get('userScholarship', [DemographicsController::class, 'userScholarship']);

    Route::get('userDemographics', [DemographicsController::class, 'userDemographics']);

    Route::get('userSignups', [DemographicsController::class, 'userSignups']);


    Route::prefix('education')->group(function () {

      Route::get('usersByInstitution', [EducationController::class, 'usersByInstitution']);

      Route::get('usersByScope', [EducationController::class, 'usersByScope']);

      Route::get('usersByStudyYear', [EducationController::class, 'usersByStudyYear']);
    });

    Route::get('financial-support/usersByScholarData', [FinancialSupportController::class, 'usersByScholarData']);

    Route::prefix('geography')->group(function () {

      Route::get('usersByResidence', [GeographyController::class, 'usersByResidence']);

      Route::get('usersByState', [GeographyController::class, 'usersByState']);

      Route::get('usersByCity', [GeographyController::class, 'usersByCity']);
    });

    Route::prefix('nationality')->group(function () {

      Route::get('usersByNationality', [NationalityController::class, 'usersByNationality']);

      Route::get('usersByGender', [NationalityController::class, 'usersByGender']);

      Route::get('usersByEthnicity', [NationalityController::class, 'usersByEthnicity']);

      Route::get('usersOtherNationalities', [NationalityController::class, 'usersOtherNationalities']);
    });

    Route::prefix('signup-info')->group(function () {

      Route::get('monthlySignups', [SignupInfoController::class, 'monthlySignups']);

      Route::get('weeklySignups', [SignupInfoController::class, 'weeklySignups']);

      Route::get('userStatusPerUniversity', [SignupInfoController::class, 'userStatusPerUniversity']);

      Route::get('weeklyCompanySignups', [SignupInfoController::class, 'weeklyCompanySignups']);

      Route::get('companiesStatus', [SignupInfoController::class, 'companiesStatus']);
    });
  });

  Route::prefix('results')->group(function () {

    Route::get('/', [ResultsController::class, 'index']);

    Route::get('assessment-results/{quiz:name}/{user_id}', [ResultsController::class, 'totals']);

    Route::get('assessment-results-type/{quiz:name}/{user_id}', [ResultsController::class, 'totalsForPipelines']);
  });

  Route::get('/job-openings', [JobOpeningsController::class, 'index']);
  Route::get('/job-openings/details/{slug}', [JobOpeningsController::class, 'detail']);
  Route::post('/job-openings/submit-application/', [JobOpeningsController::class, 'submitApplication']);
  Route::get('/job-openings/get-companies', [JobOpeningsController::class, 'getCompanies']);
  Route::get('/job-openings/get-departments', [JobOpeningsController::class, 'getDepartments']);
  Route::post('/user/update-technical-exam-score-from-lms', [JobOpeningsController::class, 'updateTechnicalExamScoreFromLms']);
  Route::get('/job-opening-applications/{external_user_id}', [JobOpeningsController::class, 'getApplications']);



  Route::get('/get-technical-skills', [JobOpeningsController::class, 'getTechnicalSkills']);
  Route::get('/get-generic-skills', [JobOpeningsController::class, 'getGenericSkills']);

  Route::get('/get-employee-contract', [JobOpeningsController::class, 'getcontract']);
  Route::get('/get-employee-detail', [JobOpeningsController::class, 'getEmployeeDetail']);

  Route::post('/upload-technical-skill-category', [JobOpeningsController::class, 'uploadFile']);

  // ->middleware(['auth:sanctum'])
  Route::get('company-details', [CompanyController::class, 'show']);
  Route::get('business-units', [BusinessUnitController::class, 'index']);
  Route::get('divisions', [DivisionController::class, 'index']);
  Route::get('departments', [DepartmentController::class, 'index']);
  Route::get('organization-chart', [CompanyController::class, 'organizationChart']);
  Route::get('employees/{id}/psychometric-results', [EmployeeController::class, 'psychometricResults'])->whereNumber('id');
  Route::get('employees', [EmployeeController::class, 'index']);
  Route::get('employees/{id}', [EmployeeController::class, 'show'])->whereNumber('id');
  Route::get('jd/{id}', [EmployeeController::class, 'jd'])->whereNumber('id');
  Route::get('technical-skill/details/{id}', [EmployeeController::class, 'technicalSkillDetails'])->whereNumber('id');
  Route::get('soft-skill/details/{title}', [EmployeeController::class, 'softSkillDetails']);
  Route::post('users', [UserController::class, 'store'])->name('users.store');
  Route::get('sectors', [SectorController::class, 'index']);
  Route::get('jobs', [JobsController::class, 'index']);

  /**
   * API Routes (Optional)
 */
  /*
  Route::middleware(['auth:sanctum', 'admin'])->prefix('insighthub/settings')->name('api.insighthub.')->group(function () {
      Route::prefix('role-management')->name('role-management.')->group(function () {
          Route::get('/', [RoleController::class, 'index']);
          Route::post('/', [RoleController::class, 'store']);
          Route::get('/{id}', [RoleController::class, 'show']);
          Route::put('/{id}', [RoleController::class, 'update']);
          Route::delete('/{id}', [RoleController::class, 'destroy']);
          Route::get('/{id}/check-deletable', [RoleController::class, 'checkDeletable']);
          Route::get('/{id}/users', [RoleController::class, 'getRoleUsers']);
      });
  });
  */
  
  /*
  |--------------------------------------------------------------------------
  | API V1 Routes - Role Management
  |--------------------------------------------------------------------------
  */

  Route::prefix('roles')
    ->name('roles.')
    ->group(function () {
        Route::get('/', [RoleController::class, 'index'])->name('index');
        Route::post('/', [RoleController::class, 'store'])->name('store');
        Route::get('/{id}', [RoleController::class, 'show'])->name('show');
        Route::put('/{id}', [RoleController::class, 'update'])->name('update');
        Route::delete('/{id}', [RoleController::class, 'destroy'])->name('destroy');
        Route::get('/{id}/users', [RoleController::class, 'users'])->name('users');
        Route::post('/{roleId}/assign/{userId}', [RoleController::class, 'assignToUser'])->name('assign');
    });
  
});
