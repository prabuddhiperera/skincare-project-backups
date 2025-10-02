<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminReviewController;

// ----------------------
// Authenticated User Info
// ----------------------
Route::get('/user', fn(Request $request) => $request->user())
    ->middleware('auth:sanctum');

// ----------------------
// Public Authentication
// ----------------------
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// ----------------------
// Routes Requiring Auth
// ----------------------
Route::middleware('auth:sanctum')->group(function () {

    // Logout
    Route::post('/logout', [AuthController::class, 'logout']);

    // Products (CRUD)
    Route::apiResource('products', ProductController::class);

    // Categories (CRUD)
    Route::apiResource('categories', CategoryController::class);

    // Orders (customers create, admins manage)
    Route::apiResource('orders', OrderController::class);

    // Order Items (CRUD)
    Route::apiResource('order-items', OrderItemController::class);

    // Reviews (CRUD)
    Route::apiResource('reviews', ReviewController::class);

    // Payments (admin only should manage update/destroy)
    Route::apiResource('payments', PaymentController::class);
});


// ----------------------
// Admin (Customers CRUD API)
// ----------------------
Route::prefix('admin')->group(function () {
    Route::get('/customers', [AdminController::class, 'apiCustomers']);
    Route::post('/customers', [AdminController::class, 'storeCustomer']);
    Route::get('/customers/{id}', [AdminController::class, 'apiShowCustomer']);
    Route::put('/customers/{id}', [AdminController::class, 'updateCustomer']);
    Route::delete('/customers/{id}', [AdminController::class, 'deleteCustomer']);
});

Route::prefix('orders')->group(function () {
    Route::get('/', [OrderController::class, 'apiIndex']);
    Route::get('/{order}', [OrderController::class, 'apiShow']);
    Route::post('/', [OrderController::class, 'apiStore']);
    Route::put('/{order}', [OrderController::class, 'apiUpdate']);
    Route::delete('/{order}', [OrderController::class, 'apiDestroy']);
});

//PRODUCTS
Route::prefix('admin')->group(function () {
    Route::get('products', [ProductController::class, 'index']);       // List all products
    Route::get('products/{id}', [ProductController::class, 'show']);   // Show a single product
    Route::post('products', [ProductController::class, 'store']);      // Create a product
    Route::put('products/{id}', [ProductController::class, 'update']); // Update a product
    Route::delete('products/{id}', [ProductController::class, 'destroy']); // Delete a product
});

// Admin Reviews API routes
Route::prefix('admin')->group(function () {

    // Get all reviews
    Route::get('/reviews', [AdminReviewController::class, 'index']);

    // Get a single review
    Route::get('/reviews/{id}', [AdminReviewController::class, 'show']);

    // Create a review
    Route::post('/reviews', [AdminReviewController::class, 'store']);

    // Update a review
    Route::put('/reviews/{id}', [AdminReviewController::class, 'update']);

    // Delete a review
    Route::delete('/reviews/{id}', [AdminReviewController::class, 'destroy']);

});