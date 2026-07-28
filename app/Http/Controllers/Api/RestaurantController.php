<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\RestaurantResource;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public function show()
    {
        $restaurant = Restaurant::first();

        return response()->json([
            'data' => RestaurantResource::make($restaurant),
        ]);
    }
}
