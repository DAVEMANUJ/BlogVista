<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\BlogController as AdminBlogController;
use App\Http\Middleware\AdminAuthenticate;

// Public routes
Route::get('/', [BlogController::class, 'home'])->name('home');
Route::get('/blogs', [BlogController::class, 'index'])->name('blogs.index');
Route::get('/blogs/{slug}', [BlogController::class, 'show'])->name('blogs.show');

// Admin Auth
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Admin Protected routes
    Route::middleware([AdminAuthenticate::class])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        
        // Admin Blog Management
        Route::resource('blogs', AdminBlogController::class);
        Route::post('blogs/{blog}/toggle', [AdminBlogController::class, 'toggle'])->name('blogs.toggle');
    });
});