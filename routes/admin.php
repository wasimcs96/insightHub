<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\QuizController;

use App\Http\Controllers\StatsController;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ClaimManagementController;
use App\Http\Controllers\Admin\DescriptorController;



use App\Http\Controllers\LoginController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\ExportDetailController;

use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\SurveyQuestionController;
use App\Http\Controllers\Admin\SurveyAnswerController;


use App\Http\Controllers\ExportPopulationController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\AnalyticalController;
use App\Http\Controllers\FacetsQuestionController;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Results\ResultsController;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\JobController;
use App\Http\Controllers\PoolController;
use App\Http\Controllers\SectorController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\PositionController;
use App\Http\Controllers\Admin\TeamsController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\MyDepartmentController;
use App\Http\Controllers\Admin\MyEmployeeController;
use App\Http\Controllers\Admin\CandidateController;
use App\Http\Controllers\Admin\GetUserDataController;

use App\Http\Controllers\DepartmentSectionController;
use App\Http\Controllers\Admin\SectionUnitController;
use App\Http\Controllers\WeightageController;
use App\Http\Controllers\Admin\JobOpeningsController;
use App\Http\Controllers\Admin\TechnicalAssessmentController;
use App\Http\Controllers\Admin\LeaveManagementController;
use App\Http\Controllers\Admin\AllowanceManagementController;
use App\Http\Controllers\Admin\GeneralSettingController;


use App\Http\Controllers\Admin\SurveyController;

use App\Http\Controllers\Admin\TalentManagementController;
use App\Http\Controllers\Admin\PdfController;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\BusinessUnitController;
use App\Http\Controllers\Admin\AggregatedPdfController as AdminAggregatedPdfController;

use App\Http\Controllers\Admin\ContractTemplateController;
use App\Http\Controllers\Admin\FeedbackController;

use App\Http\Controllers\MetaSettingsController;
use App\Http\Controllers\OrganisationController;
use App\Http\Controllers\PerformanceManagementController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\Admin\AiApisController;
use App\Http\Controllers\Admin\SkillManagementController;
use App\Http\Controllers\Admin\AiJdGeneratorController;
use App\Http\Controllers\Admin\LlmController;
use App\Http\Controllers\Admin\CareerMapController;
use App\Http\Controllers\Admin\InterviewQuestion;
use App\Http\Controllers\Admin\DepartmentDetailsController;
use App\Http\Controllers\AggregatedPdfController;
use App\Http\Controllers\Admin\TalentAcquisition\TemplateSettingsController;
use App\Http\Controllers\Admin\TalentAcquisition\JobCreateAdvertisement;
use App\Http\Controllers\Admin\TalentAcquisition\JobPostingReviewController;
use App\Http\Controllers\Admin\TalentAcquisition\JobBoardController;
use App\Http\Controllers\Admin\TalentAcquisition\JobAdvertisementReportController;
use App\Http\Controllers\Admin\TalentAcquisition\CandidateScreeningController;
use App\Http\Controllers\Admin\AdvancedComparisonController;
use App\Http\Controllers\Admin\AdvancedComparisonTmController;
use App\Http\Controllers\Admin\DropdownController;
use App\Http\Controllers\Admin\OrganizationChartController;
use App\Http\Controllers\ModalController;
use App\Http\Controllers\OrganizationChangelogController;
use App\Http\Controllers\Admin\CompanyTechnicalSkillController;
use App\Http\Controllers\Admin\JobManagementController;
// use App\Http\Controllers\Admin\JdTechnicalSkillController;
use App\Http\Controllers\AirAsiaJobManagementController;
use App\Http\Controllers\Api\UserSearchController;
use App\Http\Controllers\JobHeadcountController;
use App\Models\Job;
use App\Models\JobHeadcount;
use App\Models\OrgChartAudit;
use OwenIt\Auditing\Models\Audit;

Route::middleware(['auth', 'isadmin'])->group(function () { //middleware(['tenant.access', 'tenant.context']) 

    
            Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('employee.dashboard');

    Route::prefix('admin/talent-acquisition/template-settings')->group(function () {
        Route::get('/', [TemplateSettingsController::class, 'index'])->name('admin.talent-acquisition.template-settings.index');
        // Route::get('/create', [TemplateSettingsController::class, 'create'])->name('admin.talent-acquisition.template-settings.create');
        // Route::post('/store', [TemplateSettingsController::class, 'store'])->name('admin.talent-acquisition.template-settings.store');
        // Route::get('/edit/{id}', [TemplateSettingsController::class, 'edit'])->name('admin.talent-acquisition.template-settings.edit');
        // Route::put('/update/{id}', [TemplateSettingsController::class, 'update'])->name('admin.talent-acquisition.template-settings.update');
        // Route::delete('/delete/{id}', [TemplateSettingsController::class, 'destroy'])->name('admin.talent-acquisition.template-settings.delete');

        // Employee Contract Routes
        Route::prefix('employee-contract')->group(function () {
            Route::get('/', [TemplateSettingsController::class, 'indexEmployeeContract'])->name('admin.talent-acquisition.template-settings.employee-contract.index');
            Route::get('/create', [TemplateSettingsController::class, 'createEmployeeContract'])->name('admin.talent-acquisition.template-settings.employee-contract.create');
            Route::post('/store', [TemplateSettingsController::class, 'storeEmployeeContract'])->name('admin.talent-acquisition.template-settings.employee-contract.store');
            Route::get('/edit/{id}', [TemplateSettingsController::class, 'editEmployeeContract'])->name('admin.talent-acquisition.template-settings.employee-contract.edit');
            Route::put('/update/{id}', [TemplateSettingsController::class, 'updateEmployeeContract'])->name('admin.talent-acquisition.template-settings.employee-contract.update');
            Route::delete('/delete/{id}', [TemplateSettingsController::class, 'destroyEmployeeContract'])->name('admin.talent-acquisition.template-settings.employee-contract.delete');
            Route::post('/duplicate/{id}', [TemplateSettingsController::class, 'duplicateEmployeeContract'])->name('admin.talent-acquisition.template-settings.employee-contract.duplicate');
        });

        // Email Template Routes
        Route::prefix('email-template')->group(function () {
            Route::get('/', [TemplateSettingsController::class, 'indexEmailTemplate'])->name('admin.talent-acquisition.template-settings.email-template.index');
            Route::get('/create', [TemplateSettingsController::class, 'createEmailTemplate'])->name('admin.talent-acquisition.template-settings.email-template.create');
            Route::post('/store', [TemplateSettingsController::class, 'storeEmailTemplate'])->name('admin.talent-acquisition.template-settings.email-template.store');
            Route::get('/edit/{id}', [TemplateSettingsController::class, 'editEmailTemplate'])->name('admin.talent-acquisition.template-settings.email-template.edit');
            Route::put('/update/{id}', [TemplateSettingsController::class, 'updateEmailTemplate'])->name('admin.talent-acquisition.template-settings.email-template.update');
            Route::delete('/delete/{id}', [TemplateSettingsController::class, 'destroyEmailTemplate'])->name('admin.talent-acquisition.template-settings.email-template.delete');
            Route::get('/duplicate/{id}', [TemplateSettingsController::class, 'duplicateEmailTemplate'])->name('admin.talent-acquisition.template-settings.email-template.duplicate');
        });

        // Company Overview Routes
        Route::prefix('company-overview')->group(function () {
            Route::get('/', [TemplateSettingsController::class, 'indexCompanyOverview'])->name('admin.talent-acquisition.template-settings.company-overview.index');
            Route::get('/create', [TemplateSettingsController::class, 'createCompanyOverview'])->name('admin.talent-acquisition.template-settings.company-overview.create');
            Route::post('/store', [TemplateSettingsController::class, 'storeCompanyOverview'])->name('admin.talent-acquisition.template-settings.company-overview.store');
            Route::get('/edit/{id}', [TemplateSettingsController::class, 'editCompanyOverview'])->name('admin.talent-acquisition.template-settings.company-overview.edit');
            Route::put('/update/{id}', [TemplateSettingsController::class, 'updateCompanyOverview'])->name('admin.talent-acquisition.template-settings.company-overview.update');
            Route::delete('/delete/{id}', [TemplateSettingsController::class, 'destroyCompanyOverview'])->name('admin.talent-acquisition.template-settings.company-overview.delete');
            Route::post('/duplicate/{id}', [TemplateSettingsController::class, 'duplicateCompanyOverview'])->name('admin.talent-acquisition.template-settings.company-overview.duplicate');
        });

        // Compensation & Benefits Routes
        Route::prefix('compensation-benefits')->group(function () {
            Route::get('/', [TemplateSettingsController::class, 'indexCompensationBenefits'])->name('admin.talent-acquisition.template-settings.compensation-benefits.index');
            Route::get('/create', [TemplateSettingsController::class, 'createCompensationBenefits'])->name('admin.talent-acquisition.template-settings.compensation-benefits.create');
            Route::post('/store', [TemplateSettingsController::class, 'storeCompensationBenefits'])->name('admin.talent-acquisition.template-settings.compensation-benefits.store');
            Route::get('/edit/{id}', [TemplateSettingsController::class, 'editCompensationBenefits'])->name('admin.talent-acquisition.template-settings.compensation-benefits.edit');
            Route::put('/update/{id}', [TemplateSettingsController::class, 'updateCompensationBenefits'])->name('admin.talent-acquisition.template-settings.compensation-benefits.update');
            Route::delete('/delete/{id}', [TemplateSettingsController::class, 'destroyCompensationBenefits'])->name('admin.talent-acquisition.template-settings.compensation-benefits.delete');
            Route::post('/duplicate/{id}', [TemplateSettingsController::class, 'duplicateCompensationBenefits'])->name('admin.talent-acquisition.template-settings.compensation-benefits.duplicate');
        });
    });

    Route::prefix('admin/talent-acquisition/job-advertisement')->group(function () {
        Route::get('/detail/{id}', [JobAdvertisementReportController::class, 'index'])->name('admin.talent-acquisition.job-advertisement.detail');
        Route::post('/detail/reject-applicants/', [JobAdvertisementReportController::class, 'rejectApplicants'])->name('admin.talent-acquisition.job-advertisement.rejectApplicants');
        Route::post('/detail/send-assessment-link/', [JobAdvertisementReportController::class, 'sendEmailsToSelected'])->name('admin.talent-acquisition.job-advertisement.sendAssessmentLink');
        Route::post('/detail/change-status-to-shortlist/', [JobAdvertisementReportController::class, 'applicationChangeShortlisted'])->name('admin.talent-acquisition.job-advertisement.applicationChangeShortlisted');

        Route::get('/detail/get-filters/{id}', [JobAdvertisementReportController::class, 'getStatusCountsApi'])->name('admin.talent-acquisition.job-advertisement.getFilters');
        Route::get('/detail/{id}/applicant-details/{applicant_id}', [JobAdvertisementReportController::class, 'applicantDetails'])->name('admin.talent-acquisition.job-advertisement.detail.applicant-details');
        Route::post('/job/fetch-users', [JobAdvertisementReportController::class, 'fetchUsersByApplicationIds'])
            ->name('admin.talent-acquisition.job-advertisement.fetchUsersByApplicationIds');
    });
    Route::get('/setting', function () {
        return view('admin.setting.index');
    });

    Route::get('/job-openings/pipeline/update-application-status', [JobOpeningsController::class, 'pipelineUpdateApplicationStatus'])->name('admin.job-opening.pipeline-update-application-status');

    Route::delete('/job-openings-delete/{id}', [JobCreateAdvertisement::class, 'destroy'])
    ->name('job-openings-delete.destroy');

    Route::group(['prefix' => 'admin'], function () {

        Route::get('/talent-acquisition/job-board/create-job-advertisement', [App\Http\Controllers\Admin\TalentAcquisition\JobCreateAdvertisement::class, 'createJobAdvertisementForm'])
            ->name('admin.talent-acquisition.job-board.create-edit-job-advertisement.create-job-advertisement-page');

        Route::post('/talent-acquisition/job-board/save-draft', [App\Http\Controllers\Admin\TalentAcquisition\JobCreateAdvertisement::class, 'saveDraft'])
            ->name('admin.talent-acquisition.job-board.save-draft');

        Route::post('/talent-acquisition/job-board/save-draft-posting-review', [JobCreateAdvertisement::class, 'saveDraftPostingReview'])
            ->name('admin.talent-acquisition.job-board.save-draft-posting-review');

        // Route to handle Vacancy Details tab submission
        Route::post('/talent-acquisition/job-board/create-vacancy-details', [App\Http\Controllers\Admin\TalentAcquisition\JobCreateAdvertisement::class, 'createVacancyDetails'])
            ->name('admin.talent-acquisition.job-board.create-vacancy-details');

        Route::post('/talent-acquisition/job-board/update-vacancy-details', [App\Http\Controllers\Admin\TalentAcquisition\JobCreateAdvertisement::class, 'updateVacancyDetails'])
            ->name('admin.talent-acquisition.job-board.update-vacancy-details');

        // Route to handle Job Details tab submission
        Route::post('/talent-acquisition/job-board/create-job-details', [JobCreateAdvertisement::class, 'createJobDetails'])
            ->name('admin.talent-acquisition.job-board.create-job-details');

        // Route to handle Job Qualifications tab submission
        Route::post('/talent-acquisition/job-board/create-job-qualifications', [JobCreateAdvertisement::class, 'createJobQualifications'])
            ->name('admin.talent-acquisition.job-board.create-job-qualifications');

        Route::post('/talent-acquisition/job-board/update-job-qualifications', [App\Http\Controllers\Admin\TalentAcquisition\JobCreateAdvertisement::class, 'updateJobQualifications'])
            ->name('admin.talent-acquisition.job-board.update-job-qualifications');

        // Route to handle Job Skills tab submission
        Route::post('/talent-acquisition/job-board/create-job-skills', [JobCreateAdvertisement::class, 'createJobSkills'])
            ->name('admin.talent-acquisition.job-board.create-job-skills');

        // Route to handle Other Details tab submission
        Route::post('/talent-acquisition/job-board/create-job-other-details', [JobCreateAdvertisement::class, 'createOtherDetails'])
            ->name('admin.talent-acquisition.job-board.create-job-other-details');

        Route::post('/talent-acquisition/job-board/update-job-other-details', [JobCreateAdvertisement::class, 'updateOtherDetails'])
            ->name('admin.talent-acquisition.job-board.update-job-other-details');

        // Route to handle Hiring Workflow tab submission
        Route::post('/talent-acquisition/job-board/create-hiring-workflow', [JobCreateAdvertisement::class, 'createHiringWorkflow'])
            ->name('admin.talent-acquisition.job-board.create-hiring-workflow');

        Route::post('/talent-acquisition/job-board/update-hiring-workflow', [JobCreateAdvertisement::class, 'updateHiringWorkflow'])
            ->name('admin.talent-acquisition.job-board.update-hiring-workflow');

        Route::post('/update-job-opening-status/{id}', [JobCreateAdvertisement::class, 'updateStatus']);

        Route::post('/talent-acquisition/job-board/reuse-advertisement', [JobCreateAdvertisement::class, 'reuseAdvertisement'])
            ->name('admin./talent-acquisition.job-board.reuse-advertisement');

        Route::get('/talent-acquisition/job-board', [JobBoardController::class, 'index'])->name('admin.talent-acquisition.job-board.index');
        Route::get('/talent-acquisition/job-board/vacancies', [JobBoardController::class, 'vacancy'])->name('admin.talent-acquisition.job-board.vacancy');
        Route::get('/talent-acquisition/job-board/job-openings', [JobBoardController::class, 'getJobOpenings'])->name('admin.talent-acquisition.job-board.getJobOpenings');
        Route::delete('/talent-acquisition/job-board/job-openings/{id}', [JobBoardController::class, 'destroy']);
        Route::post('/talent-acquisition/job-board/job-openings/update-job-dates', [JobBoardController::class, 'updateJobDates'])->name('update.job.dates');
        Route::post('/talent-acquisition/job-board/job-openings/set-to-expired', [JobBoardController::class, 'setToExpired']);
        Route::post('/talent-acquisition/job-board/job-openings/extend-expiry-date', [JobBoardController::class, 'extendExpiryDate']);
        Route::post('/talent-acquisition/job-board/job-openings/launch-advertisement', [JobBoardController::class, 'launchAdvertisement']);


        Route::get('/talent-acquisition/candidate-screening/upcoming-interview', [CandidateScreeningController::class, 'upcoming_index'])->name('admin.talent-acquisition.candidate-screening.upcoming-interview.index');
        Route::get('/talent-acquisition/candidate-screening/interview-info/{id}', [CandidateScreeningController::class, 'getInterviewInfo']);
        Route::get('/talent-acquisition/candidate-screening/conduct-interview', [CandidateScreeningController::class, 'conductInterview']);
        Route::post('/talent-acquisition/candidate-screening/conduct-interview/response', [CandidateScreeningController::class, 'conductInterviewResponse'])->name('admin.talent-acquisition.candidate-screening.conduct-interview.response');



        Route::get('/talent-acquisition/candidate-screening/interview-conduct', [CandidateScreeningController::class, 'conduct_index'])->name('admin.talent-acquisition.candidate-screening.interview-conduct.index');
        Route::get('/talent-acquisition/candidate-screening/interview-conduct-data/{id}', [CandidateScreeningController::class, 'getConductInterviewInfo']);


        // InterviewQuestion
        Route::get('/interview-question', [InterviewQuestion::class, 'index'])->name('admin.interview-question.index')->middleware('auth');
        Route::get('/interview-question/create', [InterviewQuestion::class, 'create'])->name('admin.interview-question.create')->middleware('auth');
        Route::post('/interview-question/store', [InterviewQuestion::class, 'store'])->name('admin.interview-question.store')->middleware('auth');

        Route::get('/interview-question/{job_id}/{department_id}/edit', [InterviewQuestion::class, 'edit'])->name('admin.interview-question.edit')->middleware('auth');
        Route::put('/interview-question/update', [InterviewQuestion::class, 'update'])->name('admin.interview-question.update')->middleware('auth');

        Route::get('/interview-question/bulk-upload', [InterviewQuestion::class, 'bulk_upload'])->name('admin.interview-question.bulk-upload')->middleware('auth');
        Route::get('/interview-question/{department_id}/{job_id}/view', [InterviewQuestion::class, 'show'])->name('admin.interview-question.show')->middleware('auth');

        Route::get('/get-job-by-department/{department_id}', [InterviewQuestion::class, 'getJobsByDepartment'])->middleware('auth')->middleware('auth')->middleware('auth');
        Route::delete('/interview-question/delete', [InterviewQuestion::class, 'destroy'])->name('admin.interview-question.destroy')->middleware('auth')->middleware('auth');
        Route::get('/download-template/file', [InterviewQuestion::class, 'downloadTemplate'])->name('admin.interview-question.download')->middleware('auth');
        Route::post('/interview-question/import', [InterviewQuestion::class, 'import'])->name('interview.import')->middleware('auth');


        Route::get('/talent-acquisition/advanced-comparison', [AdvancedComparisonController::class, 'taAdvancedComparison'])->name('admin.talent_acquisition.advanced_comparison');
        Route::get('/advanced-comparison/get-job-openings', [AdvancedComparisonController::class, 'getJobOpenings'])->name('admin.advanced_comparison.get_job_openings');

        Route::get('/advanced-comparison/get-candidates', [AdvancedComparisonController::class, 'getCandidates'])->name('admin.advanced_comparison.get_candidates');

        Route::get('/advanced-comparison/get-job-positions', [AdvancedComparisonController::class, 'getJobPositions'])->name('admin.advanced_comparison.get_job_positions');

        Route::get('/advanced-comparison/get-employees', [AdvancedComparisonController::class, 'getEmployees'])->name('admin.advanced_comparison.get_employees');

        Route::get('/advanced-comparison/report', [AdvancedComparisonController::class, 'report'])->name('admin.advanced_comparison.report');


        Route::get('/talent-management/advanced-comparison', [AdvancedComparisonTmController::class, 'tmAdvancedComparison'])->name('admin.talent_management.advanced_comparison');
        Route::get('/tm/advanced-comparison/get-job-openings', [AdvancedComparisonTmController::class, 'getJobOpenings'])->name('admin.tm.advanced_comparison.get_job_openings');

        Route::get('/tm/advanced-comparison/get-candidates', [AdvancedComparisonTmController::class, 'getCandidates'])->name('admin.tm.advanced_comparison.get_candidates');

        Route::get('/tm/advanced-comparison/get-job-positions', [AdvancedComparisonTmController::class, 'getJobPositions'])->name('admin.tm.advanced_comparison.get_job_positions');

        Route::get('/tm/advanced-comparison/get-employees', [AdvancedComparisonTmController::class, 'getEmployees'])->name('admin.tm.advanced_comparison.get_employees');

        Route::get('/tm/advanced-comparison/report', [AdvancedComparisonTmController::class, 'report'])->name('admin.tm.advanced_comparison.report');









        //Job Posting Review
        Route::get('/talent-acquisition/job-board/create-job-advertisement/job-posting-preview-page', [JobPostingReviewController::class, 'jobPreview'])
            ->name('admin.talent-acquisition.job-board.create-edit-job-advertisement.job-posting-preview-page');

        //Country-City-State Dropdown
        // Route::get('/get-cities-states/{country_id}', [JobCreateAdvertisement::class, 'getCitiesStates']);
        Route::get('/get-states/{country_id}', [JobCreateAdvertisement::class, 'getStates']);
        Route::get('/get-cities/{state_id}', [JobCreateAdvertisement::class, 'getCities']);

        Route::get('/talent/insight', [App\Http\Controllers\Admin\TalentInsightController::class, 'index'])->name('admin.talent-insight.index');
        Route::get('/talent/insight/tag-high-potential/{employee_id}', [App\Http\Controllers\Admin\TalentInsightController::class, 'tagHighPotential'])->name('admin.talent-insight.tag_high_potential');
        Route::post('/talent-insight/export-report', [App\Http\Controllers\Admin\TalentInsightController::class, 'exportReport'])->name('admin.talent-insight.exportReport');
        Route::get('/talent-insight/download-report', [App\Http\Controllers\Admin\TalentInsightController::class, 'downloadReport'])->name('admin.talent-insight.downloadReport');

        Route::get('/talent-insight/import-user-performance-ratings', [App\Http\Controllers\Admin\TalentInsightController::class, 'importRatingDataView'])->name('admin.talent-insight.import-rating-data-view');
        Route::post('/talent-insight/import-user-performance-ratings', [App\Http\Controllers\Admin\TalentInsightController::class, 'importRatingData'])->name('admin.talent-insight.import-rating-data');
        //   Route::middleware('admin')->group(function () {
        // Define your admin dashboard and other admin routes here
        // Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::prefix('/dashboard')->group(function () {
            // Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');
            // Chart data routes (AJAX)
            Route::get('/chart-data/{chart}', [AdminController::class, 'chartData'])
            ->name('admin.dashboard.chartData');
            Route::get('/pool-stats', [AdminController::class, 'poolStats']);
            Route::get('/tenure-stats', [AdminController::class, 'tenureStats']);
            Route::get('/assessment-stats', [AdminController::class, 'assessmentStats']);
        });
        Route::get('/job/search', [App\Http\Controllers\JobController::class, 'getEmployee'])->name('job.search')->middleware('auth');
        Route::post('/job/emplooyee/save', [App\Http\Controllers\JobController::class, 'saveEmployee'])->name('job.employee.save')->middleware('auth');
        Route::get('/job/migrate-vacancy-data', [App\Http\Controllers\JobController::class, 'migrateVacancyData'])->name('job.search')->middleware('auth');

        Route::get('/analytical/dashboard', [AdminController::class, 'analytical_dashboard'])->name('admin.analytical_dashboard');
        Route::get('/lms/dashboard', function () {
            return view('admin.lms_dashboard');
        });

        Route::get('/skill-gap/dashboard', [AdminController::class, 'skillGap'])->name('admin.skill_gap');

        Route::get('/hris/index', [App\Http\Controllers\Employee\DashboardController::class, 'hris'])->name('employee.hris')->middleware('auth');

        Route::get('/support/index', [App\Http\Controllers\Employee\DashboardController::class, 'support'])->name('employee.support')->middleware('auth');

        Route::get('/talent-management/dashboard', function () {
            return view('admin.talent-management');
        });

        Route::get('/jobdescriptions', [AdminController::class, 'jobDescriptions'])->name('admin.jobdescriptions');
        Route::get('/saved-jobdescriptions', [AdminController::class, 'jobDescriptionsSaved'])->name('admin.saved.jobdescriptions');
        Route::get('/export/jobdescriptions/internal/{id}', [PdfController::class, 'exportInternalPdf'])->name('export.jd.internal');
        Route::get('/export/jobdescriptions/external/{id}', [PdfController::class, 'exportExternalPdf'])->name('export.jd.external');
        Route::get('/export/jobdescriptions/master/{id}', [PdfController::class, 'exportMasterPdf'])->name('export.jd.master');
        Route::get('/export/company/jobdescriptions/{id}', [PdfController::class, 'exportCompanyJDPdf'])->name('export.company.jd');



        Route::get('/get-skill-levels/{skillName}', [AdminController::class, 'getSkillLevel'])->name('admin.get_skill_level');
        Route::get('/get-techskill-levels/{skillName}', [AdminController::class, 'getTechSkillLevel'])->name('admin.get_tech_skill_level');


        // Route::get('/report/individual', [AdminController::class, 'individual'])->name('individual.report');
        // Route::get('/report/ocean/riasec', [AdminController::class, 'oceanRiasec'])->name('ocean.riasec.report');

        // Route::get('/report/individual/detail/{id}', [AdminController::class, 'individualDetail'])->name('individual.report.detail');
        // Route::get('/report/individual/detail/paginate', [AdminController::class, 'individualDetail'])->name('individual.report.detail.paginate');
        // Route::get('/individual/student/fetch', [AdminController::class, 'individualStudent'])->name('individual.student.fetch');
        // Route::get('/individual/ocean/view/{id}', [AdminController::class, 'oceanview'])->name('individual.ocean.view');
        // Route::get('/individual/riasec/view/{id}', [AdminController::class, 'riasecview'])->name('individual.riasec.view');


        // Route::get('/individual/student/export', [ExportController::class, 'exportToExcel'])->name('individual.student.export');
        // Route::get('/individual/student/detail/export/{id}', [ExportDetailController::class, 'exportToExcel'])->name('individual.student.detail.export');


        // Route::get('/report/population', [AdminController::class, 'population'])->name('population.report');
        // Route::get('/population/tabular/export', [ExportPopulationController::class, 'exportToExcel'])->name('population.report.tabular.export');


        // // Detailed report routes
        // Route::get('/detailed/report', [AdminController::class, 'detailed'])->name('admin.detailed.report');
        // Route::get('/detailed/report/ocean', [AdminController::class, 'ocean'])->name('admin.detailed.report.ocean');
        // Route::get('/detailed/report/riasec', [AdminController::class, 'riasec'])->name('admin.detailed.report.riasec');
        // Route::get('/detailed/report/english', [AdminController::class, 'english'])->name('admin.detailed.report.english');
        // Route::get('/detailed/report/all', [AdminController::class, 'all'])->name('admin.detailed.report.all');

        // // Detailed report Export

        // Route::get('/detailed/report/export/{type}', [ExportPopulationController::class, 'exportToExcel'])->name('admin.detailed.report.export');

        // Route::get('/dashboard/tabular/export', [ExportController::class, 'exportToExcel'])->name('admin.dashboard.report.export');

        // Route::get('/jobs', [JobController::class, 'index'])->name('jobs.index');
        Route::post('/setting/update', [WeightageController::class, 'storeWeightage'])->name('weightage.storeWeightage');

        Route::get('/jobs/duplicate', [JobController::class, 'duplicateFromSierra'])->name('jobs.duplicateFromSierra');
        Route::get('/jobs/index', [JobController::class, 'savedJobs'])->name('jobs.savedJobs');



        Route::get('/jobs/create', [JobController::class, 'create'])->name('jobs.create');
        Route::post('/jobs', [JobController::class, 'store'])->name('jobs.store');
        Route::get('/jobs/{job}/edit', [JobController::class, 'edit'])->name('jobs.edit');
        Route::get('/jobs/llm/{job}/edit', [LlmController::class, 'edit'])->name('llm.edit');
        Route::put('/jobs/{job}', [JobController::class, 'update'])->name('jobs.update');
        Route::delete('/jobs/{job}', [JobController::class, 'destroy'])->name('jobs.destroy');

        Route::get('/jobs/by_department', [JobController::class, 'allJobsByDepartment'])->name('jobs.by_department');
        Route::get('/jobs/by_org_department', [JobController::class, 'allJobsByOrgDepartment'])->name('jobs.by_org_department');
        Route::get('/jobs/allJobsByOrgDepartmentForJD', [JobController::class, 'allJobsByOrgDepartmentForJD'])->name('jobs.allJobsByOrgDepartmentForJD');


        // Job Screen Compare Screen Route
        Route::get('/job-opening/compare/get-candidates', [JobOpeningsController::class, 'getCandidates'])->name('admin.job-opening.compare.get-candidates');
        Route::get('/job-opening/compare/get-employees', [JobOpeningsController::class, 'getEmployees'])->name('admin.job-opening.compare.get-employees');
        Route::get('/job-opening/compare/get-job-openings', [JobOpeningsController::class, 'getJobOpenings'])->name('admin.job-opening.compare.get-job-openings');

        Route::get('/create/job-description', function () {
            return view('admin.setting.job_create');
        });


        Route::prefix('ajax')->name('ajax.')->group(function () {
            Route::get('/business-unit', [DropdownController::class, 'getBusinessUnit'])->name('getBusinessUnit');
            Route::get('/divisions/{businessUnitId}', [DropdownController::class, 'getDivisions'])->name('divisions');
            Route::get('/departments/{divisionId}', [DropdownController::class, 'getDepartments'])->name('departments');
            Route::POST('/get-jobs-by-department', [DropdownController::class, 'getJobs'])->name('jobs-by-department');
            Route::get('/get-superior-jobs', [JobController::class, 'getSuperiorJobs'])->name('job-superiors');
            Route::get('/generate-headcounts-code', [JobController::class, 'generateHeadcountCodes'])->name('generate-headcounts-code');
            Route::get('/job-headcounts/{id}', [DropdownController::class, 'getJobHeadcounts']);
            Route::get('/job-headcounts/data/{id}', [DropdownController::class, 'getJobHeadcountsData']);
            Route::get('/technical-skill-category/{id}', [DropdownController::class, 'getTechnicalSkillCategory']);
            Route::get('/skills/{skill}/master-skill-children-count', [DropdownController::class, 'getMasterSkillChildrenCount'])->name('skills.customChildrenCount');


            Route::get('/vacant-job-headcounts', [JobHeadcountController::class, 'getVacantHeadcounts']);
            Route::post('/convert-employee', [JobHeadcountController::class, 'convertToEmployee']);
      

            Route::get('/modal/{module}/{key}', [ModalController::class, 'show']);
            Route::get('/allowed-levels', [JobController::class, 'allowedLevelsBySuperiorJob'])->name('ajax.allowedLevels');
            // Add the route to get the organization chart data
            Route::post('/organization-chart', [OrganizationChartController::class, 'getHierarchyData'])->name('organization-chart');
            Route::get('/organization-chart-filter/business-unit', [OrganizationChartController::class, 'getBusinessUnit'])->name('organization-chart-filter.business-unit');
            Route::post('/organization-chart-filter/company-division', [OrganizationChartController::class, 'getCompanyDivision'])->name('organization-chart-filter.company-division');
            Route::post('/organization-chart-filter/headcount-codes', [OrganizationChartController::class, 'headcountCodes'])->name('organization-chart-filter.headcount-codes');
            Route::post('/organization-chart-filter/departments', [OrganizationChartController::class, 'getDepartments'])->name('organization-chart-filter.departments');
            Route::get('/organization-chart-filter/teams', [OrganizationChartController::class, 'getTeams'])->name('organization-chart-filter.teams');
            Route::get('/organization-chart-filter/levels', [OrganizationChartController::class, 'getLevels'])->name('organization-chart-filter.levels');
            Route::get('/organization-chart/{jobId}/employee-count', [OrganizationChartController::class, 'getEmployeeCountByJobId']);
            // Add this route in your routes file
            Route::post('/organization-chart-filter/position-levels', [OrganizationChartController::class, 'getPositionLevels']);




            Route::get('/employee-profile/{id}', [OrganizationChartController::class, 'fetchProfile']);
            Route::get('/position-actions/{code}', [OrganizationChartController::class, 'getPositionActions'])->name('position-actions');
            Route::get('/generate-headcounts-code-using-job', [JobController::class, 'generateCodeUsingJobId'])->name('generate-headcounts-code-using-job');
            Route::post('/org-chart/save', [OrganizationChartController::class, 'apply'])->name('org-chart-save');
            Route::get('/users/search', [OrganizationChartController::class, 'searchUsers'])->name('organization-chart-users-search');
            Route::post('/users/search', [OrganizationChartController::class, 'searchUsers'])->name('organization-chart-users-search-post');

            Route::get('/get-departments/search', [OrganizationChartController::class, 'searchDepartments'])->name('organization-chart-departments-search');
            Route::post('/get-departments/search', [OrganizationChartController::class, 'searchDepartments'])->name('organization-chart-departments-search-post');
            Route::get('/get-job-positions', [OrganizationChartController::class, 'getJobHeadcountsByDepartment'])->name('get.job.positions');
            Route::get('/search-users', [UserSearchController::class, 'search']);
            
        });


        Route::get('/candidate/add-to-bookmark/{userid}', [EmployeeController::class, 'candidateAddToBookmark'])->name('admin.candidate.add_to_bookmark')->middleware('auth');

        Route::get('/candidate/remove-bookmark/{userid}', [EmployeeController::class, 'candidateRemoveBookmark'])->name('admin.candidate.remove_bookmark')->middleware('auth');

        Route::get('/candidate/bookmarks', [EmployeeController::class, 'candidateBookmarks'])->name('admin.candidate.remove_bookmark')->middleware('auth');
        Route::post('/setting/update', [WeightageController::class, 'storeWeightage'])->name('weightage.storeWeightage');

        Route::get('/setting/weightage', [WeightageController::class, 'weightage']);
        Route::get('/setting/matching', [WeightageController::class, 'matching']);

        Route::get('/setting/team-dynamics', [FacetsQuestionController::class, 'teamDynamics']);
        Route::post('/setting/team-dynamics/store', [FacetsQuestionController::class, 'store'])->name('teamDynamics.store');


        Route::get('/setting/job-description', [JobController::class, 'index'])->name('jobs.index');
        Route::get('/setting/job-description/riasec', [JobController::class, 'generateRiasecCode'])->name('jobs.generateRiasecCode');


        Route::post('/jobs/primary/job/select', [JobController::class, 'primaryJob'])->name('jobs.primaryJob');
        Route::post('/jobs/save', [JobController::class, 'addToSave'])->name('jobs.save');

        Route::get('/compare', [AnalyticalController::class, 'compare'])->name('admin.analytical.compare')->middleware('auth');
        Route::post('/compare', [AnalyticalController::class, 'compareForm'])->name('admin.analytical.compareForm')->middleware('auth');
        Route::get('/analytical', [AnalyticalController::class, 'analytics'])->name('admin.analytical.analytics')->middleware('auth');
        Route::get('/analytical/get-employees-by-department', [AnalyticalController::class, 'getEmployeesByDepartment'])->name('admin.getEmployeesByDepartment');
        Route::get('/advance-compare', [AnalyticalController::class, 'advanceCompare'])->name('admin.analytical.advance-compare')->middleware('auth');
        // Form PM / CM post
        Route::get('/comparison', [AnalyticalController::class, 'comparison'])->name('admin.analytical.comparison')->middleware('auth');

        Route::get('/bookmarks', [EmployeeController::class, 'bookmarks'])->name('admin.employee.bookmarks')->middleware('auth');
        Route::get('/employee-details/{id}', [EmployeeController::class, 'detail'])->name('admin.employee.details')->middleware('auth');

        Route::get('/employee-details/download-report/{employee_id}', [EmployeeController::class, 'downloadReport'])->name('admin.employee.details.download_report')->middleware('auth');
        Route::get('/candidate-details/download-report/{employee_id}/{job_opening_id}', [CandidateController::class, 'downloadReport'])->name('admin.candidate.details.download_report')->middleware('auth');
        Route::get('/candidate-details/{id}', [EmployeeController::class, 'detail'])->name('admin.candidate.details')->middleware('auth');
        Route::post('/employee/add-to-bookmark', [EmployeeController::class, 'addToBookmark'])->name('admin.employee.add_to_bookmark')->middleware('auth');

        Route::post('/employee/add-to-department', [EmployeeController::class, 'addToDepartment'])->name('admin.employee.add_to_department')->middleware('auth');
        Route::post('/employee/assessment-reset', [EmployeeController::class, 'assessmentReset'])->name('admin.employee.assessment_reset')->middleware('auth');

        Route::post('/employee/remove-bookmark', [EmployeeController::class, 'removeBookmark'])->name('admin.employee.remove_bookmark')->middleware('auth');
        Route::get('/potentials', [EmployeeController::class, 'potentials'])->name('admin.employee.potentials')->middleware('auth');


        Route::get('/pool/{id}/', [PoolController::class, 'poolUsers'])->name('pool.index');
        Route::get('/sector/{id}/', [SectorController::class, 'sectorUsers'])->name('sector.index');
        Route::get('/city/{name}/', [SectorController::class, 'cityUsers'])->name('city.index');
        Route::get('/position/{level}/', [SectorController::class, 'cityByPositions'])->name('position.index');

        // User Management Routes
        Route::get('/users/{type}', [UsersController::class, 'index'])->name('admin.users.index')->middleware('auth');
        Route::get('/user/edit/{type}/{id}', [UsersController::class, 'edit'])->name('admin.user.edit')->middleware('auth');
        Route::get('/user/create/{type}', [UsersController::class, 'create'])->name('admin.user.create')->middleware('auth');
        Route::post('/user/store/', [UsersController::class, 'store'])->name('admin.user.store')->middleware('auth');
        Route::post('/user/update/{id}', [UsersController::class, 'update'])->name('admin.user.update')->middleware('auth');
        Route::get('/user/delete/{type}/{id}', [UsersController::class, 'destroy'])->name('admin.user.delete')->middleware('auth');
        Route::post('/user/import', [UsersController::class, 'bulkImport'])->name('admin.user.import')->middleware('auth');
        Route::post('/myemployee/import', [MyEmployeeController::class, 'bulkImport'])->name('admin.myemployee.import')->middleware('auth');

        Route::get('departments/{companyId}', [UsersController::class, 'getDepartments']);
        Route::get('sectorget/{companyId}', [UsersController::class, 'getSectors']);
        Route::get('postions/{departId}', [UsersController::class, 'getPositions']);
        Route::get('getteams/{departId}', [UsersController::class, 'getTeams']);

        Route::group(['prefix' => 'candidate'], function () {

            Route::get('/', [CandidateController::class, 'index'])->name('admin.candidate.users.index')->middleware('auth');
            Route::post('/import', [CandidateController::class, 'bulkImport'])->name('admin.candidate.import')->middleware('auth');
            Route::get('/{id}', [CandidateController::class, 'candidateDetails'])->name('admin.candidate.details')->middleware('auth');
        });

        // Company
        Route::group(['prefix' => 'company'], function () {

            Route::get('/users', [CompanyController::class, 'index'])->name('admin.company.users.index')->middleware('auth');
            Route::get('/user/{id}/edit', [CompanyController::class, 'edit'])->name('admin.company.user.edit')->middleware('auth');
            Route::get('/user/create', [CompanyController::class, 'create'])->name('admin.company.user.create')->middleware('auth');
            Route::post('/user/store/', [CompanyController::class, 'store'])->name('admin.company.user.store')->middleware('auth');
            Route::post('/user/{id}/update', [CompanyController::class, 'update'])->name('admin.company.user.update')->middleware('auth');
            Route::get('/user/{id}/delete', [CompanyController::class, 'destroy'])->name('admin.company.user.delete')->middleware('auth');
            Route::post('/user/import', [CompanyController::class, 'bulkImport'])->name('admin.company.user.import')->middleware('auth');
        });

        Route::group(['prefix' => 'department'], function () {

            Route::get('/users', [DepartmentController::class, 'index'])->name('admin.department.users.index')->middleware('auth');
            Route::get('/user/{id}/edit', [DepartmentController::class, 'edit'])->name('admin.department.user.edit')->middleware('auth');
            Route::get('/user/create', [DepartmentController::class, 'create'])->name('admin.department.user.create')->middleware('auth');
            Route::post('/user/store/', [DepartmentController::class, 'store'])->name('admin.department.user.store')->middleware('auth');
            Route::post('/user/{id}/update', [DepartmentController::class, 'update'])->name('admin.department.user.update')->middleware('auth');
            Route::get('/user/{id}/delete', [DepartmentController::class, 'destroy'])->name('admin.department.user.delete')->middleware('auth');
            Route::post('/user/import', [DepartmentController::class, 'bulkImport'])->name('admin.department.user.import')->middleware('auth');
        });

        Route::group(['prefix' => 'employee'], function () {

            Route::get('/users', [EmployeeController::class, 'index'])->name('admin.employee.users.index')->middleware('auth');
            Route::get('/user/{id}/edit', [EmployeeController::class, 'edit'])->name('admin.employee.user.edit')->middleware('auth');
            Route::get('/user/create', [EmployeeController::class, 'create'])->name('admin.employee.user.create')->middleware('auth');
            Route::post('/user/store/', [EmployeeController::class, 'store'])->name('admin.employee.user.store')->middleware('auth');
            Route::post('/user/{id}/update', [EmployeeController::class, 'update'])->name('admin.employee.user.update')->middleware('auth');
            Route::get('/user/{id}/delete', [EmployeeController::class, 'destroy'])->name('admin.employee.user.delete')->middleware('auth');
            Route::post('/user/import', [EmployeeController::class, 'bulkImport'])->name('admin.employee.user.import')->middleware('auth');
        });

        // Roles Management Routes

        Route::group(['prefix' => 'roles'], function () {
            Route::get('/', [RolesController::class, 'index']);
            Route::get('/create', [RolesController::class, 'create']);
            Route::post('/store', [RolesController::class, 'store']);
            Route::get('/{id}/edit', [RolesController::class, 'edit']);
            Route::post('/{id}/update', [RolesController::class, 'update']);
            Route::get('/{id}/delete', [RolesController::class, 'destroy']);
        });

        Route::group(['prefix' => 'position'], function () {
            Route::get('/', [PositionController::class, 'index'])->name('admin.position.index');
            Route::get('/create', [PositionController::class, 'create'])->name('admin.position.create');
            Route::post('/store', [PositionController::class, 'store'])->name('admin.position.store');
            Route::get('/{id}/edit', [PositionController::class, 'edit'])->name('admin.position.edit');
            Route::post('/{id}/update', [PositionController::class, 'update'])->name('admin.position.update');
            Route::get('/{id}/delete', [PositionController::class, 'destroy'])->name('admin.position.destroy');
        });

        Route::group(['prefix' => 'teams'], function () {
            Route::get('/', [TeamsController::class, 'index'])->name('admin.teams.index');
            Route::get('/create', [TeamsController::class, 'create'])->name('admin.teams.create');
            Route::post('/store', [TeamsController::class, 'store'])->name('admin.teams.store');
            Route::get('/{id}/edit', [TeamsController::class, 'edit'])->name('admin.teams.edit');
            Route::post('/{id}/update', [TeamsController::class, 'update'])->name('admin.teams.update');
            Route::get('/{id}/delete', [TeamsController::class, 'destroy'])->name('admin.teams.destroy');
            Route::get('/getemployee/{departId}', [TeamsController::class, 'getEmployee']);
        });

        Route::get('/department-details/{id}', [DepartmentDetailsController::class, 'departmentDetails'])->name('admin.department.details');
        Route::get('/download-pdf/{id}', [DepartmentDetailsController::class, 'downloadPdf']);
    });


    Route::get('company/profile/edit', [CompanyController::class, 'profileEdit'])->name('company.profile.edit');
    Route::post('company/profile/update', [CompanyController::class, 'profileUpdate']);
    Route::get('company/get/subsector/{departId}', [CompanyController::class, 'getSubSector']);

    Route::get('profile/edit', [UsersController::class, 'profileEdit']);
    Route::post('profile/update', [UsersController::class, 'profileUpdate']);
    // department
    Route::get('department/profile/edit', [UsersController::class, 'departmentProfileEdit'])->name('department.profile.edit');
    Route::post('department/profile/update', [UsersController::class, 'departmentProfileUpdate']);


    // Job Openings Route
    Route::prefix('admin')->group(function () {
        // Job Openings routes
        Route::get('/job-profiles/export', [JobController::class,'TechnicalSkillReportExport'])->name('job-profiles.export');

        Route::get('/job-openings/dashboard', [JobOpeningsController::class, 'jobDashboard'])->name('admin.jobDashboard.index');
        Route::post('/job-advertisement/update-status/{id}', [JobOpeningsController::class, 'advertisementStatus'])->name('admin.job-advertisement.update-status');

        Route::get('/job-openings', [JobOpeningsController::class, 'index'])->name('admin.job-openings.index');
        Route::get('/job-vacancies', [JobOpeningsController::class, 'vacancy'])->name('admin.job-vacancies.index');

        Route::get('/job-openings/create', [JobOpeningsController::class, 'showCreateForm'])->name('admin.job-openings.create-form');
        Route::post('/job-openings/create', [JobOpeningsController::class, 'create'])->name('admin.job-openings.create');
        Route::get('/job-openings/{id}', [JobOpeningsController::class, 'show'])->name('admin.job-openings.show');
        Route::get('/job-applicant/{id}', [JobOpeningsController::class, 'applicantShow'])->name('admin.job-applicant.show');
        Route::get('/job-applicant/shortlist/candidates', [JobOpeningsController::class, 'shortlistCandidate'])->name('admin.job-applicant.shortlistCandidate');
        Route::delete('/job-applicant/delete/{id}', [JobOpeningsController::class, 'applicationDelete'])->name('admin.applicationDelete');

        Route::get('/job-openings/{id}/edit', [JobOpeningsController::class, 'showEditForm'])->name('admin.job-openings.edit-form');

        Route::post('/job-openings/update-application-period', [JobOpeningsController::class, 'updateApplicationPeriod'])->name('admin.job.updateApplicationPeriod');
        Route::post('/job-openings/update-application-status', [JobOpeningsController::class, 'updateApplicationStatusToExpired'])->name('admin.job.updateApplicationStatusToExpired');
        Route::post('/job-openings/advertisement-detail-delete', [JobOpeningsController::class, 'deleteAdvertisement'])->name('admin.job.deleteAdvertisement');
        Route::get('/job-openings/advertisement-applicant-details/{id}', [JobAdvertisementReportController::class, 'getApplicantUsers'])->name('admin.job.getApplicantUsers');




        Route::put('/job-openings/{id}/update', [JobOpeningsController::class, 'update'])->name('admin.job-openings.update');
        Route::delete('/job-openings/{id}', [JobOpeningsController::class, 'delete'])->name('admin.job-openings.delete');
        Route::get('/job-opening/{job_opening_application_id}/applicant-details/{id}', [JobOpeningsController::class, 'applicantDetails'])->name('admin.job-opening.applicant-details');

        Route::post('/job-opening/applicant-interview/schedule', [JobOpeningsController::class, 'interviewSchedule'])->name('admin.job-opening.applicant-interview-schedule');
        Route::post('/job-opening/applicant-convert-to-employee', [JobOpeningsController::class, 'convertToEmployeeAjax'])->name('admin.job-opening.applicant-convertToEmployee');


        Route::post('/job-opening/template/select', [JobOpeningsController::class, 'templateSelect'])->name('admin.contract.template.select');
        Route::get('/contract/form/{id}/{application_id}/{type}', [ContractTemplateController::class, 'loadContractForm'])->name('admin.contract.form');
        Route::post('/contract/assign/{id}', [ContractTemplateController::class, 'assignContract'])->name('admin.assign.contract.employee');
        Route::get('/contract/pdf/{id}', [ContractTemplateController::class, 'contractPDF'])->name('admin.contract.contractPDF');
        Route::post('/admin/contract/preview', [ContractTemplateController::class, 'generatePreview'])->name('admin.contract.preview');

        Route::get('/job-opening/send-email/{id}', [JobOpeningsController::class, 'sendEmail'])->name('admin.job-opening.send-email');
        Route::post('/job-opening/send-emails/{id}', [JobOpeningsController::class, 'sendEmails'])->name('admin.job-opening.send-emails');
        Route::post('/job-opening/update-status/{id}', [JobOpeningsController::class, 'updateStatus'])->name('admin.job-opening.update-status');

        // Job Opening Compare Screen Routes
        Route::get('/job-opening/compare/', [JobOpeningsController::class, 'compareIndex'])->name('admin.job-opening.compare-index');
        Route::post('/job-opening/compare/{job_opening_id}', [JobOpeningsController::class, 'compare'])->name('admin.job-opening.compare');

        Route::get('/job-opening/departments/{companyId}', [JobOpeningsController::class, 'getByCompany'])->name('admin.job-opening.get-departments-by-company');
        Route::get('/job-opening/positions/{departmentId}', [JobOpeningsController::class, 'getByDepartment'])->name('admin.job-opening.get-positions-by-department');
        Route::get('/job-opening/get-details-by-position/{positionId}', [JobOpeningsController::class, 'getPositionDetails'])->name('admin.job-opening.get-details-by-position');
        Route::get('/job-opening/send-emails-to-selected', [JobOpeningsController::class, 'sendEmailsToSelected'])->name('admin.job-opening.send-emails-to-selected');

        Route::get('/job-opening/interview-list', [JobOpeningsController::class, 'interviewList'])->name('admin.job-openings.interview-list');
        Route::get('/job-opening/completed-interview-list', [JobOpeningsController::class, 'completedInterviewList'])->name('admin.job-openings.completed-interview-list');
        Route::post('job-opening/update-interview-completion-score', [JobOpeningsController::class, 'updateInterviewScore'])->name('update-interview-score');
        Route::get('/job-opening/take-interview/{user_id}', [JobOpeningsController::class, 'takeInterview'])->name('admin.job-openings.take-interview');
        Route::post('/job-opening/store-interview-response', [JobOpeningsController::class, 'storeInterviewResponse'])->name('admin.job-openings.store-interview-response');

        Route::get('/job-opening/compare-interviewed-candidates/{job_opening_id}', [JobOpeningsController::class, 'compareInterviewedCandidatesIndex'])->name('admin.job-opening.compare-interviewed-candidates-index');
        Route::post('/job-opening/compare-interviewed-candidates/{job_opening_id}', [JobOpeningsController::class, 'compare'])->name('admin.job-opening.compare-interviewed-candidates');

        Route::get('/job-opening/all-candidates', [JobOpeningsController::class, 'allCandidates'])->name('admin.job-openings.all-candidates');
        Route::get('/job-opening/shortlisted-candidates', [JobOpeningsController::class, 'shortlistedCandidates'])->name('admin.job-openings.shortlisted-candidates');
        Route::delete('/job-opening/remove-from-shortlist', [JobOpeningsController::class, 'removeFromShortlist'])->name('admin.job-openings.remove-from-shortlist');

        Route::get('/setting/job-description/view', [JobController::class, 'viewJD'])->name('jd.view');
        Route::get('/setting/job-description/create/{id}/{track}/{sector}', [JobController::class, 'createJD'])->name('jd.create');


        Route::get('/ai/job/generator', [AiJdGeneratorController::class, 'create'])->name('ai.jd.create');

        Route::get('/job-descriptions/view/get-sectors', [AiApisController::class, 'getSectors'])->name('admin.job-descriptions.view.get-sectors')->middleware('auth');

        Route::get('/job-descriptions/view/get-tracks-by-sector/{sector}', [AiApisController::class, 'getTracksBySector'])->name('admin.job-descriptions.view.get-tracks-by-sector')->middleware('auth');

        Route::get('/job-descriptions/view/get-roles-by-track/{sector}/{track}', [AiApisController::class, 'getRolesByTrack'])->where('track', '.+')->name('admin.job-descriptions.view.get-roles-by-track')->middleware('auth');

        // Route::get('/job-descriptions/view/get-role-details/{sector}/{track}/{role}', [AiApisController::class, 'getRoleDetails'])->name('admin.job-descriptions.view.get-role-details')->middleware('auth');
        // routes/web.php
        Route::post('/job-descriptions/view/get-role-details', [AiApisController::class, 'getRoleDetails'])->name('admin.job-descriptions.view.get-role-details')->middleware('auth');


        Route::get('/job-descriptions/view/get-skills-by-sector/{sector}/{skillType}', [AiApisController::class, 'getSkillsBySectorAndTrack'])->name('admin.job-descriptions.view.get-skill-list-by-sector-and-track')->middleware('auth');

        Route::post('/ai/jd/generator', [AiApisController::class, 'getAiGeneratorJD'])->name('admin.ai.job-descriptions.get');
        Route::get('/ai/jd/generator/create', [AiJdGeneratorController::class, 'create'])->name('admin.ai.job-descriptions.create');
        Route::get('/ai/jd/response/edit', [AiJdGeneratorController::class, 'edit'])->name('admin.ai.jd.response.edit');
        Route::post('/sendFeedbackRating', [AiApisController::class, 'sendFeedbackRating']);
        Route::post('/feedback/store', [FeedbackController::class, 'store']);
        Route::get('/ai/llm/create', [LlmController::class, 'create_llm'])->name('admin.ai.llm.create');
        Route::post('/ai/llm/store', [LlmController::class, 'store'])->name('admin.ai.llm.store');
        Route::post('/ai/llm/save/companyJd', [LlmController::class, 'saveCompanyJd'])->name('admin.ai.llm.save.jd');        Route::get('/job-descriptions/view/get-skill-details', [AiApisController::class, 'getSkillDetails'])->name('admin.job-descriptions.view.get-skill-details')->middleware('auth');

        Route::get('/skill-management/dashboard', [SkillManagementController::class, 'dashboard'])->name('skill.management.dashboard');
        Route::get('/skill-management/search', [SkillManagementController::class, 'viewSkills'])->name('skills.view');
        Route::get('/skill-management/sector-skills/{sector_id}', [SkillManagementController::class, 'sectorSkills'])->name('admin.skills_management.sector.skills');
        Route::get('/sector-skills/{sector_id}/{category_id?}', [SkillManagementController::class, 'sectorSkills'])->name('sector.skills');
        // Company Skill library routes
        Route::get('company/sector-skills', [CompanyTechnicalSkillController::class, 'index'])->name('sector.skills.company');
        Route::get('company/technical/skill/fetch', [CompanyTechnicalSkillController::class, 'fetchTechSkills'])->name('company.fetch.technical.skills');

        Route::post('company/sector-skills/update-technical-skill-level', [CompanyTechnicalSkillController::class, 'updateTechnicalSkillLvl'])->name('update.technical.skill.level');
        Route::post('company/sector-skills/approve-selected-job-profile', [CompanyTechnicalSkillController::class, 'approveSelectedJobProfile'])->name('approve.selected.job.profile');

        Route::get('company/sector-skills/create', [CompanyTechnicalSkillController::class, 'create'])->name('sector.skills.company.create');
        Route::post('company/sector-skills/store', [CompanyTechnicalSkillController::class, 'store'])->name('sector.skills.company.store');
        Route::get('company/sector-skills/edit/{id}', [CompanyTechnicalSkillController::class, 'edit'])->name('sector.skills.company.edit');
        Route::get('company/sector-skills/view/{id}', [CompanyTechnicalSkillController::class, 'view'])->name('sector.skills.company.view');
        
        Route::put('company/sector-skills/update/{id}', [CompanyTechnicalSkillController::class, 'update'])->name('sector.skills.company.update');
        Route::get('company/sector-skills/duplicate/{id}', [CompanyTechnicalSkillController::class, 'duplicate'])
        ->name('sector.skills.company.duplicate');
        Route::post('company/sector-skills/validate-duplicate-title/{id}', [CompanyTechnicalSkillController::class, 'validateDuplicateSkillTitle'])
        ->name('sector.skills.company.validate-duplicate-title');
        
        Route::delete('/sector/skills/company/{id}', [CompanyTechnicalSkillController::class, 'destroy'])
            ->name('sector.skills.company.destroy');

         Route::delete('/sector/skills/company/deleteJobSkills/{id}', [CompanyTechnicalSkillController::class, 'deleteJobSkills'])
            ->name('sector.skills.company.deleteJobSkills');

        Route::get('/company/sector-skills/related-jobs/{skillId}', [CompanyTechnicalSkillController::class, 'getRelatedJobs']);

        Route::get('/get/job-profiles-by-division/{division_id}', [CompanyTechnicalSkillController::class, 'getJobProfilesByDivision']);
        Route::get('/get/job-profiles-by-department/{department_id}', [CompanyTechnicalSkillController::class, 'getJobProfilesByDepartment']);
        Route::get('/get/skill-details/{skillId}', [CompanyTechnicalSkillController::class, 'getSkillDetails'])->name('get.skill.details');

        Route::post('company/sector-skills/create-job-family-technical-skill', [CompanyTechnicalSkillController::class, 'createJobFamilyTechSkill'])->name('create.job.family.technical.skill');

        // Company Skill library routes

        // AI JD Routes
         Route::get('/job-management/create/{type}', [JobManagementController::class, 'createJd'])->name('admin.job-management.createJd');
        // Route::get('/job-management/custom-jd', [JobManagementController::class, 'customJdIndex'])->name('admin.job-management.custom-jd.custom-jd');
    
        Route::get('/job-management/localized/{type}', [JobManagementController::class, 'CreateLocalizedJD'])->name('admin.job-management.create.localized-jd');

        Route::get('/job-family-groups', [AirAsiaJobManagementController::class, 'getJobFamilyGroup'])->name('admin.job-descriptions.view.get-job-family-group')->middleware('auth');

        Route::get('/job-families/{group_id}', [AirAsiaJobManagementController::class, 'getByGroup'])->name('admin.job-descriptions.view.get-job-family-by-group')->middleware('auth');

        Route::get('/job-profiles/{family_id}', [AirAsiaJobManagementController::class, 'getByFamily'])->name('admin.job-descriptions.view.get-position-by-job-family')->middleware('auth');

        Route::get('/setting/airasia-job-management/job-profile-detail/{profile_id}', [AirAsiaJobManagementController::class, 'getDetail'])->name('admin.job-descriptions.view.get-position-details')->middleware('auth');

        Route::get('/job-management/ai/create-jd', [JobManagementController::class, 'createAiJd'])->name('admin.job-management.company-jd.create-ai-jd');
        Route::post('/cache-job-data', [JobManagementController::class, 'store']);
        // Route::post('/technical-skill/save-edit', [JdTechnicalSkillController::class, 'saveEdit'])->name('technical-skill.save-edit');
        Route::post('/job-management/ai/store', [JobManagementController::class, 'storeJd'])->name('admin.job-management.ai.store');
        Route::post('/job-management/update', [JobManagementController::class, 'updateJd'])->name('admin.job-management.update');

        Route::get('/get-jobs-by-skill/{skillId}', [JobManagementController::class, 'getJobsBySkill']);
        Route::get('/skill-job-count/{skillId}', [JobManagementController::class, 'getJobCountBySkill']);


        Route::get('/setting/job-description', [JobController::class, 'index'])->name('jobs.index');
        Route::get('/setting/job-description/riasec', [JobController::class, 'generateRiasecCode'])->name('jobs.generateRiasecCode');
        
        Route::post('/get-riasec-data', [JobManagementController::class, 'getRiasecData'])->name('get.riasec.data');
        Route::get('/saved-jobdescriptions/update-status/{id}', [AdminController::class, 'jobDescriptionUpdateStatus'])->name('admin.saved.jobdescriptions.updateStatus');
        
        Route::get('/saved-jobdescriptions/employee-count/{id}', function ($id) {
            $count = \App\Models\User::where('position_id', $id)->count();
            return response()->json(['count' => $count]);
        })->name('admin.savedDescriptions.employeeCount');
        

        Route::get('/job-management/get-department', [JobManagementController::class, 'getDepartment'])->name('admin.job-management.get-department');
        Route::get('/job-management/get-sector', [JobManagementController::class, 'getSector'])->name('admin.job-management.get-sector');
        Route::get('/job-management/get-job-role/{sector}/{type}', [JobManagementController::class, 'getJobRole'])->name('admin.job-management.get-jobRole');
        Route::get('/job-management/get-job-role-detail/{id}', [JobManagementController::class, 'getJobRoleDetail'])->name('admin.job-management.get-jobRoleDetail');
        Route::post('/job-management/get-job-by-family', [JobManagementController::class, 'getFormattedJobByProfile']);
        Route::post('/job-management/create/job-profile', [JobManagementController::class, 'createJobProfile']);


        Route::get('/job-management/create-jd', [JobManagementController::class, 'showAICreateJD']);
            Route::get('/job-management/custom-jd', [JobManagementController::class, 'CreateLocalizedCustomJD'])->name('admin.job-management.create.localized-custom-jd');
           Route::get('/job-management/job/create', [JobManagementController::class, 'customCreate'])->name('admin.job-management.customCreate');

        // AI JD Routes
    });

    Route::prefix('admin')->group(function () {
        // Job Openings routes
        Route::get('/growth-potential', [TalentManagementController::class, 'index'])->name('admin.growth-potential.index');
        Route::get('/growth-potential-filter-users', [TalentManagementController::class, 'filterUsers'])->name('admin.growth-potential.filter-users');
        Route::get('/flight-risk', [TalentManagementController::class, 'flightRisk'])->name('admin.talent-management.flight-risk');
        Route::get('/organizational-fit-forecast', [TalentManagementController::class, 'organizationalFitForecast'])->name('admin.talent-management.organizational-fit-forecast');
        Route::get('performance/management', [App\Http\Controllers\PerformanceManagementController::class, 'performanceStepOne'])->name('performance.management.performanceStepOne');
        Route::get('performance/management/review', [PerformanceManagementController::class, 'filterUsers'])->name('admin.performance.management.filterUsers');
        Route::get('performance/review-details/{reviewId}', [PerformanceManagementController::class, 'employeeDetails'])->name('admin.performance.management.employeeDetails');
        Route::post('save/remarks', [PerformanceManagementController::class, 'saveRemarks'])->name('admin.performance.management.saveRemarks');
        Route::get('performance-management/getSkillEvaluation/{id}', [PerformanceManagementController::class, 'getSkillEvaluation'])->name('admin.performance.management.getSkillEvaluation');
        Route::get('/performance/approve/{id}', [PerformanceManagementController::class, 'approveSkillReview'])->name('performance.approve');
        Route::post('/performance-management/update-skills/{skillReviewId}', [PerformanceManagementController::class, 'updateSkills'])->name('admin.performance.management.updateSkills');
        Route::get('/performance-management/pending', [PerformanceManagementController::class, 'pendingReview'])->name('admin.performance.management.pendingReview');
        Route::get('/performance-management/planning', [PerformanceManagementController::class, 'PlanningReview'])->name('admin.performance.management.PlanningReview');
        Route::get('/performance-management/mid-year', [PerformanceManagementController::class, 'MidYearReview'])->name('admin.performance.management.MidYearReview');
        Route::get('/performance-management/end-year', [PerformanceManagementController::class, 'EndYearReview'])->name('admin.performance.management.EndYearReview');
        Route::post('/performance-management/update-planning/{kpiId}', [PerformanceManagementController::class, 'updatePlanning'])->name('admin.performance.management.updatePlanning');
        // skill - compentancy
        Route::get('/skill-competencies', [SkillController::class, 'skillStepOne'])->name('admin.skill.competencies.stepOne');
        Route::get('/get-users-by-department/{department}', [SkillController::class, 'getUsersByDepartment']);
        Route::get('/skill-competencies/skill-review/{id}', [SkillController::class, 'skillStepTwo'])->name('admin.skill-competencies.stepTwo');
        Route::get('/skill-competencies/step2/get/{id}',  [SkillController::class, 'stepThreeGet'])->name('admin.skill-competencies.stepThreeGet');
        Route::get('/skill-competencies/step3/{id}', [SkillController::class, 'skillStepThree'])->name('admin.skill-competencies.stepThree');
        Route::post('/skill-competencies/step4/{id}',  [SkillController::class, 'skillStepFour'])->name('admin.skill-competencies.stepFour');
        Route::get('/skill-competencies/get/step4/{id}',  [SkillController::class, 'skillStepFourGet'])->name('admin.skill-competencies.Get');

        Route::get('/skill-competencies/review/{id}', [SkillController::class, 'getDataByYear'])->name('admin.skill-competencies.getDataByYear');
        // Route::get('/skill-competencies', function () {
        //     return view('admin.skill-competency.index');
        // })->name('admin.skill-competencies.index');

        // Route::get('/skill-competencies/skill-review', function () {
        //     return view('admin.skill-competency.skill-review');
        // })->name('admin.skill-competencies.skill-review');

        // Meta Settings
        Route::get('/meta-settings', [MetaSettingsController::class, 'index'])->name('admin.meta-settings.index');
        Route::get('/meta-settings/create', [MetaSettingsController::class, 'create'])->name('meta-settings.create');
        Route::post('/meta-settings', [MetaSettingsController::class, 'store'])->name('meta-settings.store');
        Route::get('/meta-settings/{id}/edit', [MetaSettingsController::class, 'edit'])->name('meta-settings.edit');
        Route::put('/meta-settings/{id}', [MetaSettingsController::class, 'update'])->name('meta-settings.update');
        Route::delete('/meta-settings/{id}', [MetaSettingsController::class, 'destroy'])->name('meta-settings.destroy');

        Route::get('/organizational-structure', [OrganizationChartController::class, 'index'])->name('admin.organizational.structure');

        Route::get('/organizational-structure-changelog', [OrganizationChangelogController::class, 'index'])->name('admin.organizational.structure.changelog');

        Route::get('/organizational-structure-data', [OrganisationController::class, 'buildOrgChartData'])->name('admin.organizational.structure.data');
        Route::get('/organizational-structure-list', [OrganisationController::class, 'buildOrgChartlist'])->name('admin.organizational.structure.list');
        Route::post('/position-data/store', [OrganisationController::class, 'storePositionDetails'])->name('admin.orgposition.store');
        Route::post('/position-data/add', [OrganisationController::class, 'addpositionDetails'])->name('admin.orgposition.add');
        Route::post('/position-data/remove', [OrganisationController::class, 'removepositionDetails'])->name('admin.orgposition.remove');
        Route::get('/position-data/employees', [OrganisationController::class, 'employeesGet'])->name('admin.orgposition.employeesGet');
        Route::get('/position-data/employees/data', [OrganisationController::class, 'employeesData'])->name('admin.orgposition.employeesData');
        

        Route::get('/organization-chart/migrate-existing-data', [OrganizationChartController::class, 'migrateExistingData'])->name('organization-chart.migrate-existing-data');
        Route::get('/organization-chart/migrate-job-technical-skills', [OrganizationChartController::class, 'migrateTechnicalSkills'])->name('organization-chart.migrate-technical-skills');

        Route::get('/organization-chart/import', [OrganizationChartController::class, 'import'])->name('organization-chart.import');
        Route::post('/organization-chart/import-data', [OrganizationChartController::class, 'importData'])->name('organization-chart.import-data');
    });



    Route::prefix('admin')->group(function () {

        Route::group(['prefix' => 'division'], function () {

            Route::get('/', [DivisionController::class, 'index'])->name('admin.division.users.index')->middleware('auth');
            Route::get('/{id}/edit', [DivisionController::class, 'edit'])->name('admin.division.user.edit')->middleware('auth');
            Route::get('/create', [DivisionController::class, 'create'])->name('admin.division.user.create')->middleware('auth');
            Route::post('/store', [DivisionController::class, 'store'])->name('admin.division.user.store')->middleware('auth');
            Route::post('/{id}/update', [DivisionController::class, 'update'])->name('admin.division.user.update')->middleware('auth');
            Route::delete('/{id}/delete', [DivisionController::class, 'destroy'])->name('admin.division.delete')->middleware('auth');
            Route::post('/import', [DivisionController::class, 'bulkImport'])->name('admin.division.user.import')->middleware('auth');
            Route::post('/{id}/status', [DivisionController::class, 'updateStatus']);
        });

        Route::group(['prefix' => 'business'], function () {

            Route::get('/', [BusinessUnitController::class, 'index'])->name('admin.business.users.index')->middleware('auth');
            Route::get('/{id}/edit', [BusinessUnitController::class, 'edit'])->name('admin.business.user.edit')->middleware('auth');
            Route::get('/create', [BusinessUnitController::class, 'create'])->name('admin.business.user.create')->middleware('auth');
            Route::post('/store', [BusinessUnitController::class, 'store'])->name('admin.business.user.store')->middleware('auth');
            Route::post('/{id}/update', [BusinessUnitController::class, 'update'])->name('admin.business.user.update')->middleware('auth');
            Route::delete('/{id}/delete', [BusinessUnitController::class, 'destroy'])->name('admin.business.user.delete')->middleware('auth');
            Route::post('/import', [BusinessUnitController::class, 'bulkImport'])->name('admin.business.user.import')->middleware('auth');
            Route::post('/{id}/status', [BusinessUnitController::class, 'updateStatus']);
        });


        Route::group(['prefix' => 'mydepartment'], function () {

            Route::get('/', [MyDepartmentController::class, 'index'])->name('admin.department.users.index')->middleware(['auth']);
            Route::get('/{id}/edit', [MyDepartmentController::class, 'edit'])->name('admin.department.user.edit')->middleware('auth');
            Route::get('/create', [MyDepartmentController::class, 'create'])->name('admin.department.user.create')->middleware('auth');
            Route::post('/store', [MyDepartmentController::class, 'store'])->name('admin.department.user.store')->middleware('auth');
            Route::post('/{id}/update', [MyDepartmentController::class, 'update'])->name('admin.department.user.update')->middleware('auth');
            Route::delete('/{id}/delete', [MyDepartmentController::class, 'destroy'])->name('admin.department.user.delete')->middleware('auth');
            Route::post('/import', [MyDepartmentController::class, 'bulkImport'])->name('admin.department.user.import')->middleware('auth');
            Route::resource('department', MyDepartmentController::class)->middleware('auth');
            Route::post('/{id}/status', [MyDepartmentController::class, 'updateStatus']);
            Route::resource('mydepartment', MyDepartmentController::class)->middleware('auth');
            Route::resource('department_sections', DepartmentSectionController::class)->middleware('auth');
        });



        Route::resource('section_units', SectionUnitController::class);
        Route::get('get-sections/{departmentId}', [SectionUnitController::class, 'getSections']);
        Route::get('get-departments/{divisionId}', [DepartmentSectionController::class, 'getDepartments']);
        Route::get('/get-units/{sectionId}', [SectionUnitController::class, 'getUnits']);


        Route::group(['prefix' => 'myemployee'], function () {

            Route::get('/department-wise', [MyEmployeeController::class, 'departmentWise'])->name('admin.employee.users.department-wise')->middleware('auth');
            Route::get('/send-emails/department-wise', [MyEmployeeController::class, 'sendEmailsDepartmentWise'])->name('admin.employee.users.send.emails.department-wise')->middleware('auth');
            Route::get('/manager', [MyEmployeeController::class, 'manager'])->name('admin.employee.users.manager')->middleware('auth');
            Route::post('/manager/dynamic-percentage', [MyEmployeeController::class, 'dynamicPercentage'])->name('admin.employee.users.manager.dynamic-percentage')->middleware('auth');
            Route::get('/technical-questions', [MyEmployeeController::class, 'technicalQuestions'])->name('admin.employee.users.manager.technical-questions')->middleware('auth');
            Route::get('/', [MyEmployeeController::class, 'index'])->name('admin.employee.users.index')->middleware('auth');
            Route::get('/ajax', [MyEmployeeController::class, 'employeeGet'])->name('admin.employee.users.ajax')->middleware('auth');
            Route::get('/department/ajax', [MyEmployeeController::class, 'departmentGet'])->name('admin.employee.departments.ajax')->middleware('auth');
            Route::get('divisions/ajax',[MyEmployeeController::class, 'divisionsGet'])->name('admin.employee.divisions.ajax')->middleware('auth');
            Route::get('/position/ajax', [MyEmployeeController::class, 'positionsGet'])->name('admin.employee.positions.ajax')->middleware('auth');
            Route::get('/team/ajax', [MyEmployeeController::class, 'teamsGet'])->name('admin.employee.teams.ajax')->middleware('auth');
            Route::get('/{id}/login', [MyEmployeeController::class, 'loginAsEmployee'])->name('admin.loginAsEmployee')->middleware('auth');


            Route::get('/{id}/edit', [MyEmployeeController::class, 'edit'])->name('admin.employee.user.edit')->middleware('auth');
            Route::get('/create', [MyEmployeeController::class, 'create'])->name('admin.employee.user.create')->middleware('auth');
            Route::post('/store', [MyEmployeeController::class, 'store'])->name('admin.employee.user.store')->middleware('auth');
            Route::post('/{id}/update', [MyEmployeeController::class, 'update'])->name('admin.employee.user.update')->middleware('auth');
            Route::get('/{id}/delete', [MyEmployeeController::class, 'destroy'])->name('admin.employee.user.delete')->middleware('auth');
            // Route::post('/import', [MyEmployeeController::class, 'bulkImport'])->name('admin.employee.user.import')->middleware(['auth', 'validateEmails']);
            Route::post('/import', [MyEmployeeController::class, 'bulkImport'])->name('admin.employee.user.import')->middleware(['auth']);
            Route::get('/send/email/{id}', [MyEmployeeController::class, 'sendEmail'])->name('admin.myemployee.send-email');
            Route::get('/send/all/email', [MyEmployeeController::class, 'getUserData'])->name('admin.myemployee.send-email.all');
            Route::get('/resend-onboarding-email/{id}', [MyEmployeeController::class, 'resendOnboardingEmail'])->name('admin.myemployee.resendOnboardingEmail')->middleware('auth');
            Route::get('/send-technical-assessment/{id}', [MyEmployeeController::class, 'sendTechnicalAssessment'])->name('admin.myemployee.sendTechnicalAssessment')->middleware('auth');

        });
        Route::get('/barangay/search', [MyEmployeeController::class, 'barangaySearch'])->name('admin.barangay.search')->middleware('auth');
        Route::get('get/city/search', [MyEmployeeController::class, 'CitySearch'])->name('admin.city.search')->middleware('auth');
        Route::get('get/higherinstitution/search', [MyEmployeeController::class, 'MasterHigherInstitutionSearch'])->name('admin.higherinstitution.search')->middleware('auth');

        Route::get('/technical-skill/search', [JobController::class, 'technicalSkillsSearch'])->name('admin.technical-skill.search')->middleware('auth');
        Route::post('/checkSkill', [JobController::class, 'checkSkill'])->name('admin.checkSkill')->middleware('auth');
        Route::post('/check-company-skill-exists', [JobController::class, 'checkCompanySkillExists'])->name('admin.technical-skill.check-company-exists');
         Route::post('/technical-skill/dup-check', [JobController::class, 'dupCheck'])->name('admin.technical-skill.dup-check');
        Route::get('/users-filter/search', [UsersController::class, 'usersSearch'])->name('admin.users-filter.search')->middleware('auth');
        Route::get('/master-skills/search', [AdminController::class, 'searchGeneric']);
        Route::get('/master-skills/{id}', [AdminController::class, 'showGeneric']);
        Route::post('/users-filter/superior/save', [UsersController::class, 'superiorAdd'])->name('admin.users-filter.superior.save')->middleware('auth');



        Route::get('/departments-filter/search', [UsersController::class, 'usersDepartmentSearch'])->name('admin.departments-filter.search')->middleware('auth');



        Route::post('/check-position-code', [JobController::class, 'checkPositionCode'])->name('check-position-code')->middleware('auth');



        Route::get('/technical-skill/search', [JobController::class, 'technicalSkillsSearch'])->name('admin.technical-skill.search')->middleware('auth');
        Route::post('/check-position-code', [JobController::class, 'checkPositionCode'])->name('check-position-code')->middleware('auth');

        // for philipine add country
        Route::get('/barangay', [JobOpeningsController::class, 'barangay'])->name('admin.barangay')->middleware('auth');
        Route::get('get/city', [JobOpeningsController::class, 'City'])->name('admin.city')->middleware('auth'); //phillipines city



        Route::post('/getState', [JobOpeningsController::class, 'getState'])->name('getState')->middleware('auth');
        Route::post('/getCity', [JobOpeningsController::class, 'getCity'])->name('getCity')->middleware('auth');

        Route::post('/getState', [JobOpeningsController::class, 'getState'])->name('getState')->middleware('auth');
        Route::post('/getCity', [JobOpeningsController::class, 'getCity'])->name('getCity')->middleware('auth');

        Route::resource('templates', ContractTemplateController::class);


        Route::get('/index/survey', [SurveyController::class, 'index'])->name('survey.index')->middleware('auth');

        Route::get('/create/survey', [SurveyController::class, 'create'])->name('survey.create')->middleware('auth');

        Route::post('/store/survey', [SurveyController::class, 'store'])->name('survey.store')->middleware('auth');

        Route::resource('survey', SurveyController::class)->middleware('auth');

        Route::delete('/surveys/{id}', [SurveyController::class, 'destroy'])->name('surveys.destroy')->middleware('auth');

        Route::get('/surveys/{id}/start', [SurveyController::class, 'start'])->name('surveys.start')->middleware('auth');

        //    Route::post('/store/start', [SurveyController::class, 'start_store'])->name('start.store')->middleware('auth');

        Route::post('/start/{id}', [SurveyController::class, 'start_store'])->name('start.store')->middleware('auth');

        Route::get('/admin/recordDetails/{surveyId}', [SurveyController::class, 'recordDetails'])->name('admin.recordDetails');

        Route::get('/admin/survey/{surveyId}/user/{userId}/answers', [SurveyController::class, 'viewSurveyAnswers'])->name('survey.viewAnswers');

        Route::get('/technical/assessment/index', [TechnicalAssessmentController::class, 'index'])->name('technicalAss.index')->middleware('auth');
        Route::get('/api/jobs', [TechnicalAssessmentController::class, 'getJobs'])->name('api.jobs')->middleware('auth');
        Route::get('/technical/assessment/create', [TechnicalAssessmentController::class, 'create'])->name('technicalAss.create')->middleware('auth');
        Route::post('/technical/assessment/store', [TechnicalAssessmentController::class, 'store'])->name('technicalAss.store')->middleware('auth');
        Route::resource('technical', TechnicalAssessmentController::class)->middleware('auth');
        Route::get('/get-jobs-by-department/{department_id}', [TechnicalAssessmentController::class, 'getJobsByDepartment'])->middleware('auth');

        Route::delete('technicalAss/{id}', [TechnicalAssessmentController::class, 'destroy'])->name('technicalAss.destroy')->middleware('auth');
        Route::get('/download-template', [TechnicalAssessmentController::class, 'downloadTemplate'])->name('technicalAss.downloadTemplate')->middleware('auth');

        Route::post('/technical-assessments/import', [TechnicalAssessmentController::class, 'import'])->name('technicalAss.import')->middleware('auth');

        // Cascading Select Routes
        Route::get('/get-companies-by-bu/{bu}', [TechnicalAssessmentController::class, 'getCompaniesByBU'])->middleware('auth');
        Route::get('/get-departments-by-company/{company}', [TechnicalAssessmentController::class, 'getDepartmentsByCompany'])->middleware('auth');


        Route::get('/technical/assessment/import/file', [TechnicalAssessmentController::class, 'file'])->name('technicalAss.file')->middleware('auth');
        Route::post('/getState', [JobOpeningsController::class, 'getState'])->name('getState')->middleware('auth');
        Route::post('/getCity', [JobOpeningsController::class, 'getCity'])->name('getCity')->middleware('auth');

        Route::resource('templates', ContractTemplateController::class);

        Route::get('/leave/index', [LeaveManagementController::class, 'index'])->name('leave.index')->middleware('auth');
        Route::get('/leave/create', [LeaveManagementController::class, 'create'])->name('leave.create')->middleware('auth');
        Route::post('/leaves/store', [LeaveManagementController::class, 'store'])->name('leave.store')->middleware('auth');

        Route::resource('leave', LeaveManagementController::class)->middleware('auth');
        Route::delete('/leave/{id}', [LeaveManagementController::class, 'destroy'])->name('leave.destroy');

        Route::get('/allowance/index', [AllowanceManagementController::class, 'index'])->name('allowance.index')->middleware('auth');
        Route::get('/allowance/create', [AllowanceManagementController::class, 'create'])->name('allowance.create')->middleware('auth');
        Route::post('/allowance/store', [AllowanceManagementController::class, 'store'])->name('allowance.store')->middleware('auth');
        Route::resource('allowance', AllowanceManagementController::class)->middleware('auth');
        Route::delete('/allowance/{id}', [AllowanceManagementController::class, 'destroy'])->name('allowance.destroy');

        Route::get('/claim/index', [ClaimManagementController::class, 'index'])->name('claim.index')->middleware('auth');
        Route::get('/claim/create', [ClaimManagementController::class, 'create'])->name('claim.create')->middleware('auth');

        Route::get('/descriptors/index', [DescriptorController::class, 'index'])->name('descriptors.index')->middleware('auth');
        Route::get('/descriptors/create', [DescriptorController::class, 'create'])->name('descriptors.create')->middleware('auth');
        Route::post('/descriptors/store', [DescriptorController::class, 'store'])->name('descriptors.store')->middleware('auth');
        Route::resource('descriptors', DescriptorController::class)->middleware('auth');
        Route::delete('/descriptors/{id}', [DescriptorController::class, 'destroy'])->name('descriptors.destroy');
        Route::get('/descriptors/import/file', [DescriptorController::class, 'file'])->name('descriptors.file')->middleware('auth');
        Route::get('/descriptors/download-template', [DescriptorController::class, 'show'])->name('descriptors.download-template')->middleware('auth');
        Route::post('/descriptors/import', [DescriptorController::class, 'import'])->name('descriptors.import')->middleware('auth');

        Route::get('/general/index', [GeneralSettingController::class, 'index'])->name('general_setting.index')->middleware('auth');
        Route::get('/general/create', [GeneralSettingController::class, 'create'])->name('general_setting.create')->middleware('auth');
        Route::post('/general/store', [GeneralSettingController::class, 'store'])->name('general_setting.store')->middleware('auth');
        Route::put('/general-setting/update-multiple', [GeneralSettingController::class, 'updateMultiple'])->name('general_setting.updateMultiple');

        //    Route::get('/user-data', [GetUserDataController::class, 'getUserData']);


    });


    // Add other admin routes as needed
    //   });
Route::get('cognitive-ability-assessment/questions-display', [QuizController::class, 'cognitiveAbilityAssessmentDisplay'])->name('cognitive-ability-assessment-display');

});
Route::get('/update-technical-skills', [UsersController::class, 'updateTechnicalSkillsView'])->name('admin.update.technical-skills-view');
Route::post('/update-technical-skills', [UsersController::class, 'updateTechnicalSkills'])->name('admin.update.technical-skills');

Route::get('/migrate-technical-skills-id', [UsersController::class, 'migrateTechnicalSkillsId'])->name('admin.migrate.technical-skills-id');

Route::get('/update-technical-skills-for-jobs', [UsersController::class, 'updateTechnicalSkillsForJobsView'])->name('admin.update.technical-skills-for-jobs-view');
Route::post('/update-technical-skills-for-jobs', [UsersController::class, 'updateTechnicalSkillsForJobs'])->name('admin.update.technical-skills-for-jobs');

Route::get('/career_map', function () {
    return view('career_map');
})->name('career_map');


Route::get('/map-job-details', [CareerMapController::class, 'careerMapDetails']);

Route::post('/update-department-section-status', [DepartmentDetailsController::class, 'updateStatus'])->name('update.department.section.status');


Route::post('/generate-pdf', [DepartmentDetailsController::class, 'generatePdf'])->name('admin.generate-pdf');
Route::get('/admin/department/{id}/filter-psychometric', [DepartmentDetailsController::class, 'filterPsychometricData'])
    ->name('department.filterPsychometric');

if (env('APP_ENV') != 'production') {
    Route::get('/admin/organization-chart/delete-data', [OrganizationChartController::class, 'deleteData']);
    Route::get('/admin/organization-chart/update-superior-data', [OrganizationChartController::class, 'updateSuperiorData']);
}

// Tenant-specific subdomains
// Route::domain('{tenant}.yourapp.com')->middleware(['tenant.context'])->group(function () {
//     Route::get('/', [TenantHomeController::class, 'index'])->name('tenant.home');
    
//     Route::middleware(['auth'])->group(function () {
//         Route::get('dashboard', [TenantDashboardController::class, 'index'])->name('tenant.dashboard');
//         Route::resource('users', TenantUserController::class, ['as' => 'tenant']);
//         Route::resource('settings', TenantSettingsController::class, ['as' => 'tenant']);
//     });
// });

// // Main domain routes (without tenant context)
// Route::domain('yourapp.com')->group(function () {
//     Route::get('/', [MainHomeController::class, 'index'])->name('main.home');
//     Route::get('pricing', [PricingController::class, 'index'])->name('pricing');
//     Route::get('features', [FeaturesController::class, 'index'])->name('features');
// });

// Tenant Provisioning Routes
Route::prefix('tenant-provisioning')->name('tenant.provisioning.')->group(function () {
    Route::post('/', [App\Http\Controllers\Admin\TenantProvisioningController::class, 'provision'])->name('provision');
    Route::get('/plans', [App\Http\Controllers\Admin\TenantProvisioningController::class, 'getAvailablePlans'])->name('plans');
    Route::get('/parent-tenants', [App\Http\Controllers\Admin\TenantProvisioningController::class, 'getParentTenants'])->name('parent-tenants');
});