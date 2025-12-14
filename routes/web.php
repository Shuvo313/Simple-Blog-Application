<?php

use App\Http\Controllers\FrontendController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PostController;
use Illuminate\Support\Facades\Route;

/*
| Public
*/
Route::get('/', [FrontendController::class,'home'])->name('home');
Route::get('/blogs', [FrontendController::class,'index'])->name('blogs.index'); // optional full listing
Route::get('/blog/{slug}', [FrontendController::class,'show'])->name('blogs.show');
Route::get('/category/{slug}', [FrontendController::class,'category'])->name('categories.show');

/*
| Auth (custom)
*/
Route::get('/register', [AuthController::class,'showRegister'])->name('register.show');
Route::post('/register', [AuthController::class,'register'])->name('register');
Route::get('/login', [AuthController::class,'showLogin'])->name('login.show');
Route::post('/login', [AuthController::class,'login'])->name('login');
Route::post('/logout', [AuthController::class,'logout'])->name('logout');

/*
| Admin - group protected by middleware
*/
Route::prefix('admin')->name('admin.')->middleware(['auth.session','admin'])->group(function(){
    Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard');

    Route::resource('categories', CategoryController::class)->except(['show']);
    Route::resource('posts', PostController::class)->except(['show']);
});
