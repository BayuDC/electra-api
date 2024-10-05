<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UpdateCartRequest;

class CartController extends Controller {
    public function index(Request $request) {
        $cart = $request->user()->cart()->firstOrCreate();
        $cart->load('products');

        return response()->json($cart);
    }

    public function update(UpdateCartRequest $request) {
        $body = $request->validated();
        $cart = $request->user()->cart()->firstOrCreate();

        $product =  $cart->products()
            ->WherePivot('product_id', $body['product_id'])->first();

        if ($body['quantity'] === 0) {
            $cart->products()->detach($body['product_id']);
            return response()->json($cart);
        }

        if ($product) {
            $cart->products()->updateExistingPivot($product->id, [
                'quantity' => $body['quantity']
            ]);
        } else {
            $cart->products()->attach($body['product_id'], [
                'quantity' => $body['quantity']
            ]);
        }

        return response()->json($cart);
    }
}
