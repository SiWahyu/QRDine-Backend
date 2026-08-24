<?php

namespace App\Http\Resources\Kitchen;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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

            'table' => $this->table->number,

            'items' => $this->items->map(function ($item) {
                return [
                    'name' => $item->menu->name,
                    'price' => (float) $item->price,
                    'quantity' => $item->quantity,
                    'note' => $item->note ?: null,
                ];
            }),

            'payment_method' => $this->payment_method,
            'payment_status' => $this->payment_status,

            'status' => $this->status,

            'total' => (float) $this->total,

            'created_at' => $this->created_at?->toISOString(),
        ];
    }
}
