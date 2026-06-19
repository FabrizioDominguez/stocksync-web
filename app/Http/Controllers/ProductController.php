<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'min_stock' => 'required|integer|min:0',
        ]);

        $data = $request->all();

        // Subir la imagen si existe
        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('products', 'public');
        }

        // Guardar en la base de datos
        Product::create($data);

        // Redireccionar con un mensaje de éxito que leerá la vista index
        return redirect()->route('products.index')->with('success', '¡Producto agregado correctamente al inventario!');
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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'min_stock' => 'required|integer|min:0',
            'status' => 'required|in:active,inactive',
        ]);

        $data = $request->all();

        // Si sube una imagen nueva
        if ($request->hasFile('image')) {
            // Borrar la imagen anterior si existe
            if ($product->image_path && Storage::disk('public')->exists($product->image_path)) {
                Storage::disk('public')->delete($product->image_path);
            }
            // Guardar la nueva
            $data['image_path'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);

        return redirect()->route('products.index')->with('success', '¡Producto actualizado correctamente!');
    }

    // 6. ELIMINAR EL PRODUCTO
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        
        // Borrar la imagen física del servidor
        if ($product->image_path && Storage::disk('public')->exists($product->image_path)) {
            Storage::disk('public')->delete($product->image_path);
        }

        $product->delete();

        return redirect()->route('products.index')->with('success', 'El producto ha sido eliminado del inventario.');
    }
}