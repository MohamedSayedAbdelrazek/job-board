<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\PostController;

Route::get('/',[IndexController::class,'index'])->name('index');
Route::get('/about',[IndexController::class,'about'])->name('about');
Route::get('/contact',[IndexController::class,'contact'])->name('contact');

//Route::get('jobs',[JobController::class,'index']);

Route::resource('/posts',PostController::class);

Route::controller(AuthController::class)->group(function(){
    Route::get('/signup','showSignupForm');
    Route::post('/signup','signup')->name('signup');

    Route::get('/login', 'showLoginForm');
    Route::post('/login', 'login')->name('login');
    Route::post('/logout', 'logout')->name('logout');
});