<x-app-layout>
<style>
    .form-wrapper {
        max-width: 860px;
        margin: 0 auto;
        padding: 2.5rem 1.5rem;
    }
    /* Breadcrumb */
    .breadcrumb {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 1.5rem;
        font-size: 0.8rem;
        color: #475569;
    }
    .breadcrumb a { color: #60a5fa; text-decoration: none; }
    .breadcrumb a:hover { text-decoration: underline; }
    .breadcrumb svg { width: 14px; height: 14px; color: #334155; }

    /* Page title */
    .form-header { margin-bottom: 2rem; }
    .form-header h1 {
        font-size: 1.75rem; font-weight: 800; color: #f1f5f9;
        margin: 0 0 4px; letter-spacing: -0.02em;
    }
    .form-header p { font-size: 0.875rem; color: #64748b; margin: 0; }

    /* Form card */
    .form-card {
        background: rgba(255,255,255,0.04);
        border: 1px solid rgba(255,255,255,0.08);
        border-radius: 20px;
        padding: 2rem;
        backdrop-filter: blur(8px);
    }

    /* Section title inside form */
    .form-section-title {
        font-size: 0.7rem;
        font-weight: 700;
        color: #475569;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        margin-bottom: 1rem;
        padding-bottom: 8px;
        border-bottom: 1px solid rgba(255,255,255,0.06);
    }

    /* Grid layouts */
    .grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem; }
    .grid-3 { display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 1.25rem; }
    @media(max-width: 640px) {
        .grid-2, .grid-3 { grid-template-columns: 1fr; }
    }

    /* Form group */
    .form-group { margin-bottom: 1.25rem; }
    .form-group.span-2 { grid-column: 1 / -1; }
    label {
        display: block;
        font-size: 0.8rem;
        font-weight: 700;
        color: #94a3b8;
        margin-bottom: 6px;
        letter-spacing: 0.02em;
    }
    label span.required { color: #f87171; margin-left: 3px; }

    /* Inputs */
    input[type="text"],
    input[type="number"],
    textarea,
    select {
        width: 100%;
        padding: 10px 14px;
        border-radius: 10px;
        background: rgba(255,255,255,0.05);
        border: 1px solid rgba(255,255,255,0.1);
        color: #e2e8f0;
        font-size: 0.875rem;
        font-family: inherit;
        outline: none;
        transition: all 0.2s;
        box-sizing: border-box;
        appearance: none;
        -webkit-appearance: none;
    }
    input::placeholder, textarea::placeholder { color: #334155; }
    input:focus, textarea:focus, select:focus {
        background: rgba(255,255,255,0.07);
        border-color: rgba(59,130,246,0.6);
        box-shadow: 0 0 0 3px rgba(59,130,246,0.12);
    }
    select {
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20' fill='%2364748b'%3E%3Cpath fill-rule='evenodd' d='M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z' clip-rule='evenodd'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 12px center;
        background-size: 16px;
        padding-right: 36px;
        cursor: pointer;
    }
    select option { background: #1e293b; color: #e2e8f0; }
    textarea { resize: vertical; min-height: 100px; }

    /* Error alert */
    .alert-error {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        padding: 14px 18px;
        border-radius: 12px;
        background: rgba(239,68,68,0.08);
        border: 1px solid rgba(239,68,68,0.2);
        margin-bottom: 1.5rem;
    }
    .alert-error svg { width: 18px; height: 18px; color: #f87171; flex-shrink: 0; margin-top: 1px; }
    .alert-error .error-title { font-size: 0.875rem; font-weight: 700; color: #f87171; margin-bottom: 6px; }
    .alert-error ul { margin: 0; padding-left: 18px; }
    .alert-error ul li { font-size: 0.8rem; color: #fca5a5; margin-bottom: 3px; }

    /* Divider */
    .form-divider { height: 1px; background: rgba(255,255,255,0.06); margin: 1.5rem 0; }

    /* Form actions */
    .form-actions {
        display: flex;
        justify-content: flex-end;
        align-items: center;
        gap: 12px;
        padding-top: 1.25rem;
        border-top: 1px solid rgba(255,255,255,0.06);
        margin-top: 1rem;
    }
    .btn-cancel {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 10px 20px;
        border-radius: 10px;
        background: rgba(255,255,255,0.05);
        border: 1px solid rgba(255,255,255,0.1);
        color: #94a3b8;
        font-size: 0.875rem;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.2s;
        cursor: pointer;
    }
    .btn-cancel:hover {
        background: rgba(255,255,255,0.08);
        color: #e2e8f0;
    }
    .btn-submit-wrapper { position: relative; display: inline-block; }
    .btn-submit-glow {
        position: absolute; inset: -2px; border-radius: 12px;
        background: linear-gradient(135deg, #3b82f6, #6366f1);
        opacity: 0.7; filter: blur(4px); transition: opacity 0.2s;
    }
    .btn-submit-wrapper:hover .btn-submit-glow { opacity: 1; }
    .btn-submit {
        position: relative; z-index: 2;
        display: inline-flex; align-items: center; gap: 8px;
        padding: 10px 22px; border-radius: 10px;
        background: #0b1120; border: none;
        color: #fff; font-size: 0.875rem; font-weight: 700;
        cursor: pointer; transition: background 0.2s;
    }
    .btn-submit:hover { background: #0f1929; }
    .btn-submit svg { width: 16px; height: 16px; }
</style>

<div class="form-wrapper">

    {{-- Breadcrumb --}}
    <div class="breadcrumb">
        <a href="{{ route('products.index') }}">Productos</a>
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        <span>Agregar Producto</span>
    </div>

    {{-- Header --}}
    <div class="form-header">
        <h1>Agregar Producto</h1>
        <p>Completa la información del nuevo producto para agregarlo al inventario.</p>
    </div>

    {{-- Error Messages --}}
    @if ($errors->any())
        <div class="alert-error">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <div>
                <div class="error-title">Por favor corrige los siguientes errores:</div>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    {{-- Form Card --}}
    <div class="form-card">
        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- Identificación --}}
            <div class="form-section-title">Identificación</div>
            <div class="grid-2" style="margin-bottom: 1.25rem;">
                <div class="form-group">
                    <label>Código / Código de Barras <span class="required">*</span></label>
                    <input type="text" name="barcode" value="{{ old('barcode') }}" placeholder="Ej: LT-ASU-001" required>
                </div>
                <div class="form-group">
                    <label>Categoría <span class="required">*</span></label>
                    <select name="category_id" required>
                        <option value="">Selecciona una categoría...</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label>Nombre Completo del Producto <span class="required">*</span></label>
                <input type="text" name="name" value="{{ old('name') }}" placeholder="Ej: Laptop ASUS VivoBook 15 i5 8GB 512GB SSD" required>
            </div>

            <div class="form-group">
                <label>Ficha Técnica / Especificaciones</label>
                <textarea name="technical_specs" placeholder="Describe los detalles técnicos: puertos, velocidades, capacidades, compatibilidades...">{{ old('technical_specs') }}</textarea>
            </div>

            <div class="form-divider"></div>

            {{-- Imagen del Producto --}}
            <div class="form-section-title">Imagen del Producto</div>
            <div class="form-group">
                <label>Subir Imagen (Opcional)</label>
                <input type="file" name="image" accept="image/*" style="padding: 10px; background: rgba(255,255,255,0.05); border: 1px dashed rgba(255,255,255,0.2); cursor: pointer; color: #e2e8f0; border-radius: 10px; width: 100%;">
                <p style="font-size: 0.75rem; color: #64748b; margin-top: 6px; margin-bottom: 0;">Formatos permitidos: JPG, PNG, WEBP. Tamaño máximo: 2MB.</p>
            </div>

            <div class="form-divider"></div>

            {{-- Stock y Precios --}}
            <div class="form-section-title">Stock y Precio</div>
            <div class="grid-3">
                <div class="form-group">
                    <label>Precio Unitario (Bs.) <span class="required">*</span></label>
                    <input type="number" step="0.01" name="price" value="{{ old('price') }}" placeholder="0.00" min="0" required>
                </div>
                <div class="form-group">
                    <label>Stock Inicial <span class="required">*</span></label>
                    <input type="number" name="stock" value="{{ old('stock', 0) }}" placeholder="0" min="0" required>
                </div>
                <div class="form-group">
                    <label>Stock Mínimo (Alerta) <span class="required">*</span></label>
                    <input type="number" name="min_stock" value="{{ old('min_stock', 5) }}" placeholder="5" min="0" required>
                </div>
            </div>

            {{-- Actions --}}
            <div class="form-actions">
                <a href="{{ route('products.index') }}" class="btn-cancel">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width:15px;height:15px;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    Cancelar
                </a>
                <div class="btn-submit-wrapper">
                    <div class="btn-submit-glow"></div>
                    <button type="submit" class="btn-submit">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        Guardar Producto
                    </button>
                </div>
            </div>
        </form>
    </div>

</div>
</x-app-layout>