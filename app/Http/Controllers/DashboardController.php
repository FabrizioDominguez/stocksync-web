<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Category;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $totalCategories = Category::count();
        
        // Productos con stock crítico
        $criticalStockProducts = Product::whereColumn('stock', '<=', 'min_stock')->get();

        return view('dashboard', compact('totalProducts', 'totalCategories', 'criticalStockProducts'));
    }
}
