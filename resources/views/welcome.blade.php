@extends('layouts.public')

@push('styles')
<!-- AOS Animation Library CSS -->
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<style>
    /* =========================================
       GLOBAL & UTILITIES
       ========================================= */
    body {
        overflow-x: hidden;
    }
    .section-padding { padding: 8rem 1.5rem; }
    .container { max-width: 1200px; margin: 0 auto; }
    
    .section-header { text-align: center; margin-bottom: 5rem; }
    .section-tag {
        display: inline-block; padding: 6px 16px; border-radius: 99px;
        background: rgba(59,130,246,0.1); border: 1px solid rgba(59,130,246,0.3);
        color: #60a5fa; font-weight: 700; font-size: 0.8rem; letter-spacing: 0.1em;
        text-transform: uppercase; margin-bottom: 1rem;
    }
    .section-title { font-size: 3rem; font-weight: 900; color: #f1f5f9; letter-spacing: -0.02em; margin-bottom: 1.5rem; }
    .section-subtitle { font-size: 1.15rem; color: #94a3b8; max-width: 600px; margin: 0 auto; line-height: 1.6; }

    /* Botones */
    .btn-glow {
        display: inline-flex; align-items: center; justify-content: center; gap: 8px;
        padding: 16px 36px; border-radius: 12px;
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        color: white; font-weight: 800; font-size: 1.1rem; text-decoration: none;
        box-shadow: 0 10px 30px rgba(59,130,246,0.5); transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border: none; cursor: pointer; position: relative; overflow: hidden;
    }
    .btn-glow::after {
        content: ''; position: absolute; top: -50%; left: -50%; width: 200%; height: 200%;
        background: radial-gradient(circle, rgba(255,255,255,0.3) 0%, transparent 60%);
        opacity: 0; transform: scale(0.5); transition: all 0.3s;
    }
    .btn-glow:hover { transform: translateY(-4px); box-shadow: 0 15px 40px rgba(59,130,246,0.6); }
    .btn-glow:hover::after { opacity: 1; transform: scale(1); }

    /* =========================================
       HERO SECTION
       ========================================= */
    .hero {
        position: relative; padding: 10rem 1.5rem 6rem;
        display: flex; flex-direction: column; align-items: center; text-align: center;
        min-height: 100vh; justify-content: center;
    }
    .hero-content { max-width: 900px; position: relative; z-index: 2; }
    .hero h1 {
        font-size: clamp(3rem, 6vw, 5.5rem); font-weight: 900; line-height: 1.1;
        margin: 0 0 1.5rem; letter-spacing: -0.03em;
    }
    .hero p {
        font-size: clamp(1.1rem, 2vw, 1.35rem); color: #94a3b8; line-height: 1.6;
        margin: 0 auto 3rem; max-width: 700px;
    }
    
    /* Mockup Visual */
    .hero-mockup-wrapper {
        margin-top: 5rem; width: 100%; max-width: 1000px; position: relative;
        perspective: 1000px; z-index: 2;
    }
    .hero-mockup {
        background: rgba(11,17,32,0.9); border: 1px solid rgba(255,255,255,0.1);
        border-radius: 20px; padding: 10px; box-shadow: 0 30px 60px rgba(0,0,0,0.6), 0 0 40px rgba(59,130,246,0.2);
        transform: rotateX(10deg) scale(0.95); transition: all 0.5s ease;
    }
    .hero-mockup-wrapper:hover .hero-mockup {
        transform: rotateX(0deg) scale(1); box-shadow: 0 40px 80px rgba(0,0,0,0.8), 0 0 60px rgba(59,130,246,0.3);
    }
    .mockup-img {
        width: 100%; height: auto; border-radius: 12px; border: 1px solid rgba(255,255,255,0.05);
        display: block;
    }
    .hero-glow {
        position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);
        width: 80%; height: 80%; background: var(--primary); filter: blur(150px); opacity: 0.15; z-index: 0;
    }

    /* =========================================
       PROBLEM / SOLUTION
       ========================================= */
    .ps-grid {
        display: grid; grid-template-columns: 1fr 1fr; gap: 4rem; align-items: center;
    }
    .ps-image {
        position: relative; border-radius: 24px; overflow: hidden;
        box-shadow: 0 20px 50px rgba(0,0,0,0.5);
    }
    .ps-image img { width: 100%; height: 100%; object-fit: cover; display: block; transition: transform 0.5s; }
    .ps-image:hover img { transform: scale(1.05); }
    .ps-image::after {
        content: ''; position: absolute; inset: 0;
        background: linear-gradient(to top, rgba(11,17,32,0.8), transparent);
    }
    .pain-points { margin-top: 2rem; }
    .pain-point {
        display: flex; gap: 1rem; margin-bottom: 1.5rem; background: rgba(239,68,68,0.05);
        border-left: 4px solid #f87171; padding: 1.25rem; border-radius: 0 12px 12px 0;
    }
    .pain-point svg { color: #f87171; flex-shrink: 0; width: 24px; height: 24px; }
    .pain-point h4 { margin: 0 0 0.25rem; color: #f1f5f9; font-size: 1.1rem; }
    .pain-point p { margin: 0; color: #94a3b8; font-size: 0.95rem; }

    /* =========================================
       FEATURES (BENTO GRID)
       ========================================= */
    .features-bg { background: rgba(255,255,255,0.02); border-top: 1px solid rgba(255,255,255,0.05); border-bottom: 1px solid rgba(255,255,255,0.05); position: relative; overflow: hidden; }
    
    .bento-grid {
        display: grid; grid-template-columns: repeat(4, 1fr); gap: 1.5rem;
    }
    .bento-item {
        background: var(--bg-card); border: 1px solid var(--border-color); border-radius: 24px;
        padding: 2.5rem; position: relative; overflow: hidden; transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        display: flex; flex-direction: column;
    }
    .bento-item:hover { border-color: rgba(59,130,246,0.4); transform: translateY(-5px); box-shadow: 0 20px 40px rgba(0,0,0,0.5); }
    .bento-item.large { grid-column: span 2; }
    .bento-item.full { grid-column: span 4; display: flex; flex-direction: row; align-items: center; gap: 3rem; padding: 4rem; }
    
    .bento-icon {
        width: 60px; height: 60px; border-radius: 16px; background: rgba(59,130,246,0.1); color: #60a5fa;
        display: flex; align-items: center; justify-content: center; margin-bottom: 1.5rem;
        box-shadow: inset 0 0 20px rgba(59,130,246,0.2);
    }
    .bento-item h3 { font-size: 1.5rem; font-weight: 800; color: #fff; margin: 0 0 1rem; line-height: 1.3; }
    .bento-item p { color: #94a3b8; line-height: 1.7; font-size: 1.05rem; margin: 0; }
    
    .bento-bg-glow {
        position: absolute; top: -50%; right: -50%; width: 100%; height: 100%;
        background: radial-gradient(circle, rgba(59,130,246,0.1) 0%, transparent 60%); z-index: 0; pointer-events: none;
    }
    .bento-content { position: relative; z-index: 1; flex: 1; }

    .bento-visual {
        margin-top: 2rem; border-radius: 12px; overflow: hidden; border: 1px solid rgba(255,255,255,0.05);
        box-shadow: 0 10px 30px rgba(0,0,0,0.5); position: relative;
    }
    .bento-visual.side { margin-top: 0; flex: 1; min-width: 400px; }
    .bento-visual img { width: 100%; height: 100%; object-fit: cover; display: block; transition: transform 3s ease; }
    .bento-item:hover .bento-visual img { transform: scale(1.05); }
    
    /* Etiqueta flotante animada */
    .floating-badge {
        position: absolute; bottom: 20px; left: 20px; background: rgba(16,185,129,0.9);
        backdrop-filter: blur(4px); color: white; padding: 8px 16px; border-radius: 99px;
        font-weight: 700; font-size: 0.85rem; display: flex; align-items: center; gap: 8px;
        box-shadow: 0 10px 20px rgba(0,0,0,0.3); animation: float 3s ease-in-out infinite;
    }
    @keyframes float { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-10px); } }

    @media (max-width: 992px) {
        .bento-grid { grid-template-columns: 1fr 1fr; }
        .bento-item.full { grid-column: span 2; flex-direction: column; padding: 2rem; }
        .bento-visual.side { min-width: 100%; margin-top: 2rem; }
    }
    @media (max-width: 768px) {
        .bento-grid { grid-template-columns: 1fr; }
        .bento-item.large { grid-column: span 1; }
        .bento-item.full { grid-column: span 1; }
    }
    @media (max-width: 480px) {
        .bento-item { padding: 1.5rem; }
        .bento-item.full { padding: 1.5rem; }
        .bento-visual.side { min-width: 100%; margin-top: 1.5rem; }
        .hero h1 { font-size: 2.5rem; }
        .section-padding { padding: 4rem 1rem; }
        .pricing-card { padding: 2rem 1.5rem; }
        .metrics-banner { padding: 2rem 1.5rem; }
        .capture-box { padding: 2rem 1.5rem; }
        .ps-grid { gap: 2rem; }
    }

    /* =========================================
       PRICING
       ========================================= */
    .pricing-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 2rem; align-items: stretch; }
    .pricing-card {
        background: var(--bg-card); border: 1px solid var(--border-color); border-radius: 24px;
        padding: 3rem 2rem; display: flex; flex-direction: column; position: relative; transition: all 0.3s;
    }
    .pricing-card.popular {
        background: rgba(59,130,246,0.05); border-color: var(--primary); transform: scale(1.05);
    }
    .pricing-card:hover { transform: translateY(-10px); }
    .pricing-card.popular:hover { transform: scale(1.05) translateY(-10px); }
    
    .popular-badge {
        position: absolute; top: -12px; left: 50%; transform: translateX(-50%);
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        color: white; font-size: 0.75rem; font-weight: 800; padding: 4px 16px;
        border-radius: 99px; text-transform: uppercase; letter-spacing: 0.1em;
    }
    
    .plan-name { font-size: 1.25rem; color: #94a3b8; font-weight: 700; margin: 0 0 1rem; text-transform: uppercase; letter-spacing: 0.05em; }
    .plan-price { font-size: 3.5rem; font-weight: 900; color: #fff; line-height: 1; margin: 0 0 2rem; display: flex; align-items: flex-end; gap: 5px; }
    .plan-price span { font-size: 1rem; font-weight: 500; color: #64748b; margin-bottom: 8px; }
    
    .plan-features { list-style: none; padding: 0; margin: 0 0 3rem; flex: 1; }
    .plan-features li { display: flex; align-items: center; gap: 10px; margin-bottom: 1rem; color: #cbd5e1; }
    .plan-features li svg { color: #10b981; width: 20px; height: 20px; flex-shrink: 0; }
    .plan-features li.disabled { opacity: 0.4; text-decoration: line-through; }
    .plan-features li.disabled svg { color: #64748b; }

    .btn-plan {
        display: block; width: 100%; padding: 14px; border-radius: 12px; font-weight: 800; font-size: 1rem;
        text-align: center; text-decoration: none; transition: all 0.2s; margin-top: auto;
        box-sizing: border-box;
    }
    .btn-plan-outline { background: transparent; border: 1px solid rgba(255,255,255,0.2); color: #fff; }
    .btn-plan-outline:hover { background: rgba(255,255,255,0.1); }
    .btn-plan-primary { background: var(--primary); border: none; color: white; box-shadow: 0 10px 20px rgba(59,130,246,0.3); }
    .btn-plan-primary:hover { background: #2563eb; transform: translateY(-2px); }

    /* =========================================
       SOCIAL PROOF (TESTIMONIALS)
       ========================================= */
    .testimonials-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 2rem; }
    .testimonial-card {
        background: var(--bg-card); border: 1px solid var(--border-color); border-radius: 20px;
        padding: 2.5rem; position: relative;
    }
    .quote-icon { position: absolute; top: 1.5rem; right: 2rem; opacity: 0.1; width: 60px; height: 60px; color: var(--primary); }
    .testimonial-text { font-size: 1.15rem; color: #e2e8f0; line-height: 1.7; font-style: italic; margin: 0 0 2rem; }
    .testimonial-author { display: flex; align-items: center; gap: 1rem; }
    .author-img { width: 56px; height: 56px; border-radius: 50%; object-fit: cover; border: 2px solid rgba(59,130,246,0.3); }
    .author-info h4 { margin: 0 0 0.2rem; color: #fff; font-weight: 700; }
    .author-info p { margin: 0; color: #64748b; font-size: 0.85rem; }

    /* Métricas */
    .metrics-banner {
        display: flex; justify-content: space-around; background: linear-gradient(135deg, rgba(59,130,246,0.1), rgba(99,102,241,0.1));
        border: 1px solid rgba(59,130,246,0.2); border-radius: 24px; padding: 3rem; margin-top: 4rem;
    }
    .metric { text-align: center; }
    .metric-number { font-size: 3.5rem; font-weight: 900; color: #fff; margin-bottom: 0.5rem; }
    .metric-label { color: #94a3b8; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; }

    /* =========================================
       CAPTURE FORM & FOOTER
       ========================================= */
    .cta-section {
        background: radial-gradient(circle at center, rgba(59,130,246,0.15) 0%, transparent 70%);
        padding: 8rem 1.5rem; text-align: center; position: relative;
    }
    .capture-box {
        max-width: 600px; margin: 0 auto; background: rgba(11,17,32,0.8); backdrop-filter: blur(20px);
        border: 1px solid rgba(255,255,255,0.1); border-radius: 24px; padding: 3rem;
        box-shadow: 0 30px 60px rgba(0,0,0,0.5);
    }
    .capture-box h2 { font-size: 2rem; font-weight: 800; color: #fff; margin: 0 0 1rem; }
    .capture-box p { color: #94a3b8; margin: 0 0 2rem; line-height: 1.6; }
    
    .capture-form { display: flex; flex-direction: column; gap: 1rem; }
    .input-group { position: relative; }
    .input-group input {
        width: 100%; padding: 16px 20px; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1);
        border-radius: 12px; color: #fff; font-size: 1rem; font-family: inherit; outline: none; transition: all 0.3s;
        box-sizing: border-box;
    }
    .input-group input:focus { border-color: var(--primary); background: rgba(255,255,255,0.08); box-shadow: 0 0 0 4px rgba(59,130,246,0.1); }
    .input-error { color: #f87171; font-size: 0.8rem; text-align: left; margin-top: 5px; display: none; }
    
    /* MODAL EXCLUSIVO */
    .modal-overlay {
        position: fixed; inset: 0; background: rgba(0,0,0,0.8); backdrop-filter: blur(5px);
        display: none; align-items: center; justify-content: center; z-index: 9999;
        opacity: 0; transition: opacity 0.3s;
    }
    .modal-overlay.active { display: flex; opacity: 1; }
    .modal-content {
        background: var(--bg-dark); border: 1px solid var(--border-color); border-radius: 24px;
        max-width: 450px; width: 90%; text-align: center; padding: 3rem 2rem;
        transform: scale(0.9); transition: transform 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }
    .modal-overlay.active .modal-content { transform: scale(1); }
    .modal-img { width: 120px; height: 120px; margin: 0 auto 1.5rem; border-radius: 50%; object-fit: cover; border: 4px solid var(--primary); }
    .modal-content h3 { font-size: 1.75rem; color: #fff; margin: 0 0 1rem; }
    .modal-content p { color: #94a3b8; margin: 0 0 2rem; }
    .btn-close-modal {
        background: rgba(255,255,255,0.1); color: #fff; border: none; padding: 12px 30px; border-radius: 10px; font-weight: 700; cursor: pointer; transition: background 0.2s;
    }
    .btn-close-modal:hover { background: rgba(255,255,255,0.2); }

    /* Responsive */
    @media (max-width: 992px) {
        .ps-grid, .testimonials-grid { grid-template-columns: 1fr; }
        .pricing-grid { grid-template-columns: 1fr; max-width: 500px; margin: 0 auto; }
        .pricing-card.popular { transform: none; }
        .pricing-card.popular:hover { transform: translateY(-10px); }
        .metrics-banner { flex-direction: column; gap: 3rem; }
    }
    @media (max-width: 768px) {
        .features-grid { grid-template-columns: 1fr; }
        .hero { padding-top: 8rem; }
    }
</style>
@endpush

@section('content')
    <!-- HERO SECTION -->
    <section class="hero">
        <div class="hero-glow"></div>
        <div class="hero-content" data-aos="fade-up" data-aos-duration="1000">
            <div class="section-tag">Gestión de Inventario SaaS</div>
            <h1>Sincroniza tu stock físico y digital en <span class="gradient-text">segundos.</span></h1>
            <p>El sistema definitivo para tiendas de tecnología. Convierte tu inventario local en un catálogo online 24/7 sin esfuerzo, evita ventas sin stock y aumenta tus conversiones.</p>
            <button onclick="document.getElementById('capture-form').scrollIntoView({behavior: 'smooth'})" class="btn-glow">
                Inicia tu prueba gratis
                <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </button>
        </div>

        <div class="hero-mockup-wrapper" data-aos="zoom-in-up" data-aos-delay="300" data-aos-duration="1200">
            <div class="hero-mockup">
                <!-- Usando una imagen real de Unsplash para demostrar interfaz/tecnología -->
                <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&w=1200&q=80" alt="StockSync Dashboard Mockup" class="mockup-img">
            </div>
        </div>
    </section>

    <!-- PROBLEM / SOLUTION -->
    <section class="section-padding container">
        <div class="ps-grid">
            <div data-aos="fade-right">
                <div class="section-tag">El Problema</div>
                <h2 class="section-title">¿Pierdes ventas por no saber qué tienes en stock?</h2>
                <p class="section-subtitle" style="margin: 0 0 2rem; text-align: left;">
                    Administrar una tienda de tecnología con hojas de cálculo o sistemas anticuados genera caos. Tu inventario nunca cuadra con la realidad y tus clientes se frustran.
                </p>
                
                <div class="pain-points">
                    <div class="pain-point">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                        <div>
                            <h4>Ventas Canceladas</h4>
                            <p>Vendes un producto online que ya se agotó en la tienda física.</p>
                        </div>
                    </div>
                    <div class="pain-point">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <div>
                            <h4>Pérdida de Tiempo</h4>
                            <p>Horas invertidas respondiendo a clientes "¿Tienen este modelo?".</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ps-image" data-aos="fade-left">
                <!-- Imagen de un vendedor frustrado o tienda llena -->
                <img src="https://images.unsplash.com/photo-1580927752452-89d86da3fa0a?auto=format&fit=crop&w=800&q=80" alt="Tienda de tecnología desorganizada">
            </div>
        </div>
    </section>

    <!-- SOLUCIÓN STOCKSYNC (BENTO GRID) -->
    <section class="section-padding features-bg">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <div class="section-tag">La Solución Definitiva</div>
                <h2 class="section-title">Automatización que multiplica tus ingresos</h2>
                <p class="section-subtitle">No es solo un inventario. Es un motor de ventas diseñado para convertir tu mostrador en un comercio digital imparable.</p>
            </div>

            <div class="bento-grid">
                
                <!-- BENTO 1: FULL WIDTH (Sincronización) -->
                <div class="bento-item full" data-aos="fade-up" data-aos-delay="100">
                    <div class="bento-bg-glow"></div>
                    <div class="bento-content">
                        <div class="bento-icon">
                            <svg width="28" height="28" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                        </div>
                        <h3>Sincronización Total en Milisegundos</h3>
                        <p>Imagina vender una tarjeta gráfica en tu tienda física y que, mágicamente, desaparezca de tu catálogo web al instante. Con StockSync, esa es la realidad. <strong>Tu inventario físico y digital son uno solo.</strong> Nunca más tendrás que disculparte por vender un producto agotado.</p>
                    </div>
                    <div class="bento-visual side">
                        <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&w=800&q=80" alt="Dashboard en tiempo real">
                        <div class="floating-badge">
                            <span style="width: 8px; height: 8px; border-radius: 50%; background: white;"></span> Stock Actualizado
                        </div>
                    </div>
                </div>

                <!-- BENTO 2: LARGE (Catálogo Público) -->
                <div class="bento-item large" data-aos="fade-right" data-aos-delay="200">
                    <div class="bento-content">
                        <div class="bento-icon" style="background: rgba(16,185,129,0.1); color: #10b981;">
                            <svg width="28" height="28" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/></svg>
                        </div>
                        <h3>Un Escaparate Digital 24/7</h3>
                        <p>Deja de enviar PDFs desactualizados. Te damos un catálogo web hermoso y rápido. Tus clientes podrán ver fichas técnicas, precios reales y disponibilidad desde su celular a las 3 de la mañana.</p>
                    </div>
                    <div class="bento-visual">
                        <img src="https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?auto=format&fit=crop&w=600&q=80" alt="Cliente en su celular">
                    </div>
                </div>

                <!-- BENTO 3: LARGE (WhatsApp) -->
                <div class="bento-item large" data-aos="fade-up" data-aos-delay="300">
                    <div class="bento-content">
                        <div class="bento-icon" style="background: rgba(37,211,102,0.1); color: #25d366;">
                            <svg width="28" height="28" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                        </div>
                        <h3>Pedidos Directos a tu WhatsApp</h3>
                        <p>Los clientes arman su carrito web y te envían el encargo procesado directo a tu WhatsApp. Sin pasarelas complejas, solo cierres de venta directos.</p>
                    </div>
                    <div class="bento-visual">
                        <img src="https://images.unsplash.com/photo-1611162617474-5b21e879e113?auto=format&fit=crop&w=600&q=80" alt="App de WhatsApp">
                    </div>
                </div>

                <!-- BENTO 4: FULL (Alertas) -->
                <div class="bento-item full" data-aos="fade-left" data-aos-delay="400">
                    <div class="bento-content">
                        <div class="bento-icon" style="background: rgba(245,158,11,0.1); color: #f59e0b;">
                            <svg width="28" height="28" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                        </div>
                        <h3>Alertas Inteligentes</h3>
                        <p>Nuestro panel detecta si te estás quedando sin stock de tus productos estrella y te notifica automáticamente para que reabastezcas a tiempo. Evita quedarte en ceros sin darte cuenta.</p>
                    </div>
                    <div class="bento-visual side">
                        <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&w=800&q=80" alt="Dashboard analytics">
                        <div class="floating-badge" style="background: rgba(245,158,11,0.9);">
                            <span style="width: 8px; height: 8px; border-radius: 50%; background: white;"></span> ¡Stock Crítico!
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- PRICING -->
    <section class="section-padding container">
        <div class="section-header" data-aos="fade-up">
            <div class="section-tag">Planes Simples</div>
            <h2 class="section-title">Precios que crecen contigo</h2>
            <p class="section-subtitle">Sin costos ocultos ni comisiones por venta. Elige el plan que mejor se adapte a tu volumen de negocio.</p>
        </div>

        <div class="pricing-grid">
            <!-- Freemium -->
            <div class="pricing-card" data-aos="fade-up" data-aos-delay="100">
                <h3 class="plan-name">Básico</h3>
                <div class="plan-price">$0<span>/mes</span></div>
                <ul class="plan-features">
                    <li><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> Hasta 50 productos</li>
                    <li><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> Catálogo Público</li>
                    <li><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> Pedidos por WhatsApp</li>
                    <li class="disabled"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg> Soporte Prioritario</li>
                    <li class="disabled"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg> Múltiples Sucursales</li>
                </ul>
                <a href="#capture-form" class="btn-plan btn-plan-outline">Empezar Gratis</a>
            </div>

            <!-- Pro (Popular) -->
            <div class="pricing-card popular" data-aos="fade-up" data-aos-delay="200">
                <div class="popular-badge">Más Recomendado</div>
                <h3 class="plan-name" style="color: var(--primary);">Pro Retail</h3>
                <div class="plan-price">$29<span>/mes</span></div>
                <ul class="plan-features">
                    <li><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> Productos Ilimitados</li>
                    <li><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> Alertas de Stock Crítico</li>
                    <li><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> Integración WhatsApp API</li>
                    <li><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> Soporte Prioritario 24/7</li>
                    <li class="disabled"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg> Múltiples Sucursales</li>
                </ul>
                <a href="#capture-form" class="btn-plan btn-plan-primary">Probar Pro 14 Días</a>
            </div>

            <!-- Enterprise -->
            <div class="pricing-card" data-aos="fade-up" data-aos-delay="300">
                <h3 class="plan-name">Empresa</h3>
                <div class="plan-price">$89<span>/mes</span></div>
                <ul class="plan-features">
                    <li><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> Todo lo del plan Pro</li>
                    <li><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> Hasta 5 Sucursales</li>
                    <li><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> Roles de Empleados</li>
                    <li><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> API Personalizada</li>
                    <li><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> Capacitación al Personal</li>
                </ul>
                <a href="#capture-form" class="btn-plan btn-plan-outline">Contactar Ventas</a>
            </div>
        </div>
    </section>

    <!-- SOCIAL PROOF -->
    <section class="section-padding">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <div class="section-tag">Casos de Éxito</div>
                <h2 class="section-title">Negocios que ya se digitalizaron</h2>
            </div>

            <div class="testimonials-grid">
                <div class="testimonial-card" data-aos="fade-right">
                    <svg class="quote-icon" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/></svg>
                    <p class="testimonial-text">"Antes perdíamos al menos 5 ventas semanales porque los clientes veían cosas en Facebook que ya habíamos vendido en la tienda. Con StockSync, mi catálogo es mi inventario real. Las ventas por WhatsApp se triplicaron."</p>
                    <div class="testimonial-author">
                        <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?auto=format&fit=crop&w=150&q=80" alt="Carlos M." class="author-img">
                        <div class="author-info">
                            <h4>Carlos Mendoza</h4>
                            <p>Gerente de Compumax Tech</p>
                        </div>
                    </div>
                </div>

                <div class="testimonial-card" data-aos="fade-left">
                    <svg class="quote-icon" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/></svg>
                    <p class="testimonial-text">"Es increíblemente fácil de usar. Subí todo mi inventario de memorias y tarjetas gráficas en una tarde. Ahora mis clientes arman su carrito web, me mandan el PDF al WhatsApp y solo pasan a pagar. Cero fricción."</p>
                    <div class="testimonial-author">
                        <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=150&q=80" alt="Laura V." class="author-img">
                        <div class="author-info">
                            <h4>Laura Villarroel</h4>
                            <p>Propietaria de GamerZone</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="metrics-banner" data-aos="zoom-in" data-aos-offset="200">
                <div class="metric">
                    <div class="metric-number">+40%</div>
                    <div class="metric-label">Aumento en Ventas</div>
                </div>
                <div class="metric">
                    <div class="metric-number">0</div>
                    <div class="metric-label">Ventas sin Stock</div>
                </div>
                <div class="metric">
                    <div class="metric-number">2h</div>
                    <div class="metric-label">Ahorro Diario en Gestión</div>
                </div>
            </div>
        </div>
    </section>

    <!-- CAPTURE FORM (CTA FINAL) -->
    <section class="cta-section" id="capture-form">
        <div class="capture-box" data-aos="fade-up">
            <h2>Comienza a vender más hoy</h2>
            <p>Únete a las cientos de tiendas que ya sincronizaron su inventario. Ingresa tus datos y obtén acceso inmediato a tu prueba de 14 días.</p>
            
            <form id="saasForm" class="capture-form" onsubmit="handleFormSubmit(event)">
                <div class="input-group">
                    <input type="text" id="storeName" placeholder="Nombre de tu tienda" required>
                    <div class="input-error" id="error-storeName">Este campo es obligatorio.</div>
                </div>
                <div class="input-group">
                    <input type="email" id="email" placeholder="Correo electrónico corporativo" required>
                    <div class="input-error" id="error-email">Ingresa un correo electrónico válido.</div>
                </div>
                <button type="submit" class="btn-glow" style="width: 100%; padding: 18px; border-radius: 12px; margin-top: 10px;">
                    Solicitar Acceso Inmediato
                </button>
                <p style="font-size: 0.75rem; margin-top: 10px; color: #64748b;">No se requiere tarjeta de crédito.</p>
            </form>
        </div>
    </section>

    <!-- MODAL DE AGRADECIMIENTO -->
    <div class="modal-overlay" id="successModal">
        <div class="modal-content">
            <!-- Imagen de éxito de Unsplash -->
            <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?auto=format&fit=crop&w=300&q=80" alt="Equipo celebrando" class="modal-img">
            <h3>¡Gracias por confiar en StockSync!</h3>
            <p>Hemos recibido tu solicitud correctamente. Revisa tu bandeja de entrada en los próximos minutos para activar tu entorno de pruebas.</p>
            <button class="btn-close-modal" onclick="closeModal()">Entendido, gracias</button>
        </div>
    </div>
@endsection

@push('scripts')
<!-- AOS Animation JS -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    // Inicializar animaciones al scrollear
    AOS.init({
        once: true,
        offset: 100,
        duration: 800,
        easing: 'ease-out-cubic',
    });

    // Lógica del Formulario de Captura
    function handleFormSubmit(e) {
        e.preventDefault(); // Prevenir recarga
        
        let isValid = true;
        const storeName = document.getElementById('storeName');
        const email = document.getElementById('email');
        const errorStore = document.getElementById('error-storeName');
        const errorEmail = document.getElementById('error-email');

        // Reset errors
        errorStore.style.display = 'none';
        errorEmail.style.display = 'none';
        storeName.style.borderColor = 'rgba(255,255,255,0.1)';
        email.style.borderColor = 'rgba(255,255,255,0.1)';

        // Validar Tienda
        if(storeName.value.trim() === '') {
            errorStore.style.display = 'block';
            storeName.style.borderColor = '#f87171';
            isValid = false;
        }

        // Validar Email con Regex simple
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if(!emailRegex.test(email.value.trim())) {
            errorEmail.style.display = 'block';
            email.style.borderColor = '#f87171';
            isValid = false;
        }

        if(isValid) {
            // Limpiar campos
            storeName.value = '';
            email.value = '';
            
            // Mostrar modal
            const modal = document.getElementById('successModal');
            modal.classList.add('active');
        }
    }

    function closeModal() {
        const modal = document.getElementById('successModal');
        modal.classList.remove('active');
    }
</script>
@endpush