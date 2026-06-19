<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'StockSync') }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            :root {
                --bg-dark: #0b1120;
                --bg-card: rgba(255, 255, 255, 0.04);
                --border-color: rgba(255, 255, 255, 0.08);
                --blue-glow: rgba(59, 130, 246, 0.3);
            }
            html, body {
                max-width: 100vw;
                overflow-x: hidden;
                margin: 0; padding: 0;
            }
            body {
                background-color: var(--bg-dark);
                font-family: 'Figtree', 'Inter', system-ui, sans-serif;
                color: #e2e8f0;
                min-height: 100vh;
            }

            /* Responsive Utilities */
            .nav-mobile-btn { display: none !important; }
            .nav-desktop-links { display: flex !important; }
            .user-name-text { display: inline; }

            @media (max-width: 768px) {
                .nav-desktop-links { display: none !important; }
                .nav-mobile-btn { display: flex !important; }
                .user-name-text { display: none !important; }
                .nav-logo-text { font-size: 0.9rem !important; }
                
                .glass-card { padding: 1rem !important; }
                table { white-space: nowrap; }
                .app-wrapper { padding: 0.5rem; }
            }
            /* Animated background blobs */
            .bg-blobs {
                position: fixed;
                inset: 0;
                overflow: hidden;
                pointer-events: none;
                z-index: 0;
            }
            .blob {
                position: absolute;
                border-radius: 50%;
                filter: blur(100px);
                opacity: 0.15;
                animation: blobFloat 10s ease-in-out infinite;
            }
            .blob-1 { width: 600px; height: 600px; background: #3b82f6; top: -200px; left: -100px; animation-delay: 0s; }
            .blob-2 { width: 500px; height: 500px; background: #6366f1; top: 40%; right: -150px; animation-delay: 3s; }
            .blob-3 { width: 400px; height: 400px; background: #8b5cf6; bottom: -100px; left: 30%; animation-delay: 6s; }
            @keyframes blobFloat {
                0%, 100% { transform: translate(0, 0) scale(1); }
                33% { transform: translate(20px, -30px) scale(1.05); }
                66% { transform: translate(-15px, 15px) scale(0.95); }
            }
            /* Glass card */
            .glass-card {
                background: var(--bg-card);
                border: 1px solid var(--border-color);
                backdrop-filter: blur(12px);
                -webkit-backdrop-filter: blur(12px);
            }
            /* Main wrapper */
            .app-wrapper {
                position: relative;
                z-index: 1;
                min-height: 100vh;
            }
        </style>
    </head>
    <body>
        <div class="bg-blobs">
            <div class="blob blob-1"></div>
            <div class="blob blob-2"></div>
            <div class="blob blob-3"></div>
        </div>

        <div class="app-wrapper">
            @include('layouts.navigation')
            <main>
                {{ $slot }}
            </main>
        </div>

        <!-- Global Confirm Modal -->
        <div id="confirmModal" style="display: none; position: fixed; inset: 0; z-index: 9999; align-items: center; justify-content: center; backdrop-filter: blur(5px); background: rgba(0,0,0,0.6); opacity: 0; transition: opacity 0.3s;">
            <div style="background: rgba(11,17,32,0.95); border: 1px solid rgba(255,255,255,0.1); border-radius: 16px; padding: 24px; max-width: 400px; width: 90%; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.5); transform: scale(0.95); transition: transform 0.3s; backdrop-filter: blur(12px);" id="confirmModalContent">
                <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 12px;">
                    <div style="width: 40px; height: 40px; border-radius: 50%; background: rgba(239,68,68,0.15); color: #ef4444; display: flex; align-items: center; justify-content: center;">
                        <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                    </div>
                    <h3 style="margin: 0; font-size: 1.25rem; font-weight: 700; color: #fff;">Confirmar Acción</h3>
                </div>
                <p id="confirmModalMessage" style="color: #94a3b8; font-size: 0.95rem; margin: 0 0 24px 0; line-height: 1.5;"></p>
                <div style="display: flex; justify-content: flex-end; gap: 12px;">
                    <button type="button" onclick="closeConfirmModal()" style="background: rgba(255,255,255,0.05); color: #cbd5e1; border: 1px solid rgba(255,255,255,0.1); padding: 8px 16px; border-radius: 8px; font-weight: 600; cursor: pointer; transition: all 0.2s;" onmouseover="this.style.background='rgba(255,255,255,0.1)'" onmouseout="this.style.background='rgba(255,255,255,0.05)'">Cancelar</button>
                    <button type="button" id="confirmModalBtn" style="background: #ef4444; color: #fff; border: none; padding: 8px 16px; border-radius: 8px; font-weight: 600; cursor: pointer; transition: all 0.2s; box-shadow: 0 4px 12px rgba(239,68,68,0.3);" onmouseover="this.style.background='#dc2626'" onmouseout="this.style.background='#ef4444'">Eliminar</button>
                </div>
            </div>
        </div>

        <script>
            let confirmFormToSubmit = null;

            function showConfirmModal(message, form) {
                document.getElementById('confirmModalMessage').innerText = message;
                confirmFormToSubmit = form;
                
                const modal = document.getElementById('confirmModal');
                const content = document.getElementById('confirmModalContent');
                
                modal.style.display = 'flex';
                // Trigger reflow
                void modal.offsetWidth;
                
                modal.style.opacity = '1';
                content.style.transform = 'scale(1)';
            }

            function closeConfirmModal() {
                const modal = document.getElementById('confirmModal');
                const content = document.getElementById('confirmModalContent');
                
                modal.style.opacity = '0';
                content.style.transform = 'scale(0.95)';
                
                setTimeout(() => {
                    modal.style.display = 'none';
                    confirmFormToSubmit = null;
                }, 300);
            }

            document.getElementById('confirmModalBtn').addEventListener('click', function() {
                if(confirmFormToSubmit) {
                    confirmFormToSubmit.submit();
                }
            });
            
            function confirmDelete(event, message) {
                event.preventDefault();
                showConfirmModal(message, event.target);
                return false;
            }
        </script>
    </body>
</html>