<?php

namespace App\Services\Kitchen;

use App\Models\Order;

class OrderService
{
    public function getAll()
    {

        $order = Order::query()
            ->with(['table', 'items'])
            ->whereNotIn('status', ['pending', 'cancelled'])
            ->get();

        return $order;
    }

    public function updateStatus(Order $order, string $status)
    {
        $order->status = $status;
        $order->save();
        return $order;
    }
}
