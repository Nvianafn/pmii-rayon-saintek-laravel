import './bootstrap';

// Sticky navbar shadow on scroll
const hdr = document.getElementById('hdr');
if (hdr) {
    const onScroll = () => hdr.classList.toggle('scrolled', window.scrollY > 20);
    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();
}

// Reveal-on-scroll animation
const io = new IntersectionObserver(
    (entries) => {
        entries.forEach((e) => {
            if (e.isIntersecting) {
                e.target.classList.add('in');
                io.unobserve(e.target);
            }
        });
    },
    { threshold: 0.1 }
);
document.querySelectorAll('.reveal').forEach((el) => io.observe(el));

// Mobile menu toggle
const menuBtn = document.querySelector('.menu-btn');
const mobileNav = document.getElementById('mobile-nav');
if (menuBtn && mobileNav) {
    menuBtn.addEventListener('click', () => mobileNav.classList.toggle('open'));
}

// Simple accordion (kepengurusan per-biro)
document.querySelectorAll('[data-accordion]').forEach((head) => {
    head.addEventListener('click', () => {
        const item = head.closest('.acc-item');
        item?.classList.toggle('open');
    });
});
