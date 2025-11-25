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

    /* ================= NAVBAR ACTIVE / SCROLL SPY ================= */

    const navLinks = document.querySelectorAll('.navbar-link');
    const sections = document.querySelectorAll('section[id]');

    function setActiveNavBySectionId(id) {
        navLinks.forEach(link => {
            if (link.dataset.section === id) {
                link.classList.add('active');
            } else {
                link.classList.remove('active');
            }
        });
    }

    // Scroll spy dengan IntersectionObserver
    if ('IntersectionObserver' in window && sections.length && navLinks.length) {
        const navObserver = new IntersectionObserver(
            entries => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const id = entry.target.id;
                        setActiveNavBySectionId(id);
                    }
                });
            },
            {
                threshold: 0.5,                // 50% section terlihat
                rootMargin: '-80px 0px 0px 0px' // offset untuk tinggi navbar
            }
        );

        sections.forEach(section => navObserver.observe(section));
    }

    // Smooth scroll untuk link yang pakai #
    document.querySelectorAll('.navbar-link[href^="#"], .mobile-link[href^="#"]').forEach(link => {
        link.addEventListener('click', e => {
            e.preventDefault();
            const targetId = link.getAttribute('href').substring(1);
            const target = document.getElementById(targetId);
            if (!target) return;

            window.scrollTo({
                top: target.offsetTop - 80, // kompensasi tinggi navbar
                behavior: 'smooth'
            });
        });
    });

       /* ================= NAVBAR UNDERLINE SLIDER ================= */
    const navbarMenu = document.querySelector('.navbar-menu.desktop-only');

    if (navbarMenu) {
        const links = navbarMenu.querySelectorAll('.navbar-link');

        // buat underline kalau belum ada
        let underline = navbarMenu.querySelector('.navbar-underline');
        if (!underline) {
            underline = document.createElement('div');
            underline.className = 'navbar-underline';
            navbarMenu.appendChild(underline);
        }

        // link yang dianggap aktif (default: yang punya .active, kalau tidak ada pakai link pertama)
        let activeLink = navbarMenu.querySelector('.navbar-link.active') || links[0];

        function animateUnderlineTo(target) {
            if (!target) return;

            const rect = target.getBoundingClientRect();
            const menuRect = navbarMenu.getBoundingClientRect();
            const targetLeft = rect.left - menuRect.left;
            const targetWidth = rect.width;

            // posisikan underline di kiri link & reset width ke 0
            underline.style.transition = 'none';
            underline.style.left = `${targetLeft}px`;
            underline.style.width = `0px`;

            // paksa reflow biar animasi width dari 0 → penuh
            void underline.offsetWidth;

            underline.style.transition = 'width 0.25s ease';
            underline.style.width = `${targetWidth}px`;
        }

        // posisi awal (saat page load)
        animateUnderlineTo(activeLink);

        // saat hover: underline ikut ke link yang di-hover
        links.forEach(link => {
            link.addEventListener('mouseenter', () => {
                animateUnderlineTo(link);
            });

            // saat klik: jadikan link ini sebagai .active dan underline menetap di sini
            link.addEventListener('click', () => {
                activeLink = link;
                links.forEach(l => l.classList.remove('active'));
                link.classList.add('active');
                animateUnderlineTo(link);
            });
        });

        // ketika mouse keluar dari area menu, underline kembali ke link aktif
        navbarMenu.addEventListener('mouseleave', () => {
            if (activeLink) animateUnderlineTo(activeLink);
        });

        // jika ukuran window berubah, perbarui posisi underline aktif
        window.addEventListener('resize', () => {
            if (activeLink) animateUnderlineTo(activeLink);
        });
    }



