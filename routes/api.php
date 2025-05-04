<?php

use App\Http\Controllers\Api\V1\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\CustomerController;
use App\Http\Controllers\Api\V1\InvoiceController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//api/V1
Route::group(['prefix' => 'v1'], function(){
    Route::post('/login', [UserController::class, 'login']);
    Route::get('/login', [UserController::class, 'login'])->name('login');
    Route::post('/signup', [UserController::class, 'signup']);
    Route::group(['middleware' => 'auth:sanctum'], function(){
        Route::apiResource('customers', CustomerController::class);
        Route::apiResource('invoices', InvoiceController::class);
    });
});

