<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Agregar Nuevo Producto') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-8 border border-gray-100">
                
                @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded-lg text-sm">
                        <p class="font-bold mb-2">Por favor corrige los siguientes errores:</p>
                        <ul class="list-disc pl-5 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('products.store') }}" method="POST">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="block text-gray-700 font-bold mb-2 text-sm">Código de Barra / Identificador</label>
                            <input type="text" name="barcode" value="{{ old('barcode') }}" placeholder="Ej: LT-ASU-100" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500" required>
                        </div>
                        <div>
                            <label class="block text-gray-700 font-bold mb-2 text-sm">Categoría</label>
                            <select name="category_id" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500" required>
                                <option value="">Selecciona una categoría</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 font-bold mb-2 text-sm">Nombre Completo del Producto</label>
                        <input type="text" name="name" value="{{ old('name') }}" placeholder="Ej: Memoria RAM Corsair Vengeance 16GB" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500" required>
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 font-bold mb-2 text-sm">Ficha Técnica / Especificaciones Detalladas</label>
                        <textarea name="technical_specs" rows="4" placeholder="Detalla puertos, velocidades, rendimiento, etc..." class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">{{ old('technical_specs') }}</textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                        <div>
                            <label class="block text-gray-700 font-bold mb-2 text-sm">Precio Unitario (Bs.)</label>
                            <input type="number" step="0.01" name="price" value="{{ old('price') }}" placeholder="0.00" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500" required>
                        </div>
                        <div>
                            <label class="block text-gray-700 font-bold mb-2 text-sm">Stock Inicial</label>
                            <input type="number" name="stock" value="{{ old('stock') }}" placeholder="0" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500" required>
                        </div>
                        <div>
                            <label class="block text-gray-700 font-bold mb-2 text-sm">Stock Mínimo Alerta</label>
                            <input type="number" name="min_stock" value="{{ old('min_stock', 5) }}" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500" required>
                        </div>
                    </div>

                    <div class="flex justify-end gap-4 border-t border-gray-100 pt-6">
                        <a href="{{ route('dashboard') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold py-2 px-6 rounded-lg transition-colors">Cancelar</a>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg shadow-md transition-colors">Guardar Producto</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>