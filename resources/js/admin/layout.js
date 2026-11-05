// Mobile navigation drawer
const mobileMenuBtn = document.getElementById('mobileMenuBtn');
const mobileNav = document.getElementById('mobileNav');

mobileMenuBtn?.addEventListener('click', () => {
  mobileNav?.classList.toggle('open');
});
