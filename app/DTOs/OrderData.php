<?php

namespace App\DTOs;

use App\Http\Requests\Order\StoreOrderRequest;

class OrderData
{
    public function __construct(
        public readonly int $restaurantId,
        public readonly ?int $userId,
        public readonly int $tableId,
        public readonly string $customerName,
        public readonly ?string $customerEmail,
        public readonly ?string $customerPhone,
        public readonly string $paymentMethod,
        public readonly array $items,
    ) {}

    public static function fromRequest(StoreOrderRequest $request): self
    {
        return new self(
            restaurantId: $request->integer('restaurant_id'),
            userId: $request->input('user_id'),
            tableId: $request->integer('table_id'),
            customerName: $request->string('customer_name')->toString(),
            customerEmail: $request->input('customer_email'),
            customerPhone: $request->input('customer_phone'),
            paymentMethod: $request->string('payment_method')->toString(),
            items: $request->input('items', []),
        );
    }
}
