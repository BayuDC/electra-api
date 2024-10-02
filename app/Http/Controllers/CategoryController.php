<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

class CategoryController extends Controller {
    public function index(Request $request) {
        return Category::all();
    }

    public function show(Request $request, Category $category) {
        return $category;
    }

    public function store(StoreCategoryRequest $request) {
        $category = Category::create($request->all());
        return response()->json($category, 201);
    }

    public function update(UpdateCategoryRequest $request, Category $category) {
        $category->update($request->all());
        return response()->json($category, 200);
    }

    public function destroy(Request $request, Category $category) {
        $category->delete();
        return response()->json(null, 204);
    }
}
