@extends('layouts.public')

@push('styles')
<style>
    .cart-container {
        max-width: 1000px; margin: 3rem auto; padding: 0 1.5rem;
    }
    .cart-header {
        margin-bottom: 2.5rem;
    }
    .cart-header h1 {
        font-size: 2.25rem; font-weight: 800; color: #f1f5f9; margin: 0 0 0.5rem; letter-spacing: -0.02em;
    }
    .cart-header p { color: #94a3b8; margin: 0; font-size: 1.1rem; }

    .cart-grid {
        display: grid; grid-template-columns: 2fr 1fr; gap: 2rem; align-items: start;
    }
    @media(max-width: 768px) {
        .cart-grid { grid-template-columns: 1fr; }
    }

    /* Lista de Items */
    .cart-items {
        background: var(--bg-card); border: 1px solid var(--border-color); border-radius: 16px; padding: 1.5rem; backdrop-filter: blur(8px);
    }
    .cart-item {
        display: flex; justify-content: space-between; align-items: center; padding: 1.5rem 0; border-bottom: 1px solid rgba(255,255,255,0.06); gap: 1rem;
    }
    .cart-item:last-child { border-bottom: none; padding-bottom: 0; }
    .cart-item:first-child { padding-top: 0; }

    .item-info { flex: 1; }
    .item-name { font-size: 1.1rem; font-weight: 700; color: #fff; margin: 0 0 0.25rem; }
    .item-price { color: var(--primary); font-weight: 600; font-size: 0.95rem; }

    .item-actions {
        display: flex; align-items: center; gap: 1rem;
    }
    .qty-control {
        display: flex; align-items: center; gap: 10px; background: rgba(0,0,0,0.2); border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; padding: 4px;
    }
    .qty-btn {
        width: 28px; height: 28px; border-radius: 6px; background: rgba(255,255,255,0.05); color: #fff; border: none; cursor: pointer; display: flex; align-items: center; justify-content: center; font-weight: 700; transition: background 0.2s;
    }
    .qty-btn:hover { background: rgba(255,255,255,0.1); }
    .qty-value { width: 30px; text-align: center; color: #fff; font-weight: 600; font-size: 0.9rem; border: none; background: transparent; pointer-events: none;}

    .btn-remove {
        background: rgba(239,68,68,0.1); color: #f87171; border: 1px solid rgba(239,68,68,0.2); width: 34px; height: 34px; border-radius: 8px; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: all 0.2s;
    }
    .btn-remove:hover { background: rgba(239,68,68,0.2); }

    /* Resumen (Summary) */
    .cart-summary {
        background: rgba(0,0,0,0.2); border: 1px solid rgba(255,255,255,0.08); border-radius: 16px; padding: 1.5rem; position: sticky; top: 100px;
    }
    .summary-title { font-size: 1.25rem; font-weight: 800; color: #fff; margin: 0 0 1.5rem; border-bottom: 1px solid rgba(255,255,255,0.08); padding-bottom: 1rem; }
    
    .summary-row { display: flex; justify-content: space-between; margin-bottom: 1rem; color: #94a3b8; font-size: 0.95rem; }
    .summary-total { display: flex; justify-content: space-between; align-items: center; margin-top: 1.5rem; padding-top: 1.5rem; border-top: 1px solid rgba(255,255,255,0.08); }
    .summary-total-label { font-size: 1.1rem; font-weight: 700; color: #fff; }
    .summary-total-value { font-size: 1.75rem; font-weight: 900; color: var(--primary); letter-spacing: -0.02em; }

    .btn-whatsapp {
        width: 100%; display: flex; align-items: center; justify-content: center; gap: 10px; padding: 16px; border-radius: 12px; background: linear-gradient(135deg, #25D366, #128C7E); color: white; font-size: 1.1rem; font-weight: 800; border: none; cursor: pointer; box-shadow: 0 10px 25px rgba(37,211,102,0.3); transition: all 0.2s; margin-top: 2rem; text-decoration: none;
    }
    .btn-whatsapp:hover { transform: translateY(-3px); box-shadow: 0 15px 35px rgba(37,211,102,0.4); }

    .empty-cart { text-align: center; padding: 4rem 2rem; }
    .empty-cart svg { width: 64px; height: 64px; color: #475569; margin-bottom: 1.5rem; }
    .empty-cart h2 { color: #f1f5f9; font-size: 1.5rem; margin: 0 0 0.5rem; }
    .empty-cart p { color: #94a3b8; margin: 0 0 2rem; }
    .btn-outline {
        display: inline-flex; align-items: center; justify-content: center; gap: 8px; padding: 12px 24px; border-radius: 10px; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); color: #e2e8f0; font-weight: 700; text-decoration: none; transition: all 0.2s;
    }
    .btn-outline:hover { background: rgba(255,255,255,0.1); }
</style>
@endpush

@section('content')
<div class="cart-container">
    <a href="{{ route('shop.index', $tenant->slug) }}" style="display: inline-flex; align-items: center; gap: 8px; color: #94a3b8; text-decoration: none; font-weight: 600; margin-bottom: 2rem; transition: color 0.2s;" onmouseover="this.style.color='#fff'" onmouseout="this.style.color='#94a3b8'">
        <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        Seguir Comprando (Volver al Catálogo)
    </a>

    <div class="cart-header">
        <h1>Tu Carrito de Encargos</h1>
        <p>Revisa tus productos antes de enviar el encargo por WhatsApp.</p>
    </div>

    <div id="cartContent" style="display: none;">
        <div class="cart-grid">
            <div class="cart-items" id="cartItemsList">
                <!-- Items renderizados por JS -->
            </div>

            <div class="cart-summary">
                <h3 class="summary-title">Resumen del Encargo</h3>
                <div class="summary-row">
                    <span>Cantidad de productos</span>
                    <span id="summaryCount">0</span>
                </div>
                <div class="summary-total">
                    <span class="summary-total-label">Total Estimado</span>
                    <div class="summary-total-value">
                        <span style="font-size:1rem; color:#94a3b8; font-weight:600;">Bs.</span> <span id="summaryTotal">0.00</span>
                    </div>
                </div>

                <button onclick="sendToWhatsApp()" class="btn-whatsapp">
                    <svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 0 0-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z"/></svg>
                    Enviar Encargo por WhatsApp
                </button>
            </div>
        </div>
    </div>

    <div id="emptyCartMessage" class="empty-cart" style="display: none;">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
        <h2>Tu carrito está vacío</h2>
        <p>Parece que aún no has agregado ningún producto a tu encargo.</p>
        <a href="{{ route('shop.index', $tenant->slug) }}" class="btn-outline">Volver a la Tienda</a>
    </div>

</div>
@endsection

@push('scripts')
<script>
    // Referencia al teléfono de la tienda (Para proyecto universitario usamos un número de prueba)
    const WHATSAPP_NUMBER = "{{ $tenant->whatsapp_number ?? '59170000000' }}"; 

    function renderCart() {
        let cart = JSON.parse(localStorage.getItem(CART_KEY)) || [];
        const contentDiv = document.getElementById('cartContent');
        const emptyDiv = document.getElementById('emptyCartMessage');
        const listDiv = document.getElementById('cartItemsList');

        if(cart.length === 0) {
            contentDiv.style.display = 'none';
            emptyDiv.style.display = 'block';
            return;
        }

        contentDiv.style.display = 'block';
        emptyDiv.style.display = 'none';

        listDiv.innerHTML = '';
        let total = 0;
        let count = 0;

        cart.forEach((item, index) => {
            let itemTotal = item.price * item.quantity;
            total += itemTotal;
            count += item.quantity;

            let imageHtml = item.image 
                ? `<div style="width: 50px; height: 50px; border-radius: 8px; overflow: hidden; background: #1e293b; border: 1px solid rgba(255,255,255,0.1); flex-shrink: 0;"><img src="${item.image}" alt="${item.name}" style="width: 100%; height: 100%; object-fit: cover;"></div>`
                : `<div style="width: 50px; height: 50px; border-radius: 8px; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); display: flex; align-items: center; justify-content: center; color: #475569; flex-shrink: 0;"><svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg></div>`;

            listDiv.innerHTML += `
                <div class="cart-item">
                    ${imageHtml}
                    <div class="item-info">
                        <h4 class="item-name">${item.name}</h4>
                        <div class="item-price">Bs. ${item.price.toFixed(2)}</div>
                    </div>
                    <div class="item-actions">
                        <div class="qty-control">
                            <button class="qty-btn" onclick="updateQty(${index}, -1)">-</button>
                            <input class="qty-value" type="text" value="${item.quantity}" readonly>
                            <button class="qty-btn" onclick="updateQty(${index}, 1)">+</button>
                        </div>
                        <button class="btn-remove" onclick="removeItem(${index})" title="Eliminar del carrito">
                            <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        </button>
                    </div>
                </div>
            `;
        });

        document.getElementById('summaryCount').innerText = count;
        document.getElementById('summaryTotal').innerText = total.toFixed(2);
    }

    function updateQty(index, change) {
        let cart = JSON.parse(localStorage.getItem(CART_KEY)) || [];
        if(cart[index]) {
            cart[index].quantity += change;
            if(cart[index].quantity <= 0) {
                cart.splice(index, 1);
            }
            localStorage.setItem(CART_KEY, JSON.stringify(cart));
            updateCartCount(); // Del layout
            renderCart(); // De esta vista
        }
    }

    function removeItem(index) {
        let cart = JSON.parse(localStorage.getItem(CART_KEY)) || [];
        cart.splice(index, 1);
        localStorage.setItem(CART_KEY, JSON.stringify(cart));
        updateCartCount();
        renderCart();
    }

    function sendToWhatsApp() {
        let cart = JSON.parse(localStorage.getItem(CART_KEY)) || [];
        if(cart.length === 0) return;

        let total = cart.reduce((acc, item) => acc + (item.price * item.quantity), 0);
        
        // Construir mensaje
        let text = "👋 Hola, quiero hacer el siguiente encargo desde StockSync Web:\n\n";
        cart.forEach(item => {
            text += `🔹 ${item.quantity}x *${item.name}* (Bs. ${item.price.toFixed(2)} c/u)\n`;
        });
        text += `\n💰 *Total Estimado:* Bs. ${total.toFixed(2)}\n`;
        text += "\n¿Me confirman disponibilidad y horario para pasar a recoger?";

        // Codificar URI
        let encodedText = encodeURIComponent(text);
        
        // Redirigir a la API de WhatsApp
        let url = `https://wa.me/${WHATSAPP_NUMBER}?text=${encodedText}`;
        
        // Opcional: Vaciar el carrito después de enviarlo (descomentar si se desea)
        // localStorage.removeItem('stocksync_cart');
        
        window.open(url, '_blank');
    }

    document.addEventListener('DOMContentLoaded', renderCart);
</script>
@endpush
