<?php

use Illuminate\Support\Facades\Route;


// customer app route
Route::get("/menus", [\App\Http\Controllers\Api\MenuController::class, 'index']);
Route::get("/tables/{token}", [\App\Http\Controllers\Api\TableController::class, 'showByToken']);

Route::get('/restaurant', [App\Http\Controllers\Api\RestaurantController::class, 'show']);

Route::post('/orders', [\App\Http\Controllers\Api\OrderController::class, 'store']);
Route::get('/orders/{order_number}', [\App\Http\Controllers\Api\OrderController::class, 'show']);
Route::patch('/orders/{order}/cancel', [\App\Http\Controllers\Api\OrderController::class, 'cancel']);
Route::patch('/orders/{order_number}/pay', [\App\Http\Controllers\Api\OrderController::class, 'pay']);

Route::post(
    '/payments/{orderNumber}/payment',
    [\App\Http\Controllers\Api\PaymentController::class, 'createPayment']
);
Route::post(
    '/payments/midtrans/notification',
    [\App\Http\Controllers\Api\PaymentController::class, 'notification']
);

// admin route
Route::prefix('admin')->middleware(['auth:sanctum'])->group(function () {

    Route::get('/categories', [\App\Http\Controllers\Api\Admin\CategoryController::class, 'index']);
    Route::post('/categories', [\App\Http\Controllers\Api\Admin\CategoryController::class, 'store']);
    Route::get('/categories/{category}', [\App\Http\Controllers\Api\Admin\CategoryController::class, 'show']);
    Route::put('/categories/{category}', [\App\Http\Controllers\Api\Admin\CategoryController::class, 'update']);

    Route::get('/menus', [\App\Http\Controllers\Api\Admin\MenuController::class, 'index']);
    Route::post('/menus', [\App\Http\Controllers\Api\Admin\MenuController::class, 'store']);
    Route::get('/menus/{menu}', [\App\Http\Controllers\Api\Admin\MenuController::class, 'show']);
    Route::put('/menus/{menu}', [\App\Http\Controllers\Api\Admin\MenuController::class, 'update']);

    Route::get('/tables', [\App\Http\Controllers\Api\Admin\TableController::class, 'index']);
    Route::post('/tables', [\App\Http\Controllers\Api\Admin\TableController::class, 'store']);
    Route::get('/tables/{table}', [\App\Http\Controllers\Api\Admin\TableController::class, 'show']);
    Route::put('/tables/{table}', [\App\Http\Controllers\Api\Admin\TableController::class, 'update']);

    Route::get('/orders', [\App\Http\Controllers\Api\Admin\OrderController::class, 'index']);

    Route::get('/users', [\App\Http\Controllers\Api\Admin\UserController::class, 'index']);
    Route::post('/users', [\App\Http\Controllers\Api\Admin\UserController::class, 'store']);
    Route::put('/users/{user}', [\App\Http\Controllers\Api\Admin\UserController::class, 'update']);
    Route::delete('/users/{user}', [\App\Http\Controllers\Api\Admin\UserController::class, 'destroy']);
});

// kitchen route
Route::prefix('kitchen')->middleware(['auth:sanctum', 'role:kitchen'])->group(
    function () {
        Route::get('/orders', [\App\Http\Controllers\Api\Kitchen\OrderController::class, 'index']);
        Route::patch('/orders/{order}/status', [\App\Http\Controllers\Api\Kitchen\OrderController::class, 'updateStatus']);
    }
);

// order-status route
Route::get('/orders-status', [\App\Http\Controllers\Api\OrderStatusController::class, 'index']);

Route::post('/auth/login', [\App\Http\Controllers\Api\Auth\AuthController::class, 'login']);
Route::post('/auth/logout', [\App\Http\Controllers\Api\Auth\AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::get("/me", [\App\Http\Controllers\Api\Auth\UserController::class, 'me'])->middleware('auth:sanctum');
