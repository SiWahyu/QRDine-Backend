<?php

namespace App\Http\Controllers\Api\Kitchen;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\UpdateStatusOrderRequest;
use App\Http\Resources\Kitchen\OrderResource;
use App\Models\Order;
use App\Services\Kitchen\OrderService;

class OrderController extends Controller
{
    public function __construct(
        public readonly OrderService $orderService
    ) {}

    public function index()
    {

        $order = $this->orderService->getAll();
        return OrderResource::collection($order);
    }

    public function updateStatus(Order $order, UpdateStatusOrderRequest $request)
    {
        $order = $this->orderService->updateStatus($order,  $request->validated('status'));
        return response()->json([
            'message' => 'Order status updated successfully.',
            'data' => OrderResource::make($order),
        ]);
    }
}
