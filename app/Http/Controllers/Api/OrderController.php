<?php

namespace App\Http\Controllers\Api;

use App\DTOs\OrderData;
use App\Http\Controllers\Controller;
use App\Http\Requests\Order\StoreOrderRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Services\OrderService;

class OrderController extends Controller
{
    public function __construct(private readonly  OrderService $orderSerivece) {}
    public function store(
        StoreOrderRequest $request,
    ) {

        $data = OrderData::fromRequest($request);
        $order = $this->orderSerivece->store($data);

        return response()->json([
            'message' => 'Order created successfully.',
            'data' => new OrderResource($order),
        ], 201);
    }

    public function cancel(Order $order)
    {
        $order = $this->orderSerivece->cancel($order);

        return response()->json([
            'message' => 'Order cancelled successfully.',
            'data' => new OrderResource($order),
        ]);
    }
}
