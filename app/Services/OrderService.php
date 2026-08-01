<?php

namespace App\Services;

use App\Models\DiningTable;
use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OrderService
{
    public function store(array $data): Order
    {
        return DB::transaction(function () use ($data) {

            $table = DiningTable::with('restaurant')
                ->findOrFail($data['table_id']);

            $menuIds = collect($data['items'])
                ->pluck('menu_id');

            $menus = Menu::whereIn('id', $menuIds)
                ->get()
                ->keyBy('id');

            $subtotal = 0;

            foreach ($data['items'] as $item) {

                $menu = $menus[$item['menu_id']];

                $subtotal += $menu->price * $item['quantity'];
            }

            $taxAmount = ($subtotal * $table->restaurant->tax_percentage) / 100;

            $serviceAmount = ($subtotal * $table->restaurant->service_charge) / 100;

            $total = $subtotal + $taxAmount + $serviceAmount;

            $orderNumber = $this->generateOrderNumber();

            $order = Order::create([
                'restaurant_id' => $table->restaurant_id,
                'user_id' => auth()->id(),
                'table_id' => $table->id,

                'customer_name' => $data['customer_name'],
                'customer_email' => $data['customer_email'],
                'customer_phone' => $data['customer_phone'],

                'order_number' => $orderNumber,

                'payment_method' => $data['payment_method'],

                'subtotal' => $subtotal,
                'tax_amount' => $taxAmount,
                'service_amount' => $serviceAmount,
                'total' => $total,
            ]);

            $orderItems = [];

            foreach ($data['items'] as $item) {

                $menu = $menus[$item['menu_id']];

                $orderItems[] = [
                    'order_id' => $order->id,
                    'menu_id' => $menu->id,
                    'quantity' => $item['quantity'],
                    'price' => $menu->price,
                    'subtotal' => $menu->price * $item['quantity'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            OrderItem::insert($orderItems);

            return $order->fresh()->load([
                'table',
                'items.menu',
            ]);
        });
    }

    private function generateOrderNumber(): string
    {
        return 'ORD-' .
            now()->format('YmdHis') .
            '-' .
            strtoupper(Str::random(4));
    }
}
