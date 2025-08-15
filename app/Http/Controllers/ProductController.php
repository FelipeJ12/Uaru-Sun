<?php

namespace App\Http\Controllers;
use App\Models\Product;

use Illuminate\Http\Request;

class ProductController extends Controller
{

public function index() {
    $products = Product::all();
    return view('store.index', compact('products'));
}

// Mostrar formulario para crear producto
public function create()
{
    return view('products.create');
}

// Guardar producto
public function store(Request $request)
{
    $request->validate([
        'name'        => 'required|string|max:255',
        'description' => 'nullable|string',
        'price'       => 'required|numeric|min:0',
        'image'       => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    $product = new Product();
    $product->name        = $request->name;
    $product->description = $request->description;
    $product->price       = $request->price;

    if ($request->hasFile('image')) {
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $imageName);
        $product->image = $imageName;
    }

    $product->save();

    return redirect()->route('products.index')->with('success', 'Producto agregado correctamente.');
}

public function show(Product $product)
{
    return view('products.show', compact('product'));
}

}

 

