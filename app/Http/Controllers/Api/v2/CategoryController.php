<?php

namespace App\Http\Controllers\Api\v2;

use App\Classes\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\v2\DeleteCategoryRequest;
use App\Http\Requests\v2\StoreCategoryRequest;
use App\Http\Requests\v2\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\JsonResponse;

/**
 * API Version 2 - CategoryController
 */
class CategoryController extends Controller
{

    /**
     * Returns a list of the Categories.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $categories = Category::all();

        if (count($categories) > 0) {
            return ApiResponse::success($categories, "All categories");
        }

        return ApiResponse::error($categories, "No categories Found", 404);
    }

    /**
     * Create & Store a new Category resource.
     *
     * @param \App\Http\Requests\v2\StoreCategoryRequest $request
     * @return JsonResponse
     */
    public function store(StoreCategoryRequest $request): \Illuminate\Http\JsonResponse
    {
        /* The StoreCategoryRequest performs the validation.
         *
         * Using -->all() may result in unwanted data being updated, and lead to
         * security issues.
         *
         * Using ->validated() passes only the validated data and no more to the
         * update request. A much better solution.
         */

        $category = Category::create($request->all());
        return ApiResponse::success($category, "Category Added");
    }

    /**
     * Display the specified Category.
     *
     * @param Category $category Use Route-Model Binding to retrieve resource
     * @return JsonResponse
     */
    public function show(Category $category): \Illuminate\Http\JsonResponse
    {
        return ApiResponse::success($category, "Category Found");
    }

    /**
     * Update the specified Category resource.
     *
     * @param UpdateCategoryRequest $request
     * @param Category $category
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateCategoryRequest $request, Category $category): \Illuminate\Http\JsonResponse
    {
        /* The UpdateCategoryRequest performs the validation.
         *
         * Using -->all() may result in unwanted data being updated, and lead to
         * security issues.
         *
         * Using ->validated() passes only the validated data and no more to the
         * update request. A much better solution.
         */

        $category->update($request->validated());
        return ApiResponse::success($category, "Category Updated");
    }

    /**
     * Delete the specified Category from storage.
     *
     * Will return success true, success message, and the category just removed.
     *
     * @param DeleteCategoryRequest $request
     * @return JsonResponse
     */
    public function destroy(DeleteCategoryRequest $request, Category $category): JsonResponse
    {
        $categoryToDelete = $category;
        $categoryToDelete->delete();
        return ApiResponse::success($category, "Category Deleted");
    }
}
