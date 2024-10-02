<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller {
    public function index(Request $request) {
        return Product::all();
    }

    public function show(Request $request, Product $product) {
        return $product;
    }

    public function store(StoreProductRequest $request) {
        $product = Product::create($request->all());
        return response()->json($product, 201);
    }

    public function update(UpdateProductRequest $request, Product $product) {
        $product->update($request->all());
        return response()->json($product, 200);
    }

    public function destroy(Request $request, Product $product) {
        $product->delete();
        return response()->json(null, 204);
    }
}
