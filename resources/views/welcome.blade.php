<!DOCTYPE html>
<html lang="es" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StockSync Web - Sincronización Inteligente</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: { primary: '#3b82f6', primary_glow: '#1d4ed8', dark: '#0b1120' },
                    backgroundImage: { 'grid-pattern': "radial-gradient(rgba(255, 255, 255, 0.05) 1px, transparent 1px)" },
                    animation: { 'blob': 'blob 7s infinite' },
                    keyframes: {
                        blob: {
                            '0%': { transform: 'translate(0px, 0px) scale(1)' },
                            '33%': { transform: 'translate(30px, -50px) scale(1.1)' },
                            '66%': { transform: 'translate(-20px, 20px) scale(0.9)' },
                            '100%': { transform: 'translate(0px, 0px) scale(1)' },
                        }
                    }
                }
            }
        }
    </script>
    
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
</head>

<body class="font-sans antialiased overflow-x-hidden relative">

    <div class="fixed inset-0 overflow-hidden pointer-events-none z-0">
        <div class="absolute top-0 left-1/4 w-96 h-96 bg-blue-600/20 rounded-full mix-blend-screen filter blur-[100px] opacity-70 animate-blob"></div>
        <div class="absolute top-1/4 right-1/4 w-96 h-96 bg-indigo-600/20 rounded-full mix-blend-screen filter blur-[100px] opacity-70 animate-blob animation-delay-2000"></div>
        <div class="absolute -bottom-8 left-1/2 w-96 h-96 bg-purple-600/20 rounded-full mix-blend-screen filter blur-[100px] opacity-70 animate-blob animation-delay-4000"></div>
    </div>

    <header class="relative min-h-screen flex items-center pt-20 pb-16 overflow-hidden z-10">
        <div class="max-w-7xl mx-auto px-6 grid lg:grid-cols-2 gap-12 items-center w-full reveal active">
            <div class="text-left z-10">
                <div class="inline-flex items-center px-4 py-2 rounded-full border border-blue-500/50 bg-blue-500/10 text-blue-300 text-sm mb-6 shadow-[0_0_15px_rgba(59,130,246,0.2)]">
                    <span class="flex w-2.5 h-2.5 rounded-full bg-blue-400 mr-2 animate-pulse shadow-[0_0_8px_rgba(96,165,250,0.8)]"></span>
                    SaaS de Alto Rendimiento para Retail
                </div>
                
                <h1 class="text-5xl lg:text-6xl font-extrabold tracking-tight mb-6 leading-tight min-h-[140px] md:min-h-0">
                    Sincroniza en Tiempo Real tu Inventario y <br class="hidden md:block">
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 via-indigo-400 to-purple-400" id="typewriter"></span><span class="cursor">&nbsp;</span>
                </h1>
                
                <p class="text-lg text-slate-400 mb-10 max-w-xl leading-relaxed">
                    Deja de perder ventas por quiebres de stock. StockSync conecta el mostrador físico de tu tienda con tu página web automáticamente, sin esfuerzo manual.
                </p>
                
                <div class="flex flex-wrap gap-6 items-center">
                    <div class="relative group">
                        <div class="absolute -inset-1 bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 rounded-lg blur opacity-75 group-hover:opacity-100 transition duration-500 group-hover:duration-200 animate-pulse"></div>
                        <a href="#registro" class="relative flex items-center justify-center bg-[#0b1120] px-8 py-4 rounded-lg text-white font-bold transition-all hover:scale-[1.02]">
                            Inicia tu prueba gratis
                            <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                        </a>
                    </div>
                    <a href="#features" class="glass-card hover:bg-white/10 text-white font-semibold py-4 px-8 rounded-lg transition-all duration-300 flex items-center">Ver funciones</a>
                </div>
            </div>
            
            <div class="relative w-full z-10 hidden md:block group">
                <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[120%] h-[120%] bg-blue-500/20 blur-[120px] rounded-full group-hover:bg-blue-500/30 transition-all duration-700"></div>
                <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80" alt="Dashboard de StockSync" class="relative z-20 rounded-2xl border border-slate-700/50 shadow-[0_20px_50px_rgba(0,0,0,0.5)] animate-float">
            </div>
        </div>
    </header>

    <section class="py-24 relative z-10" id="features">
        <div class="max-w-7xl mx-auto px-6">
            <div class="glass-card rounded-3xl p-8 md:p-12 reveal shadow-2xl relative overflow-hidden group">
                <div class="absolute -top-24 -right-24 w-48 h-48 bg-blue-500/20 blur-3xl rounded-full group-hover:bg-blue-500/40 transition-all duration-500"></div>
                <div class="grid md:grid-cols-2 gap-12 relative z-10 items-center">
                    <div>
                        <h2 class="text-3xl font-bold mb-4">El Problema de Vender Tecnología Hoy</h2>
                        <p class="text-slate-400 text-lg">Llevar el control de componentes, hardware y electrodomésticos en hojas de Excel genera <strong>información desactualizada</strong>. Vender un producto físico que un cliente online acaba de comprar arruina tu reputación.</p>
                    </div>
                    <div class="border-l-2 border-blue-500/50 pl-8 relative">
                        <div class="absolute -left-[11px] top-0 w-5 h-5 bg-[#0b1120] border-4 border-blue-500 rounded-full shadow-[0_0_10px_rgba(59,130,246,1)]"></div>
                        <h3 class="text-2xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-indigo-400 mb-3">La Solución Inteligente</h3>
                        <p class="text-slate-300 text-lg">Centralizamos tu almacén en la nube. Un escaneo de código de barras en caja actualiza tu sitio web en milisegundos, blindando tu negocio contra errores administrativos.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-24 z-10 relative">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16 reveal">
                <h2 class="text-3xl md:text-5xl font-bold mb-4">Diseñado para la velocidad operativa</h2>
                <p class="text-slate-400 text-lg max-w-2xl mx-auto">Todo lo que necesitas para escalar tu negocio minorista a la era digital, desde un solo panel de control.</p>
            </div>
            
            <div class="grid md:grid-cols-3 gap-8">
                <div class="glass-card p-6 rounded-2xl hover:bg-white/5 transition-all duration-500 hover:-translate-y-3 reveal group" style="transition-delay: 100ms;">
                    <div class="h-48 rounded-xl overflow-hidden mb-6 relative">
                        <div class="absolute inset-0 bg-blue-500/20 mix-blend-overlay group-hover:opacity-0 transition-opacity z-10"></div>
                        <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700">
                    </div>
                    <h3 class="text-xl font-bold mb-2 text-white group-hover:text-blue-400 transition-colors">Sincronización Mágica</h3>
                    <p class="text-slate-400">Tu catálogo público refleja la realidad de tu almacén al instante, protegiendo tus ventas.</p>
                </div>
                <div class="glass-card p-6 rounded-2xl hover:bg-white/5 transition-all duration-500 hover:-translate-y-3 reveal group" style="transition-delay: 200ms;">
                    <div class="h-48 rounded-xl overflow-hidden mb-6 relative">
                        <div class="absolute inset-0 bg-indigo-500/20 mix-blend-overlay group-hover:opacity-0 transition-opacity z-10"></div>
                        <img src="https://images.unsplash.com/photo-1555066931-4365d14bab8c?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700">
                    </div>
                    <h3 class="text-xl font-bold mb-2 text-white group-hover:text-indigo-400 transition-colors">Fichas Técnicas PRO</h3>
                    <p class="text-slate-400">Motor de base de datos optimizado para especificaciones complejas y descripciones de hardware.</p>
                </div>
                <div class="glass-card p-6 rounded-2xl hover:bg-white/5 transition-all duration-500 hover:-translate-y-3 reveal group" style="transition-delay: 300ms;">
                    <div class="h-48 rounded-xl overflow-hidden mb-6 relative">
                        <div class="absolute inset-0 bg-purple-500/20 mix-blend-overlay group-hover:opacity-0 transition-opacity z-10"></div>
                        <img src="https://images.unsplash.com/photo-1504868584819-f8e8b4b6d7e3?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700">
                    </div>
                    <h3 class="text-xl font-bold mb-2 text-white group-hover:text-purple-400 transition-colors">Alertas Inteligentes</h3>
                    <p class="text-slate-400">Notificaciones automáticas en tiempo real cuando un dispositivo o componente alcance el stock mínimo.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-24 relative z-10">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <h2 class="text-3xl md:text-5xl font-bold mb-16 reveal">Elige el poder para tu negocio</h2>
            <div class="grid md:grid-cols-2 gap-8 max-w-4xl mx-auto">
                <div class="glass-card p-10 rounded-3xl text-left reveal hover:border-slate-500 transition-all">
                    <h3 class="text-2xl font-bold text-slate-300 mb-2">Starter</h3>
                    <div class="flex items-end gap-2 mb-8">
                        <span class="text-5xl font-extrabold">$0</span>
                        <span class="text-slate-500 mb-1">/mes</span>
                    </div>
                    <ul class="space-y-4 mb-10 text-slate-400">
                        <li class="flex items-center gap-3"><svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Hasta 100 productos</li>
                        <li class="flex items-center gap-3"><svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Catálogo web básico</li>
                        <li class="flex items-center gap-3"><svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> 1 Usuario administrador</li>
                    </ul>
                    <a href="#registro" class="block w-full py-4 text-center rounded-xl border border-blue-500/50 text-blue-400 hover:bg-blue-500/10 font-bold transition-all">Empezar Gratis</a>
                </div>
                
                <div class="bg-[#0b1120] border-2 border-blue-500 p-10 rounded-3xl text-left reveal relative shadow-[0_0_50px_rgba(59,130,246,0.2)] md:-translate-y-4 transform hover:scale-[1.02] transition-all duration-300">
                    <div class="absolute top-0 right-8 -translate-y-1/2 bg-gradient-to-r from-blue-500 to-indigo-500 text-white px-4 py-1 rounded-full text-sm font-bold shadow-[0_0_15px_rgba(59,130,246,0.5)]">RECOMENDADO</div>
                    <h3 class="text-2xl font-bold text-white mb-2">Pro Business</h3>
                    <div class="flex items-end gap-2 mb-8">
                        <span class="text-5xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-indigo-400">$29</span>
                        <span class="text-slate-400 mb-1">/mes</span>
                    </div>
                    <ul class="space-y-4 mb-10 text-slate-300">
                        <li class="flex items-center gap-3"><svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Productos ilimitados</li>
                        <li class="flex items-center gap-3"><svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Sincronización en tiempo real</li>
                        <li class="flex items-center gap-3"><svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Alertas de stock preventivas</li>
                        <li class="flex items-center gap-3"><svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Usuarios ilimitados (Roles)</li>
                    </ul>
                    
                    <div class="relative group mt-auto">
                        <div class="absolute -inset-1 bg-gradient-to-r from-blue-600 to-indigo-600 rounded-lg blur opacity-60 group-hover:opacity-100 transition duration-500"></div>
                        <a href="#registro" class="relative block w-full py-4 text-center rounded-xl bg-[#0b1120] text-white font-bold transition-all">Suscribirse Ahora</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-24 relative overflow-hidden z-10">
        <div class="max-w-4xl mx-auto px-6 relative reveal">
            <h2 class="text-3xl md:text-4xl font-bold text-center mb-12">Negocios que confían en nosotros</h2>
            <div id="carousel-container" class="relative group">
                <button id="btn-prev" class="absolute -left-4 md:-left-12 top-1/2 -translate-y-1/2 z-20 w-12 h-12 rounded-full glass-card flex items-center justify-center text-slate-400 hover:text-white hover:bg-white/20 transition-all opacity-0 group-hover:opacity-100">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                </button>
                
                <div class="overflow-hidden rounded-3xl glass-card relative z-10">
                    <div id="testimonial-track" class="flex transition-transform duration-700 ease-in-out w-full">
                        <div class="w-full flex-shrink-0 p-10 md:p-14 text-center relative">
                            <p class="text-xl md:text-2xl text-slate-300 font-medium leading-relaxed mb-8 relative z-10 pt-4">"Desde que implementamos StockSync, gestionar el inventario ha sido increíblemente rápido..."</p>
                            <div class="flex items-center justify-center gap-4">
                                <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Usuario" class="w-14 h-14 rounded-full border-2 border-[#0b1120] object-cover">
                                <div class="text-left">
                                    <p class="font-bold text-white text-lg">Roberto M.</p>
                                    <p class="text-sm text-blue-400">Gerente, Softmat Tecnología</p>
                                </div>
                            </div>
                        </div>
                        <div class="w-full flex-shrink-0 p-10 md:p-14 text-center relative">
                            <p class="text-xl md:text-2xl text-slate-300 font-medium leading-relaxed mb-8 relative z-10 pt-4">"La integración de nuestro punto de venta físico con la web fue instantánea..."</p>
                            <div class="flex items-center justify-center gap-4">
                                <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Usuario" class="w-14 h-14 rounded-full border-2 border-[#0b1120] object-cover">
                                <div class="text-left">
                                    <p class="font-bold text-white text-lg">Valeria C.</p>
                                    <p class="text-sm text-blue-400">Dueña, ElectroCenter</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <button id="btn-next" class="absolute -right-4 md:-right-12 top-1/2 -translate-y-1/2 z-20 w-12 h-12 rounded-full glass-card flex items-center justify-center text-slate-400 hover:text-white hover:bg-white/20 transition-all opacity-0 group-hover:opacity-100">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </button>
                <div id="carousel-dots" class="flex justify-center gap-2 mt-8">
                    <button class="dot-btn w-8 h-2 rounded-full bg-blue-500 shadow-[0_0_10px_rgba(59,130,246,0.8)] transition-all duration-300"></button>
                    <button class="dot-btn w-2 h-2 rounded-full bg-slate-600 transition-all duration-300 hover:bg-slate-400"></button>
                </div>
            </div>
        </div>
    </section>

    <footer id="registro" class="relative pt-32 pb-10 border-t border-white/5 overflow-hidden z-10">
        <div class="absolute bottom-0 left-1/2 -translate-x-1/2 w-[800px] h-[400px] bg-blue-600/10 blur-[150px] rounded-full pointer-events-none"></div>

        <div class="max-w-3xl mx-auto px-6 text-center mb-24 relative z-10 reveal">
            <h2 class="text-4xl font-extrabold mb-4">¿Listo para transformar tu negocio?</h2>
            <p class="text-slate-400 mb-10 text-lg">Ingresa tu correo y sé el primero en acceder a la plataforma con un mes de gracia.</p>
            
            <form id="leadForm" class="flex flex-col sm:flex-row gap-4 justify-center items-start" novalidate>
                <div class="w-full sm:w-2/3 relative text-left group">
                    <div class="absolute -inset-0.5 bg-gradient-to-r from-blue-500 to-purple-600 rounded-xl blur opacity-30 group-focus-within:opacity-60 transition duration-500"></div>
                    <input type="email" id="emailInput" required placeholder="gerencia@tutienda.com" class="relative w-full px-6 py-4 rounded-xl bg-[#0b1120] border border-white/10 text-white placeholder-slate-500 focus:outline-none focus:border-blue-500 transition-all">
                    <p id="errorMsg" class="text-red-400 text-sm mt-2 hidden absolute">Por favor, ingresa un correo válido.</p>
                </div>
                <div class="relative group w-full sm:w-auto">
                    <div class="absolute -inset-1 bg-gradient-to-r from-blue-600 to-indigo-600 rounded-xl blur opacity-70 group-hover:opacity-100 transition duration-500 animate-pulse"></div>
                    <button type="submit" class="relative w-full sm:w-auto bg-[#0b1120] text-white font-bold py-4 px-8 rounded-xl transition-all hover:scale-[1.02] whitespace-nowrap">Obtener Acceso</button>
                </div>
            </form>
        </div>

        <div class="max-w-7xl mx-auto px-6 border-t border-white/5 pt-8 flex flex-col md:flex-row justify-between items-center text-sm text-slate-500 relative z-10">
            <div class="flex items-center gap-2 mb-4 md:mb-0">
                <div class="w-6 h-6 rounded bg-gradient-to-br from-blue-500 to-indigo-600 shadow-[0_0_10px_rgba(59,130,246,0.8)]"></div>
                <span class="font-bold text-slate-300 tracking-wider">STOCKSYNC WEB</span>
                <span class="ml-2">&copy; 2026. Todos los derechos reservados.</span>
            </div>
            <div class="flex gap-6">
                <a href="#" class="hover:text-blue-400 transition-colors">Términos Legales</a>
                <a href="#" class="hover:text-blue-400 transition-colors">Política de Privacidad</a>
            </div>
        </div>
    </footer>

    <div id="successModal" class="fixed inset-0 bg-[#0b1120]/90 backdrop-blur-md flex items-center justify-center z-50 hidden opacity-0 transition-opacity duration-500">
        <div class="glass-card p-8 rounded-3xl max-w-md w-full mx-4 text-center border border-white/10 shadow-[0_0_50px_rgba(0,0,0,0.8)] transform scale-95 transition-transform duration-500" id="modalContent">
            <div class="relative mb-6 rounded-2xl overflow-hidden shadow-[0_0_20px_rgba(34,197,94,0.3)]">
                <img src="https://images.unsplash.com/photo-1587614382346-4ec70e388b28?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Registro Exitoso" class="w-full h-48 object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-[#0b1120] to-transparent"></div>
                <div class="absolute bottom-4 left-0 right-0 flex justify-center">
                    <div class="w-14 h-14 bg-green-500 rounded-full flex items-center justify-center shadow-[0_0_20px_rgba(34,197,94,0.8)]">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                </div>
            </div>
            <h3 class="text-3xl font-extrabold text-white mb-2">¡Bienvenido!</h3>
            <p class="text-slate-400 mb-8">Tu correo ha sido registrado con éxito. Hemos enviado las credenciales de acceso a tu bandeja de entrada.</p>
            <button id="closeModal" class="w-full bg-white/10 hover:bg-white/20 border border-white/10 text-white font-bold py-3 px-6 rounded-xl transition-all hover:shadow-[0_0_15px_rgba(255,255,255,0.2)]">Cerrar Ventana</button>
        </div>
    </div>

    <script src="{{ asset('js/landing.js') }}"></script>
</body>
</html>