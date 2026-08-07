<?php

namespace App\DTOs;

use App\Http\Requests\Table\StoreTableRequest;
use App\Http\Requests\Table\UpdateTableRequest;

class TableData
{

    public function __construct(public readonly int $restaurantId, public readonly string $number) {}

    public static function fromRequest(StoreTableRequest|UpdateTableRequest $request): self
    {
        return new self(
            restaurantId: $request->integer('restaurant_id'),
            number: $request->string('number')->toString()
        );
    }
}
