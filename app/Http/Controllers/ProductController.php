<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // 1. LISTAR PRODUCTOS
    public function index()
    {
        $products = Product::with('category')->get();
        return view('products.index', compact('products'));
    }

    // 2. MOSTRAR FORMULARIO DE CREAR
    public function create()
    {
        // Necesitamos las categorías para el menú desplegable (Select) del formulario
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    // 3. PROCESAR Y GUARDAR NUEVO PRODUCTO
    public function store(Request $request)
    {
        // Validaciones estrictas de tipo de datos
        $request->validate([
            'barcode' => 'required|unique:products,barcode',
            'name' => 'required|string|max:150',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'min_stock' => 'required|integer|min:0',
        ]);

        // Guardar en la base de datos
        Product::create($request->all());

        // Redireccionar con un mensaje de éxito que leerá la vista index
        return redirect()->route('dashboard')->with('success', '¡Producto agregado correctamente al inventario!');
    }

    // 4. MOSTRAR FORMULARIO DE EDITAR
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    // 5. PROCESAR LA ACTUALIZACIÓN
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'barcode' => 'required|unique:products,barcode,' . $product->id,
            'name' => 'required|string|max:150',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'min_stock' => 'required|integer|min:0',
            'status' => 'required|in:active,inactive',
        ]);

        $product->update($request->all());

        return redirect()->route('dashboard')->with('success', '¡Producto actualizado correctamente!');
    }

    // 6. ELIMINAR EL PRODUCTO
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('dashboard')->with('success', 'El producto ha sido eliminado del inventario.');
    }
}