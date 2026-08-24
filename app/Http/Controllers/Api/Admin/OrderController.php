<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\OrderResource;
use App\Services\Admin\OrderService;

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
}
