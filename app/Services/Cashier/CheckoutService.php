<?php

namespace App\Services\Cashier;

use App\Models\Order;
use App\Services\OrderService;

class CheckoutService
{

    public function __construct(private OrderService $orderService) {}

    public function show(string $order_number)
    {
        $order = Order::query()
            ->select([
                'id',
                'order_number',
                'customer_name',
                'payment_method',
                'payment_status',
                'subtotal',
                'tax_amount',
                'service_amount',
                'total',
                'status',
                'created_at',
            ])
            ->with([
                'items:id,order_id,menu_id,quantity,price',
                'items.menu:id,name,price',
            ])
            ->where('order_number', $order_number)
            ->firstOrFail();

        return $order;
    }

    public function checkout(string $order_number)
    {
        $order = $this->orderService->markAsPaid($this->show($order_number));

        return $order;
    }
}
