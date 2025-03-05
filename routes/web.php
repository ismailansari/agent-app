<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;

use App\Http\Controllers\Agent\DashboardController;
use App\Http\Controllers\Agent\UserController as AgentUserController;
use App\Http\Controllers\Agent\ProfileController as AgentProfileController;

use App\Http\Controllers\Author\PostController as AuthorPostController;
use App\Http\Controllers\Author\DashboardController as AuthorDashboardController;

Route::get('home', [HomeController::class, 'index'])->name('home.index');
Route::middleware('auth')->prefix('agent')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::resource('users', AdminUserController::class);
    Route::resource('profile', AdminProfileController::class)->only(['edit', 'update']);
});

require __DIR__.'/auth.php';
