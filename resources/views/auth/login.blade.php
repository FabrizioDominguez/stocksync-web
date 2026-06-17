<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - StockSync</title>
    <script src="https://cdn.tailwindcss.com"></script>
    
    <style>
        body { background-color: #0b1120; color: #f8fafc; font-family: ui-sans-serif, system-ui, sans-serif; }
        
        .glass-card { 
            background: rgba(255, 255, 255, 0.03); 
            backdrop-filter: blur(16px); 
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.08); 
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        }

        /* === ANIMACIONES DEL ROBOT === */
        @keyframes wobble {
            0%, 100% { transform: translateX(-50%) rotate(0deg); }
            25% { transform: translateX(-60%) rotate(-10deg) translateY(2px); }
            75% { transform: translateX(-40%) rotate(10deg) translateY(-1px); }
        }
        .animate-wobble { animation: wobble 3s ease-in-out infinite; }
        
        @keyframes blink {
            0%, 96%, 98%, 100% { transform: scaleY(1); }
            97%, 99% { transform: scaleY(0.1); } 
        }

        /* La cabeza base */
        .bot-head {
            width: 140px; height: 95px; 
            background: #1e293b; 
            border-radius: 55px 55px 35px 35px; 
            border: 5px solid #3b82f6; 
            box-shadow: inset 0 0 20px rgba(0,0,0,0.6), 0 -5px 20px rgba(59,130,246,0.5); 
            position: relative; 
            transition: all 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        }

        /* Ojos Base */
        .eye {
            position: absolute;
            background: #cbd5e1;
            border-radius: 50%;
            box-shadow: inset 0 4px 6px rgba(0,0,0,0.4);
            overflow: hidden;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .eye.left { width: 36px; height: 36px; top: 25px; left: 20px; }
        .eye.right { width: 26px; height: 26px; top: 32px; right: 26px; }

        /* Pupilas Base */
        .pupil {
            position: absolute;
            background: #0b1120;
            border-radius: 50%;
            transition: transform 0.1s ease-out, opacity 0.2s, all 0.2s;
        }
        .pupil.left { width: 16px; height: 16px; top: 10px; left: 10px; }
        .pupil.right { width: 12px; height: 12px; top: 7px; left: 7px; }

        /* --- ESTADO 1: OJOS CERRADOS --- */
        .bot-head.eyes-closed .eye {
            height: 5px;
            background: #475569; /* Gris oscuro para parecer párpado cerrado */
            box-shadow: none;
            border-radius: 5px;
        }
        .bot-head.eyes-closed .eye.left { top: 41px; }
        .bot-head.eyes-closed .eye.right { top: 43px; }
        .bot-head.eyes-closed .pupil { opacity: 0; }
        .bot-head.eyes-closed { transform: translateY(5px); } /* Se agacha un poquito al cerrar los ojos */

        /* --- ESTADO 2: ESPIANDO (Abre un ojo a medias) --- */
        .bot-head.peeking .eye.left {
            height: 18px;
            top: 34px;
            background: #cbd5e1;
            border-radius: 50% 50% 10px 10px; /* Forma de medio círculo */
        }
        .bot-head.peeking .pupil.left {
            opacity: 1;
            transform: translate(6px, -4px) !important; /* Mira hacia donde escribes disimuladamente */
        }

        /* --- ESTADO 3: ASUSTADO (¡Te vi viéndome!) --- */
        .bot-head.scared {
            transform: translateY(-8px); /* Da un pequeño salto de susto */
        }
        .bot-head.scared .eye {
            height: 42px;
            background: #fff;
            box-shadow: inset 0 0 10px rgba(59,130,246,0.5); /* Brillo de sorpresa */
        }
        .bot-head.scared .eye.left { width: 42px; top: 22px; left: 17px; }
        .bot-head.scared .eye.right { width: 32px; height: 32px; top: 29px; right: 23px; }
        .bot-head.scared .pupil {
            opacity: 1;
            width: 10px; height: 10px;
            top: 50%; left: 50%;
            transform: translate(-50%, -50%) !important; /* Pupila pequeña en el centro (shock) */
        }
    </style>
</head>
<body class="min-h-screen flex flex-col items-center justify-center relative overflow-hidden">
    
    <div class="fixed inset-0 pointer-events-none z-0">
        <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-blue-600/20 rounded-full mix-blend-screen filter blur-[100px] opacity-60"></div>
        <div class="absolute bottom-1/4 right-1/4 w-96 h-96 bg-indigo-600/20 rounded-full mix-blend-screen filter blur-[100px] opacity-60"></div>
    </div>

    <div class="w-full max-w-md relative z-10 px-6 mt-20">
        
        <div class="absolute -top-[80px] left-0 right-0 flex justify-center z-30 pointer-events-none" id="mascot-container">
            <div class="relative">
                <div class="absolute -top-5 left-1/2 -translate-x-1/2 w-1.5 h-6 bg-slate-400 rounded-t"></div>
                <div class="absolute -top-8 left-1/2 -translate-x-1/2 w-5 h-5 bg-blue-400 rounded-full shadow-[0_0_15px_#60a5fa] animate-wobble"></div>
                
                <div class="bot-head" id="bot-head">
                    <div class="eye left" id="eye-left">
                        <div class="pupil left" id="pupil-left"></div>
                    </div>
                    <div class="eye right" id="eye-right">
                        <div class="pupil right" id="pupil-right"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="glass-card rounded-3xl p-8 pt-10 relative z-20">
            <div class="text-center mb-8">
                <h2 class="text-3xl font-extrabold text-white tracking-tight">Acceso Seguro</h2>
                <p class="text-slate-400 mt-2 text-sm">Tu pequeño guardián protege tus datos</p>
            </div>

            @if ($errors->any())
                <div class="mb-4 p-3 bg-red-500/10 border border-red-500/50 rounded-lg text-red-400 text-sm text-center font-bold">
                    Credenciales incorrectas. Intenta de nuevo.
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-6">
                    <label for="email" class="block text-sm font-bold text-slate-300 mb-2">Correo Electrónico</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                        placeholder="admin@softmat.com.bo"
                        class="w-full px-4 py-3 rounded-xl bg-[#0b1120] border border-slate-700 text-white focus:border-blue-500 focus:ring-blue-500 transition-colors shadow-inner"
                        autocomplete="username">
                </div>

                <div class="mb-6">
                    <label for="password" class="block text-sm font-bold text-slate-300 mb-2">Contraseña</label>
                    <input id="password" type="password" name="password" required
                        placeholder="••••••••"
                        class="w-full px-4 py-3 rounded-xl bg-[#0b1120] border border-slate-700 text-white focus:border-blue-500 focus:ring-blue-500 transition-colors shadow-inner"
                        autocomplete="current-password">
                </div>

                <div class="flex items-center justify-between mb-8">
                    <label class="flex items-center cursor-pointer group">
                        <input type="checkbox" name="remember" class="rounded border-slate-700 bg-[#0b1120] text-blue-500 focus:ring-blue-500 cursor-pointer">
                        <span class="ml-2 text-sm text-slate-400 group-hover:text-slate-300 transition-colors">Recordar sesión</span>
                    </label>
                    <a href="/" class="text-sm text-blue-400 hover:text-blue-300 transition-colors">Volver al inicio</a>
                </div>

                <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-bold py-3 px-4 rounded-xl shadow-[0_0_15px_rgba(59,130,246,0.3)] hover:shadow-[0_0_25px_rgba(59,130,246,0.6)] transition-all transform hover:-translate-y-0.5">
                    Desbloquear Panel
                </button>
            </form>
        </div>
    </div>

    <script>
        const emailInput = document.getElementById('email');
        const passwordInput = document.getElementById('password');
        
        const botHead = document.getElementById('bot-head');
        const eyeL = document.getElementById('eye-left');
        const eyeR = document.getElementById('eye-right');
        const pupilL = document.getElementById('pupil-left');
        const pupilR = document.getElementById('pupil-right');
        
        let peekTimer;
        let scareTimer;
        let resetTimer;
        let isPasswordFocused = false;

        // --- LÓGICA DEL CORREO (SEGUIR EL TEXTO) ---
        const resetBot = () => {
            if (isPasswordFocused) return;
            botHead.style.transform = 'translateY(0)';
            pupilL.style.transform = 'translate(0px, 0px)';
            pupilR.style.transform = 'translate(0px, 0px)';
            eyeL.classList.add('animate-blink');
            eyeR.classList.add('animate-blink');
        };

        emailInput.addEventListener('input', (e) => {
            let length = e.target.value.length;
            let moveX = Math.min(Math.max((length * 0.8) - 10, -10), 10);
            pupilL.style.transform = `translate(${moveX}px, 8px)`;
            pupilR.style.transform = `translate(${moveX}px, 6px)`;
        });

        emailInput.addEventListener('focus', () => {
            botHead.classList.remove('eyes-closed', 'peeking', 'scared');
            eyeL.classList.add('animate-blink');
            eyeR.classList.add('animate-blink');
            pupilL.style.transform = `translate(-8px, 8px)`;
            pupilR.style.transform = `translate(-6px, 6px)`;
        });

        emailInput.addEventListener('blur', resetBot);

        // --- LÓGICA DE LA CONTRASEÑA (CERRAR Y ESPIAR) ---
        function startPeeking() {
            if (!isPasswordFocused) return;

            // Tiempo aleatorio entre 2 y 4 segundos para decidir espiar
            const randomDelay = Math.random() * 2000 + 2000;
            
            peekTimer = setTimeout(() => {
                if (!isPasswordFocused) return;

                // 1. Abre un ojito (Espía)
                botHead.classList.remove('eyes-closed');
                botHead.classList.add('peeking');

                // 2. Después de 1 segundo, se da cuenta y se asusta
                scareTimer = setTimeout(() => {
                    if (!isPasswordFocused) return;
                    
                    botHead.classList.remove('peeking');
                    botHead.classList.add('scared');

                    // 3. Después de 0.4 segundos, cierra los ojos de golpe (como avergonzado)
                    resetTimer = setTimeout(() => {
                        if (!isPasswordFocused) return;
                        botHead.classList.remove('scared');
                        botHead.classList.add('eyes-closed');
                        
                        // Vuelve a llamar a la función para que el ciclo se repita infinitamente
                        startPeeking(); 
                    }, 400);

                }, 1000);

            }, randomDelay);
        }

        passwordInput.addEventListener('focus', () => {
            isPasswordFocused = true;
            // Detiene el parpadeo normal
            eyeL.classList.remove('animate-blink');
            eyeR.classList.remove('animate-blink');
            
            // Cierra los ojos
            botHead.classList.add('eyes-closed');
            
            // Inicia el ciclo de espiar
            startPeeking();
        });

        passwordInput.addEventListener('blur', () => {
            isPasswordFocused = false;
            
            // Limpiar todos los temporizadores para que no haga cosas raras
            clearTimeout(peekTimer);
            clearTimeout(scareTimer);
            clearTimeout(resetTimer);
            
            // Volver al estado normal
            botHead.classList.remove('eyes-closed', 'peeking', 'scared');
            resetBot();
        });
    </script>
</body>
</html>