<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjectController;
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


// Admin Route
Route::prefix('admin')->name('admin.')->middleware(['auth:admin'])->group(function () {
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('tenant-list', [AdminController::class, 'tenantList'])->name('tenant.list');
    Route::post('logout', [AdminController::class, 'logout'])->name('logout');
});

// Tenant Route
Route::prefix('tenant')->name('tenant.')->middleware(['tenant'])->group(function () {
    Route::get('dashboard', [TenantController::class, 'tenantDashboard'])->name('dashboard');
    Route::post('logout', [TenantController::class, 'logout'])->name('logout');


    // Roles Route
    Route::get('user-list', [RoleAndPermissionController::class, 'userList'])->name('user-list');
    Route::get('add-user-form', [RoleAndPermissionController::class, 'addUserForm'])->name('add-user-form');
    Route::post('add-user', [RoleAndPermissionController::class, 'addUser'])->name('add-user');
    Route::get('edit-user/{id}', [RoleAndPermissionController::class, 'editUser'])->name('edit-user');
    Route::post('update-user/{id}', [RoleAndPermissionController::class, 'updateUser'])->name('update-user');
    Route::get('delete-user/{id}', [RoleAndPermissionController::class, 'deleteUser'])->name('delete-user');

    // Permission Route
    Route::get('add-permission-form', [RoleAndPermissionController::class, 'addPermissionForm'])->name('add-permission-form');
    Route::post('add-permission', [RoleAndPermissionController::class, 'addPermission'])->name('add-permission');
    Route::get('roles', [RoleAndPermissionController::class, 'roleList'])->name('roles');
    Route::get('add-role-form', [RoleAndPermissionController::class, 'addRoleForm'])->name('add-role-form');
    Route::post('add-role', [RoleAndPermissionController::class, 'addRole'])->name('add-role');
    Route::get('assign-permissions-to-role/{role_name}', [RoleAndPermissionController::class, 'assignPermissionForm'])->name('assign-permissions-to-role');
    Route::post('assign-permissions', [RoleAndPermissionController::class, 'assignPermissions'])->name('assign-permissions');

    // Project Routes
    Route::get('projects', [ProjectController::class, 'index'])->name('projects');
    Route::get('projects/create', [ProjectController::class, 'create'])->name('projects.create');
    Route::post('projects/store', [ProjectController::class, 'store'])->name('projects.store');
    Route::get('projects/edit/{id}', [ProjectController::class, 'edit'])->name('projects.edit');
    Route::post('projects/update/{id}', [ProjectController::class, 'update'])->name('projects.update');
    Route::get('projects/delete/{id}', [ProjectController::class, 'destroy'])->name('projects.delete');
    Route::post('projects/status/{id}', [ProjectController::class, 'updateStatus'])->name('projects.status');
});
