<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\V1\Backend\BrandController;

Route::prefix('v1')->group(function(){
    Route::post('backend/login',[\App\Http\Controllers\API\V1\Backend\AuthController::class,'login']);

    Route::post('frontend/login',[\App\Http\Controllers\API\V1\Frontend\AuthController::class,'login']);

    Route::group(['middleware' => 'jwt.verify'],function(){
        
        Route::prefix('backend')->group(function(){
            Route::get('profile',[\App\Http\Controllers\API\V1\Backend\AuthController::class,'profile']);
            Route::post('change-password',[\App\Http\Controllers\API\V1\Backend\AuthController::class,'change_password']);

            Route::apiResource('brands',BrandController::class);
        });

        Route::prefix('frontend')->group(function(){
            Route::get('profile',[\App\Http\Controllers\API\V1\Frontend\AuthController::class,'profile']);
        });
    });
});

