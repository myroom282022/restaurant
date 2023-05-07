<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\ShareTableController;
use App\Http\Controllers\API\PaymentController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// commond route----------------------------------------------
Route::get('/cleareverything', function () {
    $clearcache = Artisan::call('cache:clear');
    echo "Cache cleared<br>";

    $clearview = Artisan::call('view:clear');
    echo "View cleared<br>";

    $clearconfig = Artisan::call('config:cache');
    $clearconfig = Artisan::call('migrate --force');
    echo "Config cleared<br>";

});
Route::get('/clear-cache', function() {
    $run = Artisan::call('config:clear');
    $run = Artisan::call('cache:clear');
    $run = Artisan::call('config:cache');
    $run = Artisan::call('route:clear');
    $run = Artisan::call('view:clear');
    $run = Artisan::call('migrate');
    $run = Artisan::call('optimize:clear');
    return 'FINISHED';  
});
// commond route----------------------------------------------

Route::post('register', [RegisterController::class, 'register']);
Route::post('login', [RegisterController::class, 'login']);
     
Route::middleware('auth:api')->group( function () {
    Route::resource('products', ProductController::class);

    Route::controller(RegisterController::class)->group(function() {
        Route::post('get-user-Details/{id}', 'getUserDetails');
        Route::post('get-user-Details', 'getAllUserDetails');
        Route::post('user-profile', 'profile');
        Route::post('logout', 'logout');
    });
    Route::controller(ShareTableController::class)->group(function() {
        Route::post('share-table-create', 'shareTableCreate');
        Route::post('getall-table-list', 'getAll');
        Route::post('single-table-list/{id}', 'getAllOneTable');
    });
    Route::controller(PaymentController::class)->group(function(){
        Route::post('payment-create', 'paymentCreate')->name('payment-create');
        Route::get('user-payment-list', 'getPaymentUserList')->name('user-payment-list');
        Route::get('get-payment-list', 'getPaymentList')->name('get-payment-list');
    });
    

});

 