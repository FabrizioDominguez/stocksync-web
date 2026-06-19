<nav x-data="{ mobileMenuOpen: false }" style="background: rgba(11,17,32,0.85); border-bottom: 1px solid rgba(255,255,255,0.08); backdrop-filter: blur(16px); -webkit-backdrop-filter: blur(16px); position: sticky; top: 0; z-index: 50;">
    <div style="max-width: 1280px; margin: 0 auto; padding: 0 1.5rem;">
        <div style="display: flex; justify-content: space-between; align-items: center; height: 64px;">

            {{-- Logo --}}
            <div style="display: flex; align-items: center; gap: 1.5rem;">
                <a href="{{ route('dashboard') }}" style="display: flex; align-items: center; gap: 10px; text-decoration: none;">
                    <div style="width: 32px; height: 32px; min-width: 32px; flex-shrink: 0; border-radius: 8px; background: linear-gradient(135deg, #3b82f6, #6366f1); box-shadow: 0 0 12px rgba(59,130,246,0.7); display: flex; align-items: center; justify-content: center; color: white;">
                        <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                    </div>
                    <span class="nav-logo-text" style="font-weight: 900; font-size: 1.1rem; color: #fff; letter-spacing: 0.12em; text-transform: uppercase;">STOCKSYNC</span>
                </a>

                {{-- Nav links --}}
                <div class="nav-desktop-links" style="display: flex; align-items: center; gap: 0.5rem; margin-left: 1.5rem;">
                    <a href="{{ route('dashboard') }}"
                       style="display: inline-flex; align-items: center; gap: 6px; padding: 6px 14px; border-radius: 8px; font-size: 0.875rem; font-weight: 600; text-decoration: none; transition: all 0.2s; {{ request()->routeIs('dashboard') ? 'color: #93c5fd; background: rgba(59,130,246,0.1); border: 1px solid rgba(59,130,246,0.25);' : 'color: #cbd5e1; border: 1px solid transparent;' }}">
                        <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                        Dashboard
                    </a>
                    
                    <a href="{{ route('categories.index') }}"
                       style="display: inline-flex; align-items: center; gap: 6px; padding: 6px 14px; border-radius: 8px; font-size: 0.875rem; font-weight: 600; text-decoration: none; transition: all 0.2s; {{ request()->routeIs('categories.*') ? 'color: #93c5fd; background: rgba(59,130,246,0.1); border: 1px solid rgba(59,130,246,0.25);' : 'color: #cbd5e1; border: 1px solid transparent;' }}">
                        <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                        Categorías
                    </a>

                    <a href="{{ route('products.index') }}"
                       style="display: inline-flex; align-items: center; gap: 6px; padding: 6px 14px; border-radius: 8px; font-size: 0.875rem; font-weight: 600; text-decoration: none; transition: all 0.2s; {{ request()->routeIs('products.*') ? 'color: #93c5fd; background: rgba(59,130,246,0.1); border: 1px solid rgba(59,130,246,0.25);' : 'color: #cbd5e1; border: 1px solid transparent;' }}">
                        <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                        Productos
                    </a>
                </div>
            </div>

            {{-- Right side (Notifications + User dropdown) --}}
            <div style="display: flex; align-items: center; gap: 0.5rem;">
                
                {{-- Mobile Menu Toggle --}}
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="nav-mobile-btn" style="background: transparent; border: none; color: #cbd5e1; cursor: pointer; padding: 6px; border-radius: 8px; align-items: center; justify-content: center;">
                    <svg x-show="!mobileMenuOpen" width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    <svg x-show="mobileMenuOpen" style="display:none;" width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>

                {{-- Notification Bell --}}
                @php
                    $alertsCount = \App\Models\Product::whereColumn('stock', '<=', 'min_stock')->count();
                @endphp
                <div style="position: relative;">
                    <a href="{{ route('dashboard') }}" style="display: flex; align-items: center; justify-content: center; width: 36px; height: 36px; border-radius: 50%; background: rgba(255,255,255,0.05); color: #cbd5e1; transition: all 0.2s; text-decoration: none;"
                       onmouseover="this.style.background='rgba(255,255,255,0.1)'; this.style.color='#fff'"
                       onmouseout="this.style.background='rgba(255,255,255,0.05)'; this.style.color='#cbd5e1'">
                        <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                    </a>
                    @if($alertsCount > 0)
                        <span style="position: absolute; top: -2px; right: -2px; background: #ef4444; color: white; font-size: 0.65rem; font-weight: bold; width: 18px; height: 18px; display: flex; align-items: center; justify-content: center; border-radius: 50%; border: 2px solid #0b1120;">
                            {{ $alertsCount }}
                        </span>
                    @endif
                </div>

            {{-- User dropdown --}}
            <div style="display: flex; align-items: center; gap: 1rem;">
                <div style="position: relative;" x-data="{ open: false }" @click.outside="open = false">
                    <button @click="open = !open"
                            style="display: inline-flex; align-items: center; gap: 8px; padding: 8px 16px; border-radius: 10px; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); color: #cbd5e1; font-size: 0.875rem; font-weight: 600; cursor: pointer; transition: all 0.2s;"
                            onmouseover="this.style.background='rgba(255,255,255,0.09)'; this.style.borderColor='rgba(255,255,255,0.2)'"
                            onmouseout="this.style.background='rgba(255,255,255,0.05)'; this.style.borderColor='rgba(255,255,255,0.1)'">
                        <div style="width: 28px; height: 28px; min-width: 28px; min-height: 28px; flex-shrink: 0; border-radius: 50%; background: linear-gradient(135deg, #3b82f6, #6366f1); display: flex; align-items: center; justify-content: center; font-size: 0.75rem; font-weight: 700; color: #fff;">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                        <span class="user-name-text">{{ Auth::user()->name }}</span>
                        <svg style="width: 14px; height: 14px; transition: transform 0.2s;" :style="open ? 'transform: rotate(180deg)' : ''" fill="none" stroke="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                        </svg>
                    </button>

                    <div x-show="open" x-transition:enter="transition ease-out duration-150"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-100"
                         x-transition:leave-start="opacity-100 scale-100"
                         x-transition:leave-end="opacity-0 scale-95"
                         style="display: none; position: absolute; right: 0; top: calc(100% + 8px); width: 200px; border-radius: 12px; background: #111827; border: 1px solid rgba(255,255,255,0.1); box-shadow: 0 20px 40px rgba(0,0,0,0.6); overflow: hidden; z-index: 100;">
                        <div style="padding: 4px;">
                            <a href="{{ route('profile.edit') }}"
                               style="display: flex; align-items: center; gap: 8px; padding: 10px 14px; border-radius: 8px; color: #94a3b8; font-size: 0.875rem; font-weight: 500; text-decoration: none; transition: all 0.15s;"
                               onmouseover="this.style.background='rgba(255,255,255,0.06)'; this.style.color='#fff'"
                               onmouseout="this.style.background='transparent'; this.style.color='#94a3b8'">
                                <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                Mi Perfil
                            </a>
                            <div style="height: 1px; background: rgba(255,255,255,0.06); margin: 4px 0;"></div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                        style="width: 100%; display: flex; align-items: center; gap: 8px; padding: 10px 14px; border-radius: 8px; color: #f87171; font-size: 0.875rem; font-weight: 500; background: transparent; border: none; cursor: pointer; transition: all 0.15s; text-align: left;"
                                        onmouseover="this.style.background='rgba(248,113,113,0.08)'"
                                        onmouseout="this.style.background='transparent'">
                                    <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                                    Cerrar Sesión
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Mobile Menu --}}
    <div x-show="mobileMenuOpen" style="display: none; background: rgba(11,17,32,0.95); border-top: 1px solid rgba(255,255,255,0.05); padding: 1rem;">
        <a href="{{ route('dashboard') }}" style="display: block; padding: 12px; color: {{ request()->routeIs('dashboard') ? '#60a5fa' : '#cbd5e1' }}; font-weight: 600; text-decoration: none; border-bottom: 1px solid rgba(255,255,255,0.05);">Dashboard</a>
        <a href="{{ route('categories.index') }}" style="display: block; padding: 12px; color: {{ request()->routeIs('categories.*') ? '#60a5fa' : '#cbd5e1' }}; font-weight: 600; text-decoration: none; border-bottom: 1px solid rgba(255,255,255,0.05);">Categorías</a>
        <a href="{{ route('products.index') }}" style="display: block; padding: 12px; color: {{ request()->routeIs('products.*') ? '#60a5fa' : '#cbd5e1' }}; font-weight: 600; text-decoration: none;">Productos</a>
    </div>
</nav>