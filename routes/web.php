<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\IndexController;

Route::get('/',[IndexController::class,'index'])->name('index');
Route::get('/about',[IndexController::class,'about'])->name('about');
Route::get('/contact',[IndexController::class,'contact'])->name('contact');

//Route::get('jobs',[JobController::class,'index']);


