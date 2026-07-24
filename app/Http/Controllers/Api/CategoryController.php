<?php

namespace App\Http\Controllers\Api;

use App\DTOs\CategoryData;
use App\Http\Controllers\Controller;
use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Services\CategoryService;

class CategoryController extends Controller
{

    public function __construct(
        private CategoryService $categoryService,
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::orderBy('name')->paginate(10);

        return CategoryResource::collection($categories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {

        $data = CategoryData::fromRequest($request);

        $category = $this->categoryService->store($data);

        return response()->json([
            'message' => 'Category created successfully',
            'data' => CategoryResource::make($category),
        ])->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {

        $data = CategoryData::fromRequest($request);

        $this->categoryService->update($category, $data);

        return response()->json([
            'message' => 'Category updated successfully.',
            'data' => CategoryResource::make($category),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return response()->json([
            'message' => 'Category deleted successfully.',
        ]);
    }
}
