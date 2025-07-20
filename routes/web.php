<?php

use App\Http\Controllers\Dashboardcontroller;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Usercontroller;
use App\Http\Controllers\ArticleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {

    // Role-based redirect after login
    Route::get('/redirect', function () {
        $user = auth()->user();

        if (strtolower(trim($user->usertype)) === 'admin') {
            return redirect()->route('dashboard');
        }

        return redirect()->route('articles.client');
    })->name('redirect');

    // Dashboard - protected by custom 'admin' middleware
    Route::get('/dashboard', [Dashboardcontroller::class,'index'])
        ->middleware('admin')
        ->name('dashboard');

    // Client-only article view
    Route::get('/articles/client', [ArticleController::class, 'clientIndex'])
        ->name('articles.client');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Articles
    Route::resource('articles', ArticleController::class)->except(['edit', 'update']);
    Route::get('/articles/{article}/edit', [ArticleController::class, 'edit'])->name('articles.edit');
    Route::put('/articles/{article}', [ArticleController::class, 'update'])->name('articles.update');
    Route::put('/articles/{id}/softdelete', [ArticleController::class, 'softDelete'])->name('articles.softdelete');

    // Users
    Route::get('/users', [UserController::class, 'index'])->name('users.index');

    // Debug route
    Route::get('/debug', fn () => 'routes are working!');

    Route::post('/chat/send', [ChatController::class, 'send']);
    Route::resource('media', 'App\Http\Controllers\MediaController');
    Route::resource('users', UserController::class)->except(['edit', 'update']);

});

require __DIR__.'/auth.php';
