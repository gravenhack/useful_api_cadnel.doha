<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\ShortLinkController;
use App\Http\Middleware\CheckModuleActive;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/register', [AuthController::class, 'register']);

Route::post('/login', [AuthController::class, 'login']);

Route::post('/s/{code}', [AuthController::class, 'login']);



Route::middleware('auth:sanctum')->group(function () {

    Route::get('/modules', [ModuleController::class, 'index']);

    Route::post('/modules/{id}/activate', [ModuleController::class, 'activate']);

    Route::post('/modules/{id}/deactivate', [ModuleController::class, 'deactivate']);


    Route::middleware([CheckModuleActive::class])->group(function () {

        Route::post('/shorten', [ShortLinkController::class, 'deactivate']);

        Route::get('/links', [ShortLinkController::class, 'index']);

        Route::delete('/links/{id}', [ShortLinkController::class, 'delete']);

    });
});
