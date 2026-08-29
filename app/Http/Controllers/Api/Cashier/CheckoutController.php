<?php

namespace App\Http\Controllers\Api\Cashier;

use App\Http\Controllers\Controller;
use App\Http\Resources\Cashier\CheckoutResource;
use App\Services\Cashier\CheckoutService;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{

    public function __construct(private readonly  CheckoutService $checkoutService) {}

    public function show(Request $request, string $order_number)
    {

        $order = $this->checkoutService->show($order_number);

        return CheckoutResource::make($order);
    }

    public function checkout(Request $request, string $order_number)
    {
        $order = $this->checkoutService->checkout($order_number);

        return response()->json([
            'data' => CheckoutResource::make($order),
            'message' => 'Order checked out successfully.',
        ]);
    }
}
