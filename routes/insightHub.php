<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InsightHub\InsightHubController;
use App\Http\Controllers\InsightHub\CompanyProfileController;
use App\Http\Controllers\InsightHub\AccountManagementController;

use App\Http\Controllers\InsightHub\CompanyValueController;
use App\Http\Controllers\InsightHub\EmailTemplateController;
use App\Http\Controllers\InsightHub\HubCenterController;
use App\Http\Controllers\InsightHub\Analytic\DashboardController;
use App\Http\Controllers\InsightHub\Analytic\ChatbotController;
use App\Http\Controllers\InsightHub\SubsidiariesController;
use App\Http\Controllers\InsightHub\OrganizationStructure\BusinessUnitController;
use App\Http\Controllers\InsightHub\OrganizationStructure\DivisionController;
use App\Http\Controllers\InsightHub\OrganizationStructure\DepartmentController;
use App\Http\Controllers\InsightHub\UserManagementController;
use App\Http\Controllers\InsightHub\RoleController;


/*
|--------------------------------------------------------------------------
| Insight Hub Routes
|--------------------------------------------------------------------------
*/

// InsightHub Routes - Only accessible by authenticated users
Route::middleware(['auth'])->group(function () {
    
    // Main HubCenter Dashboard
    Route::get('/insighthub', [HubCenterController::class, 'dashboard'])->name('hubcenter.dashboard');

    Route::get('/analytic/dashboard', [DashboardController::class, 'index'])
        ->middleware('permission:insighthub.analytics.dashboard.view')
        ->name('analytics.dashboard');

    Route::get('/analytic/chatbot', [ChatbotController::class, 'index'])
        ->name('analytics.chatbot');
    
    // Explicit permission check for chatbot create
    Route::post('/analytic/chatbot', [ChatbotController::class, 'store'])
        ->middleware('permission:insighthub.analytics.chatbot.create')
        ->name('analytics.chatbot.store');


    Route::get('/subsidiaries', [SubsidiariesController::class, 'index'])->name('subsidiaries.index');

    Route::prefix('account')->name('account.')->group(function () {
        Route::get('/', [AccountManagementController::class, 'index'])->name('index');
        Route::get('/edit', [AccountManagementController::class, 'edit'])->name('edit');
        Route::post('/', [AccountManagementController::class, 'update'])->name('update');
        Route::get('/password', [AccountManagementController::class, 'showChangePasswordForm'])->name('changePassword');
        Route::post('/change/password', [AccountManagementController::class, 'changePassword'])->name('changePassword.update');
    });

    // Role Management Routes with Permission Middleware
    Route::prefix('insighthub/settings/role-management')
        ->name('insighthub.role-management.')
        ->group(function () {
            // Auto-detects: role-management.view
            Route::get('/', [RoleController::class, 'index'])->name('index');
            
            // Auto-detects: role-management.create
            Route::get('/create', [RoleController::class, 'create'])->name('create');
            Route::post('/', [RoleController::class, 'store'])->name('store');
            
            // Auto-detects: role-management.view
            Route::get('/{id}', [RoleController::class, 'show'])->name('show')->where('id', '[0-9]+');
            
            // Auto-detects: role-management.edit
            Route::get('/{id}/edit', [RoleController::class, 'edit'])->name('edit')->where('id', '[0-9]+');
            Route::put('/{id}', [RoleController::class, 'update'])->name('update')->where('id', '[0-9]+');
            Route::patch('/{id}', [RoleController::class, 'update'])->name('patch')->where('id', '[0-9]+');
            
            // Auto-detects: role-management.delete
            Route::delete('/{id}', [RoleController::class, 'destroy'])->name('destroy')->where('id', '[0-9]+');
            
            Route::get('/{id}/duplicate', [RoleController::class, 'duplicate'])->name('duplicate')->where('id', '[0-9]+');
            Route::post('/duplicate', [RoleController::class, 'storeDuplicate'])->name('duplicate.store');
            Route::get('/{id}/check-deletable', [RoleController::class, 'checkDeletable'])->name('check-deletable')->where('id', '[0-9]+');
            Route::get('/{id}/users', [RoleController::class, 'getRoleUsers'])->name('users')->where('id', '[0-9]+');
            Route::get('/assign-role/{user_id}/{role_id}', [RoleController::class, 'assignRoleToUser'])->name('assign-role');
        });
    
});

// Auto-detect permission from route name
Route::middleware(['auth'])->group(function () {
    Route::get('/insighthub/settings/role-management', [RoleController::class, 'index'])
        ->name('insighthub.role-management.index'); // Requires: role-management.view
    
    Route::post('/insighthub/settings/role-management', [RoleController::class, 'store'])
        ->name('insighthub.role-management.store'); // Requires: role-management.create
});

// Or specify permission explicitly
Route::middleware(['auth', 'permission:user-management.view'])->group(function () {
    Route::get('/insighthub/settings/user-management', [UserManagementController::class, 'index'])
        ->name('insighthub.settings.user-management.index');
});

Route::prefix('insighthub/settings/company-values')->name('insighthub.settings.company-values.')->group(function () {
    Route::get('/', [CompanyValueController::class, 'index'])->name('index');
    Route::get('/create', [CompanyValueController::class, 'create'])->name('create');
    Route::get('/{id}/edit', [CompanyValueController::class, 'edit'])->name('edit');
    Route::post('/', [CompanyValueController::class, 'store'])->name('store');
    Route::get('/{id}/show', [CompanyValueController::class, 'show'])->name('show');
    Route::put('/{companyValue}', [CompanyValueController::class, 'update'])->name('update');
    Route::delete('/{companyValue}', [CompanyValueController::class, 'destroy'])->name('destroy');
});

Route::prefix('insighthub/settings/general-settings/company-profile')
    ->name('company-profile.')
    ->group(function () {
        Route::get('/', [CompanyProfileController::class, 'index'])->name('index');
        Route::get('/edit', [CompanyProfileController::class, 'edit'])->name('edit');
        Route::post('/update', [CompanyProfileController::class, 'update'])->name('update');
    });
    
// Route::get('/insighthub/settings/general-settings/company-profile', function () {
//     return view('InsightHub.settings.general-settings.company-profile.index');
// });
 
// Route::get('/insighthub/settings/general-settings/company-profile/edit-company-information', function () {
//     return view('InsightHub.settings.general-settings.company-profile.edit');
// });
 
// Company Values Routes
// Route::get('/insighthub/settings/general-settings/company-values', function () {
//     return view('InsightHub.settings.general-settings.company-values.index');
// })->name('insighthub.settings.company-values');
 
// Route::get('/insighthub/settings/general-settings/company-values/add-company-values', function () {
//     return view('InsightHub.settings.general-settings.company-values.add');
// })->name('insighthub.settings.company-values.add');
 
// Route::get('/insighthub/settings/general-settings/company-values/view-company-values', function () {
//     return view('InsightHub.settings.general-settings.company-values.view');
// })->name('insighthub.settings.company-values.view');
 
// Route::get('/insighthub/settings/general-settings/company-values/edit-company-values', function () {
//     return view('InsightHub.settings.general-settings.company-values.edit');
// })->name('insighthub.settings.company-values.edit');
 
// Email Templates Routes
Route::prefix('insighthub/settings')->group(function () {
   Route::get('/email-templates', [EmailTemplateController::class, 'index'])
    ->name('insighthub.settings.email-templates.index');
    Route::get('/email-templates/{id}/view', [EmailTemplateController::class, 'show'])
        ->name('insighthub.settings.email-templates.view');
    Route::get('/email-templates/{id}/edit', [EmailTemplateController::class, 'edit'])
        ->name('insighthub.settings.email-templates.edit');
    Route::put('/email-templates/{id}', [EmailTemplateController::class, 'update'])
        ->name('insighthub.settings.email-templates.update');
});

// Organization Structure Routes
Route::prefix('insighthub/settings/general-settings/organization-structure')->name('organization-structure.')->group(function () {
    Route::get('/business-units/getData', [BusinessUnitController::class, 'getData'])->name('business-units.getData');
    Route::post('/business-units/check-duplicate', [BusinessUnitController::class, 'checkDuplicate'])->name('business-units.check-duplicate');
    Route::get('/business-units', [BusinessUnitController::class, 'index'])->name('business-units');
    Route::post('/business-units', [BusinessUnitController::class, 'store'])->name('business-units.store');
    Route::put('/business-units/{id}', [BusinessUnitController::class, 'update'])->name('business-units.update');
    Route::delete('/business-units/{id}', [BusinessUnitController::class, 'destroy'])->name('business-units.destroy');

    Route::get('/divisions/getData', [DivisionController::class, 'getData'])->name('divisions.getData');
    Route::post('/divisions/check-duplicate', [DivisionController::class, 'checkDuplicate'])->name('divisions.check-duplicate');
    Route::get('/divisions', [DivisionController::class, 'index'])->name('divisions');
    Route::post('/divisions', [DivisionController::class, 'store'])->name('divisions.store');
    Route::put('/divisions/{id}', [DivisionController::class, 'update'])->name('divisions.update');
    Route::delete('/divisions/{id}', [DivisionController::class, 'destroy'])->name('divisions.destroy');

    Route::get('/departments/getData', [DepartmentController::class, 'getData'])->name('departments.getData');
    Route::post('/departments/check-duplicate', [DepartmentController::class, 'checkDuplicate'])->name('departments.check-duplicate');
    Route::get('/departments', [DepartmentController::class, 'index'])->name('departments');
    Route::post('/departments', [DepartmentController::class, 'store'])->name('departments.store');
    Route::put('/departments/{id}', [DepartmentController::class, 'update'])->name('departments.update');
    Route::delete('/departments/{id}', [DepartmentController::class, 'destroy'])->name('departments.destroy');
});

// Keep the old route for backward compatibility - redirect to business units
Route::get('/insighthub/settings/general-settings/organization-structure', function () {
    return redirect()->route('organization-structure.business-units');
});
// User Management Routes
Route::prefix('insighthub/settings/user-management')->name('insighthub.settings.user-management.')->group(function () {
    Route::get('/', [UserManagementController::class, 'index'])->name('index');
    Route::get('/getData', [UserManagementController::class, 'getData'])->name('getData');
    Route::get('/filter-options', [UserManagementController::class, 'getFilterOptions'])->name('filter-options');
    Route::get('/statistics', [UserManagementController::class, 'getStatistics'])->name('statistics');
    Route::get('/{id}/view', [UserManagementController::class, 'show'])->name('show');
    Route::get('/{id}/edit', [UserManagementController::class, 'edit'])->name('edit');
    Route::get('/create', [UserManagementController::class, 'create'])->name('create');
    Route::post('/', [UserManagementController::class, 'store'])->name('store');
    Route::put('/{id}', [UserManagementController::class, 'update'])->name('update');
    Route::delete('/{id}', [UserManagementController::class, 'destroy'])->name('destroy');
    Route::post('/bulk-delete', [UserManagementController::class, 'bulkDelete'])->name('bulk-delete');
    Route::post('/bulk-upload', [UserManagementController::class, 'bulkUpload'])->name('bulk-upload');
    Route::post('/{id}/send-onboarding-email', [UserManagementController::class, 'sendOnboardingEmail'])->name('send-onboarding-email');
    Route::post('/bulk-send-onboarding-email', [UserManagementController::class, 'bulkSendOnboardingEmail'])->name('bulk-send-onboarding-email');
    Route::get('/{id}/view-candidate', [UserManagementController::class, 'showCandidate'])->name('show-candidate');
    Route::get('/get-user-by-job-position', [UserManagementController::class, 'getUserByJobPosition'])->name('user-management.get-user-by-job-position');
    Route::get('/address/states/{country}', [UserManagementController::class, 'getStatesByCountry']);
    Route::get('/address/cities/{state}', [UserManagementController::class, 'getCitiesByState']);
});


// Route::get('/insighthub/settings/role-Management', function () {
//     return view('InsightHub.settings.role-Management.index');
// });
 
// Route::get('/insighthub/settings/role-Management/view', function () {
//     return view('InsightHub.settings.role-Management.view');
// });
 
// Route::get('/insighthub/settings/role-Management/create', function () {
//     return view('InsightHub.settings.role-Management.create');
// });
 
// Route::get('/insighthub/settings/role-Management/edit', function () {
//     return view('InsightHub.settings.role-Management.edit');
// });
