<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ModuleController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'register']);

Route::get('/modules', [ModuleController::class, 'index']);

Route::post('/modules/{id}/activate', [ModuleController::class, 'activate']);

Route::post('/modules/{id}/deactivate', [ModuleController::class, 'deactivate']);

