<?php

use App\Http\Controllers\Api\ArticleApiController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboardcontroller;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ArticleImportController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\MediaController;

Route::get('/', function () {
    return view('welcome');
});

// Protected routes for authenticated users
Route::middleware('auth')->group(function () {

    /**
     * Role-based redirection after login
     */
    Route::get('/redirect', function () {
        $user = auth()->user();

        return strtolower(trim($user->role)) === 'admin'
            ? redirect()->route('dashboard')
            : redirect()->route('articles.client');
    })->name('redirect');

    /**
     * Dashboard (admin only)
     */
    Route::get('/dashboard', [Dashboardcontroller::class, 'index'])
        ->middleware('admin')
        ->name('dashboard');

    /**
     * Client-only article view
     */
    Route::get('/articles/client', [ArticleController::class, 'clientIndex'])
        ->name('articles.client');

    /**
     * Profile management
     */
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    /**
     * Article routes
     */
        Route::middleware('admin')->group(function () {
        Route::resource('articles', ArticleController::class)->except(['show']);
        Route::get('/articles/{article}/edit', [ArticleController::class, 'edit'])->name('articles.edit');
        Route::put('/articles/{article}', [ArticleController::class, 'update'])->name('articles.update');
        Route::put('/articles/{id}/softdelete', [ArticleController::class, 'softDelete'])->name('articles.softdelete');

        // Article import (admin only)
        Route::view('/articles/import', 'articles.import')->name('articles.import.form');
        Route::post('/articles/import', [ArticleController::class, 'import'])->name('articles.import');


    });

    // Allow all authenticated users to view articles
    Route::get('/articles/{article}', [ArticleController::class, 'show'])->name('articles.show');

    /**
     * User routes (admin only)
     */
        Route::middleware('admin')->group(function () {
        Route::resource('users', UserController::class)->except(['edit', 'update']);
    });

    /**
     * Media (authenticated users)
     */
    Route::resource('media', MediaController::class);

    /**
     * Chat (authenticated users)
     */
    Route::post('/chat/send', [ChatController::class, 'send']);

    /**
     * Debug (optional)
     */
    Route::get('/debug', fn () => 'routes are working!');
});

require __DIR__ . '/auth.php';
