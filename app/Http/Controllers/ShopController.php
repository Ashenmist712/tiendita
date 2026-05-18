<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ShopController extends Controller
{
    public function index()
    {
        $products = Product::latest()->take(12)->get();
        $categories = Category::all();
        
        return view('shop.index', compact('products', 'categories'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        $related = Product::where('category_id', $product->category_id)
                          ->where('id', '!=', $product->id)
                          ->take(4)
                          ->get();
                          
        return view('shop.show', compact('product', 'related'));
    }

    public function category($id)
    {
        $category = Category::findOrFail($id);
        $products = Product::where('category_id', $id)->paginate(12);
        
        return view('shop.category', compact('category', 'products'));
    }
}
