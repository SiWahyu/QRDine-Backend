<?php

namespace App\Http\Resources\Cashier;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CheckoutResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'order_number' => $this->order_number,
            'customer_name' => $this->customer_name,
            'payment_method' => $this->payment_method,
            'payment_status' => $this->payment_status,

            'subtotal' => (float) $this->subtotal,
            'tax_amount' => (float) $this->tax_amount,
            'service_amount' => (float) $this->service_amount,
            'total' => (float) $this->total,

            'status' => $this->status,
            'created_at' => $this->created_at,

            'items' => $this->items->map(function ($item) {
                return [
                    'name' => $item->menu->name,
                    'quantity' => $item->quantity,
                    'price' => (float)$item->price
                ];
            }),
        ];
    }
}
