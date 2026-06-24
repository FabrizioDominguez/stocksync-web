<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Category;
use App\Models\Tenant;

class ShopController extends Controller
{
    public function index(Request $request, $store_slug)
    {
        $tenant = Tenant::where('slug', $store_slug)->firstOrFail();

        // Obtener categorías para el filtro
        $categories = Category::withoutGlobalScope('tenant')->where('tenant_id', $tenant->id)->get();

        // Query base para productos activos
        $query = Product::withoutGlobalScope('tenant')
            ->where('tenant_id', $tenant->id)
            ->where('status', 'active')
            ->with(['category' => function ($q) {
                $q->withoutGlobalScope('tenant');
            }]);

        // Filtrar por categoría si se seleccionó una
        if ($request->has('category') && $request->category != '') {
            $query->where('category_id', $request->category);
        }

        // Obtener los productos
        $products = $query->get();

        return view('shop.index', compact('products', 'categories', 'tenant'));
    }

    public function show($store_slug, $id)
    {
        $tenant = Tenant::where('slug', $store_slug)->firstOrFail();
        
        // Mostrar detalle del producto
        $product = Product::withoutGlobalScope('tenant')
            ->where('tenant_id', $tenant->id)
            ->where('status', 'active')
            ->with(['category' => function ($q) {
                $q->withoutGlobalScope('tenant');
            }])
            ->findOrFail($id);
        
        return view('shop.show', compact('product', 'tenant'));
    }

    public function cart($store_slug)
    {
        $tenant = Tenant::where('slug', $store_slug)->firstOrFail();
        
        return view('shop.cart', compact('tenant'));
    }
}
