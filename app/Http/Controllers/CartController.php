<?php

namespace App\Http\Controllers;
use App\Models\Product;


use Illuminate\Http\Request;

class CartController extends Controller
{

public function add($id) {
    $product = Product::findOrFail($id);
    $cart = session()->get('cart', []);
    
    if (isset($cart[$id])) {
        $cart[$id]['quantity']++;
    } else {
        $cart[$id] = [
            "name" => $product->name,
            "price" => $product->price,
            "quantity" => 1
        ];
    }

    session()->put('cart', $cart);
    return redirect()->route('cart.view');
}

public function clear()
{
    session()->forget('cart');
    return redirect()->route('cart.view')->with('success', 'Carrito vaciado.');
}

public function view() {
    $cart = session()->get('cart', []);
    return view('store.cart', compact('cart'));
}

}
