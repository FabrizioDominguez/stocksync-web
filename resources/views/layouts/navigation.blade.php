<nav x-data="{ open: false }" class="bg-slate-800 border-b border-slate-700 shadow-md">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="text-2xl font-black text-white tracking-widest uppercase">
                        Stock<span class="text-blue-500">Sync</span>
                    </a>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center px-1 pt-1 border-b-2 border-blue-500 text-sm font-bold leading-5 text-white focus:outline-none transition duration-150 ease-in-out">
                        Inventario
                    </a>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <div class="relative" x-data="{ open: false }" @click.outside="open = false" @close.stop="open = false">
                    <div @click="open = ! open">
                        <button class="inline-flex items-center px-4 py-2 border border-slate-600 rounded-lg text-sm font-semibold text-slate-200 bg-slate-900 hover:text-white hover:border-slate-500 focus:outline-none transition ease-in-out duration-150 shadow-sm">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ms-2">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </div>
                    <div x-show="open" x-transition style="display: none;" class="absolute z-50 mt-2 w-48 rounded-lg shadow-xl origin-top-right right-0 border border-slate-700">
                        <div class="rounded-lg py-1 bg-slate-800">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full px-4 py-3 text-start text-sm font-medium text-slate-300 hover:bg-slate-700 hover:text-white transition duration-150 ease-in-out">
                                    Cerrar Sesión
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>