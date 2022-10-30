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
use App\Http\Controllers\Master\vendorMaster;
use App\Http\Controllers\Master\taxMaster;
use App\Http\Controllers\Master\custMaster;
use App\Http\Controllers\Master\userMaster;
use App\Http\Controllers\Master\openStock;
use App\Http\Controllers\Master\pmtinclexclMaster;
use App\Http\Controllers\Master\itemtaxMaster;


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
Route::post('pointofsaleMobile_change',[PointofSale::class, 'posCustomerData'])->name('pointofsaleMobile_change');
Route::post('pointofsale_store',[PointofSale::class, 'store'])->name('pointofsale_store');

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

Route::get('item_master', [itemMaster::class, 'list'])->name('item_master');
Route::get('item_master_add', [itemMaster::class, 'index'])->name('item_master_add');
Route::post('item_master_cate', [itemMaster::class, 'subCategory'])->name('item_master_cate');
Route::post('item_master_brand', [itemMaster::class, 'itemBrand'])->name('item_master_brand');
Route::post('item_master_store', [itemMaster::class, 'store'])->name('item_master_store');
Route::get('item_master_pdf', [itemMaster::class, 'itemMasterPdf'])->name('item_master_pdf');
Route::post('item_master_excel', [itemMaster::class, 'itemMasterExcel'])->name('item_master_excel');

Route::get('vendor_master', [vendorMaster::class, 'index'])->name('vendor_master');
Route::post('vendor_city_change', [vendorMaster::class, 'vendorCityChange'])->name('vendor_city_change');
Route::post('vendor_master_store', [vendorMaster::class, 'store'])->name('vendor_master_store');
Route::get('vendor_master_pdf', [vendorMaster::class, 'vendorPdf'])->name('vendor_master_pdf');
Route::post('vendor_master_excel', [vendorMaster::class, 'vendorMasterExcel'])->name('vendor_master_excel');

Route::get('tax_master', [taxMaster::class, 'index'])->name('tax_master');
Route::post('tax_master_store',[taxMaster::class, 'store'])->name('tax_master_store');
Route::get('tax_master_pdf', [taxMaster::class, 'taxPdf'])->name('tax_master_pdf');
Route::post('tax_master_excel', [taxMaster::class, 'taxMasterExcel'])->name('tax_master_excel');

Route::get('customer_master', [custMaster::class, 'index'])->name('customer_master');
Route::post('customer_master_city', [custMaster::class, 'cityChange'])->name('customer_master_city');
Route::post('customer_master_store', [custMaster::class, 'store'])->name('customer_master_store');
Route::get('cust_master_pdf', [custMaster::class, 'custPdf'])->name('cust_master_pdf');
Route::post('cust_master_excel', [custMaster::class, 'custMasterExcel'])->name('cust_master_excel');

Route::get('user_master', [userMaster::class, 'index'])->name('user_master');
Route::post('user_master_store',[userMaster::class,'store'])->name('user_master_store');
Route::get('user_master_pdf', [userMaster::class, 'userPdf'])->name('user_master_pdf');
Route::post('user_master_excel',[userMaster::class,'userMasterExcel'])->name('user_master_excel');

Route::get('open_stock', [openStock::class, 'index'])->name('open_stock');
Route::post('open_stock_store', [openStock::class, 'store'])->name('open_stock_store');
Route::post('get_barcode_data', [openStock::class, 'getBarcode'])->name('get_barcode_data');

Route::get('payment_group_master',[pmtinclexclMaster::class, 'index'])->name('payment_group_master');
Route::post('pmt_incl_excl_master_post', [pmtinclexclMaster::class, 'store'])->name('pmt_incl_excl_master_post');
Route::post('trans_type_change',[pmtinclexclMaster::class, 'trnasTypeChange'])->name('trans_type_change');

Route::get('item_tax_master',[itemtaxMaster::class,'index'])->name('item_tax_master');
Route::post('item_tax_master_post',[itemtaxMaster::class,'store'])->name('item_tax_master_post');
