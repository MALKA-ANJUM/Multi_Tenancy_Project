<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleAndPermissionController;
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
    Route::prefix('tenant')->name('tenant.')->middleware(['tenant'])->group(function () {
        Route::get('dashboard', [TenantController::class, 'tenantDashboard'])->name('dashboard');

        // Roles & permission
        Route::get('user-list', [RoleAndPermissionController::class, 'userList'])->name('user-list');
        Route::get('add-user-form', [RoleAndPermissionController::class, 'addUserForm'])->name('add-user-form');
        Route::post('add-user', [RoleAndPermissionController::class, 'addUser'])->name('add-user');
        Route::get('edit-user/{id}', [RoleAndPermissionController::class, 'editUser'])->name('edit-user');
        Route::post('update-user/{id}', [RoleAndPermissionController::class, 'updateUser'])->name('update-user');
        Route::get('delete-user/{id}', [RoleAndPermissionController::class, 'deleteUser'])->name('delete-user');
        Route::get('add-permission-form', [RoleAndPermissionController::class, 'addPermissionForm'])->name('add-permission-form');
        Route::post('add-permission', [RoleAndPermissionController::class, 'addPermission'])->name('add-permission');
        Route::get('roles', [RoleAndPermissionController::class, 'roleList'])->name('roles');
        Route::get('add-role-form', [RoleAndPermissionController::class, 'addRoleForm'])->name('add-role-form');
        Route::post('add-role', [RoleAndPermissionController::class, 'addRole'])->name('add-role');
    });

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
