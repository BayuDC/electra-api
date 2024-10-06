<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CartController;
use App\Http\Middleware\OnlyAdmin;
use App\Http\Middleware\OnlyUser;

Route::get('/', function () {
    return response()->json(['message' => 'Hello World!']);
});

Route::prefix('/auth')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
    Route::get('/me', [AuthController::class, 'me'])->middleware('auth:sanctum');
});
Route::prefix('/oauth')->middleware('web')->group(function () {
    Route::get('/google', [AuthController::class, 'googleRedirect']);
    Route::get('/google/callback', [AuthController::class, 'googleCallback']);
});

Route::get('/products', [ProductController::class, 'index']);
Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/products/{product}', [ProductController::class, 'show']);
Route::get('/categories/{category}', [CategoryController::class, 'show']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::middleware(OnlyAdmin::class)->group(function () {
        Route::post('/products', [ProductController::class, 'store']);
        Route::put('/products/{product}', [ProductController::class, 'update']);
        Route::delete('/products/{product}', [ProductController::class, 'destroy']);

        Route::post('/categories', [CategoryController::class, 'store']);
        Route::put('/categories/{category}', [CategoryController::class, 'update']);
        Route::delete('/categories/{category}', [CategoryController::class, 'destroy']);
    });

    Route::middleware(OnlyUser::class)->group(function () {
        Route::get('/cart', [CartController::class, 'index']);
        Route::patch('/cart', [CartController::class, 'update']);
    });
});
