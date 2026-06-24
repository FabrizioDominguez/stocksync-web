<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'StockSync') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            :root {
                --bg-dark: #0b1120;
                --bg-card: rgba(255, 255, 255, 0.03);
                --border-color: rgba(255, 255, 255, 0.08);
                --primary: #3b82f6;
                --secondary: #6366f1;
            }
            body {
                background-color: var(--bg-dark);
                font-family: 'Inter', system-ui, sans-serif;
                color: #e2e8f0;
                position: relative;
            }
            /* Animated Background */
            .bg-blobs { position: fixed; inset: 0; overflow: hidden; pointer-events: none; z-index: -1; }
            .blob { position: absolute; border-radius: 50%; filter: blur(120px); opacity: 0.15; animation: blobFloat 15s ease-in-out infinite; }
            .blob-1 { width: 600px; height: 600px; background: var(--primary); top: -200px; right: -100px; }
            .blob-2 { width: 500px; height: 500px; background: var(--secondary); bottom: -100px; left: -100px; animation-delay: 5s; }
            @keyframes blobFloat {
                0%, 100% { transform: translate(0, 0) scale(1); }
                50% { transform: translate(-30px, 40px) scale(1.1); }
            }
            
            /* Glass Form Box */
            .glass-box {
                background: rgba(11, 17, 32, 0.6);
                border: 1px solid var(--border-color);
                backdrop-filter: blur(16px);
                -webkit-backdrop-filter: blur(16px);
                box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            }
            
            /* Inputs override for Tailwind Breeze */
            input[type="text"], input[type="email"], input[type="password"] {
                background: rgba(255, 255, 255, 0.05) !important;
                border: 1px solid rgba(255, 255, 255, 0.1) !important;
                color: #fff !important;
                border-radius: 8px !important;
            }
            input:focus {
                border-color: var(--primary) !important;
                box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.2) !important;
            }
            label {
                color: #94a3b8 !important;
                font-weight: 500 !important;
            }
            .primary-btn {
                background: linear-gradient(135deg, var(--primary), var(--secondary)) !important;
                border: none !important;
                font-weight: 600 !important;
                text-transform: uppercase !important;
                letter-spacing: 0.05em !important;
                color: white !important;
                padding: 10px 20px;
                border-radius: 8px;
                transition: opacity 0.2s;
            }
            .primary-btn:hover {
                opacity: 0.9;
            }
            .text-gray-600 { color: #94a3b8 !important; }
            .hover\:text-gray-900:hover { color: #fff !important; }
        </style>
    </head>
    <body class="font-sans antialiased text-gray-200">
        <div class="bg-blobs">
            <div class="blob blob-1"></div>
            <div class="blob blob-2"></div>
        </div>

        <div class="min-h-screen flex flex-col sm:justify-center items-center py-12 relative z-10">
            <div style="margin-bottom: 1.5rem;">
                <a href="/" style="display: flex; align-items: center; gap: 12px; text-decoration: none;">
                    <div style="width: 48px; height: 48px; border-radius: 12px; background: linear-gradient(135deg, var(--primary), var(--secondary)); box-shadow: 0 0 20px rgba(59, 130, 246, 0.5); display: flex; align-items: center; justify-content: center; color: white;">
                        <svg width="28" height="28" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                    </div>
                    <span style="font-weight: 900; font-size: 1.5rem; color: #fff; letter-spacing: 0.1em; text-transform: uppercase;">StockSync</span>
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 glass-box sm:rounded-2xl" style="padding: 2.5rem 2rem;">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
