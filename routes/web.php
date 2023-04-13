<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ScrepingController;
use App\Http\Controllers\CsvFileController;

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