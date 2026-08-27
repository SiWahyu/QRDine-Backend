<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderStatusResource;
use App\Services\OrderStatusService;
use Illuminate\Http\Request;

class OrderStatusController extends Controller
{
    public function __construct(private OrderStatusService $orderStatusService) {}

    public function index()
    {
        $orders = $this->orderStatusService->getAll();

        return OrderStatusResource::collection($orders);
    }
}
