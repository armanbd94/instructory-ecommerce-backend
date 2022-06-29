<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function(){
    Route::post('backend/login',[\App\Http\Controllers\API\V1\Backend\AuthController::class,'login']);

    Route::post('frontend/login',[\App\Http\Controllers\API\V1\Frontend\AuthController::class,'login']);

    Route::group(['middleware' => 'jwt.verify'],function(){
        
        Route::prefix('backend')->group(function(){
            Route::get('profile',[\App\Http\Controllers\API\V1\Backend\AuthController::class,'profile']);
        });

        Route::prefix('frontend')->group(function(){
            Route::get('profile',[\App\Http\Controllers\API\V1\Frontend\AuthController::class,'profile']);
        });
    });
});

