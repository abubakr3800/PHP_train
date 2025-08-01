<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/he/{name}' , function($ne){
    return view('hello' , ["n" => $ne]);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

use App\Http\Controllers\ArticleController;

Route::resource('articles', ArticleController::class);

Route::middleware(['auth'])->group(function () {
    // Route::get('/articles', [ArticleController::class, 'index']);
    // Route::get('/articles/create', [ArticleController::class, 'create']);
    // Route::post('/articles', [ArticleController::class, 'store']);
    // Route::get('/articles/{id}/edit', [ArticleController::class, 'edit']);
    // Route::put('/articles/{id}', [ArticleController::class, 'update']);
    // Route::delete('/articles/{id}', [ArticleController::class, 'destroy']);
    // Route::put('/articles/{id}', [ArticleController::class, 'update'])->name('articles.update');
});