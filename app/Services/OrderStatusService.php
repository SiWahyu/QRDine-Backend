<?php

namespace App\Services;

use App\Models\Order;

class OrderStatusService
{
    public function __construct() {}

    public function getAll()
    {

        $order = Order::query()
            ->with(['table'])
            ->whereNotIn('status', ['pending', 'cancelled'])
            ->get([
                'id',
                'table_id',
                'status',
                'customer_name',
                'order_number',
                'created_at'
            ]);

        return $order;
    }
}
