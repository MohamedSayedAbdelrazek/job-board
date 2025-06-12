<?php

use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\PostApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::apiResource('posts',PostApiController::class)->middleware('auth:api');

Route::prefix('auth')->group(function(){
    Route::post('/login',[AuthController::class,'login']);

    //only if i am authorized with JWT
    Route::middleware('auth:api')->group(function(){
        Route::post('/refresh',[AuthController::class,'refresh']);
        Route::post('/logout',[AuthController::class,'logout']);
        Route::get('me',[AuthController::class,'me']);
    });
});