<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FilmController;
use Illuminate\Support\Facades\Route;

// Redirect Home to Films Index
Route::get('/', [FilmController::class, 'index']);

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Film Discovery Routes
Route::get('/films', [FilmController::class, 'index'])->name('films.index');
Route::get('/films/detail/{id}', [FilmController::class, 'show'])->name('films.show');
Route::get('/films/watch/{id}', [FilmController::class, 'watch'])->name('films.watch');

// Admin Routes (Protected by logical check in Controller, or can use middleware)
Route::middleware(['auth'])->group(function () {
    Route::get('/films/manage', [FilmController::class, 'manage'])->name('films.manage');
    Route::get('/films/create', [FilmController::class, 'create'])->name('films.create');
    Route::post('/films/store', [FilmController::class, 'store'])->name('films.store');
    Route::delete('/films/{id}', [FilmController::class, 'destroy'])->name('films.destroy');
    Route::put('/films/{id}', [FilmController::class, 'update'])->name('films.update');

    // Comments
    Route::post('/films/{id}/comments', [\App\Http\Controllers\CommentController::class, 'store'])->name('comments.store');
    Route::delete('/comments/{id}', [\App\Http\Controllers\CommentController::class, 'destroy'])->name('comments.destroy');

    // Comment Likes
    Route::post('/comments/{id}/like', [\App\Http\Controllers\CommentLikeController::class, 'toggle'])->name('comments.like');
});
