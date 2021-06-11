<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PanelController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\MailController;

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

//Route::get('/', function () {
  //  return view('welcome');
//});
Route::get('/', function () {
    return view('panel');
});

Route::get('/panel/myaccount', function () {
    return view('myaccount');
});

Route::get('/panel/reports', function () {
    return view('reports');
});
Route::get('/panel/addticket',  [PanelController::class,'addTicket'])->name('panel_access');
Route::get('/panel/myaccount',  [PanelController::class,'myAccount']);
Route::get('/panel/{panel}', [PanelController::class,'show']);
Route::post('/panel/assign', [PanelController::class,'assign'])->name('panel.assign');

Route::post('panel/request', [PanelController::class, 'ajaxRequest'])->name('panel.request');

 
Route::resource('panel', PanelController::class);
Route::resource('department', DepartmentController::class);
Route::post('department/store', [PanelController::class, 'store'])->name('department.request');
