<?php

use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Office\DashboardController;
use App\Http\Controllers\Office\DashboardSettingsController;
use App\Http\Controllers\Office\EmployeeController;
use App\Http\Controllers\Office\GeneralSettingsController;
use App\Http\Controllers\Office\InvoiceController;
use App\Http\Controllers\Office\MasterController;
use App\Http\Controllers\Office\ProfileController;
use App\Http\Controllers\Office\ReportController;
use App\Http\Controllers\Office\RolesController;
use App\Http\Controllers\Office\SettingsController;
use App\Http\Controllers\Office\UserController;
use App\Http\Controllers\Office\VendorController;
use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Auth\Passwords\Confirm;
use App\Http\Livewire\Auth\Passwords\Email;
use App\Http\Livewire\Auth\Passwords\Reset;
use App\Http\Livewire\Auth\Register;
use App\Http\Livewire\Auth\Verify;
use App\Models\Invoice;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;

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
        // Route::get('/data-verify', function () {
        //     $invoices = Invoice::whereYear('date', date('Y'))->get();

        //     echo count($invoices) . " Refs for the Year 2022,<br /><br /><br />";

        //     foreach ($invoices as $invoice) {
        //         echo $invoice->number . ",";
        //         echo Carbon::parse($invoice->date)->format('d-m-Y') . ",";
        //         echo $invoice->total_amount . ",";
        //         echo $invoice->items->first()->subcategory->category->name . ",";
        //         echo $invoice->items->first()->subcategory->name . ",";
        //         echo $invoice->vendor->country->name . ",";
        //         echo $invoice->vendor->city->state->name . ",";
        //         echo $invoice->vendor->city->name . ",";
        //         echo "<br />";
        //     }
        // });

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

        // Branches Export
        Route::get('branch/export', [VendorController::class, 'export'])->name('branch.export');


        Route::get('revenue/list', [InvoiceController::class, 'index'])->name('revenue.index');
        Route::get('revenue/export', [InvoiceController::class, 'export'])->name('revenue.export');
        Route::resource('revenue', InvoiceController::class, ['except' => ['index', 'store', 'update', 'destroy']]);

        // Dashboard Resources
        Route::resources(
            [
                'branch' => VendorController::class,
                'employee' => EmployeeController::class,
                'roles' => RolesController::class,
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

            // Employees Summary Report
            Route::get('/company', [ReportController::class, 'company'])->name('report.company');

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
            // Category
            Route::get('/category/{type?}', [MasterController::class, 'category'])->name('master.category');
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
        });

        Route::get('#', function () {
            return;
        })->name('dummy');
    });

    // Logout
    Route::post('logout', LogoutController::class)->name('logout');
});
