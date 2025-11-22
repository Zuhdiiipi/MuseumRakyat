console.log('landing.js loaded');

document.addEventListener('DOMContentLoaded', () => {
    /* ================= HAMBURGER / MOBILE MENU ================= */
    const hamburger = document.getElementById('hamburgerBtn');
    const menu = document.getElementById('mobileMenu');
    const backdrop = document.getElementById('mobileBackdrop');
    const closeBtn = document.getElementById('mobileCloseBtn');

    function openMenu() {
        menu.classList.add('open');
        backdrop.classList.add('show');
        document.body.style.overflow = 'hidden';
    }

    function closeMenu() {
        menu.classList.remove('open');
        backdrop.classList.remove('show');
        document.body.style.overflow = '';
    }

    if (hamburger) hamburger.addEventListener('click', openMenu);
    if (closeBtn) closeBtn.addEventListener('click', closeMenu);
    if (backdrop) backdrop.addEventListener('click', closeMenu);

    document.querySelectorAll('.mobile-link').forEach(link => {
        link.addEventListener('click', closeMenu);
    });

    /* ================= SCROLL TO TOP ================= */
    const scrollTopBtn = document.getElementById('scrollTopBtn');
    if (scrollTopBtn) {
        scrollTopBtn.addEventListener('click', () => {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }
 });
