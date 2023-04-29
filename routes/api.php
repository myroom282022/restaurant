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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
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
        Route::get('payment-list', 'paymentList')->name('payment-list');
    });
});

