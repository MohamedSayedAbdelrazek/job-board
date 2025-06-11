<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\PostController;


//Route::get('jobs',[JobController::class,'index']);


//Public Routes
Route::get('/',[IndexController::class,'index'])->name('index');

Route::get('/contact',[IndexController::class,'contact'])->name('contact');

Route::controller(AuthController::class)->group(function(){
    Route::get('/signup','showSignupForm');
    Route::post('/signup','signup')->name('signup');

    Route::get('/login', 'showLoginForm');
    Route::post('/login', 'login')->name('login');
    Route::post('/logout', 'logout')->name('logout');
});


//Protected Routes
Route::middleware('auth')->group(function(){
    Route::resource('/posts',PostController::class);
});

Route::middleware('onlyMe')->group(function(){
    Route::get('/about',[IndexController::class,'about'])->name('about');
});

