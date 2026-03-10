<?php

use App\Http\Controllers\AuthController;
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
Route::post('store-login', [AuthController::class, 'storeLogin'])->name('store.login');
Route::get('company-register', [AuthController::class, 'companyRegister'])->name('company.register');
Route::post('company-store-register', [AuthController::class, 'companyStoreRegister'])->name('company.store.register');
