<?php

namespace App\Services;

use App\DTOs\OrderData;
use App\Models\Table;
use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class OrderService
{
    public function store(OrderData $data): Order
    {

        return DB::transaction(function () use ($data) {
            $table = Table::with('restaurant')
                ->findOrFail($data->tableId);

            $menuIds = collect($data->items)
                ->pluck('menu_id');

            $menus = Menu::whereIn('id', $menuIds)
                ->get()
                ->keyBy('id');

            $subtotal = 0;


            foreach ($data->items as $item) {

                $menu = $menus[$item['menu_id']];

                $subtotal += $menu->price * $item['quantity'];
            }

            $taxAmount = ($subtotal * $table->restaurant->tax_percentage) / 100;

            $serviceAmount = ($subtotal * $table->restaurant->service_charge) / 100;

            $total = $subtotal + $taxAmount + $serviceAmount;

            $order = Order::create([
                'restaurant_id' => $table->restaurant_id,
                'user_id' => auth()->id(),
                'table_id' => $table->id,
                'customer_name' => $data->customerName,
                'customer_email' => $data->customerEmail,
                'customer_phone' => $data->customerPhone,
                'order_number' => $this->generateOrderNumber(),
                'payment_method' => $data->paymentMethod,
                'subtotal' => $subtotal,
                'tax_amount' => $taxAmount,
                'service_amount' => $serviceAmount,
                'total' => $total,
            ]);

            $orderItems = [];

            foreach ($data->items as $item) {
                $menu = $menus[$item['menu_id']];

                $orderItems[] = [
                    'order_id' => $order->id,
                    'menu_id' => $menu->id,
                    'quantity' => $item['quantity'],
                    'price' => $menu->price,
                    'subtotal' => $menu->price * $item['quantity'],
                    'note' => $item['note'] ?? null,
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

    public function cancel(Order $order): Order
    {
        if ($order->status !== 'pending' || $order->payment_status !== 'pending') {
            throw new UnprocessableEntityHttpException(
                'Order cannot be cancelled.'
            );
        }

        $order->update([
            'status' => 'cancelled',
        ]);

        return $order->fresh()->load([
            'table',
            'items.menu',
        ]);
    }
}
