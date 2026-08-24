<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// customer app route
Route::apiResource('menus', App\Http\Controllers\Api\MenuController::class)->except('store');
Route::apiResource(
    'tables',
    \App\Http\Controllers\Api\TableController::class
)->except('show', 'store');
Route::get("/tables/{table}/qr", [\App\Http\Controllers\Api\TableController::class, 'showQRCode']);
Route::get("/tables/{table}/qr/download", [\App\Http\Controllers\Api\TableController::class, 'downloadQrCode']);
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
Route::prefix('admin')->group(function () {

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
});
