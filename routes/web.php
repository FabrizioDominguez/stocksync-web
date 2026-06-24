<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;

// === RUTAS PÚBLICAS ===
// Ruta de la Landing Page
Route::get('/', function () {
    return view('welcome');
});

// Catálogo Público
Route::get('/t/{store_slug}', [ShopController::class, 'index'])->name('shop.index');
Route::get('/t/{store_slug}/carrito', [ShopController::class, 'cart'])->name('shop.cart');
Route::get('/t/{store_slug}/producto/{id}', [ShopController::class, 'show'])->name('shop.show');

// === BLOQUE PROTEGIDO (Solo usuarios logueados) ===
Route::middleware(['auth', 'verified'])->group(function () {
    
    // Dashboard principal
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // CRUD Productos
    Route::resource('productos', ProductController::class)->names('products');
    
    // CRUD Categorías
    Route::resource('categorias', CategoryController::class)->names('categories');

    // Rutas de Perfil (Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';