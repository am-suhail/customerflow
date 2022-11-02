<?php

use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Office\DashboardController;
use App\Http\Controllers\Office\EmployeeController;
use App\Http\Controllers\Office\EnquiryController;
use App\Http\Controllers\Office\MarketLeadsController;
use App\Http\Controllers\Office\MasterController;
use App\Http\Controllers\Office\ProfileController;
use App\Http\Controllers\Office\ProjectController;
use App\Http\Controllers\Office\RolesController;
use App\Http\Controllers\Office\ServiceController;
use App\Http\Controllers\Office\UserController;
use App\Http\Controllers\Office\VendorController;
use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Auth\Passwords\Confirm;
use App\Http\Livewire\Auth\Passwords\Email;
use App\Http\Livewire\Auth\Passwords\Reset;
use App\Http\Livewire\Auth\Register;
use App\Http\Livewire\Auth\Verify;
use App\Http\Livewire\Project\Create;
use App\Http\Livewire\Project\Edit;
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
        // Home|Dashboard
        Route::get('/home', [DashboardController::class, 'index'])->name('home');

        // Dashboard|My Profile
        Route::resource('my-profile', ProfileController::class, ['except' => ['create', 'store']]);

        // Dashboard|All Users
        Route::get('/all-users', [UserController::class, 'index'])->name('all-users');
        Route::get('/user/{id}/manage', [UserController::class, 'manage'])->name('user.manage');
        Route::put('/user/update/{id}', [UserController::class, 'update'])->name('user.update');

        // Dashboard|Employees
        Route::get('/employees', [EmployeeController::class, 'index'])->name('employee.index');
        Route::get('employee/{id}/appoint', [EmployeeController::class, 'appoint'])->name('employee.appoint');
        Route::put('employee/appoint/{id}', [EmployeeController::class, 'processAppoint'])->name('employee.appoint-process');

        //Logs
        Route::prefix('logs')->group(function () {
            Route::get('project', [ProjectController::class, 'logs'])->name('project.logs');
        });

        // Project Resource and Livewire Component for Create
        Route::get('project/create/{enquiry?}', Create::class)->name('project.create'); // Livewire Direct Component
        Route::get('project/{project}/edit', Edit::class)->name('project.edit'); // Livewire Direct Component
        Route::post('project/status', [ProjectController::class, 'status_update'])->name('project.status_update');
        Route::resource('project', ProjectController::class)->except('create', 'store', 'edit');

        // Dashboard Resources
        Route::resources([
            'enquiry' => EnquiryController::class,
            'vendor' => VendorController::class,
            'service' => ServiceController::class,
            'leads' => MarketLeadsController::class,
            'employee' => EmployeeController::class,
            'roles' => RolesController::class,
        ]);

        // Master Data
        Route::prefix('master')->group(function () {
            // Index
            Route::get('/', [MasterController::class, 'index'])->name('master-data');
            // Location
            Route::get('/location', [MasterController::class, 'location'])->name('master.location');
            // Qualification
            Route::get('/qualification', [MasterController::class, 'qualification'])->name('master.qualification');
            // Designation
            Route::get('/designation', [MasterController::class, 'designation'])->name('master.designation');
            // Industry
            Route::get('/industry', [MasterController::class, 'industry'])->name('master.industry');
            // Category
            Route::get('/category', [MasterController::class, 'category'])->name('master.category');
            // Units
            Route::get('/unit', [MasterController::class, 'unit'])->name('master.unit');
            // Badge
            Route::get('/badge', [MasterController::class, 'badge'])->name('master.badge');
        });

        Route::get('#', function () {
            return;
        })->name('dummy');
    });

    // Logout
    Route::post('logout', LogoutController::class)->name('logout');
});
