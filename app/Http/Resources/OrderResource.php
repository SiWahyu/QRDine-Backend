<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'order_number' => $this->order_number,

            'customer_name' => $this->customer_name,

            'payment_status' => $this->payment_status,
            'payment_expired_at' => $this->payment_expired_at?->toISOString(),
            'payment_method' => $this->payment_method,
            'status' => $this->status,

            'subtotal' => (float) $this->subtotal,
            'tax' => (float) $this->tax_amount,
            'service' => (float) $this->service_amount,
            'total' => (float) $this->total,

            'created_at' => $this->created_at?->toISOString(),
            'updated_at' => $this->updated_at?->toISOString(),

            'table' => [
                'id' => $this->table->id,
                'number' => $this->table->number,
            ],

            'items' => $this->items->map(function ($item) {
                return [
                    'menu_id' => $item->menu_id,
                    'name' => $item->menu->name,
                    'price' => (float) $item->price,
                    'quantity' => $item->quantity,
                    'subtotal' => (float) $item->subtotal,
                    'note' => $item->note,
                ];
            }),
        ];
    }
}
