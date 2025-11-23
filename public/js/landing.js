console.log('landing.js loaded');

document.addEventListener('DOMContentLoaded', () => {
    /* ================= HAMBURGER / MOBILE MENU ================= */
    const hamburger = document.getElementById('hamburgerBtn');
    const menu = document.getElementById('mobileMenu');
    const backdrop = document.getElementById('mobileBackdrop');
    const closeBtn = document.getElementById('mobileCloseBtn');

    function openMenu() {
        if (!menu || !backdrop) return;
        menu.classList.add('open');
        backdrop.classList.add('show');
        document.body.style.overflow = 'hidden';
    }

    function closeMenu() {
        if (!menu || !backdrop) return;
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

    /* ================= REVEAL ON SCROLL ================= */
    const revealEls = document.querySelectorAll('[data-reveal]');

    if ('IntersectionObserver' in window) {
        const observer = new IntersectionObserver(
            entries => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                        observer.unobserve(entry.target);
                    }
                });
            },
            {
                threshold: 0.15
            }
        );

        revealEls.forEach(el => observer.observe(el));
    } else {
        revealEls.forEach(el => el.classList.add('visible'));
    }

    /* ================= TEAM FILTER ================= */
    const filterChips = document.querySelectorAll('.team-filter-chip');
    const teamCards   = document.querySelectorAll('.team-card');

    if (filterChips.length && teamCards.length) {
        filterChips.forEach(chip => {
            chip.addEventListener('click', () => {
                const filter = chip.getAttribute('data-team-filter');

                // toggle chip aktif
                filterChips.forEach(c => c.classList.remove('active'));
                chip.classList.add('active');

                // filter kartu
                teamCards.forEach(card => {
                    const role = card.getAttribute('data-team-role');

                    if (filter === 'all' || role === filter) {
                        card.classList.remove('team-card--dimmed');
                    } else {
                        card.classList.add('team-card--dimmed');
                    }
                });
            });
        });
    }
});
