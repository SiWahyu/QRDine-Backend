<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TableResource extends JsonResource
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
            'number' => $this->number,
            'token' => $this->token,
            'qr_url' => config('app.frontend_url')
                . '/table/'
                . $this->token,
            'created_at' => $this->created_at?->toISOString(),
        ];
    }
}
