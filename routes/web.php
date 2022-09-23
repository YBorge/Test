<?php
  
use Illuminate\Support\Facades\Route;
  
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Master\companyMaster;
use App\Http\Controllers\Master\branchMaster;
use App\Http\Controllers\Master\PointofSale;
use App\Http\Controllers\Master\cateMaster;
use App\Http\Controllers\Master\manufacturerBrandMaster;
use App\Http\Controllers\Master\paymentMaster;
use App\Http\Controllers\Master\itemMaster;

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

Route::get('cate_master', [cateMaster::class, 'index'])->name('cate_master');
Route::post('cate_master_post', [cateMaster::class, 'store'])->name('cate_master_post');
Route::post('sub_cate_master_post', [cateMaster::class, 'subCateSave'])->name('sub_cate_master_post');
Route::get('cate_master_pdf', [cateMaster::class, 'CatePDF'])->name('cate_master_pdf');
Route::get('sub_cate_master_pdf', [cateMaster::class, 'subcateMaster'])->name('sub_cate_master_pdf');
Route::post('cate_master_excel', [cateMaster::class, 'cateMasterExcel'])->name('cate_master_excel');
Route::post('sub_cate_master_excel', [cateMaster::class, 'sub_cate_master_excel'])->name('sub_cate_master_excel');

Route::get('brand_master', [manufacturerBrandMaster::class, 'index'])->name('brand_master');
Route::post('brand_master_post', [manufacturerBrandMaster::class, 'store'])->name('brand_master_post');
Route::post('sub_brand_master_post', [manufacturerBrandMaster::class, 'storeBrand'])->name('sub_brand_master_post');

Route::get('brand_master_pdf', [manufacturerBrandMaster::class, 'brandMasterPdf'])->name('brand_master_pdf');
Route::get('sub_brand_master_pdf', [manufacturerBrandMaster::class, 'subBrandMasterPdf'])->name('sub_brand_master_pdf');
Route::post('brand_master_excel', [manufacturerBrandMaster::class, 'brandMasterExcel'])->name('brand_master_excel');
Route::post('sub_brand_master_excel', [manufacturerBrandMaster::class, 'subBrandMasterExcel'])->name('sub_brand_master_excel');

Route::get('payment_master', [paymentMaster::class, 'index'])->name('payment_master');
Route::post('payment_master_post', [paymentMaster::class, 'store'])->name('payment_master_post');
Route::get('payment_master_pdf', [paymentMaster::class, 'paymentMasterPdf'])->name('payment_master_pdf');
Route::post('payment_master_excel', [paymentMaster::class, 'paymentMasterExcel'])->name('payment_master_excel');

Route::get('item_master', [itemMaster::class, 'index'])->name('item_master');