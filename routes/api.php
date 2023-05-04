<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/settings', function () {
    return \App\Models\Setting::all();
});
Route::get('categories', [\App\Http\Controllers\Api\CategoryController::class, 'index']);
Route::get('categories/{id}', [\App\Http\Controllers\Api\CategoryController::class, 'show']);
Route::get('useful-links', [\App\Http\Controllers\Api\UsefulLinkController::class, 'index']);
Route::get('useful-links/{id}', [\App\Http\Controllers\Api\UsefulLinkController::class, 'show']);
Route::get('settings', [\App\Http\Controllers\Api\UsefulLinkController::class, 'index']);
Route::get('settings/{id}', [\App\Http\Controllers\Api\SettingsController::class, 'show']);
