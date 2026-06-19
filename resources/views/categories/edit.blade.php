<x-app-layout>
    <div style="max-width: 800px; margin: 2rem auto; padding: 0 1.5rem;">
        
        <div style="margin-bottom: 2rem;">
            <a href="{{ route('categories.index') }}" style="display: inline-flex; align-items: center; gap: 6px; color: #94a3b8; text-decoration: none; font-size: 0.875rem; font-weight: 500; transition: color 0.2s;" onmouseover="this.style.color='#fff'" onmouseout="this.style.color='#94a3b8'">
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Volver a categorías
            </a>
            <h1 style="font-size: 1.875rem; font-weight: 800; color: #fff; margin: 1rem 0 0 0; letter-spacing: -0.025em;">Editar Categoría: {{ $category->name }}</h1>
        </div>

        <div class="glass-card" style="border-radius: 16px; padding: 2rem;">
            <form action="{{ route('categories.update', $category) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div style="margin-bottom: 1.5rem;">
                    <label for="name" style="display: block; color: #cbd5e1; font-size: 0.875rem; font-weight: 600; margin-bottom: 0.5rem;">Nombre de la Categoría <span style="color: #f87171;">*</span></label>
                    <input type="text" name="name" id="name" value="{{ old('name', $category->name) }}" required
                           style="width: 100%; background: rgba(0,0,0,0.2); border: 1px solid rgba(255,255,255,0.1); color: #fff; border-radius: 8px; padding: 10px 14px; font-family: inherit; transition: all 0.2s; outline: none;"
                           onfocus="this.style.borderColor='#3b82f6'; this.style.boxShadow='0 0 0 2px rgba(59,130,246,0.2)'"
                           onblur="this.style.borderColor='rgba(255,255,255,0.1)'; this.style.boxShadow='none'">
                    @error('name')
                        <p style="color: #f87171; font-size: 0.75rem; margin-top: 0.5rem;">{{ $message }}</p>
                    @enderror
                </div>

                <div style="margin-bottom: 2rem;">
                    <label for="description" style="display: block; color: #cbd5e1; font-size: 0.875rem; font-weight: 600; margin-bottom: 0.5rem;">Descripción (Opcional)</label>
                    <textarea name="description" id="description" rows="3"
                              style="width: 100%; background: rgba(0,0,0,0.2); border: 1px solid rgba(255,255,255,0.1); color: #fff; border-radius: 8px; padding: 10px 14px; font-family: inherit; transition: all 0.2s; outline: none; resize: vertical;"
                              onfocus="this.style.borderColor='#3b82f6'; this.style.boxShadow='0 0 0 2px rgba(59,130,246,0.2)'"
                              onblur="this.style.borderColor='rgba(255,255,255,0.1)'; this.style.boxShadow='none'">{{ old('description', $category->description) }}</textarea>
                    @error('description')
                        <p style="color: #f87171; font-size: 0.75rem; margin-top: 0.5rem;">{{ $message }}</p>
                    @enderror
                </div>

                <div style="display: flex; justify-content: flex-end; gap: 1rem;">
                    <a href="{{ route('categories.index') }}" style="display: inline-flex; align-items: center; justify-content: center; padding: 10px 20px; border-radius: 8px; background: rgba(255,255,255,0.05); color: #cbd5e1; font-weight: 600; text-decoration: none; border: 1px solid rgba(255,255,255,0.1); transition: all 0.2s;" onmouseover="this.style.background='rgba(255,255,255,0.1)'" onmouseout="this.style.background='rgba(255,255,255,0.05)'">
                        Cancelar
                    </a>
                    <button type="submit" style="display: inline-flex; align-items: center; justify-content: center; padding: 10px 24px; border-radius: 8px; background: linear-gradient(135deg, #10b981, #059669); color: white; font-weight: 600; border: none; cursor: pointer; box-shadow: 0 4px 14px rgba(16,185,129,0.4); transition: all 0.2s;" onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform='none'">
                        Guardar Cambios
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
