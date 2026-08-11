<?php

namespace App\Services;

use App\Models\Order;
use Midtrans\Config;
use Midtrans\Notification;
use Midtrans\Snap;

class PaymentService
{
    /**
     * Create a new class instance.
     */
    public function __construct(private readonly OrderService $orderService,)
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$clientKey = config('midtrans.client_key');
    }

    public function createPayment(Order $order): string
    {
        $order->load('items.menu');

        $params = [
            'transaction_details' => [
                'order_id' => $order->order_number,
                'gross_amount' => (int) $order->total,

            ],
            'customer_details' => [
                'first_name' => $order->customer_name,
                'email' => $order->customer_email,
                'phone' => $order->customer_phone,
            ],
            'callbacks' => [
                'finish' => config('app.frontend_url') . '/payment-success',
            ],
            'items_details' => $order->items->map(function ($item) {
                return [
                    'id' => (string) $item->menu_id,
                    'name' => $item->menu->name,
                    'price' => (int) $item->price,
                    'quantity' => $item->quantity
                ];
            })->values()->toArray()
        ];

        return Snap::getSnapToken($params);
    }

    public function handleNotification(array $data): void
    {
        $notification = new Notification();

        $orderNumber = $data['order_id'];

        $transactionStatus = $data['transaction_status'];
        $fraudStatus = $data['fraud_status'] ?? null;


        $order = Order::where('order_number', $orderNumber)->firstOrFail();

        if ($order->payment_status === 'paid') {
            return;
        }

        if ($transactionStatus === 'capture' && $fraudStatus === 'accept') {
            $this->orderService->markAsPaid($order);
            return;
        }

        if ($transactionStatus === 'settlement') {
            $this->orderService->markAsPaid($order);

            return;
        }

        if (
            in_array($transactionStatus, [
                'cancel',
                'deny',
                'expire',
            ])
        ) {
            $order->update([
                'status' => 'cancelled',
            ]);
        }
    }
}
