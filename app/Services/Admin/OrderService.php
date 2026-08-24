<?php

namespace App\Services\Admin;

use App\Models\Order;

class OrderService
{

    public function __construct() {}

    public function getAll()
    {

        $order = Order::query()
            ->with(['table'])
            ->latest()
            ->get();

        return $order;
    }
}
