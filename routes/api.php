<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/blogs', [BlogController::class, 'store']);
    Route::post('/blogs/drafts', [BlogController::class, 'storeDraft']);
    Route::get('/blogs/{username}/{slug}', [BlogController::class, 'show']);
});
