<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RestaurantResource extends JsonResource
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
            'name' => $this->name,
            'logo' => $this->logo,
            'tax_percentage' => (float) $this->tax_percentage,
            'service_charge' => (float) $this->service_charge,
            'phone' => $this->phone,
            'address' => $this->address,
        ];
    }
}
