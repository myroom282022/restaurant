<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ScrepingController;
use App\Http\Controllers\CsvFileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\API\PaymentController;

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

Route::get('/', function () {
    return view('welcome');
});
Route::get('scrape',[ScrepingController::class,'index']);


Route::get('csv', [CsvFileController::class,'index']);
Route::post('csv', [CsvFileController::class,'upload_csv_records'])->name('store');


Route::controller(AuthController::class)->group(function(){
    Route::get('admin/login', 'login')->name('admin-login');
    Route::post('admin/login', 'storeLogin')->name('admin-login-store');
    Route::get('admin/register', 'register')->name('admin-register');
    Route::post('admin/register', 'storeRegister')->name('admin-register-store');

});

Route::group(['middleware' => 'is_admin', 'prefix' => 'admin'], function () {
    Route::get('logout',[AuthController::class,'logout'])->name('admin/login');
    Route::controller(DashboardController::class)->group(function(){
        Route::get('dashboard', 'index')->name('admin-dashboard');
    });

    Route::controller(UsersController::class)->prefix('users')->group(function(){
        Route::get('index', 'index')->name('admin-users');
    });
    Route::controller(PaymentController::class)->prefix('payments')->group(function(){
        Route::get('get-payment-list', 'index')->name('get-payment-list');
    });
});




