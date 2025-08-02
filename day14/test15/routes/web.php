<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/' , function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

use App\Http\Controllers\ArticleController;

// Public routes - anyone can view articles (no login required)
// Route::get('/', fn () => view('welcome')); // Homepage
Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index'); // List all articles
Route::get('/articles/{article}', [ArticleController::class, 'show'])->name('articles.show'); // View single article

// Protected CRUD routes - only authenticated users can access
Route::middleware(['auth'])->group(function () {
    // Resource routes for articles (create, store, edit, update, destroy)
    // except(['index', 'show']) means skip index and show routes (already defined above)
    Route::resource('articles', ArticleController::class)->except(['index', 'show']);
});