<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\PostController;

Route::get('/',[IndexController::class,'index'])->name('index');
Route::get('/about',[IndexController::class,'about'])->name('about');
Route::get('/contact',[IndexController::class,'contact'])->name('contact');

//Route::get('jobs',[JobController::class,'index']);

Route::get('/posts',[PostController::class,'index'])->name('posts.index');

Route::get('/posts/create',[PostController::class,'create'])->name('posts.create');
