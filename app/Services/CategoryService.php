<?php

namespace App\Services;

use App\DTOs\CategoryData;
use App\Models\Category;

class CategoryService
{

    public function __construct(
        private readonly SlugService  $slugService
    ) {}

    public function store(CategoryData $data): Category
    {
        return Category::create([
            'name' => $data->name,
            'slug' => $this->slugService->generate($data->name),
            'is_active' => $data->isActive,
        ]);
    }

    public function update(Category $category, CategoryData $data): bool
    {
        return  $category->update([
            'name' => $data->name,
            'slug' => $this->slugService->generate($data->name),
            'is_active' => $data->isActive,

        ]);
    }

    public function delete(Category $category): void
    {
        $category->delete();
    }
}
