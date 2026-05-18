<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::query()->with('category')->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'precio' => 'required|numeric',
            'stock' => 'required|integer',
            'descripcion' => 'nullable|string',
            'imagen' => 'nullable|string'
        ]);

        Product::create($validated);
        return redirect()->route('admin.productos.index')->with('success', 'Producto creado exitosamente');
    }

    public function edit(Product $producto)
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('producto', 'categories'));
    }

    public function update(Request $request, Product $producto)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'precio' => 'required|numeric',
            'stock' => 'required|integer',
            'descripcion' => 'nullable|string',
            'imagen' => 'nullable|string'
        ]);

        $producto->update($validated);
        return redirect()->route('admin.productos.index')->with('success', 'Producto actualizado exitosamente');
    }

    public function destroy(Product $producto)
    {
        Product::destroy($producto->id);
        return redirect()->route('admin.productos.index')->with('success', 'Producto eliminado');
    }
}
