document.addEventListener('DOMContentLoaded', function () {
    const heroSection = document.querySelector('.hero-area.home-three');
    if (heroSection) {
        heroSection.style.position = 'fixed';
        heroSection.style.top = '0';
        heroSection.style.left = '0';
        heroSection.style.width = '100%';
        heroSection.style.zIndex = '100';
    }
});