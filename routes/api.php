<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProvinceController;
use App\Http\Controllers\Api\CityController;
use App\Http\Controllers\Api\DistrictController;

// District
Route::get('/district', [DistrictController::class, 'index']);
Route::get('/district/city/{city_id}', [DistrictController::class, 'byCity']);

Route::post('/district', [DistrictController::class, 'create']);

Route::get('/district/{id}', [DistrictController::class, 'detail']);

Route::put('/district/{id}', [DistrictController::class, 'update']);

Route::delete('/district/{id}', [DistrictController::class, 'delete']);

// LOGIN (tidak perlu token)
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {

    // AUTH
    Route::get('/me', [AuthController::class, 'me']);
    Route::get('/refresh', [AuthController::class, 'refresh']);
    Route::post('/logout', [AuthController::class, 'logout']);

    // =========================
    // PROVINCE
    // =========================

    Route::get('/province', [ProvinceController::class, 'index']);

    Route::post('/province', [ProvinceController::class, 'create']);

    Route::get('/province/{id}', [ProvinceController::class, 'detail']);

    Route::put('/province/{id}', [ProvinceController::class, 'update']);

    Route::patch('/province/{id}', [ProvinceController::class, 'patch']);

    Route::delete('/province/{id}', [ProvinceController::class, 'delete']);

    // =========================
    // CITY
    // =========================

    Route::get('/city', [CityController::class, 'index']);

    Route::get(
        '/city/province/{province_id}',
        [CityController::class, 'byProvince']
    );

    Route::post('/city', [CityController::class, 'create']);

    Route::get('/city/{id}', [CityController::class, 'detail']);

    Route::put('/city/{id}', [CityController::class, 'update']);

    Route::delete('/city/{id}', [CityController::class, 'delete']);
    
});
