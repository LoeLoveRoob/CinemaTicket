<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Api\BaseApiController;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryController extends BaseApiController
{
    public function __construct()
    {
        $this->authorizeResource(Category::class);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        return $this->successResponse(
            CategoryResource::collection(Category::all()),
            "category.success_index"
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request): JsonResponse
    {
        $category = Category::create($request->validated());
        return $this->successResponse(
            CategoryResource::make($category),
            "category.success_store"
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category): JsonResponse
    {
        return $this->successResponse(
            CategoryResource::make($category),
            "category.success_show",
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category): JsonResponse
    {
        if ($category->update($request->validated())) {
            return $this->successResponse(
                CategoryResource::make($category),
                "category.success_update",
                200
            );
        } else {
            return $this->errorResponse(
                "False",
                "category.failed_update"
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category): JsonResponse
    {
        $category->delete();
        return $this->successResponse(
            "True",
            "category.success_destroy"
        );
    }
}
