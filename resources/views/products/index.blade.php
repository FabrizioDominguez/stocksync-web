<x-app-layout>
    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4 px-4 sm:px-0">
                <div>
                    <h2 class="text-3xl font-bold text-white tracking-tight">Inventario de Productos</h2>
                    <p class="text-slate-400 text-sm mt-1">Administra tu stock, precios y componentes del sistema.</p>
                </div>
                <a href="{{ route('products.create') }}" class="bg-blue-600 hover:bg-blue-500 text-white font-bold py-2.5 px-6 rounded-lg shadow-[0_0_15px_rgba(37,99,235,0.4)] transition-all flex items-center gap-2 border border-blue-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                    Agregar Producto
                </a>
            </div>

            @if(session('success'))
                <div class="mb-6 mx-4 sm:mx-0 bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 px-4 py-4 rounded-lg flex items-center gap-3 font-semibold shadow-sm">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-slate-800 rounded-2xl shadow-xl border border-slate-700 overflow-hidden mx-4 sm:mx-0">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-900/80 text-slate-300 text-xs uppercase tracking-widest border-b border-slate-700">
                                <th class="py-5 px-6 font-bold">Código</th>
                                <th class="py-5 px-6 font-bold">Producto</th>
                                <th class="py-5 px-6 font-bold">Categoría</th>
                                <th class="py-5 px-6 font-bold">Precio (Bs.)</th>
                                <th class="py-5 px-6 text-center font-bold">Stock</th>
                                <th class="py-5 px-6 text-center font-bold">Estado</th>
                                <th class="py-5 px-6 text-center font-bold">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-700/80 text-sm">
                            @foreach ($products as $item)
                                <tr class="hover:bg-slate-700/40 transition-colors">
                                    <td class="py-4 px-6 font-mono text-slate-400">{{ $item->barcode }}</td>
                                    <td class="py-4 px-6 font-bold text-white text-base">{{ $item->name }}</td>
                                    <td class="py-4 px-6 text-slate-300 font-medium">{{ $item->category->name }}</td>
                                    <td class="py-4 px-6 font-bold text-blue-400">{{ number_format($item->price, 2) }}</td>
                                    <td class="py-4 px-6 text-center">
                                        @if($item->stock <= $item->min_stock)
                                            <span class="bg-red-500/10 text-red-400 border border-red-500/30 px-3 py-1.5 rounded-lg font-bold text-xs flex items-center justify-center gap-1.5 w-fit mx-auto">
                                                <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>{{ $item->stock }} Und.
                                            </span>
                                        @else
                                            <span class="bg-emerald-500/10 text-emerald-400 border border-emerald-500/30 px-3 py-1.5 rounded-lg font-bold text-xs w-fit mx-auto block">
                                                {{ $item->stock }} Und.
                                            </span>
                                        @endif
                                    </td>
                                    <td class="py-4 px-6 text-center">
                                        <span class="px-3 py-1.5 rounded-lg text-xs font-bold uppercase tracking-wider {{ $item->status == 'active' ? 'bg-blue-500/10 text-blue-400 border border-blue-500/30' : 'bg-slate-600/20 text-slate-400 border border-slate-600/40' }}">
                                            {{ $item->status == 'active' ? 'Activo' : 'Inactivo' }}
                                        </span>
                                    </td>
                                    <td class="py-4 px-6">
                                        <div class="flex items-center justify-center gap-2">
                                            <a href="{{ route('products.edit', $item->id) }}" class="text-slate-400 hover:text-white bg-slate-700/50 hover:bg-indigo-500 border border-slate-600 hover:border-indigo-500 p-2.5 rounded-lg transition-all" title="Editar">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                                            </a>
                                            <form action="{{ route('products.destroy', $item->id) }}" method="POST" onsubmit="return confirm('¿Eliminar producto de forma permanente?');" class="inline m-0">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-slate-400 hover:text-white bg-slate-700/50 hover:bg-red-500 border border-slate-600 hover:border-red-500 p-2.5 rounded-lg transition-all" title="Eliminar">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>