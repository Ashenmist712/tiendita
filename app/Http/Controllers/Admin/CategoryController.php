<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::query()->paginate(10);
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'imagen' => 'nullable|string'
        ]);

        Category::create($validated);
        return redirect()->route('admin.categorias.index')->with('success', 'Categoría creada exitosamente');
    }

    public function edit(Category $categoria)
    {
        return view('admin.categories.edit', compact('categoria'));
    }

    public function update(Request $request, Category $categoria)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'imagen' => 'nullable|string'
        ]);

        $categoria->update($validated);
        return redirect()->route('admin.categorias.index')->with('success', 'Categoría actualizada exitosamente');
    }

    public function destroy(Category $categoria)
    {
        Category::destroy($categoria->id);
        return redirect()->route('admin.categorias.index')->with('success', 'Categoría eliminada');
    }
}
