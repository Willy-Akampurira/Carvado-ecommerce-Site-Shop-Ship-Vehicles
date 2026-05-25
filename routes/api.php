<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\{
    AuthController,
    CarController,
    CartController,
    OrderController,
    PaymentController,
    WishlistController,
    UserController
};

Route::prefix('v1')->group(function () {
    // --- Public Routes ---
    
    // Original Auth Routes (Plan A)
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);

    // Hybrid Auth Route (Plan B)
    // This allows the Flutter app to "handshake" with Laravel after Firebase sign-up
    Route::post('sync-firebase-user', [AuthController::class, 'syncFirebaseUser']);

    // --- Protected Routes ---
    Route::middleware('auth:sanctum')->group(function () {
        // Auth management
        Route::post('logout', [AuthController::class, 'logout']);

        // User profile
        Route::get('user', [UserController::class, 'index']);
        Route::put('user', [UserController::class, 'update']);
        Route::delete('user', [UserController::class, 'destroy']);

        // Admin-only user management
        Route::post('users', [UserController::class, 'store']);
        Route::get('users/{id}', [UserController::class, 'show']);

        // Core resources
        Route::apiResource('cars', CarController::class);
        Route::apiResource('cart', CartController::class);
        Route::apiResource('orders', OrderController::class);
        Route::apiResource('payments', PaymentController::class);
        Route::apiResource('wishlist', WishlistController::class);
    });
});