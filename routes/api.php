<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::fallback(function () {
    return response()->json('404');
});
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/settings', function () {
    return \App\Models\Setting::all();
});
Route::post('contact', [\App\Http\Controllers\Api\ContactController::class, 'store']);
Route::get('categories', [\App\Http\Controllers\Api\CategoryController::class, 'index']);
Route::get('categories/{id}', [\App\Http\Controllers\Api\CategoryController::class, 'show']);
Route::get('useful-links', [\App\Http\Controllers\Api\UseFullinkController::class, 'index']);
Route::get('useful-links/{id}', [\App\Http\Controllers\Api\UseFullinkController::class, 'show']);
Route::get('settings', [\App\Http\Controllers\Api\SettingsController::class, 'index']);
Route::get('settings/{name}', [\App\Http\Controllers\Api\SettingsController::class, 'show']);
Route::get('about', [\App\Http\Controllers\Api\AboutController::class, 'index']);
Route::get('about/{id}', [\App\Http\Controllers\Api\AboutController::class, 'show']);
Route::get('gallery', [\App\Http\Controllers\Api\GalleryController::class, 'index']);
Route::get('gallery/{id}', [\App\Http\Controllers\Api\GalleryController::class, 'show']);
