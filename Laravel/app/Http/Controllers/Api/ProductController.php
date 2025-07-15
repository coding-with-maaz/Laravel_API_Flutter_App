<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        return response()->json(Product::all());
    }

    public function show($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Not found'], 404);
        }
        return response()->json($product);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
        ]);
        $product = Product::create($validated);
        return response()->json($product, 201);
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Not found'], 404);
        }
        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'price' => 'sometimes|required|numeric',
            'description' => 'nullable|string',
        ]);
        $product->update($validated);
        return response()->json($product);
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Not found'], 404);
        }
        $product->delete();
        return response()->json(['message' => 'Deleted']);
    }

    // Web UI methods for Blade CRUD
    public function webIndex()
    {
        $products = Product::all();
        return view('products', compact('products'));
    }

    public function webStore(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
        ]);
        Product::create($validated);
        return redirect()->route('products.index');
    }

    public function webEdit(Product $product)
    {
        $products = Product::all();
        $editProduct = $product;
        return view('products', compact('products', 'editProduct'));
    }

    public function webUpdate(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
        ]);
        $product->update($validated);
        return redirect()->route('products.index');
    }

    public function webDestroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index');
    }
} 