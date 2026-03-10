<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TenantController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [AuthController::class, 'login'])->name('login');
Route::get('company-register', [AuthController::class, 'companyRegister'])->name('company.register');
Route::post('store-login', [AuthController::class, 'storeLogin'])->name('store.login');
Route::post('company-store-register', [AuthController::class, 'companyStoreRegister'])->name('company.store.register');

Route::middleware(['web', 'auth'])->group(function () {
   
    // Admin Route
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('tenant-list', [AdminController::class, 'tenantList'])->name('tenant.list');

    });

    // Tenant Route
    Route::prefix('tenant')->name('tenant.')->middleware(['identify.tenant'])->group(function () {
        Route::get('dashboard', [TenantController::class, 'tenantDashboard'])->name('dashboard');
    });

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
