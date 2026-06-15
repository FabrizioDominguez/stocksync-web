// public/js/landing.js

document.addEventListener("DOMContentLoaded", () => {
    
    // --- 1. EFECTO TYPEWRITER ---
    const words = ["Catálogo", "Stock", "Negocio", "Tienda"];
    let i = 0, j = 0, isDeleting = false, text = "";
    const typewriterEl = document.getElementById("typewriter");
    
    function typeWriter() {
        if(!typewriterEl) return;
        const currentWord = words[i];
        if (isDeleting) {
            text = currentWord.substring(0, j - 1);
            j--;
        } else {
            text = currentWord.substring(0, j + 1);
            j++;
        }
        
        typewriterEl.innerHTML = text;
        let typeSpeed = isDeleting ? 50 : 120;
        
        if (!isDeleting && j === currentWord.length) {
            typeSpeed = 2000;
            isDeleting = true;
        } else if (isDeleting && j === 0) {
            isDeleting = false;
            i = (i + 1) % words.length;
            typeSpeed = 500;
        }
        setTimeout(typeWriter, typeSpeed);
    }
    typeWriter();

    // --- 2. ANIMACIONES DE SCROLL (REVEAL) ---
    const revealElements = document.querySelectorAll('.reveal');
    const revealObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('active');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.15, rootMargin: "0px 0px -50px 0px" });
    revealElements.forEach(el => revealObserver.observe(el));

    // --- 3. LÓGICA DEL CARRUSEL ---
    const track = document.getElementById('testimonial-track');
    if(track) {
        const slides = Array.from(track.children);
        const btnNext = document.getElementById('btn-next');
        const btnPrev = document.getElementById('btn-prev');
        const dots = Array.from(document.querySelectorAll('.dot-btn'));
        const carouselContainer = document.getElementById('carousel-container');
        
        let currentIndex = 0;
        let autoPlayInterval;

        const updateCarousel = () => {
            track.style.transform = `translateX(-${currentIndex * 100}%)`;
            dots.forEach(dot => {
                dot.classList.remove('bg-blue-500', 'w-8', 'shadow-[0_0_10px_rgba(59,130,246,0.8)]');
                dot.classList.add('bg-slate-600', 'w-2');
            });
            dots[currentIndex].classList.remove('bg-slate-600', 'w-2');
            dots[currentIndex].classList.add('bg-blue-500', 'w-8', 'shadow-[0_0_10px_rgba(59,130,246,0.8)]');
        };

        const nextSlide = () => { currentIndex = (currentIndex + 1) % slides.length; updateCarousel(); };
        const prevSlide = () => { currentIndex = (currentIndex - 1 + slides.length) % slides.length; updateCarousel(); };
        const resetAutoPlay = () => { clearInterval(autoPlayInterval); startAutoPlay(); };
        const startAutoPlay = () => { autoPlayInterval = setInterval(nextSlide, 5000); };

        btnNext.addEventListener('click', () => { nextSlide(); resetAutoPlay(); });
        btnPrev.addEventListener('click', () => { prevSlide(); resetAutoPlay(); });
        dots.forEach((dot, index) => {
            dot.addEventListener('click', () => { currentIndex = index; updateCarousel(); resetAutoPlay(); });
        });

        carouselContainer.addEventListener('mouseenter', () => clearInterval(autoPlayInterval));
        carouselContainer.addEventListener('mouseleave', startAutoPlay);
        startAutoPlay();
    }

    // --- 4. VALIDACIÓN DE FORMULARIO ---
    const form = document.getElementById('leadForm');
    if(form) {
        const emailInput = document.getElementById('emailInput');
        const errorMsg = document.getElementById('errorMsg');
        const modal = document.getElementById('successModal');
        const modalContent = document.getElementById('modalContent');
        const closeModalBtn = document.getElementById('closeModal');

        const isValidEmail = (email) => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(String(email).toLowerCase());

        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const email = emailInput.value.trim();

            if (email === '' || !isValidEmail(email)) {
                errorMsg.classList.remove('hidden');
                emailInput.classList.add('border-red-500', 'shadow-[0_0_15px_rgba(239,68,68,0.3)]');
            } else {
                errorMsg.classList.add('hidden');
                emailInput.classList.remove('border-red-500', 'shadow-[0_0_15px_rgba(239,68,68,0.3)]');
                emailInput.value = '';

                document.body.classList.add('modal-open');
                modal.classList.remove('hidden');
                setTimeout(() => {
                    modal.classList.remove('opacity-0');
                    modalContent.classList.remove('scale-95');
                }, 10);
            }
        });

        closeModalBtn.addEventListener('click', () => {
            modal.classList.add('opacity-0');
            modalContent.classList.add('scale-95');
            setTimeout(() => {
                modal.classList.add('hidden');
                document.body.classList.remove('modal-open');
            }, 500);
        });
    }
});