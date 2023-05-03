<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/settings',function (){
    return \App\Models\Setting::all();
});
Route::get('categories',[\App\Http\Controllers\Api\CategoryController::class,'index']);
