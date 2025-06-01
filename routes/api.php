<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\Api\MeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// API v1 routes matching Express.js structure
Route::prefix('v1')->group(function () {

    // Authentication routes with rate limiting
    Route::prefix('auth')->middleware('throttle:5,1')->group(function () {
        Route::post('/register', [AuthController::class, 'register']);
        Route::post('/login', [AuthController::class, 'login']);
        Route::delete('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
    });

    // Protected routes
    Route::middleware('auth:sanctum')->group(function () {

        // Tasks routes
        Route::prefix('tasks')->group(function () {
            Route::post('/', [TaskController::class, 'store']);
            Route::get('/', [TaskController::class, 'index']); // Note: expects 'date' in request body
            Route::put('/{id}', [TaskController::class, 'update']);
            Route::delete('/{id}', [TaskController::class, 'destroy']);
        });

        // Me routes (user profile)
        Route::prefix('me')->group(function () {
            Route::get('/', [MeController::class, 'show']);
            Route::put('/', [MeController::class, 'update']);
        });
    });
});
