<?php

namespace App\DTOs;

use App\Http\Requests\Menu\StoreMenuRequest;
use App\Http\Requests\Menu\UpdateMenuRequest;
use Illuminate\Http\UploadedFile;

class MenuData
{
    public function __construct(
        public int $categoryId,
        public string $name,
        public ?string $description,
        public int $price,
        public bool $isAvailable,
        public ?UploadedFile $image,
    ) {}

    public static function fromRequest(
        StoreMenuRequest|UpdateMenuRequest $request
    ): self {

        return new self(
            categoryId: (int) $request->validated('category_id'),
            name: $request->string('name')->toString(),
            description: $request->input('description'),
            price: $request->integer('price'),
            isAvailable: $request->boolean('is_available'),
            image: $request->file('image'),
        );
    }
}
