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

      //Admin
      route::middleware('role:admin')->group(function(){
          Route::get('/posts/create',[PostController::class,'create'])->name('posts.create');
          Route::post('/posts',[PostController::class,'store'])->name('posts.store');
          Route::delete('/posts/{id}',[PostController::class,'destroy'])->name('posts.destroy');
      });
      
    //Viewer, Editor, Admin
    route::middleware('role:viewer,editor,admin')->group(function(){
          Route::get('/posts',[PostController::class,'index'])->name('posts.index');
          Route::get('/posts/{id}',[PostController::class,'show'])->name('posts.show');
    });
  
   //Editor, Admin
   route::middleware('role:editor,admin')->group(function(){
    Route::get('/posts/{id}/edit',[PostController::class,'edit'])->name('posts.edit');
    Route::put('/posts/{id}',[PostController::class,'update'])->name('posts.update');
      });

     
   
    

   
  

});

Route::middleware('onlyMe')->group(function(){
    Route::get('/about',[IndexController::class,'about'])->name('about');
});

