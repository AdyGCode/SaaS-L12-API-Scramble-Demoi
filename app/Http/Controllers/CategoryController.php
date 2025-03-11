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
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:64', 'min:3'],
            'description' => ['optional', 'string', 'max:255'],
        ]);

        $category = Category::create($validated);
        return ApiResponse::success($category, "Category Added");

    }

    /**
     * Display the specified category.
     *
     * @param  int  $id  Integer ID of the Category
     */
    public function show(int $id)
    {
        $category = Category::whereId($id)->get();

        if ($category->count() > 0) {
            return ApiResponse::success($category, "Category Found");
        }

        return ApiResponse::error($category, "Category not Found", 404);

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
