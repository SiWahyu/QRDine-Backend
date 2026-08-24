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
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {

        $this->categoryService->delete($category);

        return response()->json([
            'message' => 'Category deleted successfully.',
        ]);
    }
}
