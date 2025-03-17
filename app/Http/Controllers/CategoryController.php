<?php

namespace App\Http\Controllers;

use App\Classes\ApiResponse;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the Categories.
     *
     */
    public function index()
    {
        $categories = Category::all();

        if (count($categories) > 0) {
            return ApiResponse::success($categories, "All categories");
        }

        return ApiResponse::error($categories, "No categories Found", 404);
    }

    /**
     * Store a newly created category resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        /* We use the ->all() method as the validation
           occurs via the StoreCategoryRequest class */
        $category = Category::create($request->all());
        return ApiResponse::success($category, "Category Added");
    }

    /**
     * Display the specified category.
     *
     * @param Category $category Use Route-Model Binding to retrieve resource
     */
    public function show(Category $category)
    {
        return ApiResponse::success($category, "Category Found");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
    }
}
