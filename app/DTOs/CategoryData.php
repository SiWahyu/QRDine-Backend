<?php

namespace App\DTOs;

use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;

class CategoryData
{
    public function __construct(
        public string $name,
        public bool $isActive
    ) {}

    public static function fromRequest(StoreCategoryRequest|UpdateCategoryRequest $request): self
    {
        return new self(
            name: $request->string('name')->toString(),
            isActive: $request->boolean('is_active')
        );
    }
}
