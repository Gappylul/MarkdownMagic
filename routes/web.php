<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\BlogController;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [BlogController::class, 'dashboard'])->name('dashboard');

    // Blog routes
    Route::get('/blogs', [BlogController::class, 'index'])->name('blog.index');
    Route::get('/blog/editor', [BlogController::class, 'editor'])->name('blog.editor');
    Route::post('/blog', [BlogController::class, 'store'])->name('blog.store');
    Route::get('/blog/{blog}/edit', [BlogController::class, 'edit'])->name('blog.edit');
    Route::put('/blog/{blog}', [BlogController::class, 'update'])->name('blog.update');
    Route::delete('/blog/{blog}', [BlogController::class, 'destroy'])->name('blog.destroy');
    Route::get('/blogs/{user:name}/{blog:slug}', [BlogController::class, 'show'])->name('blog.show');
});

Route::get('/debug', function () {
    return Inertia::render('Welcome', [
        'debug' => 'test'
    ]);
})->name('debug');