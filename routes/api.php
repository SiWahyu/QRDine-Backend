<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('categories', App\Http\Controllers\Api\CategoryController::class);
Route::apiResource('menus', App\Http\Controllers\Api\MenuController::class);
Route::apiResource(
    'dining-tables',
    \App\Http\Controllers\Api\DiningTableController::class
);
Route::get("/dining-tables/{diningTable}/qr", [\App\Http\Controllers\Api\DiningTableController::class, 'showQRCode']);
Route::get("/dining-tables/{diningTable}/qr/download", [\App\Http\Controllers\Api\DiningTableController::class, 'downloadQrCode']);

Route::get('/restaurant', [App\Http\Controllers\Api\RestaurantController::class, 'show']);
