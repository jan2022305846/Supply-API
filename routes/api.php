<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\LogController;

//AUTH
Route::post('/login', [AuthController::class, 'login']);
Route::post('/forgot-password', [AuthController::class, 'forgot']);
Route::post('/reset-password', [AuthController::class, 'reset']);
Route::post('/refresh-token', [AuthController::class, 'refreshToken'])->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {
    // User Auth
    Route::get('/user', [AuthController::class, 'user']);
    Route::post('/logout', [AuthController::class, 'logout']);
    
    // Users
    Route::apiResource('users', UserController::class);
    
    // Categories
    Route::apiResource('categories', CategoryController::class);
    
    // Items
    Route::get('/items/search', [ItemController::class, 'search']);
    Route::get('/items/low-stock', [ItemController::class, 'lowStock']); 
    Route::get('/items/category/{categoryId}', [ItemController::class, 'byCategory']);
    Route::get('/items/expiring-soon', [ItemController::class, 'expiringSoon']);
    Route::get('/items/trashed', [ItemController::class, 'trashed']);
    Route::post('/items/{id}/restore', [ItemController::class, 'restore']);
    Route::apiResource('items', ItemController::class);
    // Requests
    Route::get('/requests', [RequestController::class, 'index']);
    Route::get('/my-requests', [RequestController::class, 'myRequests']);
    Route::post('/requests', [RequestController::class, 'store']);
    Route::put('/requests/{id}/status', [RequestController::class, 'updateStatus']);
    
    // Logs
    Route::get('/logs', [LogController::class, 'index']);
    Route::post('/logs', [LogController::class, 'store']);
});