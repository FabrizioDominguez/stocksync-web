@extends('layouts.public')

@push('styles')
<style>
    .product-detail-container {
        max-width: 1000px; margin: 3rem auto; padding: 0 1.5rem;
    }
    
    .back-link {
        display: inline-flex; align-items: center; gap: 8px; color: #94a3b8; text-decoration: none; font-weight: 600; margin-bottom: 2rem; transition: color 0.2s;
    }
    .back-link:hover { color: #fff; }

    .detail-grid {
        display: grid; grid-template-columns: 1fr 1fr; gap: 3rem; align-items: start;
    }
    @media(max-width: 768px) { .detail-grid { grid-template-columns: 1fr; } }

    /* Imagen */
    .image-box {
        background: rgba(255,255,255,0.02); border: 1px solid rgba(255,255,255,0.08); border-radius: 24px; aspect-ratio: 1; display: flex; align-items: center; justify-content: center; position: relative; overflow: hidden;
    }
    .image-box svg { width: 100px; height: 100px; color: #334155; }
    .badge-category { position: absolute; top: 1.5rem; left: 1.5rem; background: rgba(59,130,246,0.15); border: 1px solid rgba(59,130,246,0.3); color: #60a5fa; padding: 6px 12px; border-radius: 8px; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; backdrop-filter: blur(4px); }

    /* Info */
    .info-box h1 { font-size: 2.5rem; font-weight: 900; color: #f1f5f9; margin: 0 0 0.5rem; line-height: 1.2; letter-spacing: -0.02em; }
    .product-code { font-family: monospace; color: #64748b; background: rgba(255,255,255,0.05); padding: 4px 8px; border-radius: 6px; font-size: 0.8rem; display: inline-block; margin-bottom: 1.5rem; }
    
    .price-block { margin-bottom: 2rem; display: flex; align-items: baseline; gap: 8px; }
    .price-block .currency { color: #94a3b8; font-size: 1.25rem; font-weight: 600; }
    .price-block .amount { color: #fff; font-size: 3rem; font-weight: 800; letter-spacing: -0.02em; }

    /* Status & Stock */
    .status-panel { background: rgba(0,0,0,0.2); border: 1px solid rgba(255,255,255,0.05); border-radius: 16px; padding: 1.5rem; margin-bottom: 2rem; display: flex; flex-direction: column; gap: 1rem; }
    .status-row { display: flex; justify-content: space-between; align-items: center; }
    .status-label { color: #94a3b8; font-size: 0.875rem; font-weight: 600; }
    .status-value { font-weight: 700; color: #fff; display: flex; align-items: center; gap: 8px; }
    .status-dot { width: 8px; height: 8px; border-radius: 50%; }

    /* Action */
    .btn-cart-large {
        width: 100%; display: flex; align-items: center; justify-content: center; gap: 10px; padding: 18px; border-radius: 14px; background: linear-gradient(135deg, var(--primary), var(--secondary)); color: white; font-size: 1.125rem; font-weight: 800; border: none; cursor: pointer; box-shadow: 0 10px 25px rgba(59,130,246,0.4); transition: all 0.2s; margin-bottom: 2rem;
    }
    .btn-cart-large:hover { transform: translateY(-3px); box-shadow: 0 15px 35px rgba(59,130,246,0.5); }
    .btn-cart-large:disabled { background: #334155; box-shadow: none; cursor: not-allowed; color: #64748b; transform: none; }

    /* Specs */
    .specs-title { font-size: 1.25rem; font-weight: 800; color: #f1f5f9; margin: 0 0 1rem; padding-bottom: 0.5rem; border-bottom: 1px solid rgba(255,255,255,0.08); }
    .specs-content { color: #cbd5e1; line-height: 1.8; font-size: 0.95rem; white-space: pre-line; }
</style>
@endpush

@section('content')
<div class="product-detail-container">
    <a href="{{ route('shop.index') }}" class="back-link">
        <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        Volver al Catálogo
    </a>

    <div class="detail-grid">
        <div class="image-box">
            <span class="badge-category">{{ $product->category->name }}</span>
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
        </div>

        <div class="info-box">
            <h1>{{ $product->name }}</h1>
            <div class="product-code">COD: {{ $product->barcode }}</div>

            <div class="price-block">
                <span class="currency">Bs.</span>
                <span class="amount">{{ number_format($product->price, 2) }}</span>
            </div>

            <div class="status-panel">
                <div class="status-row">
                    <span class="status-label">Disponibilidad</span>
                    <span class="status-value">
                        @if($product->stock == 0)
                            <div class="status-dot" style="background: #f87171;"></div> Agotado
                        @else
                            <div class="status-dot" style="background: #4ade80;"></div> En Stock
                        @endif
                    </span>
                </div>
                @if($product->stock > 0)
                <div class="status-row">
                    <span class="status-label">Cantidad Actual</span>
                    <span class="status-value">{{ $product->stock }} unidades</span>
                </div>
                @endif
                <div class="status-row">
                    <span class="status-label">Condición</span>
                    <span class="status-value"><svg width="16" height="16" fill="none" stroke="#4ade80" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg> Nuevo y Sellado</span>
                </div>
            </div>

            <button class="btn-cart-large" {{ $product->stock == 0 ? 'disabled' : '' }} onclick="addToCart({{ $product->id }}, '{{ addslashes($product->name) }}', {{ $product->price }})">
                <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                {{ $product->stock == 0 ? 'Producto Agotado' : 'Añadir al Carrito' }}
            </button>

            @if($product->technical_specs)
            <div class="specs-box">
                <h3 class="specs-title">Ficha Técnica</h3>
                <div class="specs-content">{{ $product->technical_specs }}</div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
