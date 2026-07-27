<?php

namespace App\DTOs;

use App\Http\Requests\DiningTable\StoreDiningTableRequest;
use App\Http\Requests\DiningTable\UpdateDiningTableRequest;

class DiningTableData
{

    public function __construct(public readonly string $number) {}

    public static function fromRequest(StoreDiningTableRequest|UpdateDiningTableRequest $request): self
    {
        return new self(number: $request->string('number')->toString());
    }
}