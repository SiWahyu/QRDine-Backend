<?php

namespace App\Http\Controllers\Api\Admin;

use App\DTOs\CategoryData;
use App\Http\Controllers\Controller;
use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Http\Resources\Admin\CategoryResource;
use App\Models\Category;
use App\Services\Admin\CategoryService;

class CategoryController extends Controller
{

    public function __construct(private CategoryService $categoryService) {}

    public function index()
    {

        $categories = $this->categoryService->getAll();

        return CategoryResource::collection($categories);
    }

    public function store(StoreCategoryRequest $request)
    {

        $data = CategoryData::fromRequest($request);

        $category = $this->categoryService->store($data);

        return response()->json([
            'message' => 'Category created successfully',
            'data' => CategoryResource::make($category),
        ])->setStatusCode(201);
    }

    public function show(Category $category)
    {

        return CategoryResource::make($category);
    }


    public function update(UpdateCategoryRequest $request, Category $category)
    {

        $data = CategoryData::fromRequest($request);

        $this->categoryService->update($category, $data);

        return response()->json([
            'message' => 'Category updated successfully.',
        ]);
    }
}
