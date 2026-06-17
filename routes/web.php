<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

// Ruta de la Landing Page
Route::get('/', function () {
    return view('welcome');
});

// === BLOQUE PROTEGIDO (Solo usuarios logueados) ===
Route::middleware(['auth', 'verified'])->group(function () {
    
    // Lista de Productos (Dashboard principal)
    Route::get('/dashboard', [ProductController::class, 'index'])->name('dashboard');
    
    // Formulario de Creación
    Route::get('/productos/crear', [ProductController::class, 'create'])->name('products.create');
    // Procesar la Creación
    Route::post('/productos', [ProductController::class, 'store'])->name('products.store');
    
    // Formulario de Edición
    Route::get('/productos/{id}/editar', [ProductController::class, 'edit'])->name('products.edit');
    // Procesar la Edición
    Route::put('/productos/{id}', [ProductController::class, 'update'])->name('products.update');
    
    // Procesar la Eliminación
    Route::delete('/productos/{id}', [ProductController::class, 'destroy'])->name('products.destroy');

    // Rutas de Perfil (Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';