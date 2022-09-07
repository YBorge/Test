<?php
  
use Illuminate\Support\Facades\Route;
  
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Master\companyMaster;
use App\Http\Controllers\Master\branchMaster;
use App\Http\Controllers\Master\PointofSale;

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

Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('post-login', [AuthController::class, 'postLogin'])->name('login.post'); 
Route::get('registration', [AuthController::class, 'registration'])->name('register');
Route::post('post-registration', [AuthController::class, 'postRegistration'])->name('register.post'); 
Route::get('dashboard', [AuthController::class, 'dashboard']); 
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('company_master', [companyMaster::class, 'index'])->name('company_master');
Route::post('company_master_post', [companyMaster::class, 'store'])->name('company_master_post');
Route::post('company_master_city', [companyMaster::class, 'cityChange'])->name('company_master_city');

Route::get('pointofsale', [PointofSale::class, 'index'])->name('pointofsale');

Route::get('branch_master', [branchMaster::class, 'index'])->name('branch_master');
Route::post('branch_master_post', [branchMaster::class, 'store'])->name('branch_master_post');