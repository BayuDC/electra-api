<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller {
    public function index(Request $request) {
        $cart = $request->user()->cart()->firstOrCreate();
        $cart->load('products');

        return response()->json($cart);
    }
}
