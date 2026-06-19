<x-app-layout>
    <div style="max-width: 1280px; margin: 2rem auto; padding: 0 1.5rem;">
        
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; flex-wrap: wrap; gap: 1rem;">
            <div>
                <h1 style="font-size: 1.875rem; font-weight: 800; color: #fff; margin: 0; letter-spacing: -0.025em;">Panel de Control</h1>
                <p style="color: #94a3b8; margin: 0.5rem 0 0 0;">Resumen del estado de tu inventario.</p>
            </div>
            <div>
                <a href="{{ route('shop.index') }}" target="_blank" style="display: inline-flex; align-items: center; gap: 8px; background: #3b82f6; color: white; font-weight: 600; padding: 10px 20px; border-radius: 12px; text-decoration: none; transition: all 0.2s; box-shadow: 0 4px 12px rgba(59,130,246,0.3);" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 16px rgba(59,130,246,0.4)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 12px rgba(59,130,246,0.3)'">
                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    Ver Catálogo Público
                </a>
            </div>
        </div>

        {{-- Tarjetas de Resumen --}}
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem; margin-bottom: 2.5rem;">
            
            {{-- Total Productos --}}
            <div class="glass-card" style="padding: 1.5rem; border-radius: 16px; position: relative; overflow: hidden;">
                <div style="position: absolute; top: -15px; right: -15px; width: 100px; height: 100px; background: rgba(59,130,246,0.1); border-radius: 50%; filter: blur(20px);"></div>
                <div style="display: flex; align-items: center; justify-content: space-between; position: relative; z-index: 1;">
                    <div>
                        <p style="color: #94a3b8; font-size: 0.875rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; margin: 0 0 0.5rem 0;">Total Productos</p>
                        <h3 style="color: #fff; font-size: 2.5rem; font-weight: 800; margin: 0;">{{ $totalProducts ?? 0 }}</h3>
                    </div>
                    <div style="width: 48px; height: 48px; border-radius: 12px; background: rgba(59,130,246,0.15); display: flex; align-items: center; justify-content: center; color: #60a5fa;">
                        <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                    </div>
                </div>
            </div>

            {{-- Total Categorías --}}
            <div class="glass-card" style="padding: 1.5rem; border-radius: 16px; position: relative; overflow: hidden;">
                <div style="position: absolute; top: -15px; right: -15px; width: 100px; height: 100px; background: rgba(139,92,246,0.1); border-radius: 50%; filter: blur(20px);"></div>
                <div style="display: flex; align-items: center; justify-content: space-between; position: relative; z-index: 1;">
                    <div>
                        <p style="color: #94a3b8; font-size: 0.875rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; margin: 0 0 0.5rem 0;">Categorías</p>
                        <h3 style="color: #fff; font-size: 2.5rem; font-weight: 800; margin: 0;">{{ $totalCategories ?? 0 }}</h3>
                    </div>
                    <div style="width: 48px; height: 48px; border-radius: 12px; background: rgba(139,92,246,0.15); display: flex; align-items: center; justify-content: center; color: #a78bfa;">
                        <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                    </div>
                </div>
            </div>

            {{-- Alertas Stock --}}
            <div class="glass-card" style="padding: 1.5rem; border-radius: 16px; position: relative; overflow: hidden; {{ count($criticalStockProducts ?? []) > 0 ? 'border: 1px solid rgba(239,68,68,0.3); background: rgba(239,68,68,0.05);' : '' }}">
                <div style="position: absolute; top: -15px; right: -15px; width: 100px; height: 100px; background: rgba(239,68,68,0.1); border-radius: 50%; filter: blur(20px);"></div>
                <div style="display: flex; align-items: center; justify-content: space-between; position: relative; z-index: 1;">
                    <div>
                        <p style="color: {{ count($criticalStockProducts ?? []) > 0 ? '#fca5a5' : '#94a3b8' }}; font-size: 0.875rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; margin: 0 0 0.5rem 0;">Stock Crítico</p>
                        <h3 style="color: {{ count($criticalStockProducts ?? []) > 0 ? '#ef4444' : '#fff' }}; font-size: 2.5rem; font-weight: 800; margin: 0;">{{ count($criticalStockProducts ?? []) }}</h3>
                    </div>
                    <div style="width: 48px; height: 48px; border-radius: 12px; background: rgba(239,68,68,0.15); display: flex; align-items: center; justify-content: center; color: #ef4444;">
                        <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                    </div>
                </div>
            </div>
        </div>

        {{-- Tabla de Alertas de Stock --}}
        @if(isset($criticalStockProducts) && count($criticalStockProducts) > 0)
        <div class="glass-card" style="border-radius: 16px; overflow: hidden; border: 1px solid rgba(239,68,68,0.3);">
            <div style="padding: 1.5rem; border-bottom: 1px solid rgba(255,255,255,0.05); background: rgba(239,68,68,0.05);">
                <h2 style="color: #fca5a5; font-size: 1.125rem; font-weight: 700; margin: 0; display: flex; align-items: center; gap: 8px;">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                    Atención: Productos próximos a agotarse
                </h2>
            </div>
            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse; text-align: left;">
                    <thead>
                        <tr style="background: rgba(0,0,0,0.2);">
                            <th style="padding: 1rem 1.5rem; color: #94a3b8; font-size: 0.75rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em;">Código</th>
                            <th style="padding: 1rem 1.5rem; color: #94a3b8; font-size: 0.75rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em;">Producto</th>
                            <th style="padding: 1rem 1.5rem; color: #94a3b8; font-size: 0.75rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em;">Stock Actual</th>
                            <th style="padding: 1rem 1.5rem; color: #94a3b8; font-size: 0.75rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em;">Mínimo Ideal</th>
                            <th style="padding: 1rem 1.5rem; color: #94a3b8; font-size: 0.75rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em;">Estado</th>
                        </tr>
                    </thead>
                    <tbody style="divide-y divide-rgba(255,255,255,0.05);">
                        @foreach($criticalStockProducts as $product)
                        <tr style="border-top: 1px solid rgba(255,255,255,0.05); transition: background 0.2s;" onmouseover="this.style.background='rgba(255,255,255,0.02)'" onmouseout="this.style.background='transparent'">
                            <td style="padding: 1rem 1.5rem; font-family: monospace; color: #cbd5e1;">{{ $product->barcode }}</td>
                            <td style="padding: 1rem 1.5rem; font-weight: 500; color: #fff;">{{ $product->name }}</td>
                            <td style="padding: 1rem 1.5rem;">
                                <span style="display: inline-flex; align-items: center; justify-content: center; padding: 4px 10px; border-radius: 9999px; font-size: 0.75rem; font-weight: 700; background: rgba(239,68,68,0.1); color: #ef4444; border: 1px solid rgba(239,68,68,0.2);">
                                    {{ $product->stock }}
                                </span>
                            </td>
                            <td style="padding: 1rem 1.5rem; color: #94a3b8;">{{ $product->min_stock }}</td>
                            <td style="padding: 1rem 1.5rem;">
                                @if($product->stock == 0)
                                    <span style="color: #ef4444; font-size: 0.875rem; font-weight: 600;">Agotado</span>
                                @else
                                    <span style="color: #fbbf24; font-size: 0.875rem; font-weight: 600;">Crítico</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif

    </div>
</x-app-layout>
