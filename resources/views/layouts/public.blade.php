<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'StockSync') }} - Tienda</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --bg-dark: #0b1120;
            --bg-card: rgba(255, 255, 255, 0.04);
            --border-color: rgba(255, 255, 255, 0.08);
            --primary: #3b82f6;
            --primary-glow: rgba(59, 130, 246, 0.5);
            --secondary: #6366f1;
        }
        html, body {
            max-width: 100vw;
            overflow-x: hidden;
            margin: 0;
            padding: 0;
        }
        body {
            background-color: var(--bg-dark);
            font-family: 'Inter', system-ui, sans-serif;
            color: #e2e8f0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        /* Animated Background */
        .bg-blobs { position: fixed; inset: 0; overflow: hidden; pointer-events: none; z-index: -1; }
        .blob { position: absolute; border-radius: 50%; filter: blur(120px); opacity: 0.15; animation: blobFloat 15s ease-in-out infinite; }
        .blob-1 { width: 600px; height: 600px; background: var(--primary); top: -200px; right: -100px; }
        .blob-2 { width: 500px; height: 500px; background: var(--secondary); bottom: -100px; left: -100px; animation-delay: 5s; }
        @keyframes blobFloat {
            0%, 100% { transform: translate(0, 0) scale(1); }
            50% { transform: translate(-30px, 40px) scale(1.1); }
        }

        /* Navbar */
        .public-nav {
            background: rgba(11,17,32,0.85);
            border-bottom: 1px solid var(--border-color);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            position: sticky; top: 0; z-index: 50;
        }
        .nav-container {
            max-width: 1280px; margin: 0 auto; padding: 0 1.5rem;
            display: flex; justify-content: space-between; align-items: center; height: 70px;
        }
        .logo { display: flex; align-items: center; gap: 12px; text-decoration: none; }
        .logo-icon { width: 36px; height: 36px; border-radius: 10px; background: linear-gradient(135deg, var(--primary), var(--secondary)); box-shadow: 0 0 15px var(--primary-glow); display: flex; align-items: center; justify-content: center; color: white;}
        .logo-icon svg { width: 20px; height: 20px;}
        .logo-text { font-weight: 900; font-size: 1.25rem; color: #fff; letter-spacing: 0.1em; text-transform: uppercase; }
        
        .nav-links { display: flex; gap: 2rem; align-items: center; }
        .nav-link { color: #94a3b8; text-decoration: none; font-weight: 600; font-size: 0.95rem; transition: color 0.2s; }
        .nav-link:hover, .nav-link.active { color: #fff; }

        .cart-btn {
            display: flex; align-items: center; gap: 8px; padding: 8px 16px;
            background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1);
            border-radius: 12px; color: #fff; font-weight: 600; text-decoration: none;
            transition: all 0.2s; cursor: pointer;
        }
        .cart-btn:hover { background: rgba(255,255,255,0.1); border-color: rgba(255,255,255,0.2); }
        .cart-count { background: var(--primary); color: white; font-size: 0.75rem; padding: 2px 8px; border-radius: 99px; }

        /* Main Content */
        main { flex: 1; position: relative; z-index: 1; }

        /* Footer */
        footer {
            border-top: 1px solid var(--border-color);
            background: rgba(0,0,0,0.2);
            padding: 2rem 0; text-align: center; color: #64748b; font-size: 0.875rem;
            margin-top: 4rem;
        }

        /* Utilities */
        .glass-card { background: var(--bg-card); border: 1px solid var(--border-color); border-radius: 16px; backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px); }
        .gradient-text { background: linear-gradient(to right, #60a5fa, #a78bfa); -webkit-background-clip: text; color: transparent; }

        @media (max-width: 480px) {
            .nav-container { padding: 0 1rem; }
            .logo { gap: 8px; }
            .logo-icon { width: 32px; height: 32px; }
            .logo-text { font-size: 1.25rem; }
        }

        /* Toast Notifications */
        .toast-notification {
            background: rgba(11, 17, 32, 0.95);
            border: 1px solid rgba(59, 130, 246, 0.5);
            box-shadow: 0 10px 25px rgba(0,0,0,0.5), 0 0 15px rgba(59,130,246,0.2);
            backdrop-filter: blur(10px);
            color: white; padding: 14px 20px; border-radius: 12px;
            display: flex; align-items: center; gap: 12px;
            font-size: 0.95rem; font-weight: 600;
            transform: translateX(120%); opacity: 0;
            transition: all 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        }
        .toast-notification.show { transform: translateX(0); opacity: 1; }
        .toast-icon {
            display: flex; align-items: center; justify-content: center;
            background: rgba(34, 197, 94, 0.2); color: #4ade80;
            width: 24px; height: 24px; border-radius: 50%; flex-shrink: 0;
        }
    </style>
    @stack('styles')
</head>
<body>
    <div class="bg-blobs">
        <div class="blob blob-1"></div>
        <div class="blob blob-2"></div>
    </div>

    <nav class="public-nav">
        <div class="nav-container">
            <a href="/" class="logo">
                <div class="logo-icon">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                </div>
                <span class="logo-text">StockSync</span>
            </a>

        <div class="nav-links">
            @if(request()->is('/'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="nav-link" style="border: 1px solid rgba(255,255,255,0.2); padding: 8px 16px; border-radius: 10px; background: rgba(255,255,255,0.05);">Ir al Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="nav-link" style="border: 1px solid rgba(255,255,255,0.2); padding: 8px 16px; border-radius: 10px; background: rgba(255,255,255,0.05);">Iniciar Sesión</a>
                @endauth
            @else
                <a href="{{ route('shop.cart') }}" class="cart-btn">
                    <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    <span class="cart-count" id="cartCount">0</span>
                </a>
            @endif
        </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <!-- Contenedor para notificaciones Toast -->
    <div id="toastContainer" style="position: fixed; bottom: 24px; right: 24px; z-index: 9999; display: flex; flex-direction: column; gap: 12px;"></div>

    <footer>
        <div style="max-width: 1280px; margin: 0 auto; padding: 0 1.5rem;">
            <div style="display: flex; align-items: center; justify-content: center; gap: 10px; margin-bottom: 1rem;">
                <div class="logo-icon" style="width: 24px; height: 24px; border-radius: 6px;"><svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg></div>
                <span class="logo-text" style="font-size: 1rem;">StockSync</span>
            </div>
            <p>&copy; {{ date('Y') }} StockSync Web. Plataforma de venta. Todos los derechos reservados.</p>
        </div>
    </footer>

    {{-- Lógica básica compartida para el carrito (Local Storage) --}}
    <script>
        // Actualizar el contador al cargar la página
        function updateCartCount() {
            let cart = JSON.parse(localStorage.getItem('stocksync_cart')) || [];
            let totalItems = cart.reduce((total, item) => total + item.quantity, 0);
            let countEl = document.getElementById('cartCount');
            if(countEl) countEl.innerText = totalItems;
        }

        // Función para añadir al carrito
        function addToCart(id, name, price, image = '') {
            let cart = JSON.parse(localStorage.getItem('stocksync_cart')) || [];
            let existingItem = cart.find(item => item.id === id);
            
            if(existingItem) {
                existingItem.quantity += 1;
                if(image) existingItem.image = image; // Actualizar imagen por si no la tenía
            } else {
                cart.push({
                    id: id,
                    name: name,
                    price: parseFloat(price),
                    quantity: 1,
                    image: image
                });
            }
            
            localStorage.setItem('stocksync_cart', JSON.stringify(cart));
            updateCartCount();
            
            // Efecto visual simple (opcional)
            let btn = document.getElementById('cartCount');
            if(btn) {
                btn.style.transform = 'scale(1.3)';
                setTimeout(() => btn.style.transform = 'scale(1)', 200);
            }
            
            showToast('¡' + name + ' añadido al carrito!');
        }

        // Sistema de notificaciones Toast
        function showToast(message) {
            const container = document.getElementById('toastContainer');
            const toast = document.createElement('div');
            toast.className = 'toast-notification';
            toast.innerHTML = `
                <div class="toast-icon">
                    <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                </div>
                <div>${message}</div>
            `;
            container.appendChild(toast);
            
            // Animar entrada
            setTimeout(() => { toast.classList.add('show'); }, 10);
            
            // Animar salida y remover después de 3.5 segundos
            setTimeout(() => {
                toast.classList.remove('show');
                setTimeout(() => { toast.remove(); }, 400);
            }, 3500);
        }

        document.addEventListener('DOMContentLoaded', updateCartCount);
    </script>
    
    @stack('scripts')
</body>
</html>
