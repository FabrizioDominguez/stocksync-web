@extends('layouts.public')

@push('styles')
<style>
    .shop-container {
        max-width: 1280px; margin: 3rem auto; padding: 0 1.5rem;
    }
    
    .shop-header {
        display: flex; justify-content: space-between; align-items: flex-end;
        margin-bottom: 2.5rem; flex-wrap: wrap; gap: 1.5rem;
    }
    .shop-title h1 { font-size: 2.25rem; font-weight: 800; margin: 0 0 0.5rem; color: #f1f5f9; letter-spacing: -0.02em; }
    .shop-title p { color: #94a3b8; margin: 0; font-size: 1.1rem; }
    
    /* Category Filter */
    .filter-group {
        display: flex; align-items: center; gap: 10px;
    }
    .filter-label { color: #cbd5e1; font-weight: 600; font-size: 0.875rem; }
    .filter-select {
        background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1);
        color: #fff; padding: 10px 16px; border-radius: 10px; outline: none;
        font-family: inherit; font-weight: 500; cursor: pointer; transition: all 0.2s;
        appearance: none; -webkit-appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20' fill='%2394a3b8'%3E%3Cpath fill-rule='evenodd' d='M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z' clip-rule='evenodd'/%3E%3C/svg%3E");
        background-repeat: no-repeat; background-position: right 12px center; padding-right: 36px;
    }
    .filter-select:focus { border-color: var(--primary); box-shadow: 0 0 0 2px rgba(59,130,246,0.2); }
    .filter-select option { background: #1e293b; color: #fff; }

    /* Product Grid */
    .product-grid {
        display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 1.5rem;
    }
    
    @media (max-width: 480px) {
        .shop-container { padding: 0 1rem; margin: 1.5rem auto; }
        .product-grid { grid-template-columns: 1fr; }
        .shop-header { flex-direction: column; align-items: flex-start; gap: 1rem; }
        .filter-select { width: 100%; }
        .filter-group { width: 100%; flex-direction: column; align-items: flex-start; }
    }
    
    /* Product Card */
    .product-card {
        display: flex; flex-direction: column;
        background: var(--bg-card); border: 1px solid var(--border-color); border-radius: 16px;
        overflow: hidden; backdrop-filter: blur(8px); transition: all 0.3s;
        text-decoration: none; position: relative;
    }
    .product-card:hover {
        transform: translateY(-5px); border-color: rgba(59,130,246,0.4);
        box-shadow: 0 10px 30px rgba(0,0,0,0.5), 0 0 20px rgba(59,130,246,0.1);
    }
    
    /* Imagen Placeholder (como no subimos fotos, usaremos un gradiente o ícono) */
    .product-image-placeholder {
        height: 180px; width: 100%; display: flex; align-items: center; justify-content: center;
        background: linear-gradient(135deg, rgba(255,255,255,0.02), rgba(255,255,255,0.05));
        border-bottom: 1px solid var(--border-color); color: #475569;
    }
    .product-image-placeholder svg { width: 48px; height: 48px; opacity: 0.5; }
    
    .product-content { padding: 1.5rem; flex: 1; display: flex; flex-direction: column; }
    
    .product-category { font-size: 0.75rem; font-weight: 700; color: var(--primary); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.5rem; }
    .product-name { font-size: 1.125rem; font-weight: 700; color: #fff; margin: 0 0 0.5rem; line-height: 1.4; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
    .product-price { font-size: 1.5rem; font-weight: 800; color: #fff; margin: auto 0 1rem; }
    .product-price span { font-size: 0.875rem; color: #94a3b8; font-weight: 500; }
    
    .product-footer {
        display: flex; justify-content: space-between; align-items: center;
        padding-top: 1rem; border-top: 1px solid rgba(255,255,255,0.06);
    }
    
    .stock-badge {
        display: inline-flex; align-items: center; gap: 6px; font-size: 0.75rem; font-weight: 600; padding: 4px 10px; border-radius: 99px;
    }
    .stock-badge.in-stock { background: rgba(34,197,94,0.1); color: #4ade80; }
    .stock-badge.low-stock { background: rgba(245,158,11,0.1); color: #fbbf24; }
    .stock-badge.out-stock { background: rgba(239,68,68,0.1); color: #f87171; }
    .stock-badge .dot { width: 6px; height: 6px; border-radius: 50%; background: currentColor; }

    .btn-add {
        background: transparent; border: 1px solid rgba(255,255,255,0.1); color: #cbd5e1;
        width: 36px; height: 36px; border-radius: 10px; display: flex; align-items: center; justify-content: center;
        cursor: pointer; transition: all 0.2s;
    }
    .product-card:hover .btn-add { background: var(--primary); border-color: var(--primary); color: white; }

    /* Empty state */
    .empty-catalog {
        text-align: center; padding: 5rem 2rem; background: rgba(255,255,255,0.02);
        border: 1px dashed rgba(255,255,255,0.1); border-radius: 20px;
    }
    .empty-catalog svg { width: 48px; height: 48px; color: #475569; margin-bottom: 1rem; }
</style>
@endpush

@section('content')
<div class="shop-container">
    <div class="shop-header">
        <div class="shop-title">
            <h1>Catálogo de Productos</h1>
            <p>Descubre nuestro inventario sincronizado en tiempo real.</p>
        </div>
        
        <form action="{{ route('shop.index') }}" method="GET" class="filter-group">
            <span class="filter-label">Categoría:</span>
            <select name="category" class="filter-select" onchange="this.form.submit()">
                <option value="">Todas las categorías</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
        </form>
    </div>

    @if($products->count() > 0)
        <div class="product-grid">
            @foreach($products as $product)
                <a href="{{ route('shop.show', $product->id) }}" class="product-card">
                    <div class="product-image-placeholder" style="{{ $product->image_path ? 'padding:0; background:none;' : '' }}">
                        @if($product->image_path)
                            <img src="{{ Storage::url($product->image_path) }}" alt="{{ $product->name }}" style="width: 100%; height: 100%; object-fit: cover;">
                        @else
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        @endif
                    </div>
                    
                    <div class="product-content">
                        <div class="product-category">{{ $product->category->name }}</div>
                        <h3 class="product-name">{{ $product->name }}</h3>
                        
                        <div class="product-price">
                            <span>Bs.</span> {{ number_format($product->price, 2) }}
                        </div>
                        
                        <div class="product-footer">
                            @if($product->stock == 0)
                                <div class="stock-badge out-stock"><div class="dot"></div> Agotado</div>
                            @elseif($product->stock <= $product->min_stock)
                                <div class="stock-badge low-stock"><div class="dot"></div> ¡Pocas unidades! ({{ $product->stock }})</div>
                            @else
                                <div class="stock-badge in-stock"><div class="dot"></div> Disponible ({{ $product->stock }})</div>
                            @endif

                            <button class="btn-add" onclick="event.preventDefault(); addToCart({{ $product->id }}, '{{ addslashes($product->name) }}', {{ $product->price }}, '{{ $product->image_path ? Storage::url($product->image_path) : '' }}');" title="Añadir al carrito">
                                <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                            </button>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    @else
        <div class="empty-catalog">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
            <h2 style="color:#f1f5f9; font-size:1.25rem; font-weight:700; margin:0 0 0.5rem;">No se encontraron productos</h2>
            <p style="color:#94a3b8; margin:0;">Intenta seleccionar otra categoría o vuelve más tarde.</p>
            @if(request('category'))
                <a href="{{ route('shop.index') }}" style="display:inline-block; margin-top:1.5rem; color:var(--primary); text-decoration:none; font-weight:600;">← Ver todo el catálogo</a>
            @endif
        </div>
    @endif
</div>
@endsection
