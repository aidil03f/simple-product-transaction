<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Traits\Product as TraitsProduct;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use TraitsProduct;

    public function index()
    {
        $products = Product::latest()->paginate(10);
        if($products->count() == 0){
            return response()->json(['status' => 404,'data'=> null]);
        } else {
            return response()->json(['status' => 200,'data' => $this->resultProductList($products)]);
        }
    }
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return response()->json(['status' => 200,'data'=> $product]);
    }
    public function store(Request $request)
    {
        $attrs = $request->validate([
            'name' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'description' => 'sometimes'
        ]);
        $product = Product::create($attrs);
        return response()->json(['status' => 200,'data' => $product]);
    }
    public function update(Request $request,$id)
    {
        $attrs = $request->validate([
            'name' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'description' => 'sometimes'
        ]);
        $product = Product::findOrFail($id);
        $product->update($attrs);
        return response()->json(['status' => 200,'data' => $product]);
    }
    public function destroy($id)
    {
        Product::findOrFail($id)->delete();
        return response()->json(['status' => 200,'message' => 'deleted']);
    }
}
