<?php

namespace App\Http\Resources\Admin;

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
            'customer_email' => $this->customer_email,
            'customer_phone' => $this->customer_phone,

            'table' => [
                'id' => $this->table?->id,
                'number' => $this->table?->number,
            ],

            'payment_method' => $this->payment_method,
            'payment_status' => $this->payment_status,
            'payment_expired_at' => $this->payment_expired_at?->toISOString(),

            'status' => $this->status,

            'total' => (float) $this->total,

            'created_at' => $this->created_at?->toISOString(),
        ];
    }
}
