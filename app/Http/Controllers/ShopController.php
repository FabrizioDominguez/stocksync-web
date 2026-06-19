<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Category;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        // Obtener categorías para el filtro
        $categories = Category::all();

        // Query base para productos activos
        $query = Product::where('status', 'active');

        // Filtrar por categoría si se seleccionó una
        if ($request->has('category') && $request->category != '') {
            $query->where('category_id', $request->category);
        }

        // Obtener los productos
        $products = $query->get();

        return view('shop.index', compact('products', 'categories'));
    }

    public function show($id)
    {
        // Mostrar detalle del producto
        $product = Product::where('status', 'active')->findOrFail($id);
        return view('shop.show', compact('product'));
    }

    public function cart()
    {
        return view('shop.cart');
    }
}
