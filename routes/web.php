<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PanelController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\AdminController;

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

Route::get('dashboard', [CustomAuthController::class, 'dashboard']); 
Route::get('login', [CustomAuthController::class, 'index'])->name('login');
Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom'); 
Route::get('registration', [CustomAuthController::class, 'registration'])->name('register-user');
Route::post('custom-registration', [CustomAuthController::class, 'customRegistration'])->name('register.custom'); 
Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');

//Route::get('/', function () {
  //  return view('welcome');
//});
Route::get('/', [CustomAuthController::class, 'index'])->name('login');

Route::get('/panel/myaccount', function () {
    return view('myaccount');
});

Route::get('admin', function () {
    return view('admin');
});

Route::get('/admin',  [AdminController::class,'index'])->name('admin_access');

Route::get('/panel/thankyou', function () {
    return view('thankyou');
});

Route::get('/panel/reports', function () {
    return view('reports');
});
Route::get('/panel/addticket',  [PanelController::class,'addTicket'])->name('panel_access');
Route::get('/panel/myaccount',  [PanelController::class,'myAccount']);
Route::get('/panel/{panel}', [PanelController::class,'show']);
Route::post('/panel/assign', [PanelController::class,'assign'])->name('panel.assign');

Route::post('panel/request', [PanelController::class, 'ajaxRequest'])->name('panel.request');
Route::post('panel/orderrequest', [PanelController::class, 'ajaxOrderRequest'])->name('panel.orderrequest');
Route::post('panel/fileupload', [PanelController::class, 'ajaxFileUpload'])->name('panel.fileupload');
Route::get('/panel/thankyou',  [PanelController::class,'thankyou'])->name('panel.thankyou');

 
Route::resource('panel', PanelController::class);
Route::resource('department', DepartmentController::class);
Route::post('department/store', [PanelController::class, 'store'])->name('department.request');

