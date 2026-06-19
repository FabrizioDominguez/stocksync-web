<x-app-layout>
<style>
    /* ===== DASHBOARD STYLES ===== */
    .dashboard-wrapper {
        max-width: 1280px;
        margin: 0 auto;
        padding: 2.5rem 1.5rem;
    }

    /* Page header */
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 2rem;
        gap: 1rem;
        flex-wrap: wrap;
    }
    .page-header-left h1 {
        font-size: 1.875rem;
        font-weight: 800;
        color: #f1f5f9;
        margin: 0 0 4px 0;
        letter-spacing: -0.02em;
    }
    .page-header-left p {
        font-size: 0.875rem;
        color: #64748b;
        margin: 0;
    }

    /* Add product button */
    .btn-primary {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 20px;
        border-radius: 10px;
        font-size: 0.875rem;
        font-weight: 700;
        color: #fff;
        text-decoration: none;
        position: relative;
        transition: all 0.2s;
        border: none;
        cursor: pointer;
        white-space: nowrap;
    }
    .btn-primary-inner {
        position: relative;
        z-index: 2;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 20px;
        border-radius: 10px;
        background: #0b1120;
        color: #fff;
        font-weight: 700;
        font-size: 0.875rem;
        text-decoration: none;
        transition: background 0.2s;
    }
    .btn-primary-wrapper {
        position: relative;
        display: inline-block;
    }
    .btn-primary-glow {
        position: absolute;
        inset: -2px;
        border-radius: 12px;
        background: linear-gradient(135deg, #3b82f6, #6366f1);
        opacity: 0.8;
        filter: blur(4px);
        transition: opacity 0.2s;
    }
    .btn-primary-wrapper:hover .btn-primary-glow { opacity: 1; }
    .btn-primary-wrapper:hover .btn-primary-inner { background: #0f1929; }

    /* Stats row */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
        margin-bottom: 2rem;
    }
    .stat-card {
        background: rgba(255,255,255,0.04);
        border: 1px solid rgba(255,255,255,0.08);
        border-radius: 16px;
        padding: 1.25rem 1.5rem;
        display: flex;
        align-items: center;
        gap: 1rem;
        transition: border-color 0.2s, background 0.2s;
    }
    .stat-card:hover {
        background: rgba(255,255,255,0.06);
        border-color: rgba(59,130,246,0.3);
    }
    .stat-icon {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    .stat-icon svg { width: 20px; height: 20px; }
    .stat-icon.blue { background: rgba(59,130,246,0.15); color: #60a5fa; }
    .stat-icon.green { background: rgba(34,197,94,0.15); color: #4ade80; }
    .stat-icon.red { background: rgba(239,68,68,0.15); color: #f87171; }
    .stat-icon.purple { background: rgba(139,92,246,0.15); color: #a78bfa; }
    .stat-info {}
    .stat-value {
        font-size: 1.5rem;
        font-weight: 800;
        color: #f1f5f9;
        line-height: 1;
        margin-bottom: 4px;
    }
    .stat-label {
        font-size: 0.75rem;
        color: #64748b;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    /* Alert banner */
    .alert-success {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 14px 18px;
        border-radius: 12px;
        background: rgba(34,197,94,0.08);
        border: 1px solid rgba(34,197,94,0.2);
        color: #4ade80;
        font-size: 0.875rem;
        font-weight: 600;
        margin-bottom: 1.5rem;
    }
    .alert-success svg { width: 18px; height: 18px; flex-shrink: 0; }

    /* Toolbar */
    .toolbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.25rem;
        gap: 1rem;
        flex-wrap: wrap;
    }
    .search-box {
        position: relative;
        flex: 1;
        max-width: 340px;
    }
    .search-box input {
        width: 100%;
        padding: 9px 14px 9px 38px;
        border-radius: 10px;
        background: rgba(255,255,255,0.05);
        border: 1px solid rgba(255,255,255,0.09);
        color: #e2e8f0;
        font-size: 0.875rem;
        outline: none;
        transition: all 0.2s;
        box-sizing: border-box;
    }
    .search-box input::placeholder { color: #475569; }
    .search-box input:focus {
        background: rgba(255,255,255,0.07);
        border-color: rgba(59,130,246,0.5);
        box-shadow: 0 0 0 3px rgba(59,130,246,0.1);
    }
    .search-icon {
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        width: 15px;
        height: 15px;
        color: #475569;
    }
    .toolbar-info {
        font-size: 0.8rem;
        color: #475569;
    }

    /* Table container */
    .table-card {
        background: rgba(255,255,255,0.03);
        border: 1px solid rgba(255,255,255,0.07);
        border-radius: 20px;
        overflow: hidden;
    }
    .table-wrapper {
        overflow-x: auto;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.875rem;
    }
    thead tr {
        background: rgba(0,0,0,0.3);
        border-bottom: 1px solid rgba(255,255,255,0.06);
    }
    thead th {
        padding: 14px 20px;
        text-align: left;
        font-size: 0.7rem;
        font-weight: 700;
        color: #475569;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        white-space: nowrap;
    }
    thead th.center { text-align: center; }
    tbody tr {
        border-bottom: 1px solid rgba(255,255,255,0.04);
        transition: background 0.15s;
    }
    tbody tr:last-child { border-bottom: none; }
    tbody tr:hover { background: rgba(255,255,255,0.03); }
    tbody td {
        padding: 16px 20px;
        color: #cbd5e1;
        vertical-align: middle;
    }
    tbody td.center { text-align: center; }

    /* Cell types */
    .cell-barcode {
        font-family: 'Courier New', monospace;
        font-size: 0.8rem;
        color: #475569;
        background: rgba(255,255,255,0.04);
        padding: 4px 8px !important;
        border-radius: 6px;
        display: inline-block;
    }
    .cell-name {
        font-weight: 700;
        color: #f1f5f9 !important;
        font-size: 0.9rem;
    }
    .cell-category {
        color: #94a3b8 !important;
    }
    .cell-price {
        font-weight: 700;
        color: #60a5fa !important;
        font-size: 0.9rem;
    }
    .cell-price span.currency {
        font-size: 0.7rem;
        color: #475569;
        font-weight: 500;
        margin-right: 2px;
    }

    /* Stock badges */
    .badge-stock {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 4px 10px;
        border-radius: 8px;
        font-size: 0.78rem;
        font-weight: 700;
        white-space: nowrap;
    }
    .badge-stock .dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        flex-shrink: 0;
    }
    .badge-stock.ok {
        background: rgba(34,197,94,0.1);
        border: 1px solid rgba(34,197,94,0.2);
        color: #4ade80;
    }
    .badge-stock.ok .dot { background: #4ade80; }
    .badge-stock.low {
        background: rgba(239,68,68,0.1);
        border: 1px solid rgba(239,68,68,0.2);
        color: #f87171;
    }
    .badge-stock.low .dot { background: #f87171; box-shadow: 0 0 6px rgba(248,113,113,0.6); animation: pulse 1.5s infinite; }
    @keyframes pulse { 0%, 100% { opacity: 1; } 50% { opacity: 0.4; } }

    /* Status badges */
    .badge-status {
        display: inline-block;
        padding: 4px 10px;
        border-radius: 8px;
        font-size: 0.72rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.06em;
    }
    .badge-status.active {
        background: rgba(59,130,246,0.1);
        border: 1px solid rgba(59,130,246,0.25);
        color: #60a5fa;
    }
    .badge-status.inactive {
        background: rgba(100,116,139,0.1);
        border: 1px solid rgba(100,116,139,0.2);
        color: #64748b;
    }

    /* Action buttons */
    .action-group {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
    }
    .action-btn {
        width: 34px;
        height: 34px;
        border-radius: 9px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: rgba(255,255,255,0.04);
        border: 1px solid rgba(255,255,255,0.08);
        color: #64748b;
        text-decoration: none;
        cursor: pointer;
        transition: all 0.15s;
    }
    .action-btn svg { width: 15px; height: 15px; }
    .action-btn.edit:hover {
        background: rgba(99,102,241,0.15);
        border-color: rgba(99,102,241,0.4);
        color: #a5b4fc;
    }
    .action-btn.delete:hover {
        background: rgba(239,68,68,0.12);
        border-color: rgba(239,68,68,0.35);
        color: #f87171;
    }

    /* Empty state */
    .empty-state {
        padding: 4rem 2rem;
        text-align: center;
    }
    .empty-icon {
        width: 60px;
        height: 60px;
        border-radius: 16px;
        background: rgba(255,255,255,0.05);
        border: 1px solid rgba(255,255,255,0.08);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.25rem;
        color: #475569;
    }
    .empty-icon svg { width: 28px; height: 28px; }
    .empty-state h3 { color: #94a3b8; font-size: 1rem; font-weight: 600; margin: 0 0 6px; }
    .empty-state p { color: #475569; font-size: 0.875rem; margin: 0; }
</style>

<div class="dashboard-wrapper">

    {{-- Page Header --}}
    <div class="page-header">
        <div class="page-header-left">
            <h1>Inventario de Productos</h1>
            <p>Gestiona tu stock, precios y componentes en tiempo real.</p>
        </div>
        <div class="btn-primary-wrapper">
            <div class="btn-primary-glow"></div>
            <a href="{{ route('products.create') }}" class="btn-primary-inner">
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                </svg>
                Agregar Producto
            </a>
        </div>
    </div>

    {{-- Stats Cards --}}
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon blue">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
            </div>
            <div class="stat-info">
                <div class="stat-value">{{ $products->count() }}</div>
                <div class="stat-label">Total Productos</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon green">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <div class="stat-info">
                <div class="stat-value">{{ $products->where('status','active')->count() }}</div>
                <div class="stat-label">Activos</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon red">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
            </div>
            <div class="stat-info">
                <div class="stat-value">{{ $products->filter(fn($p) => $p->stock <= $p->min_stock)->count() }}</div>
                <div class="stat-label">Stock Bajo</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon purple">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
            </div>
            <div class="stat-info">
                <div class="stat-value">{{ $products->pluck('category_id')->unique()->count() }}</div>
                <div class="stat-label">Categorías</div>
            </div>
        </div>
    </div>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert-success">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            {{ session('success') }}
        </div>
    @endif

    {{-- Toolbar --}}
    <div class="toolbar">
        <div class="search-box">
            <svg class="search-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            <input type="text" id="searchInput" placeholder="Buscar por nombre, código o categoría..." oninput="filterTable()">
        </div>
        <div class="toolbar-info" id="resultCount">{{ $products->count() }} productos</div>
    </div>

    {{-- Table --}}
    <div class="table-card">
        <div class="table-wrapper">
            <table id="productsTable">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Producto</th>
                        <th>Categoría</th>
                        <th>Precio (Bs.)</th>
                        <th class="center">Stock</th>
                        <th class="center">Estado</th>
                        <th class="center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $item)
                        <tr>
                            <td>
                                <span class="cell-barcode">{{ $item->barcode }}</span>
                            </td>
                            <td>
                                <div style="display: flex; align-items: center; gap: 12px;">
                                    @if($item->image_path)
                                        <div style="width: 40px; height: 40px; border-radius: 8px; overflow: hidden; background: #1e293b; border: 1px solid rgba(255,255,255,0.1); flex-shrink: 0;">
                                            <img src="{{ Storage::url($item->image_path) }}" alt="{{ $item->name }}" style="width: 100%; height: 100%; object-fit: cover;">
                                        </div>
                                    @else
                                        <div style="width: 40px; height: 40px; border-radius: 8px; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); display: flex; align-items: center; justify-content: center; color: #475569; flex-shrink: 0;">
                                            <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                        </div>
                                    @endif
                                    <div>
                                        <span class="cell-name">{{ $item->name }}</span>
                                        @if($item->technical_specs)
                                            <div style="font-size:0.75rem; color:#475569; margin-top:3px; max-width:260px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;">
                                                {{ $item->technical_specs }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="cell-category">{{ $item->category->name }}</span>
                            </td>
                            <td>
                                <span class="cell-price">
                                    <span class="currency">Bs.</span>{{ number_format($item->price, 2) }}
                                </span>
                            </td>
                            <td class="center">
                                @if($item->stock <= $item->min_stock)
                                    <span class="badge-stock low">
                                        <span class="dot"></span>
                                        {{ $item->stock }} Und.
                                    </span>
                                @else
                                    <span class="badge-stock ok">
                                        <span class="dot"></span>
                                        {{ $item->stock }} Und.
                                    </span>
                                @endif
                            </td>
                            <td class="center">
                                <span class="badge-status {{ $item->status === 'active' ? 'active' : 'inactive' }}">
                                    {{ $item->status === 'active' ? 'Activo' : 'Inactivo' }}
                                </span>
                            </td>
                            <td class="center">
                                <div class="action-group">
                                    <a href="{{ route('products.edit', $item->id) }}" class="action-btn edit" title="Editar producto">
                                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                                    </a>
                                    <form action="{{ route('products.destroy', $item->id) }}" method="POST" style="display:inline; margin:0;" onsubmit="return confirmDelete(event, '¿Estás seguro de eliminar el producto «{{ $item->name }}» del inventario? Esta acción no se puede deshacer.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="action-btn delete" title="Eliminar producto">
                                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">
                                <div class="empty-state">
                                    <div class="empty-icon">
                                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                                    </div>
                                    <h3>Sin productos en el inventario</h3>
                                    <p>Agrega tu primer producto para comenzar a gestionar tu stock.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

<script>
function filterTable() {
    const input = document.getElementById('searchInput').value.toLowerCase();
    const rows = document.querySelectorAll('#productsTable tbody tr');
    let count = 0;
    rows.forEach(row => {
        const text = row.textContent.toLowerCase();
        const match = text.includes(input);
        row.style.display = match ? '' : 'none';
        if (match) count++;
    });
    document.getElementById('resultCount').textContent = count + ' productos';
}
</script>
</x-app-layout>