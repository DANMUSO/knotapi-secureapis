<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('register', [App\Http\Controllers\API\AuthController::class, 'register']);

Route::post('login', [App\Http\Controllers\API\AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::resource('addcard', App\Http\Controllers\API\CardController::class);
    Route::resource('addmerchant', App\Http\Controllers\API\MerchantController::class);
    Route::resource('getmerchants', App\Http\Controllers\API\MerchantController::class);
    Route::resource('addtask', App\Http\Controllers\API\CardSwitcherController::class);
    Route::post('finishedtask', [App\Http\Controllers\API\CardSwitcherController::class, 'gettasks']);

});


