<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('categories', App\Http\Controllers\Api\CategoryController::class);
Route::apiResource('menus', App\Http\Controllers\Api\MenuController::class);
Route::apiResource(
    'tables',
    \App\Http\Controllers\Api\TableController::class
)->except('show');
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
