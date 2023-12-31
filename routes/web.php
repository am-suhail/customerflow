<?php

use Carbon\Carbon;
use App\Models\Invoice;
use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Auth\Verify;
use App\Http\Livewire\Auth\Register;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Auth\Passwords\Email;
use App\Http\Livewire\Auth\Passwords\Reset;
use App\Http\Livewire\Auth\Passwords\Confirm;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Office\UserController;
use App\Http\Controllers\Office\RolesController;
use App\Http\Controllers\Office\BranchController;
use App\Http\Controllers\Office\MasterController;
use App\Http\Controllers\Office\ReportController;
use App\Http\Controllers\Office\VendorController;
use App\Http\Controllers\Office\CompanyController;
use App\Http\Controllers\Office\ExpenseController;
use App\Http\Controllers\Office\InvoiceController;
use App\Http\Controllers\Office\ProfileController;
use App\Http\Controllers\Office\EmployeeController;
use App\Http\Controllers\Office\SettingsController;
use App\Http\Controllers\Office\DashboardController;
use App\Http\Controllers\Office\SuperAdminController;
use App\Http\Controllers\Office\CustomerFlowController;
use App\Http\Controllers\Office\ExpenseUploadController;
use App\Http\Controllers\Office\RevenueUploadController;
use App\Http\Controllers\Office\TransEntryTypeController;
use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Office\FinanceSettingsController;
use App\Http\Controllers\Office\GeneralSettingsController;
use App\Http\Controllers\Office\DashboardSettingsController;

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

Route::middleware('guest')->group(function () {
    Route::get('/', Login::class)
        ->name('login');
    Route::get('/register', Register::class)
        ->name('register');
});

Route::get('password/reset', Email::class)
    ->name('password.request');

Route::get('password/reset/{token}', Reset::class)
    ->name('password.reset');

Route::middleware('auth')->group(function () {
    Route::get('email/verify', Verify::class)
        ->middleware('throttle:6,1')
        ->name('verification.notice');

    // == Not Necessary ==
    Route::get('email/verify/{id}/{hash}', EmailVerificationController::class)
        ->middleware('signed')
        ->name('verification.verify');

    Route::get('password/confirm', Confirm::class)
        ->name('password.confirm');
});

Route::middleware(['auth'])->group(function () {
    Route::prefix('my-profile')->group(function () {
        Route::get('create', [ProfileController::class, 'create'])->name('my-profile.create');
        Route::post('create', [ProfileController::class, 'store'])->name('my-profile.store');
    });

    Route::middleware('profile_setup')->group(function () {

        // Troubleshoot - Invioce - Invoice Item
        Route::get('/error-fix', [DashboardController::class, 'trouble']);

        // Home|Dashboard
        Route::get('/home', [DashboardController::class, 'index'])->name('home');

        // My Profile
        Route::resource('my-profile', ProfileController::class, ['except' => ['create', 'store']]);

        // All Users
        Route::get('/users', [UserController::class, 'index'])->name('user.index');
        Route::get('/user/manage/{id}', [UserController::class, 'manage'])->name('user.manage');
        Route::put('/user/update/{id}', [UserController::class, 'update'])->name('user.update');

        // Employees
        Route::get('employee/{id}/appoint', [EmployeeController::class, 'appoint'])->name('employee.appoint');
        Route::put('employee/appoint/{id}', [EmployeeController::class, 'process_appoint'])->name('employee.appoint-process');

        // Revenue
        Route::get('revenue/list', [InvoiceController::class, 'index'])->name('revenue.index');
        Route::get('revenue/export', [InvoiceController::class, 'export'])->name('revenue.export');
        Route::get('revenue/import', [RevenueUploadController::class, 'index'])->name('revenue.import.index');
        Route::post('revenue/import', [RevenueUploadController::class, 'store'])->name('revenue.import.store');
        Route::resource('revenue', InvoiceController::class, ['except' => ['index', 'store', 'update', 'destroy']]);

        // Expense
        Route::get('expense/export', [ExpenseController::class, 'export'])->name('expense.export');
        Route::get('expense/import', [ExpenseUploadController::class, 'index'])->name('expense.import.index');
        Route::post('expense/import', [ExpenseUploadController::class, 'store'])->name('expense.import.store');
        Route::resource('expense', ExpenseController::class, ['except' => ['store', 'update', 'destroy']]);

        // Transaction Entry Type
        Route::get('transaction-entry/{type}', [TransEntryTypeController::class, 'index'])->name('entry-type.index');

        // Exports
        Route::get('branch/export', [VendorController::class, 'export'])->name('branch.export');
        Route::get('company/export', [CompanyController::class, 'export'])->name('company.export');

        // Dashboard Resources
        Route::resources(
            [
                'company' => CompanyController::class,
                'branch' => BranchController::class,
                'employee' => EmployeeController::class,
                'roles' => RolesController::class,
                'customer-flow'=> CustomerFlowController::class,
            ]
        );

        // Reports
        Route::prefix('reports')->group(function () {
            // Index
            Route::get('/', [ReportController::class, 'index'])->name('report.index');

            // Summary Report
            Route::get('/country', [ReportController::class, 'country'])->name('report.country');

            // Services Summary Report
            Route::get('/category', [ReportController::class, 'category'])->name('report.category');

            // Company Summary Report
            Route::get('/company', [ReportController::class, 'company'])->name('report.company');

            // Branch Summary Report
            Route::get('/branch', [ReportController::class, 'branch'])->name('report.branch');

            // Bank Card Summary Report
            Route::get('/bank-summary', [ReportController::class, 'bank_summary'])->name('report.bank-summary');
        });

        // Master Data
        Route::prefix('master')->group(function () {
            // Index
            Route::get('/', [MasterController::class, 'index'])->name('master.index');
            // Location
            Route::get('/location/{type?}', [MasterController::class, 'location'])->name('master.location');
            // Qualification
            Route::get('/qualification', [MasterController::class, 'qualification'])->name('master.qualification');
            // Designation
            Route::get('/designation', [MasterController::class, 'designation'])->name('master.designation');
            // Industry
            Route::get('/industry', [MasterController::class, 'industry'])->name('master.industry');
            // Product Category
            Route::get('/category/{type?}', [MasterController::class, 'category'])->name('master.category');
            // Company Category
            Route::get('/company-category/{type?}', [MasterController::class, 'company_category'])->name('master.company-category');
            // Expense Category
            Route::get('/expense-category/{type?}', [MasterController::class, 'expense_category'])->name('master.expense-category');
            // Revenue Type
            Route::get('/revenue-type', [MasterController::class, 'revenue_type'])->name('master.revenue-type');
            // Tax Settings
            Route::get('/tax-settings', [MasterController::class, 'tax_settings'])->name('master.tax-settings');
        });

        // Application Settings
        Route::prefix('settings')->group(function () {
            Route::get('/', SettingsController::class)->name('app-settings.index');

            // General
            Route::get('/general-settings', [GeneralSettingsController::class, 'index'])->name('app-settings.general');
            Route::post('/general-settings', [GeneralSettingsController::class, 'update'])->name('app-settings.update-general');

            // Dashboard
            Route::get('/dashboard-settings', [DashboardSettingsController::class, 'index'])->name('app-settings.dashboard');
            Route::post('/dashboard-settings', [DashboardSettingsController::class, 'update'])->name('app-settings.update-dashboard');

            // Finance
            Route::get('/finance-settings', [FinanceSettingsController::class, 'index'])->name('app-settings.finance');
            Route::post('/finance-settings', [FinanceSettingsController::class, 'update'])->name('app-settings.update-finance');
        });

        Route::prefix('super-admin')->group(function () {
            Route::get('/', [SuperAdminController::class, 'index'])->name('admin.index');
            Route::get('roles-permissions', [SuperAdminController::class, 'gate'])->name('admin.roles-management');
        });

        Route::get('#', function () {
            return;
        })->name('dummy');
    });

    // Logout
    Route::post('logout', LogoutController::class)->name('logout');
});
