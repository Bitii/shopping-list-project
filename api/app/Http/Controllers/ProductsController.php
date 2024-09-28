<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\ProductRequest;

class ProductsController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return response()->json(['products' => $products]);
    }

    public function store(ProductRequest $request)
    {
        $product = Product::create($request->all());
        return response()->json(['product' => $product]);
    }

    public function update(ProductRequest $request, $id)
    {
        $product = Product::findOfFail($id);
        $product->update($request->all());
        return response()->json(['product' => $product]);
    }

    public function destroy($id)
    {
        $product = Product::findOfFail($id);
        $product->delete();
        return response()->json([
            'message' => 'Product deleted successfully',
            'id' => $id
        ]);
    }
}
